<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_1' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_ONE_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_ONE_PORT', '3306'),
            'database' => env('DB_SLAVE_ONE_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_ONE_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_ONE_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_2' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_TWO_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_TWO_PORT', '3306'),
            'database' => env('DB_SLAVE_TWO_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_TWO_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_TWO_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_3' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_THREE_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_THREE_PORT', '3306'),
            'database' => env('DB_SLAVE_THREE_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_THREE_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_THREE_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_4' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_FOUR_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_FOUR_PORT', '3306'),
            'database' => env('DB_SLAVE_FOUR_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_FOUR_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_FOUR_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_5' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_FIVE_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_FIVE_PORT', '3306'),
            'database' => env('DB_SLAVE_FIVE_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_FIVE_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_FIVE_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_6' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_SIX_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_SIX_PORT', '3306'),
            'database' => env('DB_SLAVE_SIX_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_SIX_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_SIX_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_7' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_SEVEN_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_SEVEN_PORT', '3306'),
            'database' => env('DB_SLAVE_SEVEN_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_SEVEN_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_SEVEN_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_8' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_EIGHT_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_EIGHT_PORT', '3306'),
            'database' => env('DB_SLAVE_EIGHT_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_EIGHT_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_EIGHT_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_9' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_NINE_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_NINE_PORT', '3306'),
            'database' => env('DB_SLAVE_NINE_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_NINE_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_NINE_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'slave_10' => [
            'driver' => 'mysql',
            'host' => env('DB_SLAVE_TEN_HOST_CENTRAL', '127.0.0.1'),
            'port' => env('DB_SLAVE_TEN_PORT', '3306'),
            'database' => env('DB_SLAVE_TEN_DATABASE', 'forge'),
            'username' => env('DB_SLAVE_TEN_USERNAME', 'forge'),
            'password' => env('DB_SLAVE_TEN_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
