@extends('layouts.app')
@section('title')
    {{ __('Create New Worker') }}
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
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 m-auto">
        <form id="RegisterValidation" action="{{ route('workers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <h4 class="card-title">{{ __('New Worker') }}</h4>
                </div>
                <div class="card-body ">
                    <form class="form">
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="nid">{{ __('NID') }}</label>
                                <input type="number" class="form-control" id="nid" name="nid" value="{{old('nid')}}">
                            </div>
                            <div class="col-md form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">

                            </div>
                            <div class="col-md form-group">
                                <label for="email">{{__('Email Address')}}</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="job">{{__('Job')}}</label>
                                <input type="text" class="form-control" id="job" name="job" value="{{old('job')}}">
                            </div>
                            <div class="col-md form-group">
                                <label for="start_date">{{__('Start Date')}}</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"  value="{{old('start_date')}}">
                            </div>
                            <div class="col-md form-group">
                                <label for="end_date">{{__('End Date')}}</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date')}}">
                                <small>* {{__('Leave Unseted If Still Working')}}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group text-center">
                                <label for="img" class="btn btn-primary text-light">{{ __('Worker Img') }}</label>
                                <input type="file" class="form-control" id="img" name="img" hidden>
                            </div>
                            <div class="col-md form-group text-center">
                                <div class="custom-control custom-checkbox col-md-3 btn">
                                    <input type="checkbox" class="custom-control-input" id="state" name="state" value="1">
                                    <label class="custom-control-label" for="state">{{__('state')}}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" class="btn btn-primary m-auto">{{__('Submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
@endsection
