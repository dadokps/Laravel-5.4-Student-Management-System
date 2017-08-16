<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'active', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->role->name)) ? true : null;
    }

    public function hasRole($roles)
    {
        if(is_array($roles))
        {
            foreach ($roles as $need_role) {
                if($this->checkIfUserHasRole($need_role))
                {
                    return true;
                }
            }
        } else {
            $this->checkIfUserHasRole($roles);
        }
        return false;
    }

}
