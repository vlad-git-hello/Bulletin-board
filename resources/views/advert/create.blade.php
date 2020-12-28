@extends('layouts.app')

@section('content')

    <h2>Создать обьявление</h2>

    <a class="btn btn-success mb-3" href="{{ route('advert.index') }}">Назад</a>

    <form method="POST" action="{{ route('advert.store') }}" id="form-create" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Название обьявления</label>
            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                   id="title" name="title" aria-describedby="title" placeholder="Введите название"
                   value="{{ old('title') }}"
            >
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>

        <div class="form-group" id="container-sub-category">
            <label for="sub-category">Виберете под категорию</label>
            <select class="form-control {{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                    id="sub-category" name="category_id">
                <option value="">Не выбрано</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('category_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('category_id') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="state">Состояние товара</label>
            <select class="form-control" id="state" name="state">
                <option value="{{ \App\Models\Advert::STATE_NEW }}"
                        @if(old('state') === \App\Models\Advert::STATE_NEW) selected @endif
                >Новое
                </option>
                <option value="{{ \App\Models\Advert::STATE_SHABBY }}"
                        @if(old('state') === \App\Models\Advert::STATE_SHABBY) selected @endif>Б/у
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="type_author">Тип обьявления</label>
            <select class="form-control" id="type_author" name="type_author">
                <option value="{{ \App\Models\Advert::TYPE_AUTHOR_BUSINESS }}"
                        @if(old('type_author') === \App\Models\Advert::TYPE_AUTHOR_BUSINESS ) selected @endif
                >Бизнес
                </option>
                <option value="{{ \App\Models\Advert::TYPE_AUTHOR_PRIVATE }}"
                        @if(old('type_author') === \App\Models\Advert::TYPE_AUTHOR_PRIVATE) selected @endif
                >Часное лицо
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Стоимость</label>
            <input type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                   id="price" name="price" aria-describedby="title" placeholder="Введите стоимость"
                   value="{{ old('price') }}"
            >
            @if ($errors->has('price'))
                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="overview">Описание</label>
            <textarea class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}"
                      id="overview" name="overview" rows="8">{{ old('overview') }}</textarea>
            @if ($errors->has('overview'))
                <span class="invalid-feedback"><strong>{{ $errors->first('overview') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <div class="form-control d-none {{ $errors->has('imageNames') ? ' is-invalid' : '' }}">
            </div>
            @if ($errors->has('imageNames'))
                <span class="invalid-feedback"><strong>{{ $errors->first('imageNames') }}</strong></span>
            @endif
        </div>
        <div id="imageNames"></div>
    </form>

{{--    @include('advert.image')--}}

    <p>Добавить фото</p>

    <form method="post" action="{{url('dropzone/store')}}" enctype="multipart/form-data"
          class="dropzone" id="dropzone">
        @csrf
        <div class="dz-message" data-dz-message>
            <span>Перетащите сюда файлы для загрузки</span>
        </div>
    </form>

    <script>
        const imagesNames = [];

        function appendImages() {
            const array = [];

            for (let i = 0; i < imagesNames.length; i++) {
                const input = $("<input class='d-none' name='imageNames[]'>").val(imagesNames[i]);

                array.push(input);
            }

            $('#imageNames').append(array);
        }

        Dropzone.options.dropzone = {
            maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 60000,
            success: function (file, { imageName }) {
                file.imageName = imageName;
                imagesNames.push(imageName);
            },
            error: function (file, response) {
                return false;
            },
            removedfile: function (file) {
                request(file);
                removeImage(file);

                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
        };

        function request(file) {
            $.ajax({
                url: '/dropzone/destroy/' + file.imageName,
                type: 'delete',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (data) {
                },
                error: function (msg) {
                },
            });
        }

        function removeImage(file) {
            let index = imagesNames.indexOf(file.imageName);

            if (index > -1) {
                imagesNames.splice(index, 1);
            }
        }
    </script>

    <button id="sendForm" type="submit" class="btn btn-success mt-4">Сохранить</button>

    <script>
        $('#sendForm').click(function (e) {
            appendImages();

            $("#form-create").submit();
        });
    </script>

@endsection
