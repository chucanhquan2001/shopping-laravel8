<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Roles\StoreRequest;
use App\Http\Requests\Roles\UpdateRequest;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role-list', ['only' => ['index']]);
        $this->middleware('can:role-add', ['only' => ['create', 'store']]);
        $this->middleware('can:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Role::latest()->search()->paginate(10);
        return view('admin.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('admin.roles.add', compact('permissionParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        if (!empty($request->permission_id)) {
            $data->getPermissions()->attach($request->permission_id);
        }
        return redirect()->route('role.index')->with('success', 'Added !');
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
        $data = Role::find($id);
        $permissionParent = Permission::where('parent_id', 0)->get();
        if (!$data) {
            return redirect()->route('role.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.roles.edit', compact('permissionParent', 'data'));
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
        Role::find($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $data = Role::find($id);
        $data->getPermissions()->sync($request->permission_id);
        return redirect()->route('role.index')->with('success', 'Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Role::find($id)) {
            Role::find($id)->delete();
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