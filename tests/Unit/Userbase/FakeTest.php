<?php

namespace Hyvor\HyvorConnecter\Tests\Unit\Userbase;

use Hyvor\HyvorConnecter\HyvorUser;
use Hyvor\HyvorConnecter\Userbase;

it('searches by id', function() {

    Userbase::fake([
        [
            'id' => 1
        ],
        [
            'id' => 2
        ],
        [
            'id' => 3
        ]
    ]);

    $hyvor = Userbase::fromId(1);
    expect($hyvor)->toBeInstanceOf(HyvorUser::class);
    expect($hyvor->id)->toBe(1);
    expect(Userbase::fromId(2))->toBeInstanceOf(HyvorUser::class);
    expect(Userbase::fromId(4))->toBeNull();

});


it('searches by ids', function() {

    Userbase::fake([
        [
            'id' => 1
        ],
        [
            'id' => 2
        ],
        [
            'id' => 3
        ]
    ]);

    $users = Userbase::fromIds([2,3]);

    expect(count($users))->toBe(2);
    expect($users)->each->toBeInstanceOf(HyvorUser::class);

});

it('searches by username', function() {

    Userbase::fake([
        [
            'username' => 'Hyvor'
        ],
        [
            'username' => 'Supun'
        ],
        [
            'username' => 'WOw'
        ]
    ]);

    $hyvor = Userbase::fromUsername('Hyvor');
    expect($hyvor)->toBeInstanceOf(HyvorUser::class);
    expect($hyvor->username)->toBe('Hyvor');
    expect(Userbase::fromUsername('Supun'))->toBeInstanceOf(HyvorUser::class);
    expect(Userbase::fromUsername('Someone else'))->toBeNull();

});

it('searches by usernames', function() {

    Userbase::fake([
        [
            'username' => 'Hyvor'
        ],
        [
            'username' => 'Supun'
        ],
        [
            'username' => 'WOw'
        ]
    ]);

    $users = Userbase::fromUsernames(['Hyvor', 'Supun']);

    expect(count($users))->toBe(2);
    expect($users)->each->toBeInstanceOf(HyvorUser::class);

});

it('searches by email', function() {

    Userbase::fake([
        [
            'email' => 'supun@hyvor.com'
        ],
        [
            'email' => 'hello@hyvor.com'
        ],
        [
            'email' => 'contact@hyvor.com'
        ]
    ]);

    $hyvor = Userbase::fromEmail('supun@hyvor.com');
    expect($hyvor)->toBeInstanceOf(HyvorUser::class);
    expect($hyvor->email)->toBe('supun@hyvor.com');
    expect(Userbase::fromEmail('hello@hyvor.com'))->toBeInstanceOf(HyvorUser::class);
    expect(Userbase::fromEmail('nope@hyvor.com'))->toBeNull();

});

it('searches by emails', function() {

    Userbase::fake([
        [
            'email' => 'supun@hyvor.com'
        ],
        [
            'email' => 'hello@hyvor.com'
        ],
        [
            'email' => 'contact@hyvor.com'
        ]
    ]);

    $users = Userbase::fromEmails(['supun@hyvor.com', 'hello@hyvor.com']);

    expect(count($users))->toBe(2);
    expect($users)->each->toBeInstanceOf(HyvorUser::class);

});