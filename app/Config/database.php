<?php

return [
    'engine'    => env('DBENGINE', 'mysql'),
    'server'    => env('DBSERVER', 'localhost'),
    'name'      => env('DBNAME', 'simply'),
    'user'      => env('DBUSER', 'root'),
    'pass'      => env('DBPASS', ''),
    'test_mode' => env('DBTESTMODE', false),
];
