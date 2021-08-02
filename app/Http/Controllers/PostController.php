<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\StoreRequest;
use App\Http\Requests\Posts\UpdateRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:post-list', ['only' => ['index']]);
        $this->middleware('can:post-add', ['only' => ['create', 'store']]);
        $this->middleware('can:post-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:post-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Post::orderBy('id', 'DESC')->search()->paginate(10);
        return view('admin.posts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCate = PostCategory::all();
        return view('admin.posts.add', compact('postCate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Post::create($request->all());
        return redirect()->route('post.index')->with('success', 'Added !');
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
        $data = Post::find($id);
        $postCate = PostCategory::all();
        if (!$data) {
            return redirect()->route('post.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.posts.edit', compact('data', 'postCate'));
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
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if (empty($request->image)) {
                if ($post->update($request->only('title', 'slug', 'meta_description', 'content', 'status', 'post_category_id'))) {
                    return redirect()->route('post.index')->with('success', 'Updated !');
                } else {
                    return redirect()->route('post.index')->with('error', 'Update Failed !');
                }
            } else {
                if ($post->update($request->only('title', 'slug', 'meta_description', 'content', 'image', 'status', 'post_category_id'))) {
                    return redirect()->route('post.index')->with('success', 'Updated !');
                } else {
                    return redirect()->route('post.index')->with('error', 'Update Failed !');
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
        if (Post::find($id)) {
            Post::find($id)->delete();
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