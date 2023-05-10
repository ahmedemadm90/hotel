@extends('layouts.app')
@section('title')
    {{ __('Users Management') }}
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
            <h2>{{ __('Users Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('users.create') }}">{{ __('Create New User') }}</a>
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
                        <th>{{ __('NID') }}</th>
                        <th>{{ __('Worker Img') }}</th>
                        <th>{{ __('Worker Name') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Job') }}</th>
                        <th>{{ __('State') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\User::get() as $user)
                        <tr>
                            <td>{{ $user->worker_id }}</td>
                            <td>
                                @if (isset($user->worker->img))
                                    <img src='{{ asset('media/workers/' . $user->worker->img) }}' class="avatar rounded">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->worker->job }}</td>
                            <td>
                                @if ($user->active == 1)
                                    <span class="badge bg-success text-light">{{ __('Active') }}</span>
                                @else
                                    <span class="badge bg-danger text-light">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown dropleft">
                                    <button class="btn btn-secondary " type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="dropdown-item">{{ __('Edit') }}</a>
                                        <a href="{{ route('users.destroy', $user->id) }}"
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
