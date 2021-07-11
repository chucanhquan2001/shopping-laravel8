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
