<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Backpack\CRUD\CrudTrait; 

class User extends Authenticatable
{
    use Notifiable;

    use HasApiTokens, Notifiable;
    
    use HasRoles, CrudTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function rooms()
    {
        return $this->hasMany('App\room','assigned_to','id');
    }
    
     public function room()
    {
        return $this->hasMany('App\Models\Room','assigned_to','id');
    }
    
    
}
