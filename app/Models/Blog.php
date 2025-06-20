<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'images',
        'device_type',
        'error_type',
        'status',
        'user_id'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function solutionComment()
    {
        return $this->hasOne(BlogComment::class)->where('is_solution', true);
    }
}
