@extends('layouts.app')
@section('title')
    Show Area Info
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <div class="card m-2">
        <div class="card-body">
            <h2>{{ trans('Reservations Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('reservations.index') }}">{{ trans('Back') }}</a>
        </div>
    </div>
    <div>
        <h3 class="text-center">{{ 'file.Reservation Bill Details' }}</h3>
    </div>
    <div class="row text-capitalize mt-5">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <td>{{ 'file.Details' }}</td>
                            <td>{{ 'file.From Date' }}</td>
                            <td>{{ 'file.To Date' }}</td>
                            <td>{{ 'file.Date' }}</td>
                            <td>{{ 'file.Price' }}</td>
                            <td>{{ 'file.Check Order' }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ 'file.Reservation' }}</td>
                            <td>{{ $reservation->from_date }}</td>
                            <td>{{ $reservation->to_date }}</td>
                            <td></td>
                            <td>{{ $reservation_bill }}</td>
                            <td></td>
                        </tr>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ 'file.Order' }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $order->date }}</td>
                                <td class="text-danger minus"> + {{ $order->total }}</td>
                                <td class="text-light minus">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-danger"
                                        target="_blank"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{--     <table class="table table-hover text-center" id="outprint">
        <thead>
            <tr>
                <td>{{ 'file.Details' }}</td>
                <td>{{ 'file.From Date' }}</td>
                <td>{{ 'file.To Date' }}</td>
                <td>{{ 'file.Date' }}</td>
                <td>{{ 'file.Price' }}</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ 'file.Reservation' }}</td>
                <td>{{ $reservation->from_date }}</td>
                <td>{{ $reservation->to_date }}</td>
                <td></td>
                <td>{{ $reservation_bill }}</td>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ 'file.Order' }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $order->date }}</td>
                    <td class="text-danger minus"> + {{ $order->total }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="">{{ 'file.Total' }}</td>
                <td>{{ $reservation->bill }}</td>
            </tr>
        </tfoot>
    </table>
    <input type='button' value="print" id='printMe'> --}}
@endsection

