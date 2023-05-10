@extends('layouts.app')
@section('title')
    {{ __('Edit Menu Type') }}
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
            <h2>{{__('Edit Menu Type') }}</h2>
        </div>
        <div class="m-2">
            <a class="btn btn-success" href="{{ route('menu.types.index') }}">{{ __('Menu Categories Management') }}</a>
        </div>
    </div>
    @include('layouts.sessions')
    @include('layouts.errors')
    <div class="col-md-12 w-75 m-auto">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <h4 class="card-title">{{ __('Edit Menu Type') }}</h4>
            </div>
            <div class="card-body ">
                <form class="form" method="POST" action="{{ route('menu.types.update',$type->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="type_name">{{ __('Menu Type') }}</label>
                            <input id="type_name" class="form-control" type="text" name="type_name" placeholder="Type Name" value="{{$type->type_name}}">
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="menu_category_id">{{ __('Menu Category') }}</label>
                            <select name="menu_category_id" id="menu_category_id" class="menu_category_id w-100">
                                <option></option>
                                @foreach (App\Models\MenuCategory::get() as $cat)
                                <option value="{{$cat->id}}" @if ($type->category_id = $cat->id)
                                    selected
                                @endif>{{$cat->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md">
                            <label for="price">{{ __('Type Name') }}</label>
                            <input id="price" class="form-control" type="number" name="price" placeholder="Type Price" value="{{$type->price}}">
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
            $('.menu_category_id').select2({
                placeholder: "Select Category"
            });
        });
    </script>
@endsection
