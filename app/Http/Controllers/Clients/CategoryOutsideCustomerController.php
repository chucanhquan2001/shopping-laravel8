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
            if (request()->product_show && request()->product_show != 'all') {
                $products = $this->paginate($productArr, request()->product_show);
            } else {
                $products = $productArr;
            }
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
            if (request()->product_show && request()->product_show != 'all') {
                $products = Product::where('category_id', $category->id)->paginate(request()->product_show);
            } else {
                $products = Product::where('category_id', $category->id)->get();
            }
            return view('frontend.pages.category_children', compact('categories', 'category', 'products'));
        } else {
            abort(404);
        }
    }

    // phân trang cho danh mục cha
    public function paginate($items, $perPage, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => request()->url]);
    }
}