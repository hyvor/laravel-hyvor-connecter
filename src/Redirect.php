<?php
namespace Hyvor\HyvorConnecter;

class Redirect {

    public static function to($page = 'login', $redirectPage = null) {

        $pos = strpos($page, '?');
        $placeholder = $pos === false ? '?' : '&';
        
        $redirect = '';

        if ($redirectPage === null) {
            $redirectPage = $_SERVER['REQUEST_URI'];
        }
    
        $redirect = $placeholder . 'redirect=' . 
            urlencode('https://' .  $_SERVER['HTTP_HOST'] . $redirectPage);

        redirect( 
            config('hyvor.auth_url') . 
            '/' . 
            $page .
            $redirect
        );
	}

}