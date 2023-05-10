@extends('layouts.app')
@section('title')
    {{ ('file.Room Services Requests Management') }}
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
            <h2>{{ ('file.Room Services Requests Management') }}</h2>
        </div>
        {{-- <div class="m-2">
            <a class="btn btn-success"
                href="{{ route('room.services.create') }}">{{ trans('Create New Request') }}</a>
        </div> --}}
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
                        <th>{{ __('Room No') }}</th>
                        <th>{{ __('Request Date') }}</th>
                        <th>{{ __('Done Date') }}</th>
                        <th>{{ __('State') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Service::get() as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->room->room_no }}</td>
                            <td>{{ $service->date_in }}</td>
                            <td>{{ $service->date_out }}</td>
                            <td>
                                @if ($service->state == 'pending')
                                    <span class="badge bg-primary text-light">{{ 'file.Pending' }}</span>
                                @else
                                    <span class="badge bg-success text-light">{{ 'file.Fullfilled' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown dropleft">
                                    <button class="btn btn-secondary " type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if ($service->state == 'pending')
                                        <a href="{{ route('room.services.done', $service->id) }}"
                                            class="dropdown-item">{{ ('Done') }}</a>
                                        <a href="{{ route('room.services.destroy', $service->id) }}"
                                            class="dropdown-item">{{ ('Delete') }}</a>
                                        @else
                                        <a class="dropdown-item">{{ ('Already Fullfilled') }}</a>
                                        @endif
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
