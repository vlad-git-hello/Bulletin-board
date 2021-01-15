@extends('layouts.app')

@section('content')
    <h2>Редактировать Обьявление</h2>

    <a class="btn btn-success mb-3" href="{{ route('profile.advert.index') }}">Назад</a>

    <form method="POST" action="{{ route('profile.advert.update', $advert) }}" id="form-create">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="title">Название обьявления</label>
            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                   id="title" name="title" aria-describedby="title" placeholder="Введите название"
                   value="{{ old('title', $advert->title) }}">
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>

        <div class="form-group" id="">
            <label for="sub-category">Виберете категорию</label>
            <select class="form-control" id="" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == $advert->category_id ? ' selected' : '' }}>
                        @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="state">Состояние товара</label>
            <select class="form-control" id="state" name="state">
                <option value="{{ $advert::STATE_NEW }}"
                        @if($advert->isNew()) selected @endif>Новое</option>
                <option value="{{ $advert::STATE_SHABBY }}"
                        @if($advert->isShabby()) selected @endif>Б/у</option>
            </select>
        </div>

        <div class="form-group">
            <label for="type_author">Тип обьявления</label>
            <select class="form-control" id="type_author" name="type_author">
                <option value="{{ $advert::TYPE_AUTHOR_BUSINESS }}"
                        @if($advert->isBusiness()) selected @endif>Бизнес</option>
                <option value="{{ $advert::TYPE_AUTHOR_PRIVATE }}"
                        @if($advert->isPrivate()) selected @endif>Часное лицо</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Стоимость</label>
            <input type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                   id="price" name="price" aria-describedby="title" placeholder="Введите стоимость"
                   value="{{ old('price', $advert->price) }}"
            >
            @if ($errors->has('price'))
                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="overview">Описание</label>
            <textarea class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}"
                      id="overview" name="overview" rows="8">{{ old('overview', $advert->overview) }}</textarea>
            @if ($errors->has('overview'))
                <span class="invalid-feedback"><strong>{{ $errors->first('overview') }}</strong></span>
            @endif
        </div>
        <div id="imageNames"></div>
    </form>

    @include('profile.advert.image-edit')

    <button id="sendForm" type="submit" class="btn btn-success mt-4">Сохранить</button>

    <script>
        $('#sendForm').click(function (e) {
            test();

            $('#form-create').submit();
        });
    </script>

@endsection
