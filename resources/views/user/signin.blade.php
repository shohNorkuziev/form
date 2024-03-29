@extends('wrap')
@section('title','Авторизация')
@section('content')
    <div class="background" style="background-image: url('{{asset('public/storage/'.$data['background'])}}')">

    </div>
    <form action="{{route('login')}}" method="POST">
        @method('POST')
        @csrf
        <h1>Авторизация</h1>
        @if (session('message'))
            <p class="success">
                {{session('message')}}
            </p>
        @endif
        <p>
            <label for="login">Логин</label>
            <input id="login" name="login" type="text"  class="sign-input">
        </p>
        @foreach ($errors->get('login') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <label for="password">Пароль</label>
            <input id="password" name="password" type="password"  class="sign-input">
        </p>
        @foreach ($errors->get('password') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <input type="submit" value="Войти"  class="sign-input">
        </p>
    </form>
@endsection
