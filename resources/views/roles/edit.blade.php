@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('title')
    {{trans('Edit Role')}}
@endsection

@section('content')
    @include('layouts.errors')
    @include('layouts.sessions')
    <div class="card ">
        <div class="card-body">
            <h2>{{ __('Edit Role') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('roles.index') }}">{{ trans('Roles Management') }}</a>
        </div>
    </div>
    <div class="card w-75 m-auto">
        <div class="card-body">
            {!! Form::model($role, ['method' => 'POST', 'route' => ['roles.update', $role->id]]) !!}
            <div class="row text-capitalize">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-floating">
                        <label for="floatingInput">{{ trans('Role Name') }}</label>
                        <input type="name" class="form-control" id="floatingInput" placeholder="role name" name="name"
                            value="{{ $role->name }}">
                    </div>
                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h3 class="text-center mb-2 text-capitalize">{{ trans('Permissions') }}</h3>
                        <br>
                        @foreach ($permission as $value)
                            <div class="custom-control custom-checkbox col-md-3 m-auto">
                                <input type="checkbox" class="custom-control-input" id="{{ $value->name }}"
                                    name="permission[]" value="{{ $value->id }}"
                                    @if (in_array($value->id, $rolePermissions)) checked @endif>
                                <label class="custom-control-label" for="{{ $value->name }}">{{ $value->name }}</label>
                            </div>
                        @endforeach

                    </div>

                </div> --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mt-3">
                        <h3 class="text-center mb-2 text-capitalize">{{ __('Permissions') }}</h3>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group row">
                                <br>
                                @foreach ($permission as $value)
                                    <div class="custom-control custom-checkbox col-md-3 m-auto">
                                        <input type="checkbox" class="custom-control-input" id="{{ $value->name }}" name="permission[]" value="{{ $value->name }}" @if (in_array($value->id, $rolePermissions)) checked @endif>
                                        <label class="custom-control-label"
                                            for="{{ $value->name }}">{{ $value->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
