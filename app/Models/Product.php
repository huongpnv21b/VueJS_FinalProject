<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\Order;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    public $table="products";
    // public $timestamps = false;

    protected $fillable = [
        'name','category_id','price', 'units', 'description', 'image'
    ];

    function category()
    {
     return $this->belongsTo('App\Models\Category','category_id','id');
    }
    public function order() {
        return $this->hasMany(Order::class);
    }

}
