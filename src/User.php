<?php
namespace Hyvor\HyvorConnecter;

/**
 * Properties are same as hyvor's UserObject.php
 */

class User {

    public int $id;
    public string $username;
    public string $name;
    public string $email;
    public ?string $picture;
    public ?string $location;
    public ?string $bio;
    public ?string $url;

    /**
     * Convert API response to object
     * 
     * @param $user = object from API response
     */
    public function __construct(array $user) {

        $this->id = $user['id'];
        $this->username = $user['username'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->picture = $user['picture'] ?? null;
        $this->location = $user['location'] ?? null;
        $this->bio = $user['bio'] ?? null;
        $this->url = $user['url'] ?? null;

    }

    public static function dummy() {
        return new self([
            'id' => 1,
            'username' => 'test',
            'name' => 'Test',
            'email' => 'test@hyvor.com',
        ]);
    }


}