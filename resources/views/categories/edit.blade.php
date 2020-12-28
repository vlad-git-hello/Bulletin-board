@extends('layouts.app')

@section('content')
    <h2>Редактировать категорию</h2>
    <form method="POST" action="{{ route('category.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Название категории</label>
            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                   id="title" name="title" aria-describedby="title" placeholder="Введите название"
                   value="{{ $category->title }}">
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>

        @if($category->parent_id)
            <div class="form-group">
                <label for="parent" class="col-form-label">Радительская категория</label>
                <select id="parent" class="form-control" name="parent">
                    <option value="0">Корневая категория</option>
                    @foreach($parents as $parent)

                        @if(is_null($parent->parent_id))
                            <option value="{{ $parent->id }}"
                                    @if($parent->id == $category->parent_id) selected @endif>
                                {{ $parent->title }}
                            </option>
                        @endif

                        @for ($i = 0; $i < $parent->depth; $i++)

                            @if($parent->depth === 1)
                                <option value="{{ $parent->id }}"
                                        @if($parent->id == $category->parent_id) selected @endif>
                                    ----{{ $parent->title }}
                                </option>
                            @endif

                        @endfor
                    @endforeach
                </select>
            </div>
        @endif

        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>

@endsection
