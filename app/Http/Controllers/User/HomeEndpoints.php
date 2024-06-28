<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
class HomeEndpoints extends Controller
{
    use HandleResponseTrait;

    public function getLatestProducts($token) {
        $products = $products = Product::latest()
        ->take(15)
        ->get();


        return $products = $this->addIsFavKey($products, $token);
    }

    public function getMostSelled($token) {

        $completedOrders = Order::with("products")->where("status", 4)->get();
        $topProducts = Product::
        withCount('orders')
        ->orderBy('orders_count', 'desc')
        ->limit(10)
        ->get();

        $topProducts = $this->addIsFavKey( $topProducts, $token);

        return $topProducts;
    }

    public function getHomeApi(Request $request) {
        return $this->handleResponse(
            true,
            "Success",
            [],
            [
                "latest_products" => $this->getLatestProducts($request->header('Authorization')),
                "most_selled" => $this->getMostSelled($request->header('Authorization')),
            ],
            []
        );
    }
}
