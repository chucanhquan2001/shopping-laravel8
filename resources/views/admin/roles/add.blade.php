@extends('admin/layout_master/layout_master')
@section('title', 'Add Role')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('role.store') }}" method="post" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Role Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <p style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Description Role*</label>
                            <input type="text" name="display_name"
                                class="form-control @error('display_name') is-invalid @enderror"
                                value="{{ old('display_name') }}">
                            @if ($errors->has('display_name'))
                                <p style="color:red">{{ $errors->first('display_name') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input type="checkbox" class="check_all">&nbsp;
                        <label for="">Permission All</label>
                    </div>
                    <div class="col-md-12">
                        @foreach ($permissionParent as $itemParent)
                            <div class="card" style="width: 100%;">
                                <div class="card-header" style="height: 70px">
                                    <label for="">
                                        <input type="checkbox" value="" class="checkbox_parent">
                                    </label>&nbsp;
                                    <span style="font-weight: bold; color: green">Module {{ $itemParent->name }}</span>
                                </div>
                                <div class="row" style="padding: 10px 28px">
                                    @foreach ($itemParent->getPermissions as $itemChildren)
                                        <div class="col-md-3">
                                            <label for="">
                                                <input type="checkbox" name="permission_id[]"
                                                    value="{{ $itemChildren->id }}" class="checkbox_children">
                                            </label>&nbsp;
                                            {{ $itemChildren->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>

                <div class="row" style="margin-top:20px">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('role.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(".checkbox_parent").on("click", function() {
            $(this).parents('.card').find(".checkbox_children").prop("checked", $(this).prop("checked"));
        });

        $(".check_all").on("click", function() {
            $(this).parents().find(".checkbox_children").prop("checked", $(this).prop("checked"));
            $(this).parents().find(".checkbox_parent").prop("checked", $(this).prop("checked"));
        });
    </script>
@endsection
