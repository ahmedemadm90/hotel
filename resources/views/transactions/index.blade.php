@extends('layouts.app')
@section('title')
    {{ trans('Transactions Management') }}
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
            <h2>{{ trans('Transactions Management') }}</h2>
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
                        <th>{{ __('Room No.') }}</th>
                        <th>{{ __('Customer Name') }}</th>
                        <th>{{ __('Checkout Date') }}</th>
                        <th>{{ __('Bill') }}</th>
                        <th>{{ __('State') }}</th>
                        {{-- <th>{{ __('Action') }}</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Transaction::get() as $transaction)
                        <tr class="text-capitalize">
                            <td>{{ $transaction->reservation->room->room_no }}</td>
                            <td>{{ $transaction->reservation->customer->name }}</td>
                            <td>{{ $transaction->reservation->to_date }}</td>
                            <td>{{ $transaction->bill }}</td>
                            <td>
                                @if ($transaction->state == 'reception')
                                    <span class="badge bg-primary text-light">{{$transaction->state}}</span>
                                @else
                                    <span class="badge bg-success text-light">{{$transaction->state}}</span>
                                @endif
                            </td>
                            {{-- <td class="text-center">
                                <div class="dropdown dropleft">
                                    <button class="btn btn-secondary " type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ route('transactions.done', $transaction->id) }}"
                                            class="dropdown-item">{{ ('file.Transfer') }}</a>
                                    </div>
                                </div>
                            </td> --}}
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
