@extends('layouts.app')
@section('title')
    {{ __('Edit Worker') }}
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('custome')
    @include('layouts.custome')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ __('Workers Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('workers.index') }}">{{ __('Workers Management') }}</a>
        </div>
    </div>
    <hr>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 m-auto">
        <form id="RegisterValidation" action="{{ route('workers.update',$worker->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <h4 class="card-title">{{ __('Create New Worker') }}</h4>
                </div>
                <div class="card-body ">
                    <form class="form">
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="nid">{{ __('NID') }}</label>
                                <input type="number" class="form-control" id="nid" name="nid" value="{{ $worker->id }}">
                            </div>
                            <div class="col-md form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $worker->name }}">

                            </div>
                            <div class="col-md form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $worker->email }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="job">{{ __('Job') }}</label>
                                <input type="text" class="form-control" id="job" name="job" value="{{ $worker->job }}">
                            </div>
                            <div class="col-md form-group">
                                <label for="start_date">{{__('Start Date') }}</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ $worker->start_date }}">
                            </div>
                            <div class="col-md form-group">
                                <label for="end_date">{{__('End Date')}}</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                                <small>* {{ 'file.Leave Unseted If Still Working' }}</small>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md rounded text-center">
                                    @if ($worker->img)
                                        <img src="{{ asset('media/workers/' . $worker->img) }}" height="200"
                                            class="m-auto">
                                    @else
                                        <img src="{{ asset('media/tmp/tmp_avatar.jpg') }}" height="200"
                                            class="m-auto">
                                    @endif
                                    <div class="row text-center mt-2">
                                        <input type="file" name="img" id="img" hidden>
                                        <label for="img" class="btn btn-primary m-auto text-light">{{__('Update Image')}}</label>
                                    </div>
                                </div>
                                <div class="col-md form-group text-center">
                                    <div class="custom-control custom-checkbox col-md-3 btn">
                                        <input type="checkbox" class="custom-control-input" id="state" name="state"
                                            value="1" @if ($worker->state == 1)
                                                checked
                                            @endif>
                                        <label class="custom-control-label" for="state">{{ __('state') }}</label>
                                    </div>
                                </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" class="btn btn-primary m-auto">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
@endsection
