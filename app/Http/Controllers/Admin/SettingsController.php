<?php

namespace App\Http\Controllers\Admin;

use App\HandleResponseTrait;
use App\Http\Controllers\Controller;
use App\Traits\DataFormController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Setting;
use App\SaveImageTrait;

class SettingsController extends Controller
{
    use HandleResponseTrait, SaveImageTrait;

    public function index() {
        return view("admin.settings.index");
    }

    public function store(Request $request)
    {
        foreach ($request->except('_token', 'logo', 'shape_section_image', 'hero_gallary') as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('hero_gallary'))
        {
            $hero_gallary = $request->file('hero_gallary');
            $images_path = [];
            foreach ($hero_gallary as $file) {
                $image = $this->saveImg($file, 'images/uploads/hero');
                array_push($images_path, '/images/uploads/hero/' . $image);
            }
            Setting::updateOrCreate(['key' => "hero_gallary"], ['value' => json_encode($images_path)]);
        }

        return redirect()->back();
    }


}
