@extends('admin/layout_master/layout_master')
@section('title', 'Post Category List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control"
                        placeholder="Search by setting post category name" style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('post-category.index') }}" class="btn btn-primary">All Post Category</a>
            @endif
        </div>

        <div class="col-md-3 text-right">
            <a href="{{ route('post-category.create') }}" class="btn btn-success">Add</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th>Total post</th>
                        <th scope="col">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->slug }}</td>
                            <td>
                                <div class="badge badge-success">{{ $value->getPost->count() }}</div>
                            </td>
                            @if ($value->status == 1)
                                <td>
                                    <div class="badge badge-success">{{ 'Publish' }}</div>
                                </td>
                            @elseif($value->status == 0)
                                <td>
                                    <div class="badge badge-danger">{{ 'Un Publish' }}</div>
                                </td>
                            @endif
                            <td>
                                <a href="{{ route('post-category.edit', $value->id) }}" class="badge badge-primary"><i
                                        class="far fa-edit"></i></a>
                                <a href="{{ route('post-category.destroy', $value->id) }}"
                                    class="badge badge-danger btn-delete"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="" method="post" id="delete-form">
                @csrf @method('DELETE')
            </form>
            {{ $data->appends(request()->all())->links() }}
        </div>
    </div>
@stop
@section('delete')
    <script>
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var _href = $(this).attr('href');
            $('#delete-form').attr('action', _href);
            if (confirm(
                    'Bạn có chắc chắn muốn xóa !'
                )) {
                $('#delete-form').submit();
            }
        });
    </script>
@stop
