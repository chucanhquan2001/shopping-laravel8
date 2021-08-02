<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\View\Components\MenuRecursive;
use App\View\Components\DeleteMenu;
use App\Http\Requests\Menus\StoreRequest;
use App\Http\Requests\Menus\UpdateRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:menu-list', ['only' => ['index']]);
        $this->middleware('can:menu-add', ['only' => ['create', 'store']]);
        $this->middleware('can:menu-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:menu-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Menu::orderBy('id', 'DESC')->search()->paginate(10);
        return view('admin.menus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Menu::all();
        $menuRecursive = new MenuRecursive($data);
        $htmlOptions = $menuRecursive->menuRecursiveAdd();
        return view('admin.menus.add', compact('htmlOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Menu::create($request->all());
        return redirect()->route('menu.index')->with('success', 'Added !');
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
        $data = Menu::all();
        $menu = Menu::find($id);
        if ($menu) {
            $menuRecursive = new MenuRecursive($data);
            $htmlOptions = $menuRecursive->menuRecursiveEdit($menu->parent_id);
            return view('admin.menus.edit', compact('menu', 'htmlOptions'));
        } else {
            return redirect()->route('menu.index')->with('error', 'Thông tin không tồn tại !');
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
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if ($menu->update($request->only('name', 'slug', 'parent_id'))) {
                return redirect()->route('menu.index')->with('success', 'Updated !');
            } else {
                return redirect()->route('menu.index')->with('error', 'Update Failed !');
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
        $menus = Menu::all();
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            $deleteRecursive = new DeleteMenu($menus, $menu);
            $deleteRecursive->deleteMenuRecursive($id);
            return redirect()->back()->with('success', 'Deleted !');
        }
    }
}