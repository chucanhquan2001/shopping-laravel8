<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Category;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        // xóa session cart

        $idProductVariant = $request->product_variant_id;
        $products = ProductVariant::find($idProductVariant);
        $cart = session()->get('cart');
        if (isset($cart[$idProductVariant])) {
            $cart[$idProductVariant]['quantity'] = $cart[$idProductVariant]['quantity'] + $request->quantity;
        } else {
            $cart[$idProductVariant] = [
                'product_variant_id' => $idProductVariant,
                'sku' => $products->sku,
                'image' => $products->image,
                'name' => $products->getProduct->name,
                'color' => $products->getVariantValues->first()->value,
                'quantity' => $request->quantity,
                'price' => $products->price,
                'discount' => $products->discount,
                'quantity_max' => $products->quantity
            ];
        }
        session()->put('cart', $cart);
        // session()->flush('cart');
        $cartArr = session()->get('cart');
        $totalPriceCart = 0;
        $totalQuantity = 0;
        foreach ($cartArr as $cart) {
            $totalPriceCart += ($cart['price'] - ($cart['price'] * $cart['discount'] / 100)) * $cart['quantity'];
            $totalQuantity += 1;
        }


        return response()->json([
            'success' => 'Thêm vào giỏ hàng thành công !',
            'code' => 200,
            'carts' => $cartArr,
            'price' => $products->price - ($products->price * $products->discount / 100),
            'totalPrice' => $totalPriceCart,
            'totalQuantity' => $totalQuantity
        ]);
    }

    public function showCart()
    {
        // echo "<pre>";
        // print_r(session()->get('cart'));
        // in danh mục ra menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();
        $carts = session()->get('cart');
        return view('frontend.pages.cart', compact('categories', 'carts'));
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $carts = session()->get('cart');
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $carts);

            $carts = session()->get('cart');
            $cartTableHtml = view('frontend.layouts.cart_table', compact('carts'))->render();
            return response()->json([
                'cart_table_html' => $cartTableHtml,
                'code' => 200,
            ], status: 200);
        }
    }

    public function deleteItemCart(Request $request)
    {
        if ($request->id) {
            $carts = session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart', $carts);

            $carts = session()->get('cart');
            $cartTableHtml = view('frontend.layouts.cart_table', compact('carts'))->render();
            return response()->json([
                'cart_table_html' => $cartTableHtml,
                'code' => 200,
            ], status: 200);
        }
    }

    public function deleteCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }
}