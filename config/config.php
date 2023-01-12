<?php

use Illuminate\Support\Facades\App;

return [

    /**
     * URL of hyvor
     * This should be the internal URL for production environments
     */
    'url' => env('HYVOR_URL'),

    /**
     * Public URL to use (mainly for redirections)
     */
    'public_url' => env('HYVOR_URL_PUBLIC', env('HYVOR_URL')),

    /**
     * Hyvor API Key
     */
    'api_key' => env('HYVOR_API_KEY'),

    /**
     * Whether to return dummy results
     */
    'dummy' => App::environment('production') ? false : env('HYVOR_DUMMY', true),


    /**
     * Dummy user ID
     */
    'dummy_user_id' => env('HYVOR_DUMMY_USER_ID', 1),

];