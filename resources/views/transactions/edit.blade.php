@extends('layouts.app')
@section('title')
    {{ trans('Edit Room') }}
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
            <h2>{{ trans('Rooms Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('rooms.index') }}">{{ trans('Rooms Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 w-75 m-auto">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <h4 class="card-title">{{ trans('Edit Room') }}</h4>
            </div>
            <div class="card-body ">
                <form class="form" method="POST" action="{{ route('rooms.update', $room->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="room">{{ 'file.Room No' }}</label>
                            <input id="room" class="form-control" type="text" name="room_no" placeholder="Room Number"
                                value="{{ $room->room_no }}">
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="room">{{ 'file.Price' }}</label>
                            <input id="room" class="form-control" type="text" name="price" placeholder="Room Number"
                                value="{{ $room->price }}">
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="description">{{ 'file.Description' }}</label>
                            <textarea cols="50" rows="10" class="form-control" id="description"
                                name="description">{{ $room->description }}</textarea>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md-12">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($room->gallery as $key => $val)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('media/rooms/' . $val) }}" class="d-block w-100" alt="..."
                                                height="400">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"> </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="row">
                                <div class="form-group m-auto">
                                    <label for="update" class="btn btn-primary m-auto text-light">{{('file.Update Gallery')}}</label>
                                    <input class="hidden" type="file" hidden name="gallery[]" id="update" multiple>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100">
                        <div class="row m-2">
                            <button type="submit" class="btn btn-primary m-auto">{{ 'file.Submit' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-select-users').select2({
                placeholder: "Select a Worker"
            });
        });
        $(document).ready(function() {
            $('.js-select-roles').select2({
                placeholder: "Select a Roles"
            });
        });
    </script>
@endsection
