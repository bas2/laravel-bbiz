<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $page[1] }}</title>
  {!! Html::style('css/styles.css') !!}

  {!! Html::script('js/jquery/jquery-3.1.1.min.js') !!}
  {!! Html::script('js/script.js') !!}
</head>
<body id="{{ $page[0] }}">
  @include('nav')
  @yield('content')
</body>
</html>