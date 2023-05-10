@extends('layouts.app')
@section('title')
    {{ trans('New Room') }}
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
                <h4 class="card-title">{{ trans('New Room') }}</h4>
            </div>
            <div class="card-body ">
                <form class="form" method="POST" action="{{ route('rooms.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="room">{{ 'file.Room No' }}</label>
                            <input id="room" class="form-control" type="text" name="room_no" placeholder="Room Number">
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="price">{{ 'file.Price' }}</label>
                            <input type="text" id="price" class="form-control" name="price">
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="description">{{ 'file.Description' }}</label>
                            <textarea cols="50" rows="10" class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="gallery" class="btn btn-primary text-light">{{ 'file.Room Gallery' }}</label>
                            <input type="file" id="gallery" name="gallery[]" class="" hidden multiple>
                        </div>
                    </div>
                    <hr>
                    <div class="row m-2">
                        <button type="submit" class="btn btn-primary m-auto">{{ 'file.Submit' }}</button>
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
