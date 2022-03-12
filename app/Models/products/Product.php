<?php

namespace App\Models\products;

use App\Models\order\Order;
use App\Models\users\Merchant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at'  => 'date:Y-m-d',
    ];


    /**
     * return all orders for specific products (relation).
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_items')->withPivot(['quantity','created_at']);
    }

    public function merchant () {
        return $this->belongsTo(Merchant::class);
    }

}
