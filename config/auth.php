<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'guard' => 'warga',
        'guard' => 'rt',
        'guard' => 'rw',
        'guard' => 'kades',
        'guard' => 'ordersurat',
        'guard' => 'admin',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'warga' => [
            'driver' => 'jwt',
            'provider' => 'warga',
            'hash' => false,
        ],

        'rt' => [
            'driver' => 'jwt',
            'provider' => 'rt',
            'hash' => false,
        ],

        'rw' => [
            'driver' => 'jwt',
            'provider' => 'rw',
            'hash' => false,
        ],
        'kades' => [
            'driver' => 'jwt',
            'provider' => 'kades',
            'hash' => false,
        ],
        'ordersurat' => [
            'driver' => 'jwt',
            'provider' => 'ordersurat',
            'hash' => false,
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [

        'users' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],
        'warga' => [
            'driver' => 'eloquent',
            'model' => App\Warga::class,
        ],

            'rt' => [
                'driver' => 'eloquent',
                'model' => App\Rt::class,
        ],

        'rw' => [
            'driver' => 'eloquent',
            'model' => App\Rw::class,
        ],
        'kades' => [
            'driver' => 'eloquent',
            'model' => App\Kades::class,
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],

        'ordersurat' => [
            'driver' => 'eloquent',
            'model' => App\OrderSurat::class,
        ],

        // 'rts' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Rt::class,
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'admin' => [
            'provider' => 'admin',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'warga' => [
            'provider' => 'warga',
            'table' => 'password_resets',
            'expire' => 10,
        ],
    ],

];
