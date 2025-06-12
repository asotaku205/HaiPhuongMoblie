<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'product_name',
        'category_id',
        'product_description',
        'product_content',
        'product_price',
        'product_image',
        'product_status'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'product_id');
    }
}
