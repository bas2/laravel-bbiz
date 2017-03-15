<ul class="nav">
  @if(\Auth::check())
  <li>{{ link_to('home', 'Home',  ['class'=>'homelink']) }}
  <li>{{ link_to('projects','Projects',['class'=>'projectslink']) }}
  <li>{{ link_to('content/update','Update',['class'=>'updatelink']) }}
  <li>{{ link_to('logout','Logout',['class'=>'logoutlink']) }}
  @else
  <li>{{ link_to('login','Login',['class'=>'loginlink']) }}
  @endif
</ul>