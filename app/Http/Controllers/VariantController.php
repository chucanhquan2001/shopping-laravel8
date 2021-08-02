<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variant;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:variant-list', ['only' => ['index']]);
        $this->middleware('can:variant-add', ['only' => ['create', 'store']]);
        $this->middleware('can:variant-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:variant-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Variant::latest()->search()->paginate(10);
        $data->load(['getVariantValue']);
        return view('admin.variants.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.variants.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Variant::create($request->all());
        return redirect()->route('variant.index')->with('success', 'Added !');
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
        $data = Variant::find($id);
        if (!$data) {
            return redirect()->route('variant.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.variants.edit', compact('data'));
        }
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
        $data = Variant::find($id);
        if (!$data) {
            return redirect()->route('variant.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if ($data->update($request->only('variant', 'type'))) {
                return redirect()->route('variant.index')->with('success', 'Updated !');
            } else {
                return redirect()->route('variant.index')->with('error', 'Update Failed !');
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
        if (Variant::find($id)) {
            Variant::find($id)->delete();
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