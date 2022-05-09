<?php
namespace Hyvor\HyvorConnecter;

class Redirect {

    public static function to($page = 'login', $redirectPage = null)
    {

        $pos = strpos($page, '?');
        $placeholder = $pos === false ? '?' : '&';

        if ($redirectPage === null) {
            $redirectPage = request()->getPathInfo();
        }
    
        $redirect = $placeholder . 'redirect=' . 
            urlencode(request()->getSchemeAndHttpHost() . $redirectPage);

        return redirect(
            config('hyvorconnecter.url') .
            '/' . 
            $page .
            $redirect
        );
	}

    public static function toLogin($redirectPage = null)
    {
        return self::to('login', $redirectPage);
    }

    public static function toSignup($redirectPage = null)
    {
        return self::to('signup', $redirectPage);
    }

}