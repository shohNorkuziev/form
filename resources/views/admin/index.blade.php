@extends('wrap')
@section('title','Формы')
@section('content')
    <div class="background" style="background-image: url('{{asset('public/storage/'.$data['background'])}}')">

    </div>
    <div id="overlay" class="overlay"></div>
    <p>
        <a class="button-a" href="{{route('create')}}"><button class="button-create">Создать форму</button></a>
    </p>
    <table>
        <thead>
            <tr>
              <th>Название</th>
              <th>Фон</th>
              <th>Автор</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
        <tbody>
            @foreach($data['form'] as $key =>$value)
                <tr>
                    <th>{{$value['title']}}</th>
                    <th><img src="{{asset('public/storage/'.$value['background'])}}" alt="" style="width: 200px"></th>
                    <th>{{$value['author']}}</th>
                    <th>{{$value['created_at']}}</th>
                    <th>
                        <a class="button-a" href="{{route('show',['form' => $value['id']])}}"><button class="button-form">Посмотреть</button></a>
                        <a class="button-a" href=""><button class="button-form">Изменить</button></a>
                        <a class="button-a" href="{{route('export',['form' => $value['id']])}}"><button class="button-form">Скачать</button></a>
                        <button onclick="openPopup({{$value['id']}})" class="button-delete">Удалить</button>
                        <div id="popup" class="popup popup{{$value['id']}}">
                            <h1>Подтвердите удаление</h1>
                            <p>Вы уверины что хотите удалить форму?</p>
                            <div class="popup-block">
                                <div>
                                    <button onclick="closePopup({{$value['id']}})" class="popup-button button-cancel">Отменить</button>
                                </div>
                                <div>
                                    <form action="{{route('destroy',['form' => $value['id']])}}" method="POST" class="popup-form">
                                        @method('DELETE')
                                        @csrf
                                        <button class="popup-button button-delete">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            @endforeach
        <tbody>
    </table>
@endsection
