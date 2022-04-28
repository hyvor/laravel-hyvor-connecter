<?php
namespace Hyvor\HyvorConnecter;

use Faker\Factory;

/**
 * Properties are same as hyvor's UserObject.php
 */

class HyvorUser {

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
    public function __construct(array $user, bool $email = false)
    {

        $this->id = $user['id'];
        $this->username = $user['username'];
        $this->name = $user['name'];
        if ($email) {
            $this->email = $user['email'];
        }
        $this->picture = $user['picture'] ?? null;
        $this->location = $user['location'] ?? null;
        $this->bio = $user['bio'] ?? null;
        $this->url = $user['url'] ?? null;

    }

    public static function dummy($fill = [])
    {

        $faker = Factory::create();
        return new self(array_merge([
            'id' => 1,
            'username' => $faker->username(),
            'name' => $faker->name(),
            'email' => $faker->email(),
            'picture' => $faker->imageUrl(100, 100)
        ], $fill));
    }


}