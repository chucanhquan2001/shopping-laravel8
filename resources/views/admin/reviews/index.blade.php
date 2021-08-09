@extends('admin/layout_master/layout_master')
@section('title', 'Review List')

@section('main')
    <div class="row">
        <div class="col-md-6">
            <form class="form-inline" action="" role="form">
                <div class="form-group">
                    <input type="text" name="key" id="" class="form-control" placeholder="Search by name"
                        style="width: 300px">
                </div>&nbsp;
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-6 text-right">
            @if (isset($_GET['key']))
                <a href="{{ route('slider.index') }}" class="btn btn-primary">All Review</a>
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th>Star</th>
                        <th>Comment</th>
                        <th>Product</th>
                        @can('reply-list')
                            <th>Reply</th>
                        @endcan
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <form action="{{ route('review.update', $value->id) }}" method="post">
                            @csrf @method('PUT')
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->rating_star }}</td>
                                <td>{{ $value->comment }}</td>
                                <td>{{ $value->getProduct->name }}</td>
                                @can('reply-list')
                                    @if ($value->getReplies->count() > 0)
                                        <td>
                                            <a href="{{ route('reply.index', $value->id) }}">Replied</a>
                                        </td>
                                    @else
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('client.product.detail', $value->getProduct->slug) }}">Not
                                                replied</a>
                                        </td>
                                        </td>
                                    @endif
                                @endcan
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
                                    @can('review-edit')
                                        <button onclick="return confirm('Bạn chắc chắn muốn update bản ghi này ?')"
                                            type="submit" class="badge badge-primary" style="border: none;"><i
                                                class="far fa-edit"></i></button>
                                    @endcan
                                    @can('review-delete')
                                        <a href="" data-url="{{ route('review.destroy', $value->id) }}"
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
@stop
@section('delete')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin_assets/js/delete_ajax.js') }}"></script>
@stop
