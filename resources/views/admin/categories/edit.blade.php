@extends('admin/layout_master/layout_master')
@section('title', 'Edit Category')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('category.update', $cate->id) }}" method="post" role="form">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" hidden name="id" value="{{ $cate->id }}">
                            <label for="">Category Name *</label>
                            <input type="text" name="name" value="{{ $cate->name }}"
                                class="form-control @error('name') is-invalid @enderror" id="title"
                                onkeyup="ChangeToSlug();">
                            @if ($errors->has('name'))
                                <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Slug *</label>
                            <input type="text" name="slug" value="{{ $cate->slug }}" id="slug"
                                class="form-control @error('slug') is-invalid @enderror">
                            @if ($errors->has('slug'))
                                <p style="color:red">{{ $errors->first('slug') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Select Parent Category *</label>
                            <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="0">Select Parent Category</option>
                                {!! $htmlOptions !!}
                            </select>
                            @if ($errors->has('parent_id'))
                                <p style="color:red">{{ $errors->first('parent_id') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image *</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="image_file_manager" data-input="thumbnail" data-preview="holder"
                                        class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                &nbsp;&nbsp;&nbsp;
                                <input name="image" onchange="readURL();" id="thumbnail" class="form-control" type="hidden">
                                @if ($errors->has('image'))
                                    <p style="color:red" id="disable-request">{{ $errors->first('image') }}</p>
                                @endif
                                <img src="{{ $cate->image }}" id="blah" alt=""
                                    style="max-height: 100px; max-width: 100px; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Status *</label>
                            <div class="form-control @error('status') is-invalid @enderror">
                                <label class="form-check-label" for=" inlineRadio1">Un Publish</label>
                                <input class="" type="radio" name="status" value="{{ config('common.status.unpulish') }}"
                                    @if ($cate->status == config('common.status.unpulish')) {{ 'checked' }} @endif>
                                &nbsp;&nbsp;
                                <label class="form-check-label" for="inlineRadio1">Publish</label>
                                <input type="radio" name="status" value="{{ config('common.status.pulish') }}" @if ($cate->status == config('common.status.pulish')) {{ 'checked' }} @endif>
                            </div>
                            @if ($errors->has('status'))
                                <p style="color:red">{{ $errors->first('status') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('category.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('admin_assets/js/slug.js') }}"></script>
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
@stop
