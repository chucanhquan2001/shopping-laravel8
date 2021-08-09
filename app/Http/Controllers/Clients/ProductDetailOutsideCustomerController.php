<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\Variant;
use App\Models\Review;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class ProductDetailOutsideCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:review-reply', ['only' => ['storeReply']]);
    }
    public function index($slug)
    {
        // in danh mục ra menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();



        // lấy ra sản phẩm liên quan
        $category_id = Product::where('slug', $slug)->first()->getCate->id;
        $product_related = Product::where([
            ['category_id', '=', $category_id],
            ['slug', '!=', $slug]
        ])->get();

        $products = Product::where('slug', $slug)
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('product_details', 'product_details.product_variant_id', '=', 'product_variants.id')
            ->join('variant_values', 'variant_values.id', '=', 'product_details.variant_value_id')
            ->join('variants', 'variants.id', '=', 'variant_values.variant_id')
            ->select(
                'products.*',
                'product_variants.sku',
                'product_variants.quantity',
                'product_variants.image',
                'product_variants.discount',
                'product_variants.price',
                'product_variants.status',
                'product_details.id as product_detail_id',
                'product_details.product_variant_id',
                'product_details.variant_value_id',
                'variant_values.value',
                'variant_values.variant_id',
                'variants.variant'
            )
            // ->distinct()
            ->get();

        $product_main = Product::where('slug', $slug)
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('product_details', 'product_details.product_variant_id', '=', 'product_variants.id')
            ->join('variant_values', 'variant_values.id', '=', 'product_details.variant_value_id')
            ->join('variants', 'variants.id', '=', 'variant_values.variant_id')
            ->select(
                'products.*',
                'product_variants.sku',
                'product_variants.quantity',
                'product_variants.image',
                'product_variants.discount',
                'product_variants.price',
                'product_variants.status',
                'product_details.id as product_detail_id',
                'product_details.product_variant_id',
                'product_details.variant_value_id',
                'variant_values.value',
                'variant_values.variant_id',
                'variants.variant'
            )
            ->where('product_variants.status', config('common.product_variants.status.main'))
            ->first();

        // lấy ra bình luận của sản phẩm
        $reviews = Review::where([
            ['status', '=', config('common.status.pulish')],
            ['product_id', '=', $product_main->id]
        ])->orderBy('created_at', 'DESC')->get();

        if ($products) {
            return view('frontend.pages.product_detail', compact('categories', 'product_main', 'products', 'product_related', 'reviews'));
        } else {
            abort(404);
        }
    }

    public function changProductVariant(Request $request)
    {
        $idProductVariant = $request->idProductVariant;
        $productVariant = ProductVariant::where('id', $idProductVariant)->first();
        return response()->json([
            'sku' => $productVariant->sku,
            'image' => $productVariant->image,
            'price' => $productVariant->price,
            'discount' => $productVariant->discount,
            'quantity' => $productVariant->quantity,
            'code' => 200
        ]);
    }

    public function storeReview(Request $request)
    {
        Review::create([
            'name' => $request->name,
            'email' => $request->email,
            'rating_star' => $request->rating_star,
            'comment' => $request->comment,
            'status' => config('common.status.pulish'),
            'product_id' => $request->product_id,
        ]);
        return redirect()->back()->with('success', 'Thêm bình luận thành công !');
    }

    public function storeReply(Request $request)
    {
        Reply::create([
            'comment' => $request->comment,
            'status' => config('common.status.pulish'),
            'review_id' => $request->review_id,
            'user_id' => Auth::id()
        ]);
        return redirect()->back()->with('success', 'Thêm bình luận thành công !');
    }
}