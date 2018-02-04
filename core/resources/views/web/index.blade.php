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
    <link rel="stylesheet" href="{{ url('assets/css/onepage-scroll.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/superslides/superslides.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/slick/slick.cs') }}s">

    <link rel="stylesheet" href="{{ url('assets/css/main.css') }}">

</head>

<body style="height:100%;">
    <div class="logo white li-nav" style=""><a href="#1" data-index="1"><span class="font-normal">Kalpa Tree</span></a></div>
    <div class="logo red li-nav" style=""><a href="#1" data-index="1"><span class="font-normal">Kalpa Tree</span></a></div>
    <div class="menu-right">
        <a href="#" id="show-nav"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>
    </div>

    <nav class="navbar navbar-default navbar-fixed-top navbar-costum">
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
<!--                 <li class="li-nav"><a href="#3" data-index="3">MENU</a></li> -->
                <li class="li-nav"><a href="#3" data-index="3">COFFEE</a></li>
                <li class="li-nav"><a href="#4" data-index="4">RESTAURANT</a></li>
                <li class="li-nav"><a href="#5" data-index="5">BAR & LOUNGE</a></li>
                <li class="li-nav"><a href="#6" data-index="6">EVENTS</a></li>
                <li class="li-nav"><a href="#7" data-index="7">CONTACT</a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <div class="main" style="height:100%;">
        <section class="page landing">
            <!-- ANIMATION -->
            <div id="landing-anime" style="position:absolute;width:100%; height:100%; background-image:url('files/sliders/{{$animation['image']}}'); background-size: cover; background-position: center;">
                    <div class="overlay" style="position:absolute; width:100%; height: 100%;">
                            <div class="box-middle-vertical" style="top:35%;">
                                {!! $animation['title'] !!}
                            </div>

                            <div class="" id="land-logo" style="position: absolute;top:60px; left:10%;">
                                    <!--<img src="img/logo-white.png"  width="150">-->
                                    <p class="h1-dinamis"><span class="font-normal">Kalpa Tree</span></p>
                            </div>
                    </div>
            </div>
            <!-- END -->
            
            <div id="slides">
                <div class="slides-container">
                    @foreach($slider as $sliders)
                        <li class="slides-item">
                            <img src="{{ url('files').'/sliders/'.$sliders['image'] }}" alt="">
                            <div class="overlay" style="position:absolute; width:100%; height: 100%;">
                                <div class="box-middle-vertical">
                                    {!! $sliders['title'] !!}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </div>
            </div>
            <div class="box-scroll-down">
                <p>Scroll Down</p>
                <span class="li-nav"><a href="#2" data-index="2"><img src="{{ url('assets/img/chevron-down.png') }}" width="45;" /></a></span>
            </div>
        </section>

        <section class="page abouts">
            <div class="cover-section"></div>
            <div class="fullpage">
                <div class="container" style="">
                    <div class="box">
                        <p class="txt-space3 font-MyriadPro-Bold">{{ strip_tags($about['title']) }}</p>
                        <div class="line"></div>
                        <h2 class="h2-dinamis spasinull">{{ strip_tags($about['intro']) }}</h2>

                            <p class="font-MyriadPro-Bold"></p>
                            {!! $about['descriptions'] !!}
                    </div>
                </div>
            </div>

        </section>
        <!-- <section class="page menus">
            <div class="cover-section"></div>
            <div class="fullpage">
                <div class="container">
                    <div class="box">
                        <p class="txt-space3 font-MyriadPro-Bold">{{ strip_tags($menus['title']) }}</p>
                        <div class="line"></div>
                        <h2 class="h2-dinamis spasinull">{!! str_replace('<p>','',str_replace('</p>','<br/>',$menus['intro'])) !!}</h2>

                        <p class="font-MyriadPro-Bold"></p>
                        {!! $menus['descriptions'] !!}
                        
                        <div class="container ct">
                            <div class="row spasinull">
                                <div class="col-sm-3 col-xs-3 spasinull">
                                    <a href="{{ url('appetizer') }}" class="thumbnail link">
                                        <img src="{{ url('assets/img/kalpa-img/appetizer-icon.png') }}" alt="...">
                                        <div class="caption">
                                            <p>APPETIZERS</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-3 spasinull">
                                    <a href="{{ url('main-dish') }}" class="thumbnail link">
                                        <img src="{{ url('assets/img/kalpa-img/maindish-icon.png') }}" alt="...">
                                        <div class="caption">
                                            <p>MAIN DISHES</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-3 spasinull">
                                    <a href="{{ url('dessert') }}" class="thumbnail link">
                                        <img src="{{ url('assets/img/kalpa-img/dessert-icon.png') }}" alt="...">
                                        <div class="caption">
                                            <p>DESSERTS</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-3 spasinull">
                                    <a href="{{ url('drink') }}" class="thumbnail link">
                                        <img src="{{ url('assets/img/kalpa-img/drinks-icon.png') }}" alt="...">
                                        <div class="caption">
                                            <p>DRINKS</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section> -->
        <section class="page galleries">
            <div id="facCarousel" class="carousel slide">
                <!-- Wrapper for Slides -->
                <div class="carousel-inner">
                    @php $i = 0; @endphp
                    @foreach($coffees as $coffee)
                    <div class="item {{ $i==0 ? 'active' : ''}}">
                        <!-- Set the first background image using inline CSS below. -->
                        <div class="fill" style="background-image:url('files/pages/{{ $coffee['image'] }}');"></div>
                        <div class="carousel-caption">
                            <h2 class="spasinull">{{ $coffee['title'] }}</h2>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>


                <!-- Controls -->
                <a class="left carousel-control" href="#facCarousel" data-slide="prev">
                    <span class="fac-control icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#facCarousel" data-slide="next">
                    <span class="fac-control icon-next"></span>
                </a>

                <!-- SLICK ===========================  -->
                <div id="show-box-fac" class="active"></div>
                <div id="box-fac-slick" class="show">
                    <div class="slider autoplay">
                        @php $i = 0; @endphp
                        @foreach($coffees as $coffee)
                            <div class="indicator" style="background-image: url('files/pages/{{$coffee['image']}}');" data-target="#facCarousel" data-slide-to="{{$i++}}">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>{{ $coffee['title'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($i < 5)
                            @php $b = 5 - $i; @endphp
                            @for($a = 1; $a <= $b; $a++)
                            <div class="indicator" style="background-image: url('assets/img/abu.jpg');" data-target="#facCarousel" data-slide-to="5">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>Coming Soon</h3>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>

            </div>    
        </section>

        <section class="page galleries">
            <div id="facCarousel2" class="carousel slide">
                <!-- Wrapper for Slides -->
                <div class="carousel-inner">
                    @php $i = 0; @endphp
                    @foreach($restaurants as $restaurant)
                    <div class="item {{ $i==0 ? 'active' : ''}}">
                        <!-- Set the first background image using inline CSS below. -->
                        <div class="fill" style="background-image:url('files/pages/{{ $restaurant['image'] }}');"></div>
                        <div class="carousel-caption">
                            <h2 class="spasinull">{{ $restaurant['title'] }}</h2>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>


                <!-- Controls -->
                <a class="left carousel-control" href="#facCarousel2" data-slide="prev">
                    <span class="fac-control icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#facCarousel2" data-slide="next">
                    <span class="fac-control icon-next"></span>
                </a>

                <!-- SLICK ===========================  -->
                <div id="show-box-fac" class="active"></div>
                <div id="box-fac-slick" class="show">
                    <div class="slider autoplay">
                        @php $i = 0; @endphp
                        @foreach($restaurants as $restaurant)
                            <div class="indicator" style="background-image: url('files/pages/{{$restaurant['image']}}');" data-target="#facCarousel2" data-slide-to="{{$i++}}">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>{{ $restaurant['title'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($i < 5)
                            @php $b = 5 - $i; @endphp
                            @for($a = 1; $a <= $b; $a++)
                            <div class="indicator" style="background-image: url('assets/img/abu.jpg');" data-target="#facCarousel2" data-slide-to="5">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>Coming Soon</h3>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>

            </div>    
        </section>

        <section class="page galleries">
            <div id="facCarousel3" class="carousel slide">
                <!-- Wrapper for Slides -->
                <div class="carousel-inner">
                    @php $i = 0; @endphp
                    @foreach($barLounges as $barLounge)
                    <div class="item {{ $i==0 ? 'active' : ''}}">
                        <!-- Set the first background image using inline CSS below. -->
                        <div class="fill" style="background-image:url('files/pages/{{ $barLounge['image'] }}');"></div>
                        <div class="carousel-caption">
                            <h2 class="spasinull">{{ $barLounge['title'] }}</h2>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>


                <!-- Controls -->
                <a class="left carousel-control" href="#facCarousel3" data-slide="prev">
                    <span class="fac-control icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#facCarousel3" data-slide="next">
                    <span class="fac-control icon-next"></span>
                </a>

                <!-- SLICK ===========================  -->
                <div id="show-box-fac" class="active"></div>
                <div id="box-fac-slick" class="show">
                    <div class="slider autoplay">
                        @php $i = 0; @endphp
                        @foreach($barLounges as $barLounge)
                            <div class="indicator" style="background-image: url('files/pages/{{$barLounge['image']}}');" data-target="#facCarousel3" data-slide-to="{{$i++}}">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>{{ $barLounge['title'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($i < 5)
                            @php $b = 5 - $i; @endphp
                            @for($a = 1; $a <= $b; $a++)
                            <div class="indicator" style="background-image: url('assets/img/abu.jpg');" data-target="#facCarousel3" data-slide-to="5">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>Coming Soon</h3>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>

            </div>    
        </section>
        <section class="page events">
            <div id="newsCarousel" class="carousel slide">
                <!-- Wrapper for Slides -->
                <div class="carousel-inner">
                    @php $i = 0; @endphp
                    @foreach($event as $events)
                    <div class="item {{ $i==0 ? 'active' : ''}}">
                        <!-- Set the first background image using inline CSS below. -->
                        <div class="fill" style="background-image:url('files/events/{{ $events['image'] }}');"></div>
                        <div class="carousel-caption">
                            <h2 class="spasinull">{{ $events['title'] }}</h2>
                            {!! $events['descriptions'] !!}
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>


                <!-- Controls -->
                <a class="left carousel-control" href="#facCarousel" data-slide="prev">
                    <span class="fac-control icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#facCarousel" data-slide="next">
                    <span class="fac-control icon-next"></span>
                </a>

                <!-- SLICK ===========================  -->
                <div id="show-box-fac" class="active"></div>
                <div id="box-fac-slick" class="show">
                    <div class="slider autoplay">
                        @php $i = 0; @endphp
                        @foreach($event as $events)
                            <div class="indicator" style="background-image: url('files/events/{{$events['image']}}');" data-target="#newsCarousel" data-slide-to="{{$i++}}">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>{{ $events['title'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($i < 5)
                            @php $b = 5 - $i; @endphp
                            @for($a = 1; $a <= $b; $a++)
                            <div class="indicator" style="background-image: url('assets/img/abu.jpg');" data-target="#facCarousel" data-slide-to="5">
                                <div class="overlay lima">
                                    <div class="caption">
                                        <h3>Coming Soon</h3>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>

                </div>
            </section>
            <section class="page contact">
                    
                <div id="googleMap"></div>
                <div class="bawah">
                    <div class="container" style="">
                        <div class="row">
                            <div class="col-sm-6 message">
                                <h2 class="h2-dinamis spasinull">Contact</h2>
                                <form action="{{url('sendcontact')}}" method="POST">
                                    <input hidden name="_token" value="{{csrf_token()}}" />
                                    <table id="table-message">
                                        <tr>
                                                <td>NAME</td>
                                                <td><input type="text" name="name" class="form-control"></td>
                                        </tr>
                                        <tr>
                                                <td>EMAIL</td>
                                                <td><input type="email" name="email" class="form-control"></td>
                                        </tr>
                                        <tr>
                                                <td>PHONE</td>
                                                <td><input type="text" name="phone" class="form-control"></td>
                                        </tr>
                                        <tr>
                                                <td valign="top">MESSAGES</td>
                                                <td><textarea name="messages" class="form-control"></textarea></td>
                                        </tr>
                                        <tr>
                                                <td></td>
                                                <td style="text-align: right;padding: 20px 10px 0px 0px;"><input type="submit" class="btn-border-black" value="SUBMIT"></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <div class="col-sm-6">
                            <div class="box">
                                    <h2 class="h2-dinamis spasinull">KALPA TREE</h2>

                                    <ul>
                                        <li class="marginbottom10">Restaurant & Bar</li>
                                        <li class="marginbottom10">Jl. Kiputih no 37 Ciumbuleuit Bandung, West Java 40142</li>
                                        <li><strong class="font-crete-round">Open Every</strong> Mon - Sun / 10:00 AM - 22:00 PM</li>
                                        <li><strong class="font-crete-round">T</strong> 022 64402875</li>
                                        <li><strong class="font-crete-round">E</strong> kalpatree9@gmail.com</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-12 copyright">
                                <p>COPYRIGHT 2017 - MANAGE BY KALPA TREE</p>
                            </div>
                        </div>

                        <div class="footer" style="">
                            <ul class="socialmedia">
                                <li><a href="http://www.facebook.com/"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                <li><a href="https://plus.google.com/"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                    

            </section>
    </div>
</body>
<script src="{{ url('assets/node_modules/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/node_modules/bootstrap/dist/js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/jquery.onepage-scroll.js') }}" type="text/javascript"></script>

<!-- <script src="plugins/imagemaps/jquery.maphilight.js" type="text/javascript"></script> -->
<script src="{{ url('assets/plugins/imagemaps/jquery.rwdImageMaps.js') }}" type="text/javascript"></script>
<!-- <script src="plugins/imagemaps/map_rollover.js" type="text/javascript"></script> -->

<script src="{{ url('assets/plugins/slick/slick.js') }}" type="text/javascript"></script>

<script src="{{ url('assets/plugins/superslides/jquery.superslides.js') }}" type="text/javascript"></script>

<script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg_yMosmEdYVxs77oDPOc1kBaaFBKYvng">
</script>

<!--<script src="http://maps.googleapis.com/maps/api/js"></script>-->

<script src="{{ url('assets/js/main.js') }}" type="text/javascript"></script>

<script src="{{ url('assets/js/fastclick.js') }}" type="text/javascript"></script>
<script>
    $(function() {
        FastClick.attach(document.body);
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#text-two').attr('style', 'position:absolute; top:0%;')
        $('#text-three').attr('style', 'position:absolute; top:0%;')
    })
</script>

<!--
<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('googleMap'), {
          center: {lat: -6.8946476, lng: 107.6150896},
          zoom: 15
        });
      }
    </script>-->
</html>