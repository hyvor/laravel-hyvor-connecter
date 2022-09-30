<?php
namespace Hyvor\HyvorConnecter;

use Illuminate\Support\Collection;

class Userbase
{

    /**
     * If $FAKE is set, dummy will be searched from this collection
     * Results will only be returned if the search is matched
     *
     * @var Collection|null
     */
    public static ?Collection $FAKE = null;

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

        if (config('hyvorconnecter.dummy')) {
            return self::returnDummyMulti('id', $ids);
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

        if (config('hyvorconnecter.dummy')) {
            return self::returnDummySingle('id', $id);
        }

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

        if (config('hyvorconnecter.dummy')) {
            return self::returnDummyMulti('username', $usernames);
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

        if (config('hyvorconnecter.dummy')) {
            return self::returnDummySingle('username', $username);
        }

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
        if (config('hyvorconnecter.dummy')) {
            return self::returnDummyMulti('email', $emails);
        }

        $response = ApiCaller::callEndpoint('/users/from/emails', [
            'emails' => implode(',', $emails)
        ]);

        if ($response->successful()) {
            $users = collect($response->json());
            return $users->map(fn($user) => new HyvorUser(
                $user,
                /**
                 * Emails were already sent, so no matter of having them again
                 * Usually, this endpoint is called for internal work
                 */
                true)
            );
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

        if (config('hyvorconnecter.dummy')) {
            return self::returnDummySingle('email', $email);
        }

        $users = self::fromEmails([$email]);

        return $users->get($email);

    }

    /**
     * Returns
     * @param string $type 'email' or 'username'
     * @param string|int $value
     * @return HyvorUser|null
     */
    public static function returnDummySingle(string $type, string|int $value) : ?HyvorUser
    {
        if (self::$FAKE) { //  If $FAKE is set, search from it
            $fake = self::$FAKE->firstWhere($type, $value);
            return $fake ? HyvorUser::dummy($fake) : null;
        }
        return HyvorUser::dummy([$type => $value]);
    }

    public static function returnDummyMulti(string $type, array $values) : Collection
    {
        if (self::$FAKE) {
            $matches = self::$FAKE->whereIn($type, $values);
            return $matches
                ->map(fn($match) => HyvorUser::dummy($match))
                ->keyBy($type);
        }
        return collect($values)
            ->map(fn($value) => HyvorUser::dummy([$type => $value]))
            ->keyBy($type);
    }


    /**
     * Set fake data for userbase
     *
     */
    public static function fake(array $users)
    {
        self::$FAKE = collect($users);
    }

}
