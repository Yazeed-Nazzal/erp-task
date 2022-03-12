<?php

namespace App\Models\order;

use App\Models\products\Product;
use App\Models\users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at'  => 'date:Y-m-d',
    ];

    /**
     * get all products that belong to order instance  (relation)
     *
     * @return Product
     */
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_items')->withPivot(['quantity','created_at']);
    }

    /**
     * get all user who prepare this order
     *
     * @return User
     */
    public function user() {

        return $this->belongsTo(User::class);

    }
}
