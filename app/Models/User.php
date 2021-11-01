<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject{
    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    //roles, their names, level, and features
    //'viewing_users': subsidiary, all
    const ROLE
        = [
            'admin'           => [
                'name'         => 'Administrator',
                'level'        => 100,                                                                                                                                        /*all,my,my_client's*/
                'capabilities' => ['viewing_users' => 'all', 'user_baned', 'user_delete', 'user_edit', 'user_create' => 'all', 'project_create', 'checkTT_project','addNews','viewing_project'=>'all']
            ],
            'accountant'      => [
                'name'         => 'Accountant',
                'level'        => 90,
                'capabilities' => ['viewing_users' => 'all']
            ],
            'account_manager' => [
                'name'         => 'Account Manager',
                'level'        => 40,
                'capabilities' => ['user_create' => ['agent'], 'project_create']
            ],
            'agent'           => [
                'name'         => 'Agent',
                'level'        => 40,
                'capabilities' => ['user_create' => ['client', 'customer'], 'project_create']
            ],
            'client'          => [
                'name'         => 'Client',
                'level'        => 40,
                'capabilities' => []
            ],
            'customer'        => [
                'name'         => 'Customer',
                'level'        => 40,
                'capabilities' => []
            ],
            'project_manager' => [
                'name'         => 'Project Manager',
                'level'        => 40,
                'capabilities' => ['viewing_users' => 'client_of_the_parent']
            ],
            'keeper'          => [
                'name'         => 'Keeper',
                'level'        => 40,
                'capabilities' => ['user_create' => ['agent', 'client', 'customer']]
            ]
        ];

    public static function getEditRole()
    {

        $roleListName = self::isAllowed('user_create');
        $role         = self::getUserRole(auth()->user()->role);
        if($roleListName == 'all') {
            return $role;
        } else {
            $roleList = [];
            foreach($roleListName as $item) {
                $roleList[$item] = $role[$item];
            }
            return $roleList;
        }

    }

    public static function getUserRole($role)
    {
        $newArr = [];
        if($role == 'keeper') {
            foreach(self::ROLE as $key => $role) {
                if($key == 'agent' || $key == 'client' || $key == 'customer') {
                    $newArr[$key] = $role;
                }
            }
            return $newArr;
        } else if($role == 'account_manager') {
            foreach(self::ROLE as $key => $role) {
                if($key == 'agent') {
                    $newArr[$key] = $role;
                }
            }
            return $newArr;
        } else if($role == 'agent') {
            foreach(self::ROLE as $key => $role) {
                if($key == 'client' || $key == 'customer') {
                    $newArr[$key] = $role;
                }
            }
            return $newArr;
        } else {
            return self::ROLE;
        }

    }

    public static function isAllowed($capabilities)
    {
        $cap = self::ROLE[auth()->user()->role]['capabilities'];
        if(isset($cap[$capabilities])) {
            return $cap[$capabilities];
        } else {
            return in_array($capabilities, $cap);
        }
    }

    public static function getList()
    {
        switch(self::isAllowed('viewing_users')) {
            case 'all':
                return self::get()->groupBy('role');
                break;
            case 'subsidiary':
                return $users = self::where('parent_id', Auth::id())->get()->groupBy('role');
                break;
            case 'client_of_the_parent':
                return $users = self::where('parent_id', Auth::user()->parent_id)->Where('role', 'client')->get()->groupBy('role');

        }


    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded    = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password', 'remember_token',
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];



}
