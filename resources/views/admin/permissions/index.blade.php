@extends('admin/layout_master/layout_master')
@section('title', 'Permission List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" value="{{ old('key') }}" name="key" id="" class="form-control"
                        placeholder="Search by permission name" style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('permission.index') }}" class="btn btn-primary">All permission</a>
            @endif
        </div>
        @can('role-add')
            <div class="col-md-3 text-right">
                <a href="{{ route('permission.create') }}" class="btn btn-success">Add</a>
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
                        <td>ID</td>
                        <th scope="col">Name</th>
                        <th>Key code</th>
                        <th scope="col">Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->key_code }}</td>
                            <td>{{ $value->display_name }}</td>
                            <td>
                                @can('role-edit')
                                    <a href="{{ route('permission.edit', $value->id) }}" class="badge badge-primary"><i
                                            class="far fa-edit"></i></a>
                                @endcan
                                @can('role-delete')
                                    <a href="" data-url="{{ route('permission.destroy', $value->id) }}"
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
