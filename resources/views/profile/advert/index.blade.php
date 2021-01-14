@extends('layouts.app')

@section('content')
    <h2>Index advert profile</h2>

    @include('messages.profile.advert.success')
    @include('messages.profile.advert.error')

    <a class="btn btn-success mt-4" href="{{ route('profile.advert.create') }}">Create advert</a>

    <div class="row mb-4">
        @foreach($adverts as $advert)
            <div class="col-3 mt-5">
                <div class="card">
                    <img class="card-img-top"
                         style="height: 18rem;"
                         src="{{ url('/storage/' . $advert->images[0]->name) }}"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $advert->title }}</h5>
                        <h5 class="card-text">{{ $advert->shortOverview() }}</h5>
                        <a href="{{ route('profile.advert.show', $advert) }}" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $adverts->links() }}
@endsection
