@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Check your email</div>
                    <div class="card-body">
                        To complete the registration check your mail, if the letter has not arrived
                        <a href="{{ route('verification.show') }}">click here to request another</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
