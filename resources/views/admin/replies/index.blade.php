@extends('admin/layout_master/layout_master')
@section('title', 'Reply List')

@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by comment"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-6 text-right">
            @if (isset($_GET['key']))
                <a href="{{ route('reply.index', $idReview) }}" class="btn btn-primary">All Reply</a>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Comment</th>
                        <th>Review</th>
                        <th>User</th>
                        <td>Create at</td>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <form action="{{ route('reply.update', $value->id) }}" method="post">
                            @csrf @method('PUT')
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->comment }}</td>
                                <td>{{ $value->getReview->comment }}</td>
                                <td>{{ $value->getUser->name }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <select name="status" style="width:120px" class="custom-select mr-sm-2"
                                        id="inlineFormCustomSelect">
                                        <option value="1"
                                            {{ $value->status == config('common.status.pulish') ? 'selected' : '' }}>
                                            Publish
                                        </option>
                                        <option value="0"
                                            {{ $value->status == config('common.status.unpulish') ? 'selected' : '' }}>Un
                                            Publish</option>
                                    </select>
                                </td>
                                <td>
                                    @can('reply-edit')
                                        <button onclick="return confirm('Bạn chắc chắn muốn update bản ghi này ?')"
                                            type="submit" class="badge badge-primary" style="border: none;"><i
                                                class="far fa-edit"></i></button>
                                    @endcan
                                    @can('reply-delete')
                                        <a href="" data-url="{{ route('reply.destroy', $value->id) }}"
                                            data-token="{{ csrf_token() }}" class="badge badge-danger btn-delete"><i
                                                class="far fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
            {{ $data->appends(request()->all())->links() }}
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 text-center">
            <a href="{{ route('review.index') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
@stop
@section('delete')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin_assets/js/delete_ajax.js') }}"></script>
@stop
