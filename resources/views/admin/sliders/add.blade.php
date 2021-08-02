@extends('admin/layout_master/layout_master')
@section('title', 'Add Slider')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('slider.store') }}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Slider Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Slider Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <p style="color:red">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
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
                                <input name="image_path" onchange="readURL();" id="thumbnail" class="form-control"
                                    type="hidden">
                                @if ($errors->has('image_path'))
                                    <p style="color:red" id="disable-request">{{ $errors->first('image_path') }}</p>
                                @endif
                                <img src="" id="blah" alt=""
                                    style="max-height: 100px; max-width: 100px; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;display: none;">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Post Link</label> *</label>
                            <input type="text" name="post_link"
                                class="form-control @error('post_link') is-invalid @enderror"
                                value="{{ old('post_link') }}">
                            @if ($errors->has('post_link'))
                                <p style="color:red">{{ $errors->first('post_link') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status *</label>
                            <div class="form-control @error('status') is-invalid @enderror">
                                <label class="form-check-label" for=" inlineRadio1">Banner</label>
                                <input class="" type="radio" name="status"
                                    value="{{ config('common.status_sliders.banner') }}">
                                &nbsp;&nbsp;
                                <label class="form-check-label" for="inlineRadio1">Banner children</label>
                                <input type="radio" name="status"
                                    value="{{ config('common.status_sliders.banner_children') }}">
                            </div>
                            @if ($errors->has('status'))
                                <p style="color:red">{{ $errors->first('status') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Description *</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <p style="color:red">{{ $errors->first('description') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('slider.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
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
