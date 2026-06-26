<?php

return [
    'show_errors'          => env('SHOW_ERRORS', true),
    'error_handler'        => env('ERROR_HANDLER', 'whoops'),
    'csp_policy'           => env('CSP_POLICY', "default-src 'self'"),
    'rate_limit_max'       => env('RATE_LIMIT_MAX_ATTEMPTS', 5),
    'rate_limit_decay'     => env('RATE_LIMIT_DECAY_SECONDS', 60),
    'rate_limit_storage'   => env('RATE_LIMIT_STORAGE', '../app/storage/framework/rate-limit'),
];
