<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8" />
    <meta name="description" content="Kalpa Tree" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="author" content="">

    <title>Kalpa Tree</title>
    <link rel="stylesheet" href="{{ url('assets/node_modules/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/superslides/superslides.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/slick/slick.css') }}s">

    <link rel="stylesheet" href="{{ url('assets/css/main.css') }}">

</head>
<body style="height:100%;">
    <div class="logo white li-nav" style=""><a href="{{ url('') }}/#1" data-index="1"><span class="font-normal">Kalpa Tree</span></a></div>
    <div class="logo red li-nav active" style=""><a href="{{ url('') }}/#1" data-index="1"><span class="font-normal">Kalpa Tree</span></a></div>
    <div class="menu-right active">
            <a href="#" id="show-search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><!-- <img src="img/search.png" width="15;"> --></a>
            <a href="#" id="show-lang">EN <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
            <a href="#" id="show-nav"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>
    </div>

    <div class="box-search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="SEARCH">
              <span class="input-group-btn">
                <input type="submit" class="btn btn-default" type="button" value="GO">
              </span>
            </div><!-- /input-group -->
    </div>

    <div class="box-lang">
            <ul>
                    <li><strong class="font-MyriadPro-Bold">ENGLISH</strong></li>
                    <li>INDONESIA</li>
            </ul>
    </div>
    <nav class="navbar navbar-default navbar-fixed-top navbar-costum active">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <!--  <a class="navbar-brand" href="#">Brand</a> -->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="li-nav"><a href="#2" data-index="2">ABOUT</a></li>
            <li class="li-nav"><a href="#3" data-index="3">MENU</a></li>
            <li class="li-nav"><a href="#4" data-index="4">GALLERY</a></li>
            <li class="li-nav"><a href="#5" data-index="5">BLOG</a></li>
            <li class="li-nav"><a href="#6" data-index="6">CONTACT</a></li>
           
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    @yield('content')
    
</body>
<script src="{{ url('assets/node_modules/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/node_modules/bootstrap/dist/js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/main2.js') }}" type="text/javascript"></script>
</html>