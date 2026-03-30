<?php
// If the requested file exists, serve it directly
if (file_exists(__DIR__ . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH))) {
    return false;
}

// Otherwise, show your custom 404 page
http_response_code(404);
require __DIR__ . "/404.php";
