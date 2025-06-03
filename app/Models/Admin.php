<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'admusername',
        'admemail',
        'admphone',
        'admpassword',
    ];

    protected $hidden = [
        'admpassword',
        'remember_token',
    ];
    public function getAuthPassword()
    {
        return $this->admpassword;
    }

    

    // Đổi tên trường mặc định username thành admusername
    public function username()
    {
        return 'admusername';
    }
}