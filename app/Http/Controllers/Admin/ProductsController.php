<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\SaveImageTrait;
use App\DeleteImageTrait;
use App\Models\Product;
use App\Models\Option;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    use HandleResponseTrait, SaveImageTrait, DeleteImageTrait;

    public function index() {
        return view('Admin.products.index');
    }

    public function add() {
        return view("Admin.products.create");
    }

    public function edit($id) {
        $product = Product::latest()->find($id);

        if ($product)
            return view("Admin.products.edit")->with(compact("product"));

        return $this->handleResponse(
            false,
            "Product not exits",
            ["Product id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        DB::beginTransaction();

        try {

        $validator = Validator::make($request->all(), [
            "name" => ["required"],
            "description" => ["required"],
            "name_ar" => ["required"],
            "description_ar" => ["required"],
            "type" => ["required"],
            "price" => ["required", "numeric"],
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            "name.required" => "ادخل اسم الخدمة",
            "main_image.required" => "ارفع الصورة الرئيسية للخدمة",
            "category_id.required" => "اختر القسم",
            "description.required" => "ادخل وصف الخدمة",
            "quantity.required" => "ادخل الكمية المتاحة من الخدمة",
            "price.required" => "ادخل سعر الخدمة الخدمة",
            "images.required" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.min_images" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.mimes" => "يجب ان تكون الصورة بين هذه الصيغ (jpeg, png, jpg, gif)",
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

        $main_image_name = $this->saveImg($request->main_image, 'images/uploads/Products');
        $product = Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "name_ar" => $request->name_ar,
            "description_ar" => $request->description_ar,
            "type" => $request->type,
            "price" => $request->price,
            "main_image" => '/images/uploads/Products/' . $main_image_name,
        ]);

        DB::commit();
            return $this->handleResponse(
                true,
                "تم اضافة الخدمة بنجاح",
                [],
                [],
                []
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->handleResponse(
                false,
                "فشل الاضافة",
                [$e->getMessage()],
                [],
                []
            );
        }

    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            "id" => ["required"],
            "name" => ["required"],
            "description" => ["required"],
            "name_ar" => ["required"],
            "description_ar" => ["required"],
            "type" => ["required"],
            "price" => ["required", "numeric"],
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            "name.required" => "ادخل اسم الخدمة",
            "description.required" => "ادخل وصف الخدمة",
            "quantity.required" => "ادخل الكمية المتاحة من الخدمة",
            "price.required" => "ادخل سعر الخدمة الخدمة",
            "images.required" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.min_images" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.mimes" => "يجب ان تكون الصورة بين هذه الصيغ (jpeg, png, jpg, gif)",
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

        $product = Product::find($request->id);
        if ($request->main_image) {
            $main_image_name = $this->saveImg($request->main_image, 'images/uploads/Products');
            $product->main_image = '/images/uploads/Products/' . $main_image_name;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->name_ar = $request->name_ar;
        $product->description_ar = $request->description_ar;
        $product->price = $request->price;
        $product->type = $request->type;

        $product->save();

        if ($product)
            return $this->handleResponse(
                true,
                "تم تحديث الخدمة بنجاح",
                [],
                [],
                []
            );

    }

    public function deleteIndex($id) {
        $product = Product::find($id);

        if ($product)
            return view("Admin.products.delete")->with(compact("product"));

        return $this->handleResponse(
            false,
            "Product not exits",
            ["Product id not valid"],
            [],
            []
        );
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            "id" => ["required"],
        ], [
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

        $product = Product::find($request->id);

        $product->delete();

        if ($product)
            return $this->handleResponse(
                true,
                "تم حذف الخدمة بنجاح",
                [],
                [],
                []
            );

    }
}
