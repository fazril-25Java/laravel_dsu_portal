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

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Allow API and Sanctum routes

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'], // Allow all common HTTP methods

    'allowed_origins' => ['*'], // Allow all origins temporarily for debugging

    'allowed_origins_patterns' => [], // No specific patterns

    'allowed_headers' => ['*'], // Allow all headers

    'exposed_headers' => [], // No exposed headers

    'max_age' => 0, // No caching of preflight responses

    'supports_credentials' => true, // Allow credentials (e.g., cookies, authorization headers)

];