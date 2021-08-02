<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Variant;
use App\Models\ProductVariant;
use App\Models\VariantValue;
use App\View\Components\Recursive;
// ảnh
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:product-list', ['only' => ['index']]);
        $this->middleware('can:product-add', ['only' => ['create', 'store']]);
        $this->middleware('can:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:product-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $data = Product::latest()->search()->paginate(10);
        return view('admin.products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOptions = $this->getCate($parent_id = '');
        $getVariant = Variant::all();
        return view('admin.products.add', compact('htmlOptions', 'getVariant'));
    }

    // hàm chung để hiển thị danh muc đệ quy
    public function getCate($parent_id)
    {
        $data = Category::all();
        $recursive = new Recursive($data);
        $htmlOptions = $recursive->categoryRecursive($parent_id);
        return $htmlOptions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'content' => $request->content,
                'description' => $request->description,
                'status' => $request->status,
                'view' => 0,
                'category_id' => $request->category_id,
                'user_id' => auth()->id()
            ]);



            // Thêm bảng tag
            if (!empty($request->tag)) {
                foreach ($request->tag as $tagItem) {
                    $tagNew = Tag::firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagNew->id;
                }
                $product->getTag()->attach($tagIds);
            }



            // thêm vào bảng product_variants
            $productVariant = ProductVariant::create([
                'quantity' => $request->quantity,
                'image' => $request->image,
                'discount' => $request->discount,
                'price' => $request->price,
                'sku' => $request->sku,
                'status' => 0,
                'product_id' => $product->id
            ]);

            // thêm vào bảng product_detail

            if (!empty($request->variant_value_id)) {
                $productVariant->getVariantValues()->attach($request->variant_value_id);
            }

            DB::commit();
            // trỏ về trang list product
            return redirect()->route('product.index')->with('success', 'Added !');
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $dataProductVariant = $data->getProductVariant()->where('status', 0)->first();
        $htmlOptions = $this->getCate($data->category_id);
        $getVariant = Variant::all();
        return view('admin.products.edit', compact('data', 'htmlOptions', 'getVariant', 'dataProductVariant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProduct = [
                'name' => $request->name,
                'slug' => $request->slug,
                'content' => $request->content,
                'description' => $request->description,
                'status' => $request->status,
                'view' => 0,
                'category_id' => $request->category_id,
                'user_id' => auth()->id()
            ];
            // find sản phảm để kiểm tra xem có id sản phẩm cần sửa không
            $getProduct = Product::find($id);
            if ($getProduct) {
                Product::find($id)->update($dataProduct);
                // find sản phẩm sau khi update
                $product = Product::find($id);

                // Thêm bảng tag
                if (!empty($request->tag)) {
                    foreach ($request->tag as $tagItem) {
                        $tagNew = Tag::firstOrCreate(['name' => $tagItem]);
                        $tagIds[] = $tagNew->id;
                    }
                    // hàm sync : thêm tất cả $tagId vào bảng product_tag, xóa hết cái cũ đi
                    $product->getTag()->sync($tagIds);
                }

                // update bảng product variant
                $product_variant_id = $request->product_variant_id;
                $dataProductVariant = [
                    'quantity' => $request->quantity,
                    'discount' => $request->discount,
                    'price' => $request->price,
                    'sku' => $request->sku,
                    'status' => 0,
                    'product_id' => $product->id
                ];
                if (!empty($request->image)) {
                    $dataProductVariant['image'] = $request->image;
                }
                ProductVariant::find($product_variant_id)->update($dataProductVariant);
                // find product variant sau khi update
                $productVariant = ProductVariant::find($product_variant_id);
                // update bảng product_details
                if (!empty($request->variant_value_id)) {
                    $productVariant->getVariantValues()->sync($request->variant_value_id);
                }

                DB::commit();
                // trỏ về trang list product
                return redirect()->route('product.index')->with('success', 'Updated !');
            } else {
                return redirect()->route('product.index')->with('error', 'Thông tin không tồn tại !');
            }
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Product::find($id)) {
            Product::find($id)->delete();
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