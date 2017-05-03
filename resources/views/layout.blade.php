<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
   content="{{ (isset($page['meta_description'])?$page['meta_description']:"" ) }}">
  <title>{{ $page[1] }}</title>
  <!-- Bootstrap -->
  {!! Html::style('css/bootstrap.min.css') !!}
  {!! Html::style('css/styles.css') !!}

  {!! Html::script('js/jquery/jquery-3.1.1.min.js') !!}
  {!! Html::script('js/script.js') !!}
</head>
<body id="{{ $page[0] }}">
  @include('nav')
  <div class="wrapper">
  <p class="text-center">
  <a href="http://www.1and1.com/web-hosting?kwk=523119831&ac=OM.US.US930K244547B7030a" rel="nofollow"><img src="http://adimg.uimserv.net/1und1/KWK/Classic-Hosting/US/NewHosting_kwk_us_sw_728x90.gif"/></a>
  </p>
  @yield('content')
  </div>
  <footer class="footer">
    <div class="container-fluid">
      <p class="text-muted text-center">Glyphicons provided by {{ link_to('http://glyphicons.com','<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Glyphicons',[],null,false) }}</p>

    </div>
  </footer>
  {!! Html::script('js/bootstrap.min.js') !!}
</body>
</html>