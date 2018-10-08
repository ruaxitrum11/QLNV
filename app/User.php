<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name' , 'password', 'permission_id', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hashPassword($password)
    {
        $this->attributes['password']=bcrypt($password);
    }

    public function permission()
    {
        return $this->hasOne(permission::class, 'id', 'permission_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class,'user_id','id');
    }

    public function isManager(){
        if($this->permission_id===2){
            return true;
        }else {
            return false;
        }
    }

//    public function authorizePermission($permissions)
//    {
//        if(is_array($permissions)){
//            return $this->hasAnyPermission($permissions);
//        }
//        return $this->hasPermission($permissions);
//    }
//
//    public function hasAnyPermission($permissions)
//    {
////        dd($permissions);
//        return null !== $this->permissions()->whereIn('name',$permissions);
//    }
//    public function hasPermission($permissions)
//    {
//        return null !== $this->permissions()->where('name', $permissions);
//    }

}
