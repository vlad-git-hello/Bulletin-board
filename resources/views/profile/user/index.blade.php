@extends('layouts.app')

@section('content')
    @php /** @var App\Models\User $user */@endphp

    <div class="main-body">
        {{--            <a class="btn btn-primary" href="{{ route('profile.advert.index') }}">Advert</a>--}}

        <div class="row gutters-sm mt-4">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img
                                src="{{ url('/storage/' . $user->photo) }}"
                                alt="Admin" class="rounded-circle" width="150" height="150">
                            <div class="mt-3">
                                <h4>{{ $user->name }}</h4>
                                <p class="text-muted font-size-sm">
                                    {{ $user->fullAddressName() }}
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
                                {{ $user->contact_name ?? '-' }}
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
                                {{ $user->telephone ?? '-' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->fullAddressName() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a class="btn btn-primary w-100" href="{{ route('profile.edit') }}">Edit</a>
                </div>
            </div>

        </div>
    </div>

@endsection
