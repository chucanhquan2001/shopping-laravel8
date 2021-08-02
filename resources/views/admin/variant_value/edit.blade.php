@extends('admin/layout_master/layout_master')
@section('title', 'Edit Variant Value')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('variant-value.update', $data->id) }}" method="post" role="form">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="">Value *</label>
                    <input type="name" name="value" class="form-control @error('value') is-invalid @enderror"
                        value="{{ $data->value }}">
                    @if ($errors->has('value'))
                        <p style="color:red">{{ $errors->first('value') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Variant *</label>
                    <select name="variant_id" class="form-control">
                        @foreach ($getVariant as $key => $value)
                            <option value="{{ $value->id }}" {{ $value->id == $data->variant_id ? ' selected' : '' }}>
                                {{ $value->variant }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('variant_id'))
                        <p style="color:red">{{ $errors->first('variant_id') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('variant-value.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
