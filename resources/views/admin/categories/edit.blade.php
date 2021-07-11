@extends('admin/layout_master/layout_master')
@section('title', 'Edit Category')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('category.update', $cate->id) }}" method="post" role="form">
                @csrf @method('PUT')
                <div class="form-group">
                    <input type="text" hidden name="id" value="{{ $cate->id }}">
                    <label for="">Category Name *</label>
                    <input type="text" name="name" value="{{ $cate->name }}"
                        class="form-control @error('name') is-invalid @enderror" id="title" onkeyup="ChangeToSlug();">
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
