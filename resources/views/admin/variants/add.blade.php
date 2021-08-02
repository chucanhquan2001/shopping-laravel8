@extends('admin/layout_master/layout_master')
@section('title', 'Add Variant')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('variant.store') }}" method="post" role="form">
                @csrf
                <div class="form-group">
                    <label for="">Variant *</label>
                    <input type="text" name="variant" class="form-control @error('variant') is-invalid @enderror"
                        value="{{ old('variant') }}">
                    @if ($errors->has('variant'))
                        <p style="color:red">{{ $errors->first('variant') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Type *</label>
                    <select name="type" id="" class="form-control">
                        <option value="text">Text</option>
                        <option value="color">Color</option>
                    </select>
                    @if ($errors->has('type'))
                        <p style="color:red">{{ $errors->first('type') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('variant.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
