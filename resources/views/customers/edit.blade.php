@extends('layouts.app')
@section('title')
    {{ trans('New Customer') }}
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
            <h2>{{ trans('Customers Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('customers.index') }}">{{ __('Customers Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 m-auto text-capitalize">
        <form id="RegisterValidation" action="{{ route('customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <h4 class="card-title">{{ __('Edit customer') }}</h4>
                </div>
                <div class="card-body ">
                    <form class="form">
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="nid">{{ __('NID') }}</label>
                                <input type="number" class="form-control" id="nid" name="nid" value="{{$customer->nid}}">
                            </div>
                            <div class="col-md form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$customer->name}}">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$customer->email}}">
                            </div>
                            <div class="col-md form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{$customer->country}}">
                            </div>
                        </div>
                        <div class="row m-2">
                        <div class="col-md-12">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($customer->gallery as $key => $val)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('media/customers/' . $val) }}" class="d-block w-100" alt="..."
                                                height="400">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"> </span>
                                    <span class="sr-only">{{__('Previous')}}</span>
                                </a>
                                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">{{__('Next')}}</span>
                                </a>
                            </div>
                            <div class="row">
                                <div class="form-group m-auto">
                                    <label for="update" class="btn btn-primary m-auto text-light">{{__('Update Gallery')}}</label>
                                    <input class="hidden" type="file" hidden name="gallery[]" id="update" multiple>
                                </div>
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
