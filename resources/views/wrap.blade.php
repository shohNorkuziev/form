<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>IT-CUBE | @yield('title')</title>
        <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
        <link rel="shortcut icon" href="{{asset('public/img/static/logo.ico')}}" type="image/x-icon">
    </head>
    <body>
        <div class="wrap">
            <header>
                    <div class="header">
                        <div>
                            <a href="https://itcube.su/" class="logo">IT-CUBE</a>
                        </div>
                        <div class="naw">
                            @if (isset($data['naw']))
                            <a href="{{route('index')}}" class="naw-a {{isset($data['active'])&&$data['active']=='form'?'nav-active':''}}">Формы</a>
                            <a href="{{route('indeximage')}}" class="naw-a {{isset($data['active'])&&$data['active']=='image'?'nav-active':''}}">Изображения</a>
                            @endif
                        </div>
                        <div>

                        </div>
                    </div>

            </header>
            <div class="main">
                <div class="content">
                    @yield('content')
                </div>
            </div>
            @if (isset($data['footer']))
                <footer>
                    <div class="content">
                        <div class="footer">
                            <div>
                                <h2>Адрес</h2>
                                <hr>
                                <p>
                                    г. Магнитогорск, пр-т Ленина, д. 38, корп. 3, этаж 3.
                                </p>
                            </div>
                            <div>
                                <h2>Контакты</h2>
                                <hr>
                                <p>
                                    <a href="tel:+73519330808">+7&nbsp;(3519)&nbsp;33-08-08</a>
                                </p>
                                <p>
                                    <a href="mailto:mailcube@yandex.ru">mailcube@yandex.ru</a>
                                </p>
                            </div>
                            <div>
                                <h2>Социальные сети</h2>
                                <hr>
                                <p>
                                    <a href="https://vk.com/itcube74">
                                        <img class="" alt="" src="{{asset('public/img/static/vk.webp')}}">
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="footer-two">
                            © 2021 - 2024  Все права защищены
                        </div>
                    </div>
                </footer>
            @endif
        </div>
    </body>
    <script src="{{asset('public/js/script.js')}}"></script>
</html>
