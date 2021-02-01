<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\Product;


class Order extends Model
{
    use SoftDeletes;

    public $table="orders";
    // public $timestamps= false;

    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'address' 
    ];

  

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }

}
