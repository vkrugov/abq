<?php

namespace App\helpers;

use App\Enums\GenderEnum;
use App\User;

class UserHelper
{
    public static function getInfo(User $user)
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role_id,
            'gender' => GenderEnum::toSelectArray()[$user->gender_id],
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }
}
