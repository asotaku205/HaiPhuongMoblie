<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'blog_id',
        'user_id',
        'admin_id',
        'is_solution'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getAuthorNameAttribute()
    {
        return $this->admin ? $this->admin->fullname : ($this->user ? $this->user->fullname : 'Unknown');
    }

    public function isAdmin()
    {
        return !is_null($this->admin_id);
    }
}
