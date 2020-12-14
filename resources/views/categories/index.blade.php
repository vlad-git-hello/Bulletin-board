@extends('layouts.app')

@section('content')
    <p><a href="{{ route('category.create') }}" class="btn btn-success">Добавить категорию</a></p>

    @include('messages.success')
    @include('messages.error')

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Расположение</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>
                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                    <a href="{{ route('category.show', $category) }}">{{ $category->title }}</a>
                </td>
                <td>
                    <div class="d-flex flex-row">
                        <form method="POST" action="{{ route('categories.first', $category) }}" class="mr-1">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <span class="fa fa-angle-up">first</span>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('categories.up', $category) }}" class="mr-1">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <span class="fa fa-angle-up">up</span>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('categories.down', $category) }}" class="mr-1">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <span class="fa fa-angle-up">down</span>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('categories.last', $category) }}" class="mr-1">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <span class="fa fa-angle-up">last</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
