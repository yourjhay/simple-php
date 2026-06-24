<?php

return [
    'name'    => env('APP_NAME', 'simply'),
    'handler' => env('LOG_HANDLER', 'daily'),
    'path'    => env('LOG_PATH', './storage/logs/app.log'),
    'level'   => env('LOG_LEVEL', 'debug'),
    'days'    => 14,
];
