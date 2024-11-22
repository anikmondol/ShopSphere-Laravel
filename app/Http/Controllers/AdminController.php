<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Intervention\Image\Laravel\Facades\Image;



class AdminController extends Controller
{
    //
    function index()
    {
        return view("admin.index");
    }

    function brands()
    {
        $brands = Brand::orderBy("id", "DESC")->paginate(10);
        return view("admin.brands", compact('brands'));
    }


    function add_brand()
    {
        return view("admin.brand-add");
    }

    function brand_store(Request $request)
    {

        $request->validate([
            'name' => "required",
            'slug' => "required|unique:brands,slug",
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $brand = new Brand();

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->generateBrandThumbnailsImage($image, $file_name);
        $brand->image = $file_name;
        $brand->save();
        return redirect()->route("admin.brands")->with("status", "Brand has been added successfully");
    }


    function generateBrandThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path("uploads/brands");
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124, function ($constrain) {
            $constrain->aspectRatio();
        })->save($destinationPath . "/" . $imageName);
    }
}
