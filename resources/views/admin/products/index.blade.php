@extends('admin/layout_master/layout_master')
@section('title', 'Product List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by product name"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('product.index') }}" class="btn btn-primary">All product</a>
            @endif
        </div>
        @can('product-add')
            <div class="col-md-3 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-success">Add</a>
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
                        <th scope="col">Product Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->name }}</td>
                            <td><img src="{{ $value->getProductVariant()->where('status', 0)->first()->image }}"
                                    style="width:50px; max-height: 100px ; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
                                    alt=""></td>
                            @if ($value['status'] == config('common.status.pulish'))
                                <td>
                                    <div class="badge badge-success">{{ 'Publish' }}</div>
                                </td>
                            @elseif($value['status'] == config('common.status.unpulish'))
                                <td>
                                    <div class="badge badge-danger">{{ 'Un Publish' }}</div>
                                </td>
                            @endif
                            <td>
                                {{ optional($value->getCate)->name }}
                            </td>
                            <td>
                                @can('product-edit')
                                    <a href="{{ route('product.edit', $value->id) }}">Edit</a>
                                @endcan
                                @can('product-delete') |
                                    <a href="" data-url=" {{ route('product.destroy', $value->id) }}"
                                        data-token="{{ csrf_token() }}" class="btn-delete">Delete</a>
                                    <br>
                                @endcan
                                <a href="{{ route('product-variant.index', $value->id) }}">Variants</a>
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
