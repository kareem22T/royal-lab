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
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
class ProductsController extends Controller
{
    use HandleResponseTrait;

    public function get(Request $request) {
        $per_page = $request->per_page ? $request->per_page : 10;

        $sortKey =($request->sort && $request->sort == "HP") || ( $request->sort && $request->sort == "LP") ? "price" :"created_at";
        $sortWay = $request->sort && $request->sort == "HP" ? "desc" : ( $request->sort && $request->sort  == "LP" ? "asc" : "desc");

        $products = Product::orderBy($sortKey, $sortWay)->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [
                $products
            ],
            [
                "parameters" => [
                    "per_page" => "لتحديد عدد العناصر لكل صفحة",
                    "page" => "لتحديد صفحة",
                    "sort" => [
                        "HP" => "height price",
                        "LP" => "lowest price",
                    ]
                ],
                "sort" => [
                    "default" => "لو مبعتش حاجة هيفلتر ع اساس الاحدث",
                    "sort = HP" => "لو بعت ال 'sort' ب 'HP' هيفلتر من الاغلى للارخص",
                    "sort = LP" => "لو بعت ال 'sort' ب 'LP' هيفلتر من الارخص للاغلى",
                ]
            ]
        );
    }

    public function getAll(Request $request) {
        $sortKey =($request->sort && $request->sort == "HP") || ( $request->sort && $request->sort == "LP") ? "price" :"created_at";
        $sortWay = $request->sort && $request->sort == "HP" ? "desc" : ( $request->sort && $request->sort  == "LP" ? "asc" : "desc");

        $products = Product::orderBy($sortKey, $sortWay)->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [
                $products
            ],
            [
                "parameters" => [
                    "sort" => [
                        "HP" => "height price",
                        "LP" => "lowest price",
                    ]
                ],
                "sort" => [
                    "default" => "لو مبعتش حاجة هيفلتر ع اساس الاحدث",
                    "sort = HP" => "لو بعت ال 'sort' ب 'HP' هيفلتر من الاغلى للارخص",
                    "sort = LP" => "لو بعت ال 'sort' ب 'LP' هيفلتر من الارخص للاغلى",
                ]
            ]
        );
    }

    public function search(Request $request) {
        $per_page = $request->per_page ? $request->per_page : 10;

        $sortKey = ($request->sort && ($request->sort == "HP" || $request->sort == "LP")) ? "price" : "created_at";
        $sortWay = $request->sort && $request->sort == "HP" ? "desc" : ($request->sort && $request->sort == "LP" ? "asc" : "desc");
        $search = $request->search ? $request->search : '';

        $query = Product::with(["gallery"])
            ->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });

        if ($request->has('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->has('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        $products = $query->orderBy($sortKey, $sortWay)->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [
                $products
            ],
            [
                "search" => "البحث بالاسم او اي كلمة في المحتوى",
                "parameters" => [
                    "per_page" => "لتحديد عدد العناصر لكل صفحة",
                    "page" => "لتحديد صفحة",
                    "sort" => [
                        "HP" => "height price",
                        "LP" => "lowest price",
                    ],
                    "price_from" => "لتحديد الحد الأدنى للسعر",
                    "price_to" => "لتحديد الحد الأقصى للسعر",
                    "categories" => "لتحديد فئات معينة"
                ],
                "sort" => [
                    "default" => "لو مبعتش حاجة هيفلتر ع اساس الاحدث",
                    "sort = HP" => "لو بعت ال 'sort' ب 'HP' هيفلتر من الاغلى للارخص",
                    "sort = LP" => "لو بعت ال 'sort' ب 'LP' هيفلتر من الارخص للاغلى",
                ]
            ]
        );
    }

    public function getPackages(Request $request) {
        $per_page = $request->per_page ? $request->per_page : 10;

        $sortKey = ($request->sort && ($request->sort == "HP" || $request->sort == "LP")) ? "price" : "created_at";
        $sortWay = $request->sort && $request->sort == "HP" ? "desc" : ($request->sort && $request->sort == "LP" ? "asc" : "desc");

        $products = Product::where('type', 2)
                            ->orderBy($sortKey, $sortWay)
                            ->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$products],
            [
                "parameters" => [
                    "per_page" => "لتحديد عدد العناصر لكل صفحة",
                    "page" => "لتحديد صفحة",
                    "sort" => [
                        "HP" => "height price",
                        "LP" => "lowest price",
                    ]
                ],
                "sort" => [
                    "default" => "لو مبعتش حاجة هيفلتر ع اساس الاحدث",
                    "sort = HP" => "لو بعت ال 'sort' ب 'HP' هيفلتر من الاغلى للارخص",
                    "sort = LP" => "لو بعت ال 'sort' ب 'LP' هيفلتر من الارخص للاغلى",
                ]
            ]
        );
    }
    public function getAllPackages(Request $request) {
        $sortKey = ($request->sort && ($request->sort == "HP" || $request->sort == "LP")) ? "price" : "created_at";
        $sortWay = $request->sort && $request->sort == "HP" ? "desc" : ($request->sort && $request->sort == "LP" ? "asc" : "desc");

        $products = Product::where('type', 2)
                            ->orderBy($sortKey, $sortWay)
                            ->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$products],
            [
                "parameters" => [
                    "sort" => [
                        "HP" => "height price",
                        "LP" => "lowest price",
                    ]
                ],
                "sort" => [
                    "default" => "لو مبعتش حاجة هيفلتر ع اساس الاحدث",
                    "sort = HP" => "لو بعت ال 'sort' ب 'HP' هيفلتر من الاغلى للارخص",
                    "sort = LP" => "لو بعت ال 'sort' ب 'LP' هيفلتر من الارخص للاغلى",
                ]
            ]
        );
    }
    public function searchPackages(Request $request) {
        $per_page = $request->per_page ? $request->per_page : 10;

        $sortKey = ($request->sort && ($request->sort == "HP" || $request->sort == "LP")) ? "price" : "created_at";
        $sortWay = $request->sort && $request->sort == "HP" ? "desc" : ($request->sort && $request->sort == "LP" ? "asc" : "desc");
        $search = $request->search ? $request->search : '';

        $query = Product::with(["gallery"])
                        ->where('type', 2)
                        ->where(function($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                              ->orWhere('description', 'like', '%' . $search . '%');
                        });

        if ($request->has('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->has('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        $products = $query->orderBy($sortKey, $sortWay)->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$products],
            [
                "search" => "البحث بالاسم او اي كلمة في المحتوى",
                "parameters" => [
                    "per_page" => "لتحديد عدد العناصر لكل صفحة",
                    "page" => "لتحديد صفحة",
                    "sort" => [
                        "HP" => "height price",
                        "LP" => "lowest price",
                    ],
                    "price_from" => "لتحديد الحد الأدنى للسعر",
                    "price_to" => "لتحديد الحد الأقصى للسعر",
                    "categories" => "لتحديد فئات معينة"
                ],
                "sort" => [
                    "default" => "لو مبعتش حاجة هيفلتر ع اساس الاحدث",
                    "sort = HP" => "لو بعت ال 'sort' ب 'HP' هيفلتر من الاغلى للارخص",
                    "sort = LP" => "لو بعت ال 'sort' ب 'LP' هيفلتر من الارخص للاغلى",
                ]
            ]
        );
    }

    public function getProduct(Request $request) {
        $validator = Validator::make($request->all(), [
            "product_id" => ["required"],
        ]);

        if ($validator->fails()) {
            return $this->handleResponse(
                false,
                "",
                [$validator->errors()->first()],
                [],
                []
            );
        }

        $product = Product::find($request->product_id);

        if ($product) {
            return $this->handleResponse(
                true,
                "عملية ناجحة",
                [],
                [
                    $product
                ],
                []
            );
        } else {
            return $this->handleResponse(
                false,
                "",
                ["الخدمة غير موجود"],
                [],
                []
            );
        }
    }

}
