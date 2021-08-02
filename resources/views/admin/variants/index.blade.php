@extends('admin/layout_master/layout_master')
@section('title', 'Variant List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by variant name"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('variant.index') }}" class="btn btn-primary">All Variant</a>
            @endif
        </div>
        @can('variant-add')
            <div class="col-md-3 text-right">
                <a href="{{ route('variant.create') }}" class="btn btn-success">Add</a>
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
                        <th scope="col">Variant</th>
                        <th scope="col">Type</th>
                        <th>Variation Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->variant }}</td>
                            <td>{{ $value->type }}</td>
                            <td>
                                @foreach ($value->getVariantValue as $item)
                                    <span class="badge badge-success">{{ $item->value }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('variant-edit')
                                    <a href="{{ route('variant.edit', $value->id) }}" class="badge badge-primary"><i
                                            class="far fa-edit"></i></a>
                                @endcan
                                @can('variant-delete')
                                    <a href="" data-url="{{ route('variant.destroy', $value->id) }}"
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
