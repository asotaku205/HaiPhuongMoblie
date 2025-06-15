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
    
    protected $fillable = ['category_name', 'category_description', 'category_status', 'parent_id'];
    
    // Lấy danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'category_id');
    }
    
    // Lấy các danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }
    
    // Lấy tất cả sản phẩm thuộc danh mục này
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
    
    // Lấy tất cả sản phẩm thuộc danh mục này và các danh mục con
    public function allProducts()
    {
        $categoryIds = $this->getAllChildrenIds();
        $categoryIds[] = $this->category_id;
        
        return Product::whereIn('category_id', $categoryIds);
    }
    
    // Lấy tất cả ID của các danh mục con (bao gồm cả con của con)
    public function getAllChildrenIds()
    {
        $ids = [];
        $this->addChildrenIds($this, $ids);
        return $ids;
    }
    
    private function addChildrenIds($category, &$ids)
    {
        foreach ($category->children as $child) {
            $ids[] = $child->category_id;
            $this->addChildrenIds($child, $ids);
        }
    }
}
