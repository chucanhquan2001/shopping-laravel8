<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Variant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ProductVariants\StoreRequest;
use App\Http\Requests\ProductVariants\UpdateRequest;

class ProductVariantController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:product-list', ['only' => ['index']]);
        $this->middleware('can:product-add', ['only' => ['create', 'store']]);
        $this->middleware('can:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:product-delete', ['only' => ['destroy']]);
    }
    public function index($idProduct)
    {
        $data = ProductVariant::where('product_id', $idProduct)->latest()->paginate(10);
        return view('admin.product_variants.index', compact('data', 'idProduct'));
    }

    public function create($idProduct)
    {
        $getVariant = Variant::all();
        return view('admin.product_variants.add', compact('getVariant', 'idProduct'));
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            // thêm vào bảng product_variants
            $productVariant = ProductVariant::create([
                'quantity' => $request->quantity,
                'image' => $request->image,
                'discount' => $request->discount,
                'price' => $request->price,
                'sku' => $request->sku,
                'status' => 1,
                'product_id' => $request->product_id
            ]);

            // thêm vào bảng product_detail

            if (!empty($request->variant_value_id)) {
                $productVariant->getVariantValues()->attach($request->variant_value_id);
            }

            DB::commit();
            // trỏ về trang list product
            return redirect()->route('product-variant.index', $request->product_id)->with('success', 'Added !');
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $data = ProductVariant::find($id);
        $getVariant = Variant::all();
        return view('admin.product_variants.edit', compact('data', 'getVariant'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductVariant = [
                'quantity' => $request->quantity,
                'discount' => $request->discount,
                'price' => $request->price,
                'sku' => $request->sku,
            ];
            if (!empty($request->image)) {
                $dataProductVariant['image'] = $request->image;
            }
            ProductVariant::find($id)->update($dataProductVariant);
            // find product variant sau khi update
            $productVariant = ProductVariant::find($id);
            // update bảng product_details
            if (!empty($request->variant_value_id)) {
                $productVariant->getVariantValues()->sync($request->variant_value_id);
            }
            DB::commit();
            // trỏ về trang list product variants
            return redirect()->route('product-variant.index', $productVariant->getProduct->id)->with('success', 'Updated !');
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $data = ProductVariant::find($id);

        if ($data->status != 0) {
            $data->delete();
            return response()->json([
                'success' => 'Record deleted successfully!',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'error' => 'Xóa không thành công !',
                'code' => 500
            ]);
        }
    }
}