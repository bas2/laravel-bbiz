<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<meta name="description"
   content="{{ (isset($page['meta_description'])?$page['meta_description']:"" ) }}">-->
  <title>{{ $page[1] }}</title>
  <!-- Bootstrap -->
  {!! Html::style('css/app.css') !!}
  {!! Html::style('css/styles.css') !!}

  {!! Html::script('js/jquery/jquery-3.1.1.min.js') !!}
  {!! Html::script('js/script.js') !!}
</head>
<body id="{{ $page[0] }}">

  {{-- @include('nav') --}}

  <div class="wrapper">

  <div class="container-fluid">
  <div class="jumbotron">

    <h2 class="text-center">Items I'm selling</h2>
    <p class="lead text-center">I have two items that I'm currently selling</p>


    <div class="itemtosell">
      <h3><span class="badge">&pound;</span></h3>
      <p></p> 
      <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4 text-center">
        {{ Html::Image('img/itemstosell/zoostorm.jpg','',['width'=>300,'class'=>'thumbnail']) }}
        </div>
      </div>
      <p class="actionbuttons">
      <button class="interested btn btn-success">I am interested in buying this for &pound;90</button>
      <button class="not-interested btn btn-warning">I am not interested in buying this for &pound;90</button>
      </p>
    </div>






    <div class="itemtosell">
      <h3>1. Pink Zoostorm W25 1EL notebook in very good condition<span class="badge">&pound;90</span></h3>
      <p>I have a notebook purchased a few years ago in very good condition for sale. There are very slight imperfections but it's in otherwise great condition. 
      <div class="row">
        <div class="col-md-8">
          <p>The specs are as follows: 
          <ul>
            <li>2.4Gig Pentium CPU 
            <li>1TB hard drive 
            <li>8Gb RAM
            <li>CD/DVD 
            <li>Laptop bag (unused) 
            <li>Latest Ubuntu installed (notebook did not come with Windows installed. 
          </ul>
          <p>I've hardly used the battery so there should be plenty of juice. 

          <p>You will get the main unit, mains adapter and a laptop bag. 
        </div>
        <div class="col-md-4 text-center">
        {{ Html::Image('img/itemstosell/zoostorm.jpg','',['width'=>300,'class'=>'thumbnail']) }}
        </div>
      </div>
      <p class="actionbuttons">
      <button class="interested btn btn-success">I am interested in buying this for &pound;90</button>
      <button class="not-interested btn btn-warning">I am not interested in buying this for &pound;90</button>
      </p>
    </div>

    <div class="itemtosell">
      <h3>2. Samsung NP 102SP Netbook/Windows 7 starter in good condition<span class="badge">&pound;50</span></h3>
      <p>I have this netbook that I want to sell. It is in very good condition. Windows 7 Starter is newly restored on it.</p>
      <div class="row">
        <div class="col-md-8">
          <ul>
            <li>The battery's hardly been used so there should be plenty of juice left. 

            <li>You get the main unit, carry pouch and system disk. 

            <li>"Samsung N102S 10.1 inch Laptop - Black (Intel Atom N2100 1.6GHz, 1GB RAM, 320GB HDD, LAN, WLAN, BT, Webcam, Windows 7 Starter)"
          </ul>
        </div>
        <div class="col-md-4 text-center">
          {{ Html::Image('img/itemstosell/netbook.jpg','',['width'=>300,'class'=>'thumbnail']) }}
          {{-- <video src="img/itemstosell/zoostorm.mp4" width="200" controls></video> --}}
        </div>
      </div>
      <p><button>I am interested in this item!</button></p>
    </div>

  <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home2" aria-controls="home2" role="tab" data-toggle="tab">How this works</a></li>
    <li role="presentation"><a href="#payitem" aria-controls="payitem" role="tab" data-toggle="tab">Paying for the item</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Where I am</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Need to know more?</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home2">
      <p>Once you've decided you are interested in buying an item, contact me by
      calling me on +44 77 599 702 09 or by sending your name and contact email. You don't have to 
      supply your email address. If you don't, you will be given a link to communicate via this site.</p> 
      <p>We can meet and you can take a look at the item.</p>
      <p>If you agree, pay the amount and take the item.</p>
      <p>You can ask for a discount (via the not interested button) and I will contact you if I can sell it at that price.</p>
    </div>
    <div role="tabpanel" class="tab-pane" id="payitem">
      <p>I accept only cash payments.</p>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
      <p>I am based in Walthamstow and I would expect you come to me to see 
      the item you're interested in to make sure it is what you want.</p>
    </div>
    <div role="tabpanel" class="tab-pane" id="settings">
      <p>You can use the system on this web site if you have any further questions 
      about the items or anything else.</p>
    </div>
  </div>

  </div>

  </div>
  </div>

  @yield('content')
    <div class="container-fluid">
    <a href="https://www.1and1.co.uk/hosting?ac=OM.UK.UKf11K357007T7073a&kwk=523119831" rel="nofollow">
    <img class="img-responsive center-block" src="http://adimg.uimserv.net/1und1/KWK/Classic-Hosting/US/NewHosting_kwk_us_sw_728x90.gif"/></a>
    </div>
  </div>

  <footer class="footer">
    <div class="container-fluid">
      <p class="text-muted text-center">Glyphicons provided by {{ link_to('http://glyphicons.com','<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Glyphicons',[],null,false) }}</p>
    </div>
  </footer>

  {!! Html::script('js/bootstrap.min.js') !!}

</body>
</html>