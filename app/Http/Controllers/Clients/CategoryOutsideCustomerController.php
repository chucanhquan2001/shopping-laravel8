<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;



class CategoryOutsideCustomerController extends Controller
{
    public function categoryParent($slug)
    {
        // in danh mục ra menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();

        // lấy sản phẩm theo id danh mục con truyền vào
        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $productArr = [];
            $categoryChildren = Category::where('parent_id', $category->id)->get();
            foreach ($categoryChildren as $itemCategoryChildren) {
                foreach ($itemCategoryChildren->getProduct as $product) {
                    $productArr[] = $product;
                }
            }
            $products = $productArr;
            return view('frontend.pages.category_parent', compact('categories', 'category', 'products'));
        } else {
            abort(404);
        }
    }

    public function categoryChildren($slug)
    {
        // in danh mục ra menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();

        // lấy sản phẩm theo id danh mục con truyền vào
        $category = Category::where('slug', $slug)->first();

        if ($category) {
            if (request()->short_by) {
                if (request()->short_by == config('common.sortBy.mac_dinh')) {
                    $products = Product::where('category_id', $category->id)
                        ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->where('product_variants.status', config('common.product_variants.status.main'))
                        ->get();
                } elseif (request()->short_by == config('common.sortBy.pho_bien')) {
                    $products = Product::where('category_id', $category->id)
                        ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->where('product_variants.status', config('common.product_variants.status.main'))
                        ->orderBy('products.view', 'DESC')->get();
                } elseif (request()->short_by == config('common.sortBy.ban_chay_nhat')) {
                    $products = Product::where('category_id', $category->id)
                        ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->where('product_variants.status', config('common.product_variants.status.main'))
                        ->orderBy('products.total_product_sold', 'DESC')->get();
                } elseif (request()->short_by == config('common.sortBy.moi_nhat')) {
                    $products = Product::where('category_id', $category->id)
                        ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->where('product_variants.status', config('common.product_variants.status.main'))
                        ->orderBy('product_variants.created_at', 'DESC')->get();
                } elseif (request()->short_by == config('common.sortBy.thap_cao')) {
                    $products = Product::where('category_id', $category->id)
                        ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->where('product_variants.status', config('common.product_variants.status.main'))
                        ->orderBy('product_variants.price', 'ASC')->get();
                } elseif (request()->short_by == config('common.sortBy.cao_thap')) {
                    $products = Product::where('category_id', $category->id)
                        ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->where('product_variants.status', config('common.product_variants.status.main'))
                        ->orderBy('product_variants.price', 'DESC')->get();
                }
            } else {
                $products = Product::where('category_id', $category->id)
                    ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                    ->where('product_variants.status', config('common.product_variants.status.main'))
                    ->get();
            }
            return view('frontend.pages.category_children', compact('categories', 'category', 'products'));
        } else {
            abort(404);
        }
    }
}