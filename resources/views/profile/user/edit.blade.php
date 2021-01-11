@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                   id="email" name="email"
                   aria-describedby="emailHelp" value="{{ old('email', $user->email) }}">
            @if ($errors->has('email'))
                <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                   id="password" name="password"
                   placeholder="Password">
            @if ($errors->has('password'))
                <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="name">User name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                   id="name" name="name"
                   value="{{ old('name', $user->name) }}">
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="contact_name">Contact name</label>
            <input type="text" class="form-control {{ $errors->has('contact_name') ? ' is-invalid' : '' }}"
                   id="contact_name" name="contact_name"
                   value="{{ old('contact_name', $user->contact_name) }}">
            @if ($errors->has('contact_name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('contact_name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="text" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}"
                   id="telephone" name="telephone"
                   value="{{ old('telephone', $user->telephone) }}">
            @if ($errors->has('telephone'))
                <span class="invalid-feedback"><strong>{{ $errors->first('telephone') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="city">Example city</label>
            <select class="form-control" id="city" name="city_id">
                @foreach($cities as $city)
                    <option @if($user->city_id === $city->id) selected @endif
                    value="{{ $city->id }}">
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="photo">Upload new photo</label>
            <input type="file"
                   class="form-control-file {{ $errors->has('photo') ? ' is-invalid' : '' }}"
                   id="photo" name="photo">
            @if ($errors->has('photo'))
                <span class="invalid-feedback"><strong>{{ $errors->first('photo') }}</strong></span>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Save changes</button>
        <a class="btn btn-danger" href="{{ route('profile.show', $user) }}">Назад</a>
    </form>

@endsection
