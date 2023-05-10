@extends('layouts.app')
@section('title')
    {{ __('Edit Menu Category') }}
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
            <h2>{{ __('Edit Menu Category') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('menu.categories.index') }}">{{ __('Menu Categories Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 w-75 m-auto">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <h4 class="card-title">{{ __('Edit Menu Category') }}</h4>
            </div>
            <div class="card-body ">
                <form class="form" method="POST" action="{{ route('menu.categories.update',$category->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="category_name">{{ __('Category Name') }}</label>
                            <input id="category_name" class="form-control" type="text" name="category_name" placeholder="{{ __('Category Name') }}" value="{{$category->category_name}}">
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

