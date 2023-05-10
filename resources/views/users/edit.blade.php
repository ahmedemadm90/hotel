@extends('layouts.app')
@section('title')
    {{ trans('Edit User') }}
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
    <div class="card m-2">
        <div class="card-body">
            <h2>{{ __('Edit User') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('users.index') }}">{{ __('Users Management') }}</a>
        </div>
    </div>
    <hr>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 m-auto">
        <form id="RegisterValidation" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <h4 class="card-title">{{ trans('Edit User') }}</h4>
                </div>
                <div class="card-body ">
                    <form class="form" method="POST" action="{{ route('users.update',$user->worker_id) }}">
                    @csrf
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="worker">{{ __('Worker Name') }}</label>
                            <select class="js-select-users form-control form-select-lg w-100" id="worker" name="worker_id">
                                <option></option>
                                @foreach (App\Models\Worker::where('state', 1)->get() as $worker)
                                    <option value="{{ $worker->id }}" @if ($worker->id = $user->worker_id)
                                        selected
                                    @endif>{{ $worker->name }}</option>
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
                                    <option value="{{ $role }}" @if (in_array($role, $userRole))
                                        selected
                                    @endif >{{ $role }}</option>
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
        </form>
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
