@extends('layouts.app')

@section('content')

    @include('home.search-form')
    @include('home.categories.select')
    @include('home.adverts')

@endsection
