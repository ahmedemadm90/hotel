@extends('layouts.app')
@section('title')
    {{ __('Show Room Info') }}
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ __('Show Room Info') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('rooms.index') }}">{{ trans('Rooms Management') }}</a>
        </div>
    </div>
    <div class="col-md-12 w-75 m-auto">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <h4 class="card-title">{{ __('Show Room Info') }}</h4>
            </div>
            <div class="card-body ">
                <div class="row m-2">
                    <div class="col-md">
                        <label for="room">{{ __('Room No') }}</label>
                        <input id="room" class="form-control" type="text" name="room_no" placeholder="Room Number"
                            value="{{ $room->room_no }}" disabled>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md">
                        <label for="price">{{ __('Price') }}</label>
                        <input type="text" id="price" class="form-control" name="price" value="{{ $room->price }}"
                            disabled>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-md">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea cols="50" rows="10" class="form-control" id="description" name="description"
                            disabled>{{ $room->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($room->gallery as $key => $val)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('media/rooms/' . $val) }}" class="d-block w-100" alt="..."
                                        height="300">
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
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection
