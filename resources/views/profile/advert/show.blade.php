@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Просмотр категории</h2>

    <a class="btn btn-success" href="{{ route('profile.advert.index', $advert->user_id) }}">Назад</a>
    <a class="btn btn-primary" href="{{ route('profile.advert.edit', $advert) }}">Редактировать</a>
    <form class="d-lg-inline-block" method="POST"
          action="{{ route('profile.advert.destroy', $advert) }}" id="form-create">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger">Удалить</button>
    </form>

    <div class=" mt-3 mb-5">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card p-3">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    @for($i = 0; $i < count($advert->images); $i++)
                                        <div class="carousel-item  @if($i == 0) active @endif  ">
                                            <img class="d-block w-100"
                                                 src="{{ url('/storage/' . $advert->images[$i]->name) }}" alt="Third slide">
                                        </div>
                                    @endfor

                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"> {{ $advert->title }} </h5>
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $advert->price }} грн.</h5>
                                    <a href="#" class="card-link">Избранное</a>
                                </div>
                                <div>
                                    Состояние: {{ $advert->state }} <br>
                                    Тип обьявления: {{ $advert->type_author }}
                                </div>
                                <p class="card-text mt-3">
                                    Описание <br>
                                    {{ $advert->overview }}
                                </p>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text">Добавлено
                                        {{ date('j F, Y', strtotime($advert->created_at)) }}
                                    </p>
                                    <p class="card-text">Просмотров: {{ $advert->view }}</p>
                                    <p class="card-text">Номер обьявления: {{ $advert->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
{{--                            <img class="card-img-top" style="height: 200px;" src="images/1.webp" alt="Card image cap">--}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $advert->user->contact_name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Зарегистрирован:
                                    {{ date('j F, Y', strtotime($advert->user->created_at)) }}
                                </h6>
                                <h6 class="card-subtitle mt-3">
                                    Контактный телефон:
                                    {{ $advert->user->telephone }}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Точный адрес</h6>
                                <h5 class="card-title">
                                    {{ $advert->user->city->name }},
                                    {{ $advert->user->city->region->name }}
                                </h5>
{{--                                <img class="card-img-top" style="height: 200px;" src="images/1.webp" alt="Card image cap">--}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
