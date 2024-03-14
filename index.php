<?php
// Start session
session_start();

// Clean redirect buffer
ob_start();

include_once 'connection.php';
include_once 'h-functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo head_html(); ?>
    <title>Login with JWT token</title>
</head>

<body>
    <?php echo header_html(); ?>

    <?php
    // Example of crypt password
    // echo password_hash('BAa1rQAnaDm8tLP', PASSWORD_DEFAULT);

    // Get data from form
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($data);
    if (!empty($data['user']) && !empty($data['password'])) {

        // Verify if user was in DB
        $query_user = "SELECT id, name, user, email, password 
                        FROM users WHERE user = :user LIMIT 1";

        // Prepare query
        $stmt_user = $conn->prepare($query_user);

        // Bind parameters
        $stmt_user->bindParam(':user', $data['user']);

        // Execute query
        $stmt_user->execute();

        if (($stmt_user) && ($stmt_user->rowCount() > 0)) {
            $row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

            $_SESSION['msg'] = "<div id='fade-out' class='alert alert-success text-center' role='alert'>User found!</div>";
            // Set session variable name
            $_SESSION['name'] = $row_user['name'];
            // Verify if password is correct
            if (password_verify($data['password'], $row_user['password'])) {
                $_SESSION['msg'] = "<div id='fade-out' class='alert alert-success text-center' role='alert'>Connected!</div>";

                // JWT was did here. Header + Payload + Signature
                // Header
                $header = [
                    'alg' => 'HS256',
                    'typ' => 'JWT'
                ];
                // Convert to JSON
                $header = json_encode($header);
                // Encode to base64
                $header = base64_encode($header);
                echo "<h6 style='font-size:.5rem;'>Header: $header</h6>";

                // Payload was the body of JWT
                // iss is the domain of the application, creator of token
                // aud is the domain of domain that will use the token
                // exp is the expiration time of token
                if (isset($data['remember']) && $data['remember'] == 'remember-me') {
                    // 7 days; 24 hours; 60 minutes; 60 seconds
                    $expiration = time() + (7 * 24 * 60 * 60);
                } else {
                    // Only for tests, using 6 seconds
                    // Change it to 1 hour
                    $expiration = time() + (6);
                }
                // $expiration = time() + (7 * 24 * 60 * 60);
                // $expiration = time() + (60);

                // Payload
                $payload = [
                    'exp' => $expiration,
                    'id' => $row_user['id'],
                    'name' => $row_user['name'],
                    'user' => $row_user['user']
                ];
                // Convert to JSON
                $payload = json_encode($payload);
                // Encode to base64
                $payload = base64_encode($payload);
                echo "<h6 style='font-size:.5rem;'>Payload: $payload</h6>";

                // Signature
                $secret_key = 'F6F1F37584D8189';
                $signature = hash_hmac('sha256', "$header.$payload", $secret_key, true);
                // Encode to base64
                $signature = base64_encode($signature);
                // Print signature
                echo "<h6 style='font-size:.5rem;'>Signature: $signature</h6>";

                // Print token
                echo "<h6 style='font-size:.5rem;'>Token: $header.$payload.$signature</h6>";

                // Set token in cokkie
                setcookie('token', "$header.$payload.$signature", (time() + (7 * 24 * 60 * 60)));

                // Redirect to home
                header('Location: home.php');
            } else {
                $_SESSION['msg'] = "<div id='fade-out' class='alert alert-danger text-center' role='alert'>Error! User or password incorrect...</div>";
            }
        } else {
            $_SESSION['msg'] = "<div id='fade-out' class='alert alert-danger text-center' role='alert'>Error! User or password incorrect...</div>";
        }
    }

    ?>
    <main class="form-signin col-md-4 col-10 mt-4 mx-auto">
        <form method="POST" action="">

            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <?php
            // Verify if $SESSION['msg'] exists
            if (isset($_SESSION['msg'])) {

                // Print $SESSION['msg']
                echo $_SESSION['msg'];

                // Destroy $SESSION['msg']
                unset($_SESSION['msg']);
            }
            $user = '';
            if (isset($data['user'])) {
                $user = $data['user'];
            } else { // Delete else to use empty user
                $user = 'jr@login.com';
            }
            $password = '';
            if (isset($data['password'])) {
                $password = $data['password'];
            } else { // Delete else to use empty password
                $password = 'BAa1rQAnaDm8tLP';
            }
            ?>


            <div class="form-floating">
                <input type="email" name="user" class="form-control" id="floatingInput" placeholder value="<?php echo $user ?>" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder value="<?php echo $password ?>" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" name="remember" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <div class="text-center">
                <button class="btn btn-primary w-50 py-2" type="submit">Sign in</button>
            </div>            
        </form>
    </main>
    <p class="position-absolute bottom-0 end-0 me-3 text-body-secondary">©Jr-2024</p>
    <script src="script.js"></script>
</body>

</html>