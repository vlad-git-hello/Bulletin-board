@extends('layouts.app')

@section('content')
    <div class="">
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ $imageUrl }}"
                                     alt="Admin" class="rounded-circle" width="150" height="150">
                                <div class="mt-3">
                                    <h4>{{ $user->name }}</h4>
                                    <p class="text-muted font-size-sm">
                                        {{ $user->city->name }},
                                        {{ $user->city->region->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Contact Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->contact_name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telephone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->telephone }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->city->name }},
                                    {{ $user->city->region->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-primary w-100"
                           href="{{ route('profile.edit', $user) }}">Edit</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
