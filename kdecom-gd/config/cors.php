<?php

return [
    'paths' => ['api/*', 'broadcasting/auth', 'pusher/auth'],
    'supports_credentials' => true,
    'allowed_origins' => ['*'],
    'allowed_origins_patterns' => [],
    'allowed_methods' => ['*'],
    'allowed_headers' => ['*'],
    'expose_headers' => [],
    'max_age' => 0,
];
