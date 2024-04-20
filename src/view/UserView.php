<?php

declare (strict_types=1);

namespace app\view;

use app\model\User;

class UserView
{
    /** @param array<User> $users */
    public static function showUsers(array $users): void
    {
        /** @var User $user */
        foreach ($users as $user) {
            var_dump($user);
        }
    }
}
