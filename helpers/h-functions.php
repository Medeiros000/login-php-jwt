<?php
include_once 'logs.php';

function h_head(string $title, string $content = null)
{
	$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';

	return '
      <!DOCTYPE html>
      <html lang="en" data-bs-theme="' . $theme . '">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        ' . $content . '         
        <title>' . $title . '</title>
      </head>
        ';
}
function h_header(string $name = 'Guest')
{
	$page = isset($_COOKIE['token']) ? 'Logout' : 'Login';
	return '
      <div class="cover-container d-flex w-100 p-3 mx-auto mt-4 flex-column">
        <header class="mb-auto bg-secondary p-2 border border-5 rounded">
          <div>
            <h3 class="float-md-start mb-0">Dashboard ' . $name . '</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
              <a class="nav-link fw-bold text-white py-1 px-1 active" aria-current="page" href="index.php">Home</a>
              <a class="nav-link fw-bold text-white py-1 px-1" href="features.php">Features</a>
              <a class="nav-link fw-bold text-white py-1 px-1" href="contact.php">Contact</a>
              <a class="nav-link fw-bold text-white py-1 px-1" href="' . strtolower($page) . '.php">' . $page . '</a>
            </nav>
          </div>
        </header>
      </div>
      ';
}


// Button to change theme
function footer_theme()
{
	return '
      <span class="position-fixed bottom-0 end-0 me-3 text-body-secondary">
          ©Jr-' . date('Y') . '
          <button id="theme" class="btn " type="button">🌓</button>
      </span>
        ';
}

// Script function
function script()
{
	return '<script src="js/script.js"></script>';
}


/**
 * Function to create a alert message
 * 
 * @param string $msg
 * @param string $type It'll return a message with danger color 
 * and success will return a message with success color for example
 * @return string html
 * @template echo h_alert('This is a alert message', 'success');
 */
function h_alert(string $msg, string $type = 'danger')
{
	return  '
      <div style="width: 15rem;" id="fade-out" class="toast z-3 show position-absolute start-50 translate-middle bg-' . $type . '">
        <div class="toast-body d-flex justify-content-between">
          <p class="d-inline my-auto fw-semibold">' . $msg . '</p><button type="button" class="btn-close d-inline my-auto" data-bs-dismiss="toast"></button>
        </div>
      </div>
          ';
}

function h_css(string $path)
{
	return '<link rel="stylesheet" href="' . $path . '">';
}

function h_js(string $path)
{
	return '<script src="' . $path . '"></script>';
}
