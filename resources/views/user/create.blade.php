@extends('wrap')
@section('title','Регистрация')
@section('content')
    <div class="background" style="background-image: url('{{asset('public/storage/'.$data['background'])}}')">

    </div>
    <form action="{{route('logup')}}" method="POST">
        @method('POST')
        @csrf
        <input  name="theme_id" type="hidden" value="1">
        <h1>Регистрация</h1>
        <p>
            <label for="first_name">Имя</label>
            <input id="first_name" name="first_name" type="text" class="sign-input">
            @foreach ($errors->get('first_name') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <label for="last_name">Фамилия</label>
            <input id="last_name" name="last_name" type="text" class="sign-input">
            @foreach ($errors->get('last_name') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <label for="patronymic">Отчество</label>
            <input id="patronymic" name="patronymic" type="text" class="sign-input">
            @foreach ($errors->get('patronymic') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <label for="email">Email</label>
            <input id="email" name="email" type="text" class="sign-input">
            @foreach ($errors->get('email') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <label for="login">Логин</label>
            <input id="login" name="login" type="text" class="sign-input">
            @foreach ($errors->get('login') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <label for="password">Пароль</label>
            <input id="password" name="password" type="password" class="sign-input">
            @foreach ($errors->get('password') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <input type="submit" value="Создать"  class="sign-input">
        </p>
    </form>
@endsection
