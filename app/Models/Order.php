<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        'user_id',
        'order_code',
        'fullname',
        'email',
        'phone',
        'address',
        'ward',
        'district',
        'city',
        'postal_code',
        'order_total',
        'payment_method',
        'payment_status',
        'order_status',
        'order_note'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
} 