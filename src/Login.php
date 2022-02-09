<?php
namespace Hyvor\HyvorConnecter;

class Login {

    const AUTH_COOKIE_NAME = 'authsess';

    public static function check() : User|false {

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
