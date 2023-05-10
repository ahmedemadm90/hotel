@extends('layouts.app')
@section('title')
    {{ trans('New User') }}
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
            <h2>{{ __('Create New User') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('users.index') }}">{{ __('Users Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 w-75 m-auto">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <h4 class="card-title">{{ __('Create New User') }}</h4>
            </div>
            <div class="card-body ">
                <form class="form" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="worker">{{ __('Worker') }}</label>
                            <select class="js-select-users form-control form-select-lg w-100" id="worker" name="worker_id">
                                <option></option>
                                @foreach (App\Models\Worker::where('state', 1)->get() as $worker)
                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" id="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="confirm-password">{{ __('Confirm Password') }}</label>
                            <input type="password" id="confirm-password" class="form-control" name="confirm-password">
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="roles">{{ __('Roles') }}</label>
                            <select class="js-select-roles form-control form-select-lg w-100" id="roles" name="roles[]"
                                multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row m-2">
                        <button type="submit" class="btn btn-primary m-auto">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-select-users').select2({
                placeholder: "Select a Worker"
            });
        });
        $(document).ready(function() {
            $('.js-select-roles').select2({
                placeholder: "Select a Roles"
            });
        });
    </script>
@endsection
