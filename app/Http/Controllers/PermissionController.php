<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\Permissions\StoreRequest;
use App\Http\Requests\Permissions\UpdateRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:role-list', ['only' => ['index']]);
        $this->middleware('can:role-add', ['only' => ['create', 'store']]);
        $this->middleware('can:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Permission::latest()->search()->paginate(10);
        return view('admin.permissions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('admin.permissions.add', compact('permissionParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Permission::create($request->all());
        return redirect()->route('permission.index')->with('success', 'Added !');
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
        $data = Permission::find($id);
        $permissionParent = Permission::where('parent_id', 0)->get();
        if (!$data) {
            return redirect()->route('permission.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.permissions.edit', compact('data', 'permissionParent'));
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
        $data = Permission::find($id);
        if (!$data) {
            return redirect()->route('permission.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if ($data->update($request->all())) {
                return redirect()->route('permission.index')->with('success', 'Updated !');
            } else {
                return redirect()->route('permission.index')->with('error', 'Update Failed !');
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
        if (Permission::find($id)) {
            Permission::find($id)->delete();
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