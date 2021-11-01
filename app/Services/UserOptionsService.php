<?php


namespace App\Services;


class UserOptionsService
{
    public static function getOptions($authUser){

        switch ($authUser->role){
            case 'user':
                $newArr = ['user','keeper','agent','client','accountant'];
                break;
            case 'keeper':
                $newArr = ['agent'];
                break;
            case 'agent':
                $newArr = ['client'];
                break;
            default:
                $newArr = [];
                break;
        }
        return $newArr;
    }
}
