<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariantValue;
use App\Models\Variant;

class VariantValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:variant-value-list', ['only' => ['index']]);
        $this->middleware('can:variant-value-add', ['only' => ['create', 'store']]);
        $this->middleware('can:variant-value-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:variant-value-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = VariantValue::latest()->search()->paginate(10);
        $data->load(['getVariant']);
        return view('admin.variant_value.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getVariant = Variant::all();
        return view('admin.variant_value.add', compact('getVariant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        VariantValue::create($request->all());
        return redirect()->route('variant-value.index')->with('success', 'Added !');
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
        $data = VariantValue::find($id);
        $getVariant = Variant::all();
        if (!$data) {
            return redirect()->route('variant_value.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.variant_value.edit', compact('data', 'getVariant'));
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
        $data = VariantValue::find($id);
        if (!$data) {
            return redirect()->route('variant-value.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if ($data->update($request->only('value', 'variant_id'))) {
                return redirect()->route('variant-value.index')->with('success', 'Updated !');
            } else {
                return redirect()->route('variant-value.index')->with('error', 'Update Failed !');
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
        if (VariantValue::find($id)) {
            VariantValue::find($id)->delete();
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