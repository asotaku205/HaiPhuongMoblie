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
        'product_images',
        'product_status',
        'stock_quantity',
        'in_stock',
        'product_specs',
        'color',
        'capacity'
    ];
    
    protected $casts = [
        'product_specs' => 'array',
        'product_images' => 'array',
        'in_stock' => 'boolean',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'product_id');
    }
    
    /**
     * Lấy danh sách màu có sẵn cho sản phẩm
     * 
     * @return array Danh sách các màu sắc có thể có của sản phẩm 
     */
    public function getAvailableColors()
    {
        // Nếu màu được lưu dưới dạng một màu duy nhất
        if ($this->color) {
            return [$this->color];
        }
        
        // Nếu thông số kỹ thuật có chứa màu sắc
        if ($this->product_specs && isset($this->product_specs['Màu sắc'])) {
            $colors = $this->product_specs['Màu sắc'];
            if (is_string($colors) && strpos($colors, ',') !== false) {
                return array_map('trim', explode(',', $colors));
            }
        }
        
        return [];
    }
}
