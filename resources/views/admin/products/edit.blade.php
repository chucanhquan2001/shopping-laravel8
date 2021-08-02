@extends('admin/layout_master/layout_master')
@section('title', 'Edit Product')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('product.update', $data->id) }}" method="post" role="form"
                enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="text" name="id" value="{{ $data->id }}" hidden>
                <input type="text" name="product_variant_id" value="{{ $dataProductVariant->id }}" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Sku *</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku"
                                value="{{ $dataProductVariant->sku }}">
                            @if ($errors->has('sku'))
                                <p style="color:red">{{ $errors->first('sku') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Product Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="title" onkeyup="ChangeToSlug();" value="{{ $data->name }}">
                            @if ($errors->has('name'))
                                <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Slug *</label>
                            <input type="text" name="slug" id="slug"
                                class="form-control @error('slug') is-invalid @enderror" value="{{ $data->slug }}">
                            @if ($errors->has('slug'))
                                <p style="color:red">{{ $errors->first('slug') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Status *</label>
                            <div class="form-control @error('status') is-invalid @enderror">
                                <label class="form-check-label" for=" inlineRadio1">Un Publish</label>
                                <input class="" type="radio" name="status" value="{{ config('common.status.unpulish') }}"
                                    @if ($data->status == config('common.status.unpulish')) {{ 'checked' }} @endif>
                                &nbsp;&nbsp;
                                <label class="form-check-label" for="inlineRadio1">Publish</label>
                                <input type="radio" name="status" value="{{ config('common.status.pulish') }}" @if ($data->status == config('common.status.pulish')) {{ 'checked' }} @endif>
                            </div>
                            @if ($errors->has('status'))
                                <p style="color:red">{{ $errors->first('status') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Tags *</label>
                            <select class="form-control tags_select_choose @error('tag') is-invalid @enderror" name="tag[]"
                                multiple="multiple">
                                @foreach ($data->getTag as $item)
                                    <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tag'))
                                <p style="color:red">{{ $errors->first('tag') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Select Category *</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                {!! $htmlOptions !!}
                            </select>
                            @if ($errors->has('category_id'))
                                <p style="color:red">{{ $errors->first('category_id') }}</p>
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
                                @if ($errors->has('image'))
                                    <p style="color:red" id="disable-request">{{ $errors->first('image') }}</p>
                                @endif
                                <img src="{{ $dataProductVariant->image }}" id="blah" alt=""
                                    style="height: 205px;width: 100px; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;margin-bottom: 5px">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Price *</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ $dataProductVariant->price }}">
                            @if ($errors->has('price'))
                                <p style="color:red">{{ $errors->first('price') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Discount *</label>
                            <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror"
                                value="{{ $dataProductVariant->discount }}" placeholder="%">
                            @if ($errors->has('discount'))
                                <p style="color:red">{{ $errors->first('discount') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Quantity *</label>
                            <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ $dataProductVariant->quantity }}">
                            @if ($errors->has('quantity'))
                                <p style="color:red">{{ $errors->first('quantity') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Content *</label>
                            <textarea name="content" class="form-control my-editor">{{ $data->content }}</textarea>
                            @if ($errors->has('content'))
                                <p style="color:red">{{ $errors->first('content') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Description *</label>
                            <textarea name="description"
                                class="form-control my-editor">{{ $data->description }}</textarea>
                            @if ($errors->has('description'))
                                <p style="color:red">{{ $errors->first('description') }}</p>
                            @endif
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
                                            {{ $dataProductVariant->getVariantValues->contains('id', $valueItem->id) ? 'selected' : '' }}>
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
                        <a href="{{ route('product.index') }}" class="btn btn-danger">Back</a>
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
    {{-- tags --}}
    <script>
        $(".tags_select_choose").select2({
            tags: true,
            tokenSeparators: [',']
        })
    </script>
    {{-- end tags --}}
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

    <script>
        var editor_config = {
            path_absolute: "/",
            selector: 'textarea.my-editor',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@stop
