@extends('layouts.app')

@section('content')
    <a href="{{ route('advert.create') }}" class="btn btn-success">
        Добавить обьявление
    </a>

    <table class="table table-bordered table-striped mt-5">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Категория</th>
            <th scope="col">Цена</th>
            <th scope="col">Город</th>
            <th scope="col">Вид обьявления</th>
            <th scope="col">Просмотры</th>
        </tr>
        </thead>
        <tbody>
        @foreach($adverts as $advert)
            <tr>
                <td>
                    <a href="{{ route('advert.show', $advert) }}" class="text-dark">
                        {{ $advert->title }}
                    </a>
                </td>
                <td>{{ $advert->category->title }}</td>
                <td>{{ $advert->price }}</td>
                <td>{{ $advert->user->city->name }}</td>
                <td>{{ $advert->type_author }}</td>
                <td>{{ $advert->view }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $adverts->links() }}
@endsection
