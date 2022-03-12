<?php

namespace Database\Seeders;

use App\Models\order\Order;
use App\Models\products\Product;
use App\Models\users\Merchant;
use App\Models\users\User;
use Database\Factories\users\MerchantFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

          $products = Product::factory(10)->create();
          $orders   = Order::factory(10)->create();

          //seed random item order
          Order::all()->random()->take(2)->each(function ($order) use ($products){
            $order->products()->attach(
                $products->random(rand(1,9))->pluck('id')->toArray(),
                ['quantity' => mt_rand(1,1000),'created_at'=>now()]
            );
          });

    }
}
