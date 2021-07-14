@extends('admin/layout_master/layout_master')
@section('title', 'Edit Post')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('post.update', $data->id) }}" method="post" role="form">
                @csrf @method('PUT')
                <input type="text" name="id" value="{{ $data->id }}" hidden>
                <div class="form-group">
                    <label for="">Post Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                        onkeyup="ChangeToSlug();" value="{{ $data->title }}">
                    @if ($errors->has('title'))
                        <p style="color:red">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Slug *</label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                        value="{{ $data->slug }}">
                    @if ($errors->has('slug'))
                        <p style="color:red">{{ $errors->first('slug') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Meta description *</label>
                    <textarea name="meta_description"
                        class="form-control my-editor">{{ $data->meta_description }}</textarea>
                    @if ($errors->has('meta_description'))
                        <p style="color:red">{{ $errors->first('meta_description') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Content *</label>
                    <textarea name="content" class="form-control my-editor">{{ $data->content }}</textarea>
                    @if ($errors->has('content'))
                        <p style="color:red">{{ $errors->first('content') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Image *</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="image_file_manager" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        &nbsp;&nbsp;&nbsp;
                        <input name="image" onchange="readURL();" id="thumbnail" class="form-control" type="hidden">
                        @if ($errors->has('image'))
                            <p style="color:red" id="disable-request">{{ $errors->first('image') }}</p>
                        @endif
                        <img src="{{ $data->image }}" id="blah" alt=""
                            style="max-height: 100px; max-width: 100px; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Status *</label>
                    <div class="form-control @error('status') is-invalid @enderror">
                        <label class="form-check-label" for=" inlineRadio1">Un Publish</label>
                        <input class="" type="radio" name="status" value="0" @if ($data->status == 0) {{ 'checked' }} @endif>
                        &nbsp;&nbsp;
                        <label class="form-check-label" for="inlineRadio1">Publish</label>
                        <input type="radio" name="status" value="1" @if ($data->status == 1) {{ 'checked' }} @endif>
                    </div>
                    @if ($errors->has('status'))
                        <p style="color:red">{{ $errors->first('status') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Post category *</label>
                    <select name="post_category_id" id="" class="form-control">
                        @foreach ($postCate as $key => $value)
                            <option value="{{ $value->id }}" @if ($data->post_category_id == $value->id) {{ 'selected' }} @endif>{{ $value->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('post_category_id'))
                        <p style="color:red">{{ $errors->first('post_category_id') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('post.index') }}" class="btn btn-danger">Back</a>
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
    <script>
        $('#image_file_manager').filemanager('image');
    </script>
    <script>
        function readURL() {
            var _link = $('input#thumbnail').val();
            var _img = "{{ env('APP_URL') }}" + _link;
            $('#blah').attr('src', _img);
            $('#blah').css("display", "block");
            $('#disable-request').css("display", "none");
        }
    </script>
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
