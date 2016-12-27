<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Liker 2016</title>
    <meta content="Erofeev Sergey"name="author">
    <meta content="Бэкенд студента loftschool" name="description">
    <meta content="Нравится, не нравится" name="keywords">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/foundation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/foundation.js') }}" defer></script>
    <script src="{{ asset('js/bundle.js') }}" defer></script><!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
  </head>
  <body>
    <!--[if lt IE 7]>
    <p class="browsehappy">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите его</a></p>
    <![endif]-->
    <div id="wrapper" class="wrapper">
      <div class="header">
        <div class="container">
          <div class="logo">
            <img src="{{ asset('img/logo.png') }}" title="logo" class="logo__img">
            @if(!empty($message))
              <p>{{ $message }}</p>
            @eleseif(session()->has('message'))
              <p>{{ session('message') }}</p>
            @endif
          </div>
          <div id="sidebar" class="sidebar">
            <div id="sidebar__title" class="sidebar__title">Посмотреть всех</div>
            <div id="menu-btn" class="sidebar__btn">
              <div class="sidebar__btn-bar"></div>
            </div>
          </div>
        </div>
      </div>
      <div id="sidebarInner" class="sidebar__inner addblock">
        <div class="addblock__top">
          <div class="addblock__title">Понравились</div>
          <ul class="addblock__list">
            @foreach($userAll as $user)
              @if($user->liker == 1)
                <li class="addblock__item">
                    <div class="addblock__img-wrapper"><img src="{{ $user->photo_200 }}" class="addblock__img"></div>
                    <a class="remove" href="{{ url('liker/delete/'.$user->id) }}" data-method="delete" data-token="{{csrf_token()}}"></a>
                    <div class="addblock__user">{{ $user->first_name }} {{ $user->last_name }}</div>
                </li>
              @endif
            @endforeach
          </ul>
          @if ($userAll->lastPage() > 1)
            <ul class="paginator__list">
              <li class="{{ ($userAll->currentPage() == 1) ? ' paginator__items disabled' : 'paginator__items' }}">
                <a class="paginator__link" href="{{ $userAll->url(1) }}">&lt;</a>
              </li>
              @for ($i = 1; $i <= $userAll->lastPage(); $i++)
                <li class="{{ ($userAll->currentPage() == $i) ? ' paginator__items active' : 'paginator__items' }}">
                  <a class="paginator__link" href="{{ $userAll->url($i) }}">{{ $i }}</a>
                </li>
              @endfor
              <li class="{{ ($userAll->currentPage() == $userAll->lastPage()) ? ' paginator__items disabled' : 'paginator__items' }}">
                <a class="paginator__link" href="{{ $userAll->url($userAll->currentPage()+1) }}" >&gt;</a>
              </li>
            </ul>
          @endif
          <div class="line"></div>
        </div>
        <div class="addblock__down">
          <div class="addblock__title">Не понравились</div>
          <ul class="addblock__list">
            @foreach($userAll as $user)
              @if($user->liker == 0)
                <li class="addblock__item">
                  <div class="addblock__img-wrapper"><img src="{{ $user->photo_200 }}" class="addblock__img"></div>
                    <a class="remove" href="{{ url('liker/delete/'.$user->id) }}" data-method="delete" data-token="{{csrf_token()}}"></a>
                  <div class="addblock__user">{{ $user->first_name }} {{ $user->last_name }}</div>
                </li>
              @endif
            @endforeach
          </ul>
        </div>
      </div>
      <div class="main">
        <div class="main-foto">
          <div class="main-foto__inner">
            <div class="main-foto__wrapper"><img id="photo_max_orig" src="{{ $userData->photo_max_orig }}" alt="" class="main-foto__img"></div>
            <div class="main-foto__name">
              <span id="first_name">{{ $userData->first_name }}</span>
              <span id="last_name">{{ $userData->last_name }}</span>
            </div>
            <div id="university_name" class="main-foto__uni">{{ $userData->university_name }}</div>
          </div>
          <div class="main-foto__buttons">
            <a id="true" href="#" class="btn btn_true">Нравится</a>
            <a id="false" href="#" class="btn btn_false">Не нравится</a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="container">
        <div class="footer__text">2016 | Создано командой профессионалов на курсе “Комплексное обучение разработке на PHP” от Loftschool</div>
      </div>
    </div>
    <div id="id" style="visibility: hidden;">{{ $userData->id }}</div>
    <div id="sex" style="visibility: hidden;">{{ $userData->sex }}</div>
    <div id="photo_200" style="visibility: hidden;">{{ $userData->photo_200 }}</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/vk.js') }}"></script>
    <script src="{{ asset('js/laravel.js') }}"></script>
  </body>
</html>