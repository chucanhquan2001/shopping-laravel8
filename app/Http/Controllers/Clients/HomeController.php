<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

class HomeController extends Controller
{
    public function index()
    {
        // lấy banner
        $banners = Slider::where('status', config('common.status_sliders.banner'))->get();

        // lấy slider nhỏ
        $sliders1 = Slider::where('status', config('common.status_sliders.banner_children'))->orderBy('id', 'DESC')->take(2)->get();
        $sliders2 = Slider::where('status', config('common.status_sliders.banner_children'))->orderBy('id', 'ASC')->take(2)->get();

        // in danh mục ra menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();

        // lấy 8 sản phẩm mới nhất
        $product_latest = Product::latest()->take(8)->get();

        // lấy 8 sản phẩm đặc biệt
        $product_pulish = Product::where('status', config('common.status.pulish'))->take(8)->get();

        // lấy 8 sản phẩm xu hướng mới theo view
        $product_trending = Product::orderBy('view', 'DESC')->take(8)->get();

        return view('home', compact('banners', 'sliders1', 'sliders2', 'categories', 'product_latest', 'product_pulish', 'product_trending'));
    }

    public function addCart(Request $request)
    {
        // return response()->json([
        //     'product_id' => $request->product_variant_id,
        //     'code' => 200
        // ]);
    }
}