<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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

    function brand_delete($id)
    {

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

    function add_category()
    {
        return view("admin.category-add");
    }

    function category_store(Request $request)
    {

        $request->validate([
            'name' => "required",
            'slug' => "required|unique:categories,slug",
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $category = new Category();

        $category->name = $request->name;
        if ($request->filled('slug')) {
            $category->slug = Str::slug($request->slug);
        } else {
            $category->slug = Str::slug($request->name);
        }
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp . '.' . $file_extension;
        $this->generateCategoryThumbnailsImage($image, $file_name);
        $category->image = $file_name;
        $category->save();
        return redirect()->route("admin.categories")->with("status", "Category has been added successfully");
    }


    function category_edit($id)
    {
        $category = Category::find($id);
        return view("admin.category-edit", compact('category'));
    }

    function category_update(Request $request)
    {

        $request->validate([
            'name' => "required",
            'slug' => "required|unique:categories,slug," . $request->id,
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Optional image validation
        ]);


        $category = Category::find($request->id);


        $category->name = $request->name;
        if ($request->filled('slug')) {
            $category->slug = Str::slug($request->slug);
        } else {
            $category->slug = Str::slug($request->name);
        }

        if ($request->hasFile('image')) {
            if (!empty($category->image) && File::exists(public_path("uploads/categories/{$category->image}"))) {
                File::delete(public_path("uploads/categories/{$category->image}"));
            }

            $image = $request->file('image');
            $file_extension = $image->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extension;
            $this->generateCategoryThumbnailsImage($image, $file_name);
            $category->image = $file_name;
        }

        $category->save();
        return redirect()->route("admin.categories")->with("status", "Category has been updated successfully");
    }


    function generateCategoryThumbnailsImage($image, $imageName)
    {
        $destinationPath = public_path("uploads/categories");
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124, function ($constrain) {
            $constrain->aspectRatio();
        })->save($destinationPath . "/" . $imageName);
    }

    function category_delete($id)
    {

        $category = Category::find($id);

        if (File::exists(public_path("uploads/categories/{$category->image}"))) {
            File::delete(public_path("uploads/categories/{$category->image}"));
        }

        $category->delete();
        return redirect()->route("admin.categories")->with("status", "Category has been delete successfully");
    }


    // products functionality

    function products()
    {
        $products = Product::orderBy("created_at", "DESC")->paginate(10);
        return view("admin.products", compact('products'));
    }

    function add_product()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();

        return view("admin.product-add", compact('categories', 'brands'));
    }


    function product_store(Request $request)
    {

        $request->validate([

            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'regular_prince' => 'required',
            'sale_prince' => 'required',
            'SKD' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_prince = $request->regular_prince;
        $product->sale_prince = $request->sale_prince;
        $product->SKD = $request->SKD;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $current_timestamp . "." . $image->extension();
            $this->generateProductThumbnailsImage($image, $imageName);
            $product->image = $imageName;
        }


        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if ($request->hasFile('images')) {
            $allowedFilExtension = ['jpg', 'png', 'jpeg'];
            $files = $request->file('images');

            foreach ($files as $file) {
                $gExtension = $file->getClientOriginalExtension();
                $gCheck = in_array($gExtension, $allowedFilExtension);

                if ($gCheck) {
                    $gFileName = $current_timestamp . '-' . $counter . '.' . $gExtension;
                    $this->generateProductThumbnailsImage($file, $gFileName);
                    array_push($gallery_arr, $gFileName);
                    $counter = $counter + 1;
                }
            }

            $gallery_images = implode(',', $gallery_arr);
        }


    }


    function generateProductThumbnailsImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path("uploads/products/thumbnails");
        $destinationPath = public_path("uploads/products");
        $img = Image::read($image->path());

        $img->cover(540, 689, "top");
        $img->resize(540, 689, function ($constrain) {
            $constrain->aspectRatio();
        })->save($destinationPath . "/" . $imageName);

        $img->resize(104, 104, function ($constrain) {
            $constrain->aspectRatio();
        })->save($destinationPathThumbnail . "/" . $imageName);
    }


    // function product_store(Request $request)
    // {

    //     $request->validate([

    //         'name' => 'required',
    //         'slug' => 'required|unique:products,slug',
    //         'short_description' => 'required',
    //         'description' => 'required',
    //         'regular_prince' => 'required',
    //         'sale_prince' => 'required',
    //         'SKD' => 'required',
    //         'stock_status' => 'required',
    //         'featured' => 'required',
    //         'quantity' => 'required',
    //         'image' => 'nullable|mimes:jpg,png,jpeg|max:2048',
    //         'category_id' => 'required',
    //         'brand_id' => 'required',
    //     ]);

    //     $product = new Product();

    //     $product->name = $request->name;
    //     if ($request->filled('slug')) {
    //         $product->slug = Str::slug($request->slug);
    //     } else {
    //         $product->slug = Str::slug($request->name);
    //     }
    //     $product->short_description = $request->short_description;
    //     $product->description = $request->description;
    //     $product->regular_prince = $request->regular_prince;
    //     $product->sale_prince = $request->sale_prince;
    //     $product->SKD = $request->SKD;
    //     $product->stock_status = $request->stock_status;
    //     $product->featured = $request->featured;
    //     $product->quantity = $request->quantity;
    //     $product->category_id = $request->category_id;
    //     $product->brand_id = $request->brand_id;

    //     $current_timestamp = Carbon::now()->timestamp;

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = $current_timestamp . '.' . $image->extension();
    //         $this-> generateProductThumbnailsImage($image, $imageName);
    //         $product->image = $imageName;
    //     }

    //     $gallery_arr = array();
    //     $gallery_images = "";
    //     $counter = 1;

    //     if ($request->hasFile('images')) {
    //         $allowedFilExtension = ['jpg', 'png', 'jpeg'];
    //         $files = $request->file('images');

    //         foreach ($files as $file) {
    //             $gExtension = $file->getClientOriginalExtension();
    //             $gCheck = in_array($gExtension, $allowedFilExtension);

    //             if ($gCheck) {
    //                 $gFileName = $current_timestamp . '.' . $counter . '.' . $gExtension;
    //                 $this->generateProductThumbnailsImage($file, $gFileName);
    //                 array_push($gallery_arr, $gFileName);
    //                 $counter = $counter + 1;
    //             }
    //         }

    //         $gallery_images = implode(',',$gallery_arr);
    //     }

    //     $product->images = $gallery_images;


    //     $product->save();
    //     return redirect()->route("admin.products")->with("status", "Product has been added successfully");
    // }


    // function generateProductThumbnailsImage($image, $imageName)
    // {
    //     $destinationPathThumbnail = public_path("uploads/products/thumbnails");
    //     $destinationPath = public_path("uploads/products");
    //     $img = Image::read($image->path());
    //     $img->cover(540, 689, "top");
    //     $img->resize(540, 689, function ($constrain) {
    //         $constrain->aspectRatio();
    //     })->save($destinationPath . "/" . $imageName);

    //     $img->resize(104, 104, function ($constrain) {
    //         $constrain->aspectRatio();
    //     })->save($destinationPathThumbnail . "/" . $imageName);

    // }





}
