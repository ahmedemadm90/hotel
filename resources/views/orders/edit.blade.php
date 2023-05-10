@extends('layouts.app')
@section('title')
    {{ trans('New Order') }}
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
            <h2>{{ 'file.Orders Management' }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('orders.index') }}">{{ 'file.Orders Management' }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="alert alert-danger m-2" id="errTypes" hidden>
        <p class="mb-0 text-capitalize inline">The Order Can't Be Empty</p>
    </div>
    <div class="col-md-12 w-75 m-auto">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <h4 class="card-title">{{ 'file.Edit Order' }}</h4>
            </div>
            <div class="card-body ">
                <form class="form" method="POST" action="{{ route('orders.update', $order->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="room">{{ 'file.Room No' }}</label>
                            <select class="select-reservation w-100" name="reservation_id">
                                <option value=""></option>
                                @foreach (App\Models\Reservation::where('state', 'active')->get() as $reservation)
                                    <option value="{{ $reservation->id }}"
                                        @if ($order->reservation_id == $reservation->id) selected @endif>
                                        {{ $reservation->room->room_no }} ||
                                        {{ $reservation->customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w-100" id="types">
                            @foreach ($arr as $key => $val)
                            <div class="w-100" id="type">
                                    <div class="row m-3" id="selectType">
                                        <div class="col-md">
                                            <label for="qty">{{ 'file.qty' }}</label>
                                            <input type="number" id="qty" class="form-control" name="qty[]"
                                                value="{{ $key }}">
                                        </div>
                                        <div class="col-md">
                                            <label for="room">{{ 'file.Types' }}</label>
                                            <select class="form-select form-control w-100" name="types[]">
                                                <option value="" disabled hidden selected>{{ 'file.Select Type' }}
                                                </option>
                                                @foreach (App\Models\MenuType::get() as $type)
                                                    <option value="{{ $type->id }}"
                                                        @if ($type->type_name == $val)
                                                        selected
                                                        @endif>
                                                        {{ $type->type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn" id="removeType">
                                            <i class="fa-solid fa-circle-minus"></i></button>
                                    </div>
                                </div>
                                @endforeach
                        </div>

                    </div>
                    <div class="text-center">
                        <button class="btn btn-success m-auto" id="addType">
                            <i class="fa-solid fa-circle-plus"></i></button>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="note">{{ 'file.note' }}</label>
                            <textarea cols="50" rows="5" class="form-control" id="note" name="note">{{ $order->note }}</textarea>
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
            $('.select-reservation').select2({
                placeholder: "Select a Reservation"
            });
        });

        $(document).ready(function() {
            $('.select-types').select2({
                placeholder: "Select a Type"
            });
        });
    </script>
    <script>
        $(document).on('click', '#removeType', function(event) {
            event.preventDefault();
            if ($('#types').children().length < 2) {
                $('#errTypes').fadeIn();
            } else {
                $(this).parent().parent().remove();
            };
            if ($('#errTypes').is(':visible')) {
                setTimeout(function() {
                    $('#errTypes').fadeOut();
                }, 5000);
            };
        });
        $(document).on('click', '#addType', function(event) {
            event.preventDefault();
            $involved = $('#type').clone(true).appendTo($('#types'));
        });
    </script>
@endsection
