<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Checkout\StoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('cart')) {
            $categories = Category::where([
                ['status', '=', config('common.status.pulish')],
                ['parent_id', '=', 0]
            ])->take(4)->get();
            return view('frontend.pages.checkout', compact('categories'));
        } else {
            return redirect()->route('home');
        }
    }

    public function store(StoreRequest $request)
    {
        if ($request->session()->has('cart')) {



            $latestInvoice = Invoice::orderBy('created_at', 'DESC')->first();
            // tạo mã hóa đơn tự động
            if ($latestInvoice) {
                $invoice_nr = '#' . str_pad($latestInvoice->id + 1, 8, "0", STR_PAD_LEFT);
            } else {
                $invoice_nr = '#' . str_pad(0 + 1, 8, "0", STR_PAD_LEFT);
            }

            // lấy id user 
            if (auth()->check()) {
                $user_id = auth()->id();
            } else {
                if ($request->create_account == 1) {
                    $passwordRand = Str::random(6);
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($passwordRand),
                        'active' => config('common.active.active')
                    ]);
                    $user->getRoles()->attach(config('common.role.guest'));
                    $user_id = $user->id;
                } else {
                    $user_id = null;
                }
            }
            $dataInvoice = Invoice::create([
                'invoice_nr' => $invoice_nr,
                'phone' => $request->phone,
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'note' => $request->note,
                'total_price' => $request->total_price,
                'user_id' => $user_id,
                'user_id_admin' => null,
                'status' => config('common.invoice.status.cho_xac_nhan'),
            ]);
            if ($dataInvoice) {
                foreach ($request->session()->get('cart') as $itemCart) {
                    $dataInvoiceDetail = InvoiceDetail::create([
                        'product_variant_id' => $itemCart['product_variant_id'],
                        'invoice_id' => $dataInvoice->id,
                        'unit_price' => $itemCart['price'] - ($itemCart['price'] * $itemCart['discount'] / 100),
                        'quantity' => $itemCart['quantity'],
                        'color' => $itemCart['color'],
                    ]);
                    $productVariant = ProductVariant::find($dataInvoiceDetail->product_variant_id);
                    $productVariant->update([
                        'quantity' => $productVariant->quantity - $dataInvoiceDetail->quantity,
                    ]);
                    $productVariant->getProduct->update([
                        'total_product_sold' => $productVariant->getProduct->total_product_sold + $dataInvoiceDetail->quantity,
                    ]);
                }

                Mail::to('quancaph09928@fpt.edu.vn')
                    ->send(new SendMail($invoice_nr, $request->name, $request->address, $request->phone, $request->email, $request->note, $request->session()->get('cart'), $request->total_price));

                session()->forget('cart');
                return redirect()->route('order.success.index');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function orderSuccess()
    {
        // hiển thị menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();
        return view('frontend.pages.order_success', compact('categories'));
    }
}