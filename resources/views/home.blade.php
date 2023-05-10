@extends('layouts.app')
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('navbar')
@include('layouts.navbar')
@endsection
@section('cards')
    @include('layouts.cards')
@endsection
@section('title')
{{ trans('Dashboard') }}
@endsection
@section('content')
<div class="container">
</div>
@endsection
