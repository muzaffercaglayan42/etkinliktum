<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Etkinlik</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Kültürel Etkinlik Takip
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Anasayfa</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Oturum Aç</a></li>
                        <!--<li><a href="{{ url('/register') }}">Kayıt Ol</a></li> -->
                    @else
                    
                    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->adsoyad }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Çıkış</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
 @if (Auth::user())
<div class="container">
    <div class="row">
    <div class="col-md-2">
            <div class="profile-sidebar">
                <!-- SIDEBAR MENU -->

<div class="row affix-row">
    <div class="col-sm-4 col-md-4 affix-sidebar">

    <div class="navbar-collapse collapse sidebar-navbar-collapse">
      <ul class="nav" id="sidenav01" style="width: 170px;">
      <li class="active">
                <a href="#">
                <i class="glyphicon glyphicon-home"></i>
                Anasayfa </a>
            </li>
            <?php if (Auth::user()->tip==3) {
                         ?>
        <li >
          <a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-user"></span> Kullanıcı İşlemleri <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo" style="height: 0px;">
            <ul class="nav nav-list" style=" text-indent: 10px;">
            
            
              <li>
                <a href="{{ url('/userekle') }}">
                <i class="glyphicon glyphicon-user"></i>
                Personel Ekle </a>
            </li>
            <li>
                <a href="{{ url('/userlistele') }}">
                <i class="glyphicon glyphicon-list"></i>
                Personel Listele </a>
            </li>
            <li>
                <a href="{{ url('/ogrenciekle') }}">
                <i class="glyphicon glyphicon-user"></i>
                Öğrenci Ekle </a>
            </li>
            <li>
                <a href="{{ url('/ogrencilistele') }}">
                <i class="glyphicon glyphicon-list"></i>
                Öğrenci Listele </a>
            </li>
            </ul>
          </div>
        </li>
        <li class="active">
          <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-list"></span> Etkinlik İşlemleri <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo2" style="height: 0px;">
            <ul class="nav nav-list" style=" text-indent: 10px;">
              <li>
                <a href="{{ url('/etkinlikekle') }}">
                <i class="glyphicon glyphicon-ok"></i>
                Etkinlik Ekle </a>
            </li>
             <li>
                <a href="{{ url('/etkinliklistele') }}">
                <i class="glyphicon glyphicon-list"></i>
                Etkinlik Listele </a>
                <li>
                <a href="{{ url('/etkinlikdersekle') }}">
                <i class="glyphicon glyphicon-ok"></i>
                Ders Ekle </a>
            </li>
             <li>
                <a href="{{ url('/etkinlikderslistele') }}">
                <i class="glyphicon glyphicon-list"></i>
                Ders Listele </a>
            </li>
            </li>
            </ul>
          </div>
        </li>
        <li class="active">
          <a href="#" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-ok"></span> Ders İşlemleri <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo3" style="height: 0px;">
            <ul class="nav nav-list" style=" text-indent: 10px;">
              <li>
                <a href="{{ url('/dersekle') }}">
                <i class="glyphicon glyphicon-ok"></i>
                Ders Ekle </a>
            </li>
             <li>
                <a href="{{ url('/derslistele') }}">
                <i class="glyphicon glyphicon-list"></i>
                Ders Listele </a>
            </li>
            </ul>
          </div>
        </li>
        <?php } ?> 
       <?php if (Auth::user()->tip!=3) {
         
         ?>
        <li>
             <a href="{{ url('/etkinlikdurumlistele') }}">
            <i class="glyphicon glyphicon-flag"></i>
            Etkinlik Durum </a>
        </li>
         <?php } ?>
      </ul>
      </div><!--/.nav-collapse -->
    </div>
</div>

                    <ul class="nav">
                        
                        
                        
                        
                        
                        
                       
                    </ul>
               
                <!-- END MENU -->
            </div>
        </div>
        @endif
    @yield('content')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
