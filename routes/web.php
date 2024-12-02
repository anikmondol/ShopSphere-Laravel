<?php

use App\Http\Controllers\About;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Layout;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');

// shop functionality
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');


// about functionality
Route::get('/about', [About::class, 'index'])->name('about.index');

// cart functionality
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::delete('/cart/remove_item/{rowId}', [CartController::class, 'remove_item'])->name('cart.item.remove');
Route::delete('/cart/clear', [CartController::class, 'empty_cart'])->name('cart.empty');


//  apple coupon
Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name("cart.coupon.apply");
Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name("cart.coupon.remove");
Route::get('/checkout', [CartController::class, 'checkout'])->name("cart.checkout");
Route::post('/place-an-order', [CartController::class, 'place_an_order'])->name("cart.place.an.order");
Route::get('/order-confirmation', [CartController::class, 'order_confirmation'])->name("cart.order.confirmation");



// brands wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
Route::delete('/wishlist/item/remove/{rowId}', [WishlistController::class, 'remove_item'])->name('wishlist.item.remove');
Route::delete('/wishlist/clear', [WishlistController::class, 'empty_wishlist'])->name('wishlist.empty');
Route::post('/wishlist/move-to-cart/{rowId}', [WishlistController::class, 'move_to_cart'])->name('wishlist.move.to.cart');

// contact
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::post('/contact/store', [HomeController::class, 'contact_store'])->name('home.contact.store');

// search
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name("user.index");

    // orders functionality
    Route::get('/account-orders', [UserController::class, 'orders'])->name('user.order');
    Route::get('/account-order/details/{order_id}', [UserController::class, 'order_details'])->name('user.order.details');
    Route::put('/account-order/order-cancel', [UserController::class, 'order_cancel'])->name('user.order.cancel');
});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name("admin.index");
    Route::get('/layout', [AdminController::class, 'contacts_count'])->name("contacts.count");


    // brands functionality
    Route::get('/admin/brands', [AdminController::class, 'brands'])->name("admin.brands");
    Route::get('/admin/brand/add', [AdminController::class, 'add_brand'])->name("admin.brand.add");
    Route::post('/admin/brand/store', [AdminController::class, 'brand_store'])->name("admin.brand.store");
    Route::get('/admin/brand/edit/{id}', [AdminController::class, 'brand_edit'])->name("admin.brand.edit");
    Route::put('/admin/brand/update', [AdminController::class, 'brand_update'])->name("admin.brand.update");
    Route::delete('/admin/brand/delete/{id}', [AdminController::class, 'brand_delete'])->name("admin.brand.delete");

    // categories functionality
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name("admin.categories");
    Route::get('/admin/category/add', [AdminController::class, 'add_category'])->name("admin.category.add");
    Route::post('/admin/category/store', [AdminController::class, 'category_store'])->name("admin.category.store");
    Route::get('/admin/category/edit/{id}', [AdminController::class, 'category_edit'])->name("admin.category.edit");
    Route::put('/admin/category/update', [AdminController::class, 'category_update'])->name("admin.category.update");
    Route::delete('/admin/category/delete/{id}', [AdminController::class, 'category_delete'])->name("admin.category.delete");


    // products functionality
    Route::get('/admin/products', [AdminController::class, 'products'])->name("admin.products");
    Route::get('/admin/product/add', [AdminController::class, 'add_product'])->name("admin.product.add");
    Route::post('/admin/product/store', [AdminController::class, 'product_store'])->name("admin.product.store");
    Route::get('/admin/product/edit/{id}', [AdminController::class, 'product_edit'])->name("admin.product.edit");
    Route::put('/admin/product/update', [AdminController::class, 'product_update'])->name("admin.product.update");
    Route::delete('/admin/product/delete/{id}', [AdminController::class, 'product_delete'])->name("admin.product.delete");



    // coupons functionality
    Route::get('/admin/coupons', [AdminController::class, 'coupons'])->name("admin.coupons");
    Route::get('/admin/coupon/add', [AdminController::class, 'add_coupon'])->name("admin.coupon.add");
    Route::post('/admin/coupon/store', [AdminController::class, 'coupon_store'])->name("admin.coupon.store");
    Route::get('/admin/coupon/edit/{id}', [AdminController::class, 'coupon_edit'])->name("admin.coupon.edit");
    Route::put('/admin/coupon/update', [AdminController::class, 'coupon_update'])->name("admin.coupon.update");
    Route::delete('/admin/coupon/delete/{id}', [AdminController::class, 'coupon_delete'])->name("admin.coupon.delete");


    // orders functionality
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name("admin.orders");
    Route::get('/admin/order/details/{order_id}', [AdminController::class, 'order_details'])->name('admin.order.details');
    Route::put('/admin/order/update-status', [AdminController::class, 'update_order_status'])->name('admin.order.status.update');


    // slides functionality
    Route::get('/admin/slides', [AdminController::class, 'slides'])->name("admin.slides");
    Route::get('/admin/slider/add', [AdminController::class, 'add_slider'])->name("admin.slider.add");
    Route::post('/admin/slider/store', [AdminController::class, 'slider_store'])->name("admin.slider.store");
    Route::get('/admin/slider/edit/{id}', [AdminController::class, 'slider_edit'])->name("admin.slider.edit");
    Route::put('/admin/slider/update', [AdminController::class, 'slider_update'])->name("admin.slider.update");
    Route::delete('/admin/slider/delete/{id}', [AdminController::class, 'slider_delete'])->name("admin.slider.delete");

    // contacts functionality
    Route::get('/admin/contacts', [AdminController::class, 'contacts'])->name("admin.contacts");
    Route::delete('/admin/contact/delete/{id}', [AdminController::class, 'contact_delete'])->name("admin.contact.delete");


    // search functionality
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

    // users functionality
    Route::get('/admin/users', [AdminController::class, 'users'])->name("admin.users");
    Route::delete('/admin/users/delete/{id}', [AdminController::class, 'users_delete'])->name("admin.users.delete");


});
