@extends('admin/layout_master/layout_master')
@section('title', 'Add Post Category')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('post-category.store') }}" method="post" role="form">
                @csrf
                <div class="form-group">
                    <label for="">Post category Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="title"
                        onkeyup="ChangeToSlug();" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <p style="color:red">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Slug *</label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug') }}">
                    @if ($errors->has('slug'))
                        <p style="color:red">{{ $errors->first('slug') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Status *</label>
                    <div class="form-control @error('status') is-invalid @enderror">
                        <label class="form-check-label" for=" inlineRadio1">Un Publish</label>
                        <input class="" type="radio" name="status" value="{{ config('common.status.unpulish') }}">
                        &nbsp;&nbsp;
                        <label class="form-check-label" for="inlineRadio1">Publish</label>
                        <input type="radio" name="status" value="{{ config('common.status.pulish') }}">
                    </div>
                    @if ($errors->has('status'))
                        <p style="color:red">{{ $errors->first('status') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('post-category.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('admin_assets/js/slug.js') }}"></script>
@stop
