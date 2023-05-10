@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('title')
    {{ __('New Role') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ __('New Role') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('roles.index') }}">{{ __('Roles Management') }}</a>
        </div>
    </div>
    @include('layouts.errors')
    @include('layouts.sessions')
    <div class="card w-75 m-auto">
        <div class="card-body">
            {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col m-auto">
                        <div class="form-floating">
                            <label for="floatingInput">{{ __('Name') }}</label>
                            <input type="text" class="form-control text-capitalize" id="floatingInput" placeholder="{{__('Role Name')}}"
                                name="name">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mt-3">
                        <h3 class="text-center mb-2 text-capitalize">{{ __('Permissions') }}</h3>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group row">
                                <br>
                                @foreach ($permission as $value)
                                    <div class="custom-control custom-checkbox col-md-3 m-auto">
                                        <input type="checkbox" class="custom-control-input" id="{{ $value->name }}" name="permission[]" value="{{ $value->name }}">
                                        <label class="custom-control-label"
                                            for="{{ $value->name }}">{{ $value->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="w-100 p-1">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

