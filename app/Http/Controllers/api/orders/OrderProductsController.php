<?php

namespace App\Http\Controllers\api\orders;

use App\Http\Controllers\Controller;
use App\Models\order\Order;
use App\Models\products\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderProductsController extends Controller
{

    /**
     * list of the least ordered product during a specific time range and in particular day of week
     *
     * @return Product
     */
    public function getLeastOrderedProducts (Request $request) {
       $request->validate([
           'from'  => 'required|numeric',
           'to'    => 'required|numeric',
           'day'   => 'required'
       ]);

           //convert timestamp to data
         $from =  Carbon::createFromTimestamp($request->from,'Europe/Paris')->toDateTime();
         $to =  Carbon::createFromTimestamp($request->to)->toDateTime();

         $allowed_days = array();

         //get the data of specific day in the date between 2 dates
         while ($from <= $to) {
                if ($from->format('w') == $request->day) {
                    $allowed_days[] = $from->format('Y-m-d');
                }
                $from->modify('+1 day');
         }

        //retrieve orders in the allowed dates array
        $orders_query = Order::where('created_at','>=' ,$from);
        foreach ($allowed_days as $key => $day){
            $orders_query->orWhere('created_at','like','%'.$day.'%');
         }
        $orders = $orders_query->with(['products','products.merchant'])->get(['id','created_at']);


        //get products from each order
       $orders_products = array();
        foreach ($orders as $order){
            $orders_products [] = $order->products;
        }
        $order_products = array();
        for ($i=0 ; $i < count($orders_products); $i++){
            for ($j = 0; $j < count($orders_products[$i]);$j++){
                $order_products [] = $orders_products[$i][$j];
            }
        }

       return response()->json([
            'products' => $order_products
       ]);


    }
}
