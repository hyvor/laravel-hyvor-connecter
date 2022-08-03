<?php

namespace Hyvor\HyvorConnecter\Tests\Unit;

use Hyvor\HyvorConnecter\Redirect;

it('redirects correctly', function() {

    $domain = 'https://hyvor.com';
    config(['hyvorconnecter.public_url' => $domain]);

    $redirect = Redirect::to('somewhere');

    expect($redirect->getTargetUrl())->toStartWith("$domain/somewhere?redirect=");

});