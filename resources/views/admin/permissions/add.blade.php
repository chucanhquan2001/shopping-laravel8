@extends('admin/layout_master/layout_master')
@section('title', 'Add Permission')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('permission.store') }}" method="post" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Permission Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Key code *</label>
                            <input type="text" name="key_code" class="form-control @error('key_code') is-invalid @enderror"
                                value="{{ old('key_code') }}">
                            @if ($errors->has('key_code'))
                                <p style="color:red">{{ $errors->first('key_code') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Description *</label>
                            <input type="text" name="display_name"
                                class="form-control @error('display_name') is-invalid @enderror"
                                value="{{ old('display_name') }}">
                            @if ($errors->has('display_name'))
                                <p style="color:red">{{ $errors->first('display_name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Permission parent</label>
                            <select name="parent_id" id="" class="form-control">
                                <option value="0">Permission parent</option>
                                @foreach ($permissionParent as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                                <p style="color:red">{{ $errors->first('parent_id') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:20px">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('permission.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
