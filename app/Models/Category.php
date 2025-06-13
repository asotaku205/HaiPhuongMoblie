<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category_product';
    protected $primaryKey = 'category_id';  
    public $timestamps = true;  
    
    protected $fillable = ['category_name', 'category_description', 'category_status'];
}
