@extends('admin/layout_master/layout_master')
@section('title', 'Setting List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by setting config key"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('setting.index') }}" class="btn btn-primary">All Setting</a>
            @endif
        </div>
        @can('setting-add')
            <div class="col-md-3 text-right">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Add
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('setting.create') . '?type=text' }}"
                            class="btn btn-success">Text</a>
                        <a class="dropdown-item" href="{{ route('setting.create') . '?type=textarea' }}"
                            class="btn btn-success">Textarea</a>
                        <a class="dropdown-item" href="{{ route('setting.create') . '?type=image' }}"
                            class="btn btn-success">Image</a>
                    </div>
                </div>
            </div>
        @endcan
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Config Key</th>
                        <th scope="col">Config Value</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->config_key }}</td>
                            <td>
                                @if ($value->type == 'image')
                                    <img src="{{ $value->config_value }}"
                                        style="width:100px; max-height: 150px ; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
                                        alt="">
                                @else
                                    {{ $value->config_value }}
                                @endif
                            </td>
                            <td>
                                @can('setting-edit')
                                    <a href="{{ route('setting.edit', $value->id) }}" class="badge badge-primary"><i
                                            class="far fa-edit"></i></a>
                                @endcan
                                @can('setting-delete')
                                    <a href="" data-url="{{ route('setting.destroy', $value->id) }}"
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
