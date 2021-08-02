@extends('admin/layout_master/layout_master')
@section('title', 'Edit Product Variant')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('product-variant.update', $data->id) }}" method="post" role="form"
                enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="text" name="id" value="{{ $data->id }}" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Sku *</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku"
                                value="{{ $data->sku }}">
                            @if ($errors->has('sku'))
                                <p style="color:red">{{ $errors->first('sku') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Price *</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ $data->price }}">
                            @if ($errors->has('price'))
                                <p style="color:red">{{ $errors->first('price') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Discount *</label>
                            <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror"
                                value="{{ $data->discount }}" placeholder="%">
                            @if ($errors->has('discount'))
                                <p style="color:red">{{ $errors->first('discount') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Quantity *</label>
                            <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ $data->quantity }}">
                            @if ($errors->has('quantity'))
                                <p style="color:red">{{ $errors->first('quantity') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image *</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="thumbnail" data-preview="holder"
                                        class="btn btn-primary image_file_manager">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                &nbsp;&nbsp;&nbsp;
                                <input name="image" onchange="readURL();" id="thumbnail" class="form-control" type="hidden">
                                <img src="{{ $data->image }}" id="blah" alt=""
                                    style="height: 205px;width: 120px; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;margin-bottom: 5px">
                                @if ($errors->has('image'))
                                    <p style="color:red" id="disable-request">{{ $errors->first('image') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($getVariant as $key => $variantItem)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $variantItem->variant }} *</label>
                                <select class="form-control role_select_choose @error('role') is-invalid @enderror"
                                    name="variant_value_id[]" multiple>
                                    <option value=""></option>
                                    @foreach (App\Models\VariantValue::where('variant_id', $variantItem->id)->get() as $valueItem)
                                        <option value="{{ $valueItem->id }}"
                                            {{ $data->getVariantValues->contains('id', $valueItem->id) ? 'selected' : '' }}>
                                            {{ $valueItem->value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('variant_value_id'))
                                    <p style="color:red">{{ $errors->first('variant_value_id') }}</p>
                                @endif
                                <br><br>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('product-variant.index', $data->getProduct->id) }}"
                            class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('admin_assets/js/slug.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- quản lý ảnh --}}
    <script>
        $('.image_file_manager').filemanager('image');
    </script>
    {{-- end quản lý ảnh --}}

    {{-- chọn thuộc tính --}}
    <script>
        $(".role_select_choose").select2({
            'placeholder': 'Choose variant'
        })
    </script>
    {{-- end chọn thuộc tính --}}
    {{-- Hiện thị ảnh --}}
    <script>
        function readURL() {
            var _link = $('input#thumbnail').val();
            var _img = "{{ env('APP_URL') }}" + _link;
            $('#blah').attr('src', _img);
            // $('#blah').css("display", "block");
            $('#disable-request').css("display", "none");
        }
    </script>
    {{-- End hiển thị ảnh --}}

@stop
