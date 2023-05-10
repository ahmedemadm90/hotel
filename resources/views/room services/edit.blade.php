@extends('layouts.app')
@section('title')
    {{ trans('New Reservation') }}
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
            <h2>{{ trans('Reservations Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('reservations.index') }}">{{ trans('Reservations Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 m-auto">
        <form id="RegisterValidation" action="{{ route('reservations.update',$reservation->id) }}" method="POST">
            @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <h4 class="card-title">{{ trans('Edit Reservation') }}</h4>
                </div>
                <div class="card-body ">
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="customer">{{ 'file.Customer' }}</label>
                            <select class="js-select-customer form-control form-select-lg w-100" id="customer" name="customer_id">
                                <option></option>
                                @foreach (App\Models\Customer::get() as $customer)
                                    <option value="{{ $customer->id }}" @if ($customer->id == $reservation->customer_id)
                                        selected
                                    @endif>{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="room">{{ 'file.Room' }}</label>
                            <select class="js-select-room form-control form-select-lg w-100" id="room" name="room_id">
                                <option></option>
                                @foreach (App\Models\Room::get() as $room)
                                    <option value="{{ $room->id }}"@if ($room->id == $reservation->room_id)
                                        selected
                                    @endif>{{ $room->room_no }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="from_date">{{('file.From Date')}}</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="{{$reservation->from_date}}">
                        </div>
                        <div class="col-md">
                            <label for="to_date">{{('file.To Date')}}</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="{{$reservation->to_date}}">
                        </div>
                    </div>
                    <hr>
                    <div class="row m-2">
                        <button type="submit" class="btn btn-primary m-auto">{{ 'file.Submit' }}</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-select-customer').select2({
                placeholder: "Select a Worker"
            });
        });
        $(document).ready(function() {
            $('.js-select-room').select2({
                placeholder: "Select a Roles"
            });
        });
    </script>
@endsection
