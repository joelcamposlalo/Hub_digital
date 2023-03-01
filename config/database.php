<?php

use Illuminate\Support\Str;

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

    'default' => env('DB_CONNECTION', 'pgsql'),

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
            'driver'                    => 'sqlite',
            'url'                       => env('DATABASE_URL'),
            'database'                  => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix'                    => '',
            'foreign_key_constraints'   => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver'                    => 'mysql',
            'url'                       => env('DATABASE_URL'),
            'host'                      => env('DB_HOST', '127.0.0.1'),
            'port'                      => env('DB_PORT', '3306'),
            'database'                  => env('DB_DATABASE', 'forge'),
            'username'                  => env('DB_USERNAME', 'forge'),
            'password'                  => env('DB_PASSWORD', ''),
            'unix_socket'               => env('DB_SOCKET', ''),
            'charset'                   => 'utf8mb4',
            'collation'                 => 'utf8mb4_unicode_ci',
            'prefix'                    => '',
            'prefix_indexes'            => true,
            'strict'                    => true,
            'engine'                    => null,
            'options'                   => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA  => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver'            => 'pgsql',
            'host'              => env('DB_HOST', '172.16.4.15'),
            'port'              => env('DB_PORT', '5432'),
            'database'          => env('DB_DATABASE', 'vdigital'),
            'username'          => env('DB_USERNAME', 'usr_ventanilla'),
            'password'          => env('DB_PASSWORD', '19V3ntanill4'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
            'schema'            => 'public',
            'sslmode'           => 'prefer',
        ],

        'acreditaciones' => [
            'driver'            => 'pgsql',
            'host'              => env('DB_HOST_ACREDITACIONES', '172.16.4.15'),
            'port'              => env('DB_PORT_ACREDITACIONES', '5432'),
            'database'          => env('DB_DATABASE_ACREDITACIONES', 'Acreditaciones'),
            'username'          => env('DB_USERNAME_ACREDITACIONES', 'usr_ventanilla'),
            'password'          => env('DB_PASSWORD_ACREDITACIONES', '19V3ntanill4'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
            'schema'            => 'public',
            'sslmode'           => 'prefer',
        ],

        'catastro' => [
            'driver'            => 'pgsql',
            'host'              => env('DB_HOST_CATASTRO', '192.168.20.123'),
            'port'              => env('DB_PORT_CATASTRO', '5432'),
            'database'          => env('DB_DATABASE_CATASTRO', 'zapopan_prod'),
            'username'          => env('DB_USERNAME_CATASTRO', 'gev'),
            'password'          => env('DB_PASSWORD_CATASTRO', 'jU5QbHhHtdanNjk5GX4Q'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
            'schema'            => 'public',
            'sslmode'           => 'prefer',
        ],

        'geo' => [
            'driver'            => 'pgsql',
            'host'              => env('DB_HOST_CATASTRO', '10.10.23.78'),
            'port'              => env('DB_PORT_CATASTRO', '5432'),
            'database'          => env('DB_DATABASE_CATASTRO', 'zapopan_geo_pg'),
            'username'          => env('DB_USERNAME_CATASTRO', 'geo_wms_coneccion_r'),
            'password'          => env('DB_PASSWORD_CATASTRO', 'g30matiK@*20i9'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
            'schema'            => 'public',
            'sslmode'           => 'prefer',
        ],


        'sqlsrv' => [
            'driver'            => 'sqlsrv',
            'url'               => env('DATABASE_URL'),
            'host'              => env('DB_HOST', 'localhost'),
            'port'              => env('DB_PORT', '1433'),
            'database'          => env('DB_DATABASE', 'forge'),
            'username'          => env('DB_USERNAME', 'forge'),
            'password'          => env('DB_PASSWORD', ''),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
        ],

        'tramites_op' => [
            'driver'            => 'sqlsrv',
            'host'              => env('DB_HOST_OP_TRAM', '172.16.4.75'),
            'port'              => env('DB_PORT_OP_TRAM', '1433'),
            'database'          => env('DB_DATABASE_OP_TRAM', 'Tramites'),
            'username'          => env('DB_USERNAME_OP_TRAM', 'usr_tramitesOP'),
            'password'          => env('DB_PASSWORD_OP_TRAM', '87654321'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
        ],

        'pyl' => [
            'driver'            => 'sqlsrv',
            'host'              => env('DB_HOSTDB_CONNECTION_PYL', '172.16.4.26'),
            'port'              => env('DB_PORT_PYL', '1433'),
            'database'          => env('DB_DATABASE_PYL', 'zapopan2006'),
            'username'          => env('DB_USERNAME_PYL', 'usr_gpm'),
            'password'          => env('DB_PASSWORD_PYL', 'Abcd1234'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
        ],

        'parkimetros' => [
            'driver'            => 'sqlsrv',
            'host'              => env('DB_HOSTDB_CONNECTION_PARKY', '172.16.4.65'),
            'port'              => env('DB_PORT_PARKY', '1433'),
            'database'          => env('DB_DATABASE_PARKY', 'Parkimetros'),
            'username'          => env('DB_USERNAME_PARKY', 'usr_ws'),
            'password'          => env('DB_PASSWORD_PARKY', 'park1%_M'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
        ],

        'sir' => [
            'driver'            => 'sqlsrv',
            'host'              => env('DB_CONNECTION_SIR', '10.10.23.73'),
            'port'              => env('DB_PORT_SIR', '1433'),
            'database'          => env('DB_DATABASE_SIR', 'SIR_ZapopanPruebas'),
            'username'          => env('DB_USERNAME_SIR', 'usr_test'),
            'password'          => env('DB_PASSWORD_SIR', '_Z4p0p4n$#2021_'),
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
        ],

        'captura_op' => [
            'driver'            => 'sqlsrv',
            'host'              => '172.16.4.15',
            'port'              => '1433',
            'database'          => 'CapturaWeb',
            'username'          => 'usr_tramitesOP',
            'password'          => '87654321',
            'charset'           => 'utf8',
            'prefix'            => '',
            'prefix_indexes'    => true,
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
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
