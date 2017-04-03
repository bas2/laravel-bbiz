<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav nav-justified">
      @if(\Auth::check())
      <li>{{ link_to('/', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home',  ['class'=>'homelink'],null,false) }}
      <li>{{ link_to('projects','Projects',['class'=>'projectslink']) }}
      <li>{{ link_to('content/update','<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update',['class'=>'updatelink'],null,false) }}
      <li>{{ link_to('logout','<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout',['class'=>'logoutlink'],null,false) }}
      @else
      <li>{{ link_to('/', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home',  ['class'=>'homelink'],null,false) }}
      {{-- <li>{{ link_to('login','<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login',['class'=>'loginlink'],null,false) }} --}}
      @endif
      </ul>
    </div>

  </div>
</nav>
