<?php
namespace Hyvor\HyvorConnecter;

use Illuminate\Support\Collection;

class Userbase
{

    /**
     * Get multiple users by ID
     *
     * $extra = location, bio, url
     * $email = user's email address
     *
     * @param array<int> $ids
     * @param bool $email
     * @return Collection<int, HyvorUser>
     */
    public static function fromIds(array $ids, bool $email = false) : Collection
    {

        // return dummy
        if (config('hyvorconnecter.dummy'))
        {
            return collect($ids)->map(fn($id) => HyvorUser::dummy(['id' => $id]));
        }

        $response = ApiCaller::callEndpoint('/users/from/ids', [
            'ids' => implode(',', $ids)
        ]);

        if ($response->successful()) {
            $users = collect($response->json());
            return $users->map(fn($user) => new HyvorUser($user, $email));
        }

        return collect([]);
    }

    /**
     * Get a single user by ID
     *
     * @param int $id
     * @param bool $email
     * @return HyvorUser|null
     */
    public static function fromId(int $id, bool $email = false) : ?HyvorUser
    {

        $users = self::fromIds([$id], $email);

        return $users->get($id);
    }


    /**
     * @param array<string> $usernames
     * @param bool $email
     * @return Collection
     */
    public static function fromUsernames(array $usernames, bool $email = false) : Collection
    {
        // return dummy
        if (config('hyvorconnecter.dummy'))
        {
            collect($usernames)->map(fn($username) => HyvorUser::dummy(['username' => $username]));
        }

        $response = ApiCaller::callEndpoint('/users/from/usernames', [
            'usernames' => implode(',', $usernames)
        ]);

        if ($response->successful()) {
            $users = collect($response->json());
            return $users->map(fn($user) => new HyvorUser($user, $email));
        }

        return collect([]);

    }


    /**
     * Get a single user by username
     *
     * @param string $username
     * @param bool $email
     * @return HyvorUser|null
     */
    public static function fromUsername(string $username, bool $email = false) : ?HyvorUser
    {

        $users = self::fromUsernames([$username], $email);

        return $users->get($username);
    }


    /**
     * @param array<string> $emails
     * @return Collection
     */
    public static function fromEmails(array $emails) : Collection
    {

        // return dummy
        if (config('hyvorconnecter.dummy'))
        {
            collect($emails)->map(fn($email) => HyvorUser::dummy(['email' => $email]));
        }

        $response = ApiCaller::callEndpoint('/users/from/emails', [
            'emails' => implode(',', $emails)
        ]);

        if ($response->successful()) {
            $users = collect($response->json());
            $users->map(fn($user) => new HyvorUser(
                $user,
                /**
                 * Emails were already sent, so no matter of having them again
                 * Usually, this endpoint is called for internal work
                 */
                true)
            );
            return $users;
        }

        return collect([]);
    }


    /**
     * Get a single user by email
     *
     * @param string $email
     * @return HyvorUser|null
     */
    public static function fromEmail(string $email) : ?HyvorUser
    {

        if (config('hyvorconnecter.dummy'))
        {
            return HyvorUser::dummy(['email' => $email]);
        }

        $users = self::fromEmails([$email]);

        return $users->get($email);

    }

}
