<?php

return [
    'engine'    => env('DBENGINE', 'sqlite'),
    'server'    => env('DBSERVER', 'localhost'),
    'name'      => env('DBNAME', './database/database.db'),
    'user'      => env('DBUSER', 'root'),
    'pass'      => env('DBPASS', ''),
    'test_mode' => env('DBTESTMODE', false),
];
