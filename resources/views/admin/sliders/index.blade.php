@extends('admin/layout_master/layout_master')
@section('title', 'Slider List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by slider name"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('slider.index') }}" class="btn btn-primary">All Slider</a>
            @endif
        </div>
        @can('slider-add')
            <div class="col-md-3 text-right">
                <a href="{{ route('slider.create') }}" class="btn btn-success">Add</a>
            </div>
        @endcan
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Slider Name</th>
                        <th scope="col" style="max-width: 200px;">Slider Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->name }}</td>
                            <td style="max-width: 200px;">{{ $value->title }}</td>
                            <td><img src="{{ $value->image_path }}"
                                    style="width:200px; max-height: 150px ; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
                                    alt=""></td>
                            @if ($value['status'] == config('common.status_sliders.banner'))
                                <td>
                                    <div class="badge badge-success">{{ 'Banner' }}</div>
                                </td>
                            @elseif($value['status'] == config('common.status_sliders.banner_children'))
                                <td>
                                    <div class="badge badge-danger">{{ 'Banner children' }}</div>
                                </td>
                            @endif
                            <td>
                                @can('slider-edit')
                                    <a href="{{ route('slider.edit', $value->id) }}" class="badge badge-primary"><i
                                            class="far fa-edit"></i></a>
                                @endcan
                                @can('slider-delete')
                                    <a href="" data-url="{{ route('slider.destroy', $value->id) }}"
                                        data-token="{{ csrf_token() }}" class="badge badge-danger btn-delete"><i
                                            class="far fa-trash-alt"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->appends(request()->all())->links() }}
        </div>
    </div>
@stop
@section('delete')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin_assets/js/delete_ajax.js') }}"></script>
@stop
