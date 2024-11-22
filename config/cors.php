<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
    'paths' => ['api/*', 'login/google/callback', 'login/google'],

    'allowed_methods' => ['*'], // Allows all HTTP methods (GET, POST, PUT, DELETE, etc.)
    'allowed_origins' => ['http://127.0.0.1:8000'], // or 'http://localhost:8080' if your frontend runs on a different port
    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Allows all headers


    'exposed_headers' => false,

    'max_age' => 3600, // Cache preflight response for 1 hour

    'supports_credentials' => false,

];
