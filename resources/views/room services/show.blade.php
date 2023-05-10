@extends('layouts.app')
@section('title')
    {{ 'file.Show Room Service Request' }}
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <hr class="">
    <div class="card m-2">
        <div class="card-body">
            <h2>{{ trans('Room Services Requests Management') }}</h2>
        </div>
        {{-- <div class="m-2">
            <a class="btn btn-success" href="{{ route('room.services.create') }}">{{ trans('Create New Request') }}</a>
        </div> --}}
    </div>
    <div class="container text-capitalize">
        <div class="card">
            <div class="card-body">
                <p class="">{{ 'file.room no.' }} : {{ $service_request->room->room_no }}</p>
                <p class="">{{ 'file.request date' }} : {{ $service_request->date_in }}</p>
                <p class="">{{ 'file.request fullfilled date' }} : {{ $service_request->date_in }}</p>
            </div>
            @if ($service_request->state == 'pending')
            <div class="card-footer">
                <button class="btn btn-success">done</button>
            </div>
            @else
            <div class="card-footer">
                <a class="btn btn-success" href="{{route('room.services.index')}}">{{('file.Back')}}</a>
            </div>
            @endif
        </div>
    </div>
@endsection
