<?php


namespace App\Services;


use App\Models\User;

class ChildService
{
    public static function getChilds($user_id){
        $user = User::find($user_id);
    }
}
