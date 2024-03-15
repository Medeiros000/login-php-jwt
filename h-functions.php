<?php 

function head_html(){
    return '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        ';
}

function header_html(string $name = 'Guest'){
    return '
        <div class="cover-container d-flex w-100 p-3 mx-auto mt-4 flex-column">
            <header class="mb-auto bg-secondary p-2 border border-5 rounded">
                <div>
                    <h3 class="float-md-start mb-0">Dashboard '.$name.'</h3>
                    <nav class="nav nav-masthead justify-content-center float-md-end">
                        <a class="nav-link fw-bold text-white py-1 px-1 active" aria-current="page" href="home.php">Home</a>
                        <a class="nav-link fw-bold text-white py-1 px-1" href="features.php">Features</a>
                        <a class="nav-link fw-bold text-white py-1 px-1" href="contact.php">Contact</a>
                        <a class="nav-link fw-bold text-white py-1 px-1" href="logout.php">Logout</a>
                    </nav>
                </div>
            </header>
        ';
}
?>