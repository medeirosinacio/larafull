<?php

namespace App;

use App\Custom\ModelAuthenticate;

class User extends ModelAuthenticate
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'active',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getUrl()
    {
        if ($this->id) {
            return url("/painel/usuarios/{$this->id}/");
        }
    }

}
