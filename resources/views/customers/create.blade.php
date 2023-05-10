@extends('layouts.app')
@section('title')
    {{ __('New Customer') }}
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
            <h2>{{ __('Customers Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('customers.index') }}">{{ __('Customers Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 m-auto text-capitalize">
        <form id="RegisterValidation" action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <h4 class="card-title">{{ __('Create New Customer') }}</h4>
                </div>
                <div class="card-body ">
                    <form class="form">
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="nid">{{ __('NID') }}</label>
                                <input type="number" class="form-control" id="nid" name="nid" value="{{ old('nid') }}">
                            </div>
                            <div class="col-md form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="col-md form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="{{ old('country') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="gallery" class="btn btn-primary text-light">{{ __('Gallery') }}</label>
                                <input type="file" id="gallery" name="gallery[]" class="" hidden multiple>
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
