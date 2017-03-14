<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $pagetitle }}</title>
  {!! Html::style('css/styles.css') !!}
  {!! Html::style('js/slimbox/slimbox2.css') !!}

  {!! Html::script('js/jquery/jquery-3.1.1.min.js') !!}
  {!! Html::script('js/imghover.js') !!}
  {!! Html::script('js/slimbox/slimbox2.js') !!}
  {!! Html::script('js/script.js') !!}
</head>
<body id="{{ $page }}">
  @include('nav')
  @yield('content')
</body>
</html>