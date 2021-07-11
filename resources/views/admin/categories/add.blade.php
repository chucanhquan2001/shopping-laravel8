@extends('admin/layout_master/layout_master')
@section('title', 'Add Category')
@section('main')
    <div class="row">

        <div class="col-md-6">
            <form action="{{ route('category.store') }}" method="post" role="form">
                @csrf
                <div class="form-group">
                    <label for="">Category Name *</label>
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
                    <label for="">Select Parent Category *</label>
                    <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id">
                        <option value="0" {{ old('parent_id') == 0 ? 'selected' : '' }}>Select Parent Category</option>
                        {!! $htmlOptions !!}
                    </select>
                    @if ($errors->has('parent_id'))
                        <p style="color:red">{{ $errors->first('parent_id') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
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
@stop
