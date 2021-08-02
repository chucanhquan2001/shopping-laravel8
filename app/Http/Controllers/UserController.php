<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user-list', ['only' => ['index']]);
        $this->middleware('can:user-add', ['only' => ['create', 'store']]);
        $this->middleware('can:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = User::latest()->search()->paginate(10);
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.add', compact('roles'));
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
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'active' => $request->active
            ]);
            $roleIds = $request->role_id;
            $user->getRoles()->attach($roleIds);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Added !');
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
        $data = User::find($id);
        $roles = Role::all();
        if (!$data) {
            return redirect()->route('user.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.users.edit', compact('data', 'roles'));
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
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'email' => $request->email,
                'active' => $request->active
            ];
            if (!empty($request->password)) {
                $dataUpdate['password'] = Hash::make($request->password);
            }
            User::find($id)->update($dataUpdate);
            $user = User::find($id);
            $roleIds = $request->role_id;
            $user->getRoles()->sync($roleIds);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Updated !');
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

        if (User::find($id)) {
            if ($id != Auth::id()) {
                User::find($id)->delete($id);
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
            return redirect()->route('user.index')->with('error', 'Thông tin không tồn tại !');
        }
    }
}