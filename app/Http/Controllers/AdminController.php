<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


use Intervention\Image\Laravel\Facades\Image;



class AdminController extends Controller
{
    //
    function index()
    {
        return view("admin.index");
    }

    // brands functionality

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
        if ($request->filled('slug')) {
            $brand->slug = Str::slug($request->slug);
        } else {
            $brand->slug = Str::slug($request->name);
        }
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp . '.' . $file_extension;
        $this->generateBrandThumbnailsImage($image, $file_name);
        $brand->image = $file_name;
        $brand->save();
        return redirect()->route("admin.brands")->with("status", "Brand has been added successfully");
    }


    function brand_edit($id)
    {
        $brand = Brand::find($id);
        return view("admin.brand-edit", compact('brand'));
    }


    function brand_update(Request $request)
    {

        $request->validate([
            'name' => "required",
            'slug' => "required|unique:brands,slug," . $request->id,
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Optional image validation
        ]);


        $brand = Brand::find($request->id);


        $brand->name = $request->name;
        if ($request->filled('slug')) {
            $brand->slug = Str::slug($request->slug);
        } else {
            $brand->slug = Str::slug($request->name);
        }

        if ($request->hasFile('image')) {
            if (!empty($brand->image) && File::exists(public_path("uploads/brands/{$brand->image}"))) {
                File::delete(public_path("uploads/brands/{$brand->image}"));
            }

            $image = $request->file('image');
            $file_extension = $image->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extension;
            $this->generateBrandThumbnailsImage($image, $file_name);
            $brand->image = $file_name;
        }

        $brand->save();
        return redirect()->route("admin.brands")->with("status", "Brand has been updated successfully");
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

    function brand_delete($id){

        $brand = Brand::find($id);

        if (File::exists(public_path("uploads/brands/{$brand->image}"))) {
            File::delete(public_path("uploads/brands/{$brand->image}"));
        }

        $brand->delete();
        return redirect()->route("admin.brands")->with("status", "Brand has been delete successfully");

    }


    // categories functionality

    function categories()
    {
        $categories = Category::orderBy("id", "DESC")->paginate(10);
        return view("admin.categories", compact('categories'));
    }

}
