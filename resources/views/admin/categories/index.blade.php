@extends('admin/layout_master/layout_master')
@section('title', 'Category List')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by category name"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-3">
            @if (isset($_GET['key']))
                <a href="{{ route('category.index') }}" class="btn btn-primary">All Category</a>
            @endif
        </div>

        <div class="col-md-3 text-right">
            <a href="{{ route('category.create') }}" class="btn btn-success">Add</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th>Total Product</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->slug }}</td>
                            <td>
                                <span class="badge badge-primary">4</span>
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $value->id) }}" class="badge badge-primary"><i
                                        class="far fa-edit"></i></a>
                                <a href="{{ route('category.destroy', $value->id) }}"
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
                    'Xóa danh mục này đồng nghĩa với việc xóa các danh mục con của nó (nếu có), bạn có chắc chắn muốn xóa !'
                )) {
                $('#delete-form').submit();
            }
        });
    </script>
@stop
