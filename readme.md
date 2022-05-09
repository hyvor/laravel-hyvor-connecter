# Docs

## Installation

```
composer require hyvor/laravel-hyvor-connecter
```

## Config

Add these to the `.env`

* `HYVOR_URL` - URL of Hyvor. This is internal IP in production. In testing, you may use the local URL.
* `HYVOR_API_KEY` - API Key.
* `HYVOR_DUMMY` - Set this to `true` in development so that dummy data will be return. Therefore, you don't need to have the auth set up and running to test the other application. Login check will always be true when using this.

## Hyvor User Object

The properties of the `HyvorUser` object, which is returned in endpoints.

```php
public int $id;
public string $username;
public string $name;
public string $email;
public ?string $picture_url;
public ?string $location;
public ?string $bio;
public ?string $website_url;
```


## Checking Login

```php
use Hyvor\HyvorConnecter\Login;

$user = Login::check(); // null | HyvorUser
```

## Getting User Data

```php
use Hyvor\HyvorConnecter\Userbase;

// get one from ID (email is not set in the HyvorUser object)
Userbase::fromId($id);

// get one from ID with email
Userbase::fromId($id, true);

// get multiple from ID
Userbase::fromIds([$id1, $id2, ...], bool $email);

Userbase::fromUsername();
Userbase::fromUsernames();
Userbase::fromEmail();
Userbase::fromEmails();
```

## Redirecting to Auth

Return URL will be added automatically so that the user will come back to the page specified after logging in or signing up.

```php
use Hyvor\HyvorConnecter\Redirect;

Redirect::to('account');
Redirect::toLogin();
Redirect::toSignup();
```