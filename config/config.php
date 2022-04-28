<?php

use Illuminate\Support\Facades\App;

return [

    /**
     * Application name
     * Subdomain of the product
     * talk|blogs|...
     */
    'app_name' => env('HYVOR_APP_NAME'),

    /**
     * URL of hyvor
     * This should be the internal URL for production environments
     */
    'url' => env('HYVOR_URL'),


    /**
     * Hyvor API Key
     */
    'api_key' => env('HYVOR_API_KEY'),

    /**
     * Whether to return dummy results
     */
    'dummy' => App::environment('production') ? false : env('HYVOR_DUMMY', true)

];