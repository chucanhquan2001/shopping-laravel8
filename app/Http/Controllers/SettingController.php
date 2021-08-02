<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\Settings\StoreRequest;
use App\Http\Requests\Settings\UpdateRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('can:setting-list', ['only' => ['index']]);
        $this->middleware('can:setting-add', ['only' => ['create', 'store']]);
        $this->middleware('can:setting-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:setting-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Setting::orderBy('id', 'DESC')->search()->paginate(10);
        return view('admin.settings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Setting::create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);
        return redirect()->route('setting.index')->with('success', 'Added !');
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
        $setting = Setting::find($id);
        if (!$setting) {
            return redirect()->route('setting.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.settings.edit', compact('setting'));
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
        $setting = Setting::find($id);
        if (!$setting) {
            return redirect()->route('setting.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if ($setting->update($request->only('config_key', 'config_value'))) {
                return redirect()->route('setting.index')->with('success', 'Updated !');
            } else {
                return redirect()->route('setting.index')->with('error', 'Update Failed !');
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
        if (Setting::find($id)) {
            Setting::find($id)->delete();
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