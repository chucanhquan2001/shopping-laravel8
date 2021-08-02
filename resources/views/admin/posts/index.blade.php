@extends('admin/layout_master/layout_master')
@section('title', 'Post List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by setting post title"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('post.index') }}" class="btn btn-primary">All Post</a>
            @endif
        </div>
        @can('post-add')
            <div class="col-md-3 text-right">
                <a href="{{ route('post.create') }}" class="btn btn-success">Add</a>
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
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th>Post Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->slug }}</td>
                            <td><img src="{{ $value->image }}"
                                    style="width:200px; max-height: 150px ; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
                                    alt=""></td>
                            @if ($value->status == config('common.status.pulish'))
                                <td>
                                    <div class="badge badge-success">{{ 'Publish' }}</div>
                                </td>
                            @elseif($value->status == config('common.status.unpulish'))
                                <td>
                                    <div class="badge badge-danger">{{ 'Un Publish' }}</div>
                                </td>
                            @endif
                            <td>
                                {{ $value->postCategory->name }}
                            </td>
                            <td>
                                @can('post-edit')
                                    <a href="{{ route('post.edit', $value->id) }}" class="badge badge-primary"><i
                                            class="far fa-edit"></i></a>
                                @endcan
                                @can('post-delete')
                                    <a href="" data-url="{{ route('post.destroy', $value->id) }}"
                                        data-token="{{ csrf_token() }}" class="badge badge-danger btn-delete"><i
                                            class="far fa-trash-alt"></i></a>
                                @endcan
                                <a href="#" class="badge badge-secondary btn-delete"><i class="fas fa-eye"></i></a>
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
