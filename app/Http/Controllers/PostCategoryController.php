<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;
use App\Http\Requests\PostCategory\StoreRequest;
use App\Http\Requests\PostCategory\UpdateRequest;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:post-category-list', ['only' => ['index']]);
        $this->middleware('can:post-category-add', ['only' => ['create', 'store']]);
        $this->middleware('can:post-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:post-category-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = PostCategory::orderBy('id', 'DESC')->search()->paginate(10);
        return view('admin.post_categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post_categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        PostCategory::create($request->all());
        return redirect()->route('post-category.index')->with('success', 'Added !');
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
        $data = PostCategory::find($id);
        if (!$data) {
            return redirect()->route('post-category.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.post_categories.edit', compact('data'));
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
        $data = PostCategory::find($id);
        if (!$data) {
            return redirect()->route('post-category.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if ($data->update($request->only('name', 'slug', 'status'))) {
                return redirect()->route('post-category.index')->with('success', 'Updated !');
            } else {
                return redirect()->route('post-category.index')->with('error', 'Update Failed !');
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
        $data = PostCategory::find($id);
        if ($data) {
            if ($data->id != 1) {
                if ($data->getPost->count() > 0) {
                    foreach ($data->getPost as $item) {
                        Post::find($item->id)->update(array('post_category_id' => 1));
                    }
                }
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
        } else {
            return redirect()->route('post-category.index')->with('error', 'Thông tin không tồn tại !');
        }
    }
}