@extends('admin/layout_master/layout_master')
@section('title', 'Invoice Detail')

@section('main')
@can('invoice-edit')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('invoice.update', $invoice_id) }}" method="post">
                @csrf
                <div class=" form-group">
                    <label>Custom invoice status </label>
                    <select name="status" id="" class="form-control">
                        <option value="{{ config('common.invoice.status.cho_xac_nhan') }}"
                            {{ $dataInvoice->status == config('common.invoice.status.cho_xac_nhan') ? ' selected' : '' }}>
                            Chờ xác nhận</option>
                        <option value="{{ config('common.invoice.status.cho_lay_hang') }}"
                            {{ $dataInvoice->status == config('common.invoice.status.cho_lay_hang') ? ' selected' : '' }}>
                            Chờ lấy hàng</option>
                        <option value="{{ config('common.invoice.status.dang_giao') }}"
                            {{ $dataInvoice->status == config('common.invoice.status.dang_giao') ? ' selected' : '' }}>
                            Đang giao</option>
                        <option value="{{ config('common.invoice.status.da_giao') }}"
                            {{ $dataInvoice->status == config('common.invoice.status.da_giao') ? ' selected' : '' }}>
                            Đã giao</option>
                        <option value="{{ config('common.invoice.status.da_huy') }}"
                            {{ $dataInvoice->status == config('common.invoice.status.da_huy') ? ' selected' : '' }}>
                            Đã hủy</option>
                    </select>
                </div>
                <button onclick="return confirm('Bạn chắc chắn muốn update trạng thái đơn hàng này ?')" type="submit"
                    class="btn btn-primary">Cập nhập</button>
            </form>
        </div>
    </div>
    <hr>
@endcan
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Product</th>
                    <th>Image</th>
                    <td>Color</td>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)

                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->getProductVariant->getProduct->name }}</td>
                        <td><img src="{{ $value->getProductVariant->image }}" alt="" style="max-width: 100px;"></td>
                        <td>{{ $value->color }}</td>
                        <td>{{ $value->unit_price }}</td>
                        <td>{{ $value->quantity }}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-12 text-center">
        <a href="{{ route('invoice.index') }}" class="btn btn-danger">Back</a>
    </div>
</div>
@stop
