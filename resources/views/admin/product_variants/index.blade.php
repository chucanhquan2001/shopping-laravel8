@extends('admin/layout_master/layout_master')
@section('title', 'Product variant List')
@section('main')
    @can('product-add')
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ route('product-variant.create', $idProduct) }}" class="btn btn-success">Add new product
                    variant</a>
            </div>
        </div>
    @endcan
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sku</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Variant value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->sku }}</td>
                            <td>{{ number_format($value->price) }} đ</td>
                            <td>{{ $value->discount }} %</td>
                            <td><img src="{{ $value->image }}"
                                    style="width:50px; max-height: 100px ; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
                                    alt=""></td>
                            <td>{{ $value->quantity }}</td>
                            @if ($value->status == config('common.product_variants.status.main'))
                                <td>
                                    <div class="badge badge-success">{{ 'Main' }}</div>
                                </td>
                            @elseif($value->status == config('common.product_variants.status.extra'))
                                <td>
                                    <div class="badge badge-danger">{{ 'Extra' }}</div>
                                </td>
                            @endif
                            <td>
                                {{-- @php
                                    dd($value->getVariantValues());
                                @endphp --}}
                                @foreach ($value->getVariantValues as $variantValueItem)
                                    <div class="badge badge-danger">{{ $variantValueItem->value }}</div>
                                @endforeach
                            </td>
                            <td>
                                @can('product-edit')
                                    <a href="{{ route('product-variant.edit', $value->id) }}" class="badge badge-primary"><i
                                            class="far fa-edit"></i></a>
                                @endcan
                                @can('product-delete')
                                    <a href="" data-url="{{ route('product-variant.destroy', $value->id) }}"
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
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 text-center">
            <a href="{{ route('product.index') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
@stop
@section('delete')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin_assets/js/delete_ajax.js') }}"></script>
@stop
