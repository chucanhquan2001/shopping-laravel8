<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:reply-list', ['only' => ['index']]);
        $this->middleware('can:reply-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:reply-delete', ['only' => ['destroy']]);
    }
    public function index($idReview)
    {
        $data = Reply::where('review_id', $idReview)->search()->latest()->paginate(10);
        return view('admin.replies.index', compact('data', 'idReview'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reply = Reply::find($id);
        if ($reply) {
            $reply->update($request->only('status'));
            $replyNew = Reply::find($id);
            return redirect()->route('reply.index', $replyNew->getReview->id)->with('success', 'Updated !');
        } else {
            return redirect()->route('reply.index')->with('error', 'Thông tin không tồn tại');
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
        if (Reply::find($id)) {
            Reply::find($id)->delete();
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