<div class="row mb-4">
    @php /** @var App\Models\Advert $advert */@endphp

    @foreach($adverts as $advert)
        <div class="col-3 mt-5">
            <div class="card">
                <img class="card-img-top"
                     src="{{ url('/storage/' . $advert->images[0]->name) }}"
                     style="height: 18rem;"
                     alt="Card image cap">
                <div class="card-body">
                    <a href="{{ route('advert.show', $advert) }}" class="card-title">
                        {{ $advert->title }}
                    </a>
                    <h5 class="card-text">{{ $advert->price }}</h5>
                    <h5 class="card-text">
                        {{ date('j F', strtotime($advert->created_at)) }}
                    </h5>
                    <h5 class="card-text">{{ $advert->user->city->name }}</h5>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{ $adverts->links() }}
