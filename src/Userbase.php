<?php
namespace Hyvor\HyvorConnecter;

use Illuminate\Support\Collection;

class Userbase {

    /**
     * Get multiple users by ID
     * 
     * $extra = location, bio, url
     * $email = user's email address
     * 
     * @return User[]
     */
    public static function fromIds(array $ids, $extra = false, $email = false) : Collection {

        $response = ApiCaller::callEndpoint('/users/from/ids', [
            'ids' => implode(',', $ids),
            'extra' => $extra,
            'email' => $email,
        ]);

        if ($response->successful()) {

            $json = $response->json();
            foreach ($json as $id => &$user) {
                $user = new User((array) $user);
            }

            return $json;

        }

        return [];
    }

    /**
     * Get a single user by ID
     */
    public static function fromId(int $id, $extra = false, $email = false) {
        $data = self::fromIds([$id], $extra, $email);
        return $data[$id] ?? null;
    }




}