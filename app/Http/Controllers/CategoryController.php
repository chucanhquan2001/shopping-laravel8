<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\View\Components\Recursive;
use App\View\Components\DeleteCate;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:category-list', ['only' => ['index']]);
        $this->middleware('can:category-add', ['only' => ['create', 'store']]);
        $this->middleware('can:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:category-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $data = Category::latest()->search()->paginate(10);
        return view('admin.categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOptions = $this->getCate($parent_id = '');
        return view('admin.categories.add', ['htmlOptions' => $htmlOptions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Added !');
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

    // hàm chung để hiển thị danh muc đệ quy
    public function getCate($parent_id)
    {
        $data = Category::all();
        $recursive = new Recursive($data);
        $htmlOptions = $recursive->categoryRecursive($parent_id);
        return $htmlOptions;
    }

    public function edit($id)
    {
        $cate = Category::find($id);
        if (!$cate) {
            return redirect()->route('category.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            $htmlOptions = $this->getCate($cate->parent_id);
            return view('admin.categories.edit', compact('cate', 'htmlOptions'));
        }
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
        $cate = Category::find($id);
        if (!$cate) {
            return redirect()->route('category.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if (!empty($request->image)) {
                if ($cate->update($request->only('name', 'slug', 'parent_id', 'image', 'status'))) {
                    return redirect()->route('category.index')->with('success', 'Updated !');
                } else {
                    return redirect()->route('category.index')->with('error', 'Update Failed !');
                }
            } else {
                if ($cate->update($request->only('name', 'slug', 'parent_id', 'status'))) {
                    return redirect()->route('category.index')->with('success', 'Updated !');
                } else {
                    return redirect()->route('category.index')->with('error', 'Update Failed !');
                }
            }
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
        $cate = Category::find($id);
        $cates = Category::all();
        if (!$cate) {
            return redirect()->route('category.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if ($id != 1) {
                $deleteRecursive = new DeleteCate($cates, $cate);
                $deleteRecursive->deleteCategoryRecursive($id);
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
}