@extends('layouts.app')

@section('content')
    <h2>Создать категорию</h2>
    <form method="POST" action="{{ route('category.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Название категории</label>
            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                   id="title" name="title" aria-describedby="title" placeholder="Введите название"
                   value="{{ old('title') }}"
            >
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="selectCategory">Виберете категорию</label>
            <select class="form-control" id="selectCategory" name="category">
                <option value="0">Корневая категория</option>
                @foreach($categories as $category)
                    @if(is_null($category->parent_id))
                        <option value="{{ $category->id }}"
                            @if(old('category') == $category->id) selected @endif
                        >
                            {{ $category->title }}
                        </option>
                    @endif

                    @for ($i = 0; $i < $category->depth; $i++)
                        @if($category->depth === 1)
                            <option value="{{ $category->id }}"
                                @if(old('category') == $category->id) selected @endif
                            >
                                ----{{ $category->title }}
                            </option>
                            @break
                        @endif
                    @endfor
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
@endsection
