@extends('layouts.app')
@section('title')
    {{ __('Roles Management') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ __('Roles Management') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('roles.create') }}">{{ __('New Role') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-hover table-hover text-center">
                    <thead>
                        <tr>
                            <th>{{__('No')}}</th>
                            <th>{{__('Name')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td class="text-capitalize">{{ $role->name }}</td>
                                <td>
                                    <div class="dropdown dropleft">
                                        <button class="btn btn-secondary dropdown" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}">{{__('Edit')}}</a>
                                            <a class="dropdown-item"
                                                href="{{ route('roles.destroy', $role->id) }}">{{__('Delete')}}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
