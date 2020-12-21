<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'address',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee(){
        return $this->belongsTo('App\Models\Employee');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    //many roles can belong to a user
    public function roles(){
        return $this -> belongsToMany('App\Models\Role', 'user_role');
    }

    public function authorizeRoles($roles){
        if(is_array($roles)){
            return $this->hasAnyRole($roles);
        }
        return $this->hasRole($roles);
    }

    public function hasAnyRole($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    public function hasRole($role){
        return null !== $this->roles()->where('name', $role)->first();
    }

}
