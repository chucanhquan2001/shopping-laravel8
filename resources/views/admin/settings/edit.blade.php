@extends('admin/layout_master/layout_master')
@section('title', 'Edit Setting')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('setting.update', $setting->id) }}" method="post" role="form">
                @csrf @method('PUT')
                <input type="text" name="id" value="{{ $setting->id }}" hidden>
                <div class="form-group">
                    <label for="">Config Key *</label>
                    <input type="text" name="config_key" class="form-control @error('config_key') is-invalid @enderror"
                        value="{{ $setting->config_key }}">
                    @if ($errors->has('config_key'))
                        <p style="color:red">{{ $errors->first('config_key') }}</p>
                    @endif
                </div>
                @if ($setting->type === 'text')
                    <div class="form-group">
                        <label for="">Config Value *</label>
                        <input type="text" name="config_value"
                            class="form-control @error('config_value') is-invalid @enderror"
                            value="{{ $setting->config_value }}">
                        @if ($errors->has('config_value'))
                            <p style="color:red">{{ $errors->first('config_value') }}</p>
                        @endif
                    </div>
                @elseif($setting->type === 'textarea')
                    <div class="form-group">
                        <label for="">Config Value *</label>
                        <textarea name="config_value" id="" cols="30" rows="10"
                            class="form-control @error('config_value') is-invalid @enderror ">{{ $setting->config_value }}</textarea>
                        @if ($errors->has('config_value'))
                            <p style="color:red">{{ $errors->first('config_value') }}</p>
                        @endif
                    </div>
                @else
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
                            <input name="config_value" onchange="readURL();" id="thumbnail" class="form-control"
                                type="hidden">
                            @if ($errors->has('config_value'))
                                <p style="color:red" id="disable-request">{{ $errors->first('config_value') }}</p>
                            @endif
                            <img src="{{ $setting->config_value }}" id="blah" alt=""
                                style="max-height: 100px; max-width: 200px; border-radius: 5px; border: 2px solid #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('setting.index') }}" class="btn btn-danger">Back</a>
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
@endsection
