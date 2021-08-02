@extends('admin.layout_master.layout_master')
@section('title', 'Create User')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('user.store') }}" method="post" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password *</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <p style="color:red">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password confirm *</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                value="{{ old('password_confirmation') }}">
                            @if ($errors->has('password_confirmation'))
                                <p style="color:red">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <p style="color:red">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Active *</label>
                            <div class="form-control @error('active') is-invalid @enderror">
                                <label class="form-check-label" for=" inlineRadio1">Lock</label>
                                <input type="radio" name="active" value="{{ config('common.active.lock') }}">
                                &nbsp;&nbsp;
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                                <input type="radio" name="active" value="{{ config('common.active.active') }}">
                            </div>
                            @if ($errors->has('active'))
                                <p style="color:red">{{ $errors->first('active') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Role *</label>
                            <select class="form-control role_select_choose @error('role') is-invalid @enderror"
                                name="role_id[]" multiple>
                                <option value=""></option>
                                @foreach ($roles as $roleItem)
                                    <option value="{{ $roleItem->id }}">{{ $roleItem->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role_id'))
                                <p style="color:red">{{ $errors->first('role_id') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('user.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".role_select_choose").select2({
            'placeholder': 'Choose role'
        })
    </script>
@endsection
