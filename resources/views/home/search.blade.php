@extends('layouts.app')

@section('content')
    <h1>Search page!</h1>

    @include('home.search-form')
    @include('home.filer')
    @include('home.adverts')

@endsection
