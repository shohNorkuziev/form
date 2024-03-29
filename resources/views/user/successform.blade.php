@extends('wrap')
@section('title',$data['title'])
@section('content')
    <div class="background" style="background-image: url('{{asset('public/storage/'.$data['background'])}}')">

    </div>
    <div class="success-block">
        <h1>Спасибо!</h1>
        <p>Ваше сообщение отправлено.</p>
        <a href="{{route('showform',['form' => $data['id']])}}">
            <div class="repeat">
                <div>
                    <img src="{{asset('public/img/static/repeat.png')}}" alt="">
                </div>
                <div>
                    Заполнить форму ещё раз
                </div>
            </div>
        </a>
    </div>
    <p></p>
    <div class="success-block share">
        <div>
            <h2>Поделиться формой</h2>
        </div>
        <div>
            <a href="https://telegram.me/share/url?url=http://form/form/{{$data['id']}}">
                <img class="share-img" src="{{asset('public/img/static/tg.png')}}" alt="tg">
            </a>
            <a href="https://vk.com/share.php?url=http://form/form/{{$data['id']}}">
                <img class="share-img" src="{{asset('public/img/static/vk.png')}}" alt="vk">
            </a>
            <div class="copy">
                http://form/form/{{$data['id']}}
            </div>
        </div>
    </div>
@endsection
