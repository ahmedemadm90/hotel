@extends('layouts.app')
@section('title')
    {{ __('Reservations Management') }}
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
            <h2>{{ __('Reservations Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success"
                href="{{ route('reservations.create') }}">{{ __('New Reservation') }}</a>
        </div>
    </div>
    @include('layouts.errors')
    @include('layouts.sessions')
    <div class="card shadow m-2 p-1">
        <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover text-center" cellspacing="0"
                width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Customer Name') }}</th>
                        <th>{{ __('Room Number') }}</th>
                        <th>{{ __('From Date') }}</th>
                        <th>{{ __('To Date') }}</th>
                        <th>{{ __('State') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Reservation::get() as $reservation)
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->customer->name }}</td>
                            <td>{{ $reservation->room->room_no }}</td>
                            <td>{{ $reservation->from_date }}</td>
                            <td>{{ $reservation->to_date }}</td>
                            <td>
                                @if ($reservation->state == 'active')
                                    <span class="badge bg-success">{{ 'Active' }}</span>
                                @else
                                    <span class="badge bg-danger">{{ 'Checkedout' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown dropleft">
                                    <button class="btn btn-secondary " type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if ($reservation->state == 'active')
                                        <a href="{{ route('reservations.checkout', $reservation->id) }}"
                                            class="dropdown-item">{{ __('Checkout') }}</a>
                                        @elseif($reservation->state == 'checkedout')
                                        <a href="{{ route('reservations.bill', $reservation->id) }}"
                                            class="dropdown-item">{{ __('Bill') }}</a>
                                        @endif
                                        <a href="{{ route('reservations.edit', $reservation->id) }}"
                                            class="dropdown-item">{{ __('Edit') }}</a>
                                        <a href="{{ route('reservations.destroy', $reservation->id) }}"
                                            class="dropdown-item">{{ __('Delete') }}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, 100, 200, 250 - 1],
                    [10, 25, 50, 100, 200, 250, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });
            var table = $('#datatable').DataTable();
        });
    </script>
@endsection
