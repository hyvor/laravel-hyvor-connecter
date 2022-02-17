<?php
namespace Hyvor\HyvorConnecter;

use Illuminate\Support\Facades\App;

class Login {

    const AUTH_COOKIE_NAME = 'authsess';

    public static function check() : User|false {

        if (App::environment('local')) {
            return User::dummy();
        }

        $cookie = $_COOKIE[self::AUTH_COOKIE_NAME] ?? null;

        if (!$cookie) {
            return false;
        }

        $response = ApiCaller::callEndpoint('/check', [], [
            'Cookie' => "authsess:$cookie"
        ]);

        if ($response->successful()) {
            return new User($response->json());
        }

        return false;

    }

}
