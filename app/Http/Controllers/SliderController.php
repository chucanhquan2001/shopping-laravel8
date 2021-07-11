<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Sliders\StoreRequest;
use App\Http\Requests\Sliders\UpdateRequest;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slider::orderBy('id', 'DESC')->search()->paginate(10);
        return view('admin.sliders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //TẢI FILE BÌNH THƯỜNG
        // $file = $request->image_path;
        // // lấy tên gốc của ảnh
        // $fileNameOrigin = $file->getClientOriginalName();
        // // đặt tên ảnh
        // $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
        // // lưu ảnh vào thư mục storage/public/sliders/id user đang đăng nhập/
        // $filePath = $request->file('image_path')->storeAs(
        //     'public/sliders/' . Auth::id(),
        //     $fileNameHash
        // );
        // $data = [
        //     'file_name' => $fileNameOrigin,
        //     // url storage để thay public/ thành storage/ trên path để lưu vào db và in ra ngoài
        //     'file_path' => Storage::url($filePath)
        // ];
        // dd($data);

        // Tải ảnh bằng file manager và
        // dd(env('APP_URL'));
        Slider::create($request->all());
        return redirect()->route('slider.index')->with('success', 'Added !');
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

        $data = Slider::find($id);
        if (!$data) {
            return redirect()->route('slider.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            return view('admin.sliders.edit', compact('data'));
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
        $slider = Slider::find($id);
        if (!$slider) {
            return redirect()->route('slider.index')->with('error', 'Thông tin không tồn tại !');
        } else {
            if (empty($request->image_path)) {
                if ($slider->update($request->only('name', 'title', 'description', 'post_link', 'status'))) {
                    return redirect()->route('slider.index')->with('success', 'Updated !');
                } else {
                    return redirect()->route('slider.index')->with('error', 'Update Failed !');
                }
            } else {
                if ($slider->update($request->only('name', 'title', 'description', 'post_link', 'image_path', 'status'))) {
                    return redirect()->route('slider.index')->with('success', 'Updated !');
                } else {
                    return redirect()->route('slider.index')->with('error', 'Update Failed !');
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
        if (Slider::find($id)) {
            Slider::find($id)->delete();
            return redirect()->back()->with('success', 'Deleted !');
        } else {
            return redirect()->route('slider.index')->with('error', 'Thông tin không tồn tại !');
        }
    }
}