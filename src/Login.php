<?php
namespace Hyvor\HyvorConnecter;

class Login
{

    const AUTH_COOKIE_NAME = 'authsess';

    public static function check() : ?HyvorUser
    {

        if (config('hyvorconnecter.dummy')) {
            return HyvorUser::dummy();
        }

        $cookie = $_COOKIE[self::AUTH_COOKIE_NAME] ?? null;

        if (!$cookie) {
            return null;
        }

        $response = ApiCaller::callEndpoint('/check', [], [
            'Cookie' => self::AUTH_COOKIE_NAME . "=$cookie"
        ]);

        if ($response->successful()) {
            return new HyvorUser($response->json());
        }

        return null;
    }

}
