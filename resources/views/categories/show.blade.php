@extends('layouts.app')

@section('content')
    <h2>Просмотр категории</h2>
    <a href="{{ route('category.index') }}" class="btn btn-success mt-2 mb-5">Назад</a>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>{{ $category->title }}</td>
            <td class="d-flex">
                <a href="{{ route('category.edit', $category) }}" class="btn btn-success mr-1">Изменить</a>
                <form method="POST" action="{{ route('category.destroy', $category) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>

    <h3 class="mt-5 mb-4">Вложенные категории</h3>

    <table class="table table-bordered table-striped col-4">
        <thead>
        <tr>
            <th>Название</th>
        </tr>
        </thead>
        <tbody>
        @if($category->children->isNotEmpty())
            @foreach($category->children as $item)
                <tr>
                    <td>
                        <a href="{{ route('category.show', $item) }}" class="text-dark"> {{ $item->title }} </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>
                    <span class="text-black-50">Вложеных категорий нет.</span>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
