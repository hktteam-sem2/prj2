<?php

namespace App\Providers;

use App\Customer;
use App\Order;
use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            // $min_price = Product::min('product-price');
            // $max_price = Product::max('product-price');

            // $min_price_range = $min_price + 500000;
            // $max_price_range = $max_price + 10000000;

            $products = Product::all()->count();
            $orders = Order::all()->count();
            $customers = Customer::all()->count();
            $product_views = Product::orderBy('product_views','DESC')->take(20)->get();
            $view
            // ->with('min_price' , $min_price)
            // ->with('max_price' , $max_price)
            // ->with('min_price_range' , $min_price_range)
            // ->with('max_price_range' , $max_price_range)
            ->with('products' , $products)
            ->with('orders' , $orders)
            ->with('customers' , $customers)
            ->with('product_views' , $product_views);

        });
    }
}
