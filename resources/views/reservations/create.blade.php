@extends('layouts.app')
@section('title')
    {{ __('New Reservation') }}
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
            <h2>{{ __('New Reservation') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('reservations.index') }}">{{ __('Reservations Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 m-auto">
        <form id="RegisterValidation" action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <h4 class="card-title">{{ __('New Reservation') }}</h4>
                </div>
                <div class="card-body ">
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="customer">{{ __('New Customer') }}</label>
                            <select class="js-select-customer form-control form-select-lg w-100" id="customer" name="customer_id">
                                <option></option>
                                @foreach (App\Models\Customer::get() as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="room">{{ __('Room No') }}</label>
                            <select class="js-select-room form-control form-select-lg w-100" id="room" name="room_id">
                                <option></option>
                                @foreach (App\Models\Room::where('state','available')->get() as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_no }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="from_date">{{__('From Date')}}</label>
                            <input type="date" name="from_date" id="from_date" class="form-control">
                        </div>
                        <div class="col-md">
                            <label for="to_date">{{__('To Date')}}</label>
                            <input type="date" name="to_date" id="to_date" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row m-2">
                        <button type="submit" class="btn btn-primary m-auto">{{ __('Submit') }}</button>
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
                placeholder: "Select a Customer"
            });
        });
        $(document).ready(function() {
            $('.js-select-room').select2({
                placeholder: "Select a Room"
            });
        });
    </script>
@endsection
