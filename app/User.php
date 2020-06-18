<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function deletePicture()
    {
        $path = "user/img/$this->img";
        return unlink($path);
    }

    public function adminlte_image()
    {
        $path = "/img/user/$this->img";
        return $path;
    }

    public function adminlte_desc()
    {
        $desc = 'lorem ipsum dolor sit amaet';
        return $desc;
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }

}
