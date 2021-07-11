@extends('admin/layout_master/layout_master')
@section('title', 'Add Setting')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('setting.store') }}" method="post" role="form">
                @csrf
                <input type="text" name="type" value="{{ request()->type == 'text' ? 'text' : 'textarea' }}" hidden>
                <div class="form-group">
                    <label for="">Config Key *</label>
                    <input type="text" name="config_key" class="form-control @error('config_key') is-invalid @enderror"
                        value="{{ old('config_key') }}">
                    @if ($errors->has('config_key'))
                        <p style="color:red">{{ $errors->first('config_key') }}</p>
                    @endif
                </div>
                @if (request()->type === 'text')
                    <div class="form-group">
                        <label for="">Config Value *</label>
                        <input type="text" name="config_value"
                            class="form-control @error('config_value') is-invalid @enderror"
                            value="{{ old('config_value') }}">
                        @if ($errors->has('config_value'))
                            <p style="color:red">{{ $errors->first('config_value') }}</p>
                        @endif
                    </div>
                @else
                    <div class="form-group">
                        <label for="">Config Value *</label>
                        <textarea name="config_value" id="" cols="30" rows="10"
                            class="form-control @error('config_value') is-invalid @enderror ">{{ old('config_value') }}</textarea>
                        @if ($errors->has('config_value'))
                            <p style="color:red">{{ $errors->first('config_value') }}</p>
                        @endif
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
