<?php

return array(
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

    'connections' => array(
        'mysql' => array(
            'driver' => 'mysql',
            'host' => 'rdslq6c8ex10slepofzq0.mysql.rds.aliyuncs.com',
            'database' => 'rkx48pp69659taqa',
            'username' => 'rkx48pp69659taqa',
            'password' => 'dianku521',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => 'lottery_',
        )
    ),
);
