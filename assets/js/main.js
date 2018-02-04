 /*
|-----------------------------------------------------------------------------------
| Carousel
|-----------------------------------------------------------------------------------
|
|
*/

        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })

/*
|-----------------------------------------------------------------------------------
| One Page Scroll
|-----------------------------------------------------------------------------------
|
|
*/
   
        $(".main").onepage_scroll({
            sectionContainer: "section",
        });

/*
|-----------------------------------------------------------------------------------
| Google Maps
|-----------------------------------------------------------------------------------
|
|
*/


function initialize() {
        var cord = new google.maps.LatLng(-6.8663822, 107.6093935);
      var mapProp = {
        center:cord,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
      };
      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

      var image = {
        url: 'assets/img/marker.png'/*,
        size: new google.maps.Size(60, 80),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(30, 80)*/
      };

      var contentString = '<h1 style=color:#ef434d>Kalpa Tree</h1>';

      var infowindow = new google.maps.InfoWindow({
          content: contentString
      });

      // Set map marker
      var marker = new google.maps.Marker({
            position: cord,
            icon: image,
            map: map,
            title: 'My Location',
            animation:google.maps.Animation.BOUNCE
      });

      // click marker show tooltip
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });

      
        // keep BOUNCE after zoom map
        google.maps.event.addListener(map, 'bounds_changed', function(event) {
            if(map.getBounds().contains(marker.position)){
                marker.setAnimation(google.maps.Animation.BOUNCE);
            };
        });

    }
    google.maps.event.addDomListener(window, 'load', initialize);

 


/*
|-----------------------------------------------------------------------------------
| 
|-----------------------------------------------------------------------------------
|
|
*/
            /*$('.gall').click(function() {
                var id = $(this).attr('id');
                var imgSrc = document.getElementById(id).getAttribute('src');
                console.log(imgSrc);
                document.getElementById("gall-modal").setAttribute("src", imgSrc);
            });*/
   




/*
|-----------------------------------------------------------------------------------
| ImageMap
|-----------------------------------------------------------------------------------
|
|
*/

    /*$(function() {
        $('.map').maphilight({
            fillColor: '880000'
        });
    });*/

     //mengambil posisi cursor
        var mouseX;
        var mouseY;
        $(document).mousemove( function(e) {
           mouseX = e.pageX; 
           mouseY = e.pageY;
        });  

/*        //get image size
        var img = document.getElementById('images');
        var imgW = img.clientWidth;
        console.log(imgW);
        // tengah gedung
        var imgWsetengah = imgW / 2;*/

        
        $('.maparea').click(function(e) {
            var id = $(this).attr("id");
            var cordinat_left = $(this).attr('coords'); //ambil kordinat
           
           

             if ( $('.maparea-isi.'+id).hasClass('active') ) {
                    closeAlert();
               } else {
                     closeAlert();
                     if(window.innerWidth > 768) {
                             
                              $('.maparea-isi').removeClass('mobile');
                              //$('#'+id+'-isi').css({'display': 'block', 'top': mouseY, 'left': mouseX});
                              $('#'+id+'-isi').css({'top': mouseY, 'left': mouseX});
                              $('#'+id+'-isi').addClass("active");
                     } else {
                              $('.maparea-isi').addClass('mobile');
                              //$('#'+id+'-isi').css({'display': 'block', 'top': '50%', 'left': '50%'});
                              $('#'+id+'-isi').css({'top': mouseY, 'left': mouseX});
                              $('#'+id+'-isi').addClass("active");
                      }
               }
        })

        $('.f-read').click(function() {
              closeAlert();
        });

        function closeAlert() {
             //$('.maparea-isi').css({'display':'none'});
             $('.maparea-isi').removeClass("active");
        }



            // image map responsive
            $(document).ready(function(e) {
                $('img[usemap]').rwdImageMaps();
            });



// close popup if click outside box area
$('html').click(function() {
    if ( $('.maparea-isi').hasClass('active') ) {
        closeAlert();
    } 
});

$('.maparea').click(function(event){
    event.stopPropagation();
});

   /*
|-----------------------------------------------------------------------------------
| Superslide
|-----------------------------------------------------------------------------------
|
|
*/

    /*$('#slides').superslides({
      animation: 'fade',
        play: 3000
    });*/
  

  /*
|-----------------------------------------------------------------------------------
| Fungsi click dialog SEARCH and LANGUAGE
|-----------------------------------------------------------------------------------
|
|
*/

  // menampilkan dialoh serch
  $("#show-search").click(function() {
            if($(".box-search.active").is(":visible")) {
                    $(".box-search").removeClass("active");
            } else {
                    $(".box-search").addClass("active");
                    $(".box-lang").removeClass("active");
            }
  });

   $("#show-lang").click(function() {
            if($(".box-lang.active").is(":visible")) {
                    $(".box-lang").removeClass("active");
            } else {
                    $(".box-lang").addClass("active");
                    $(".box-search").removeClass("active");
            }
  });

/*
|-----------------------------------------------------------------------------------
| Hiden Show NAVIGASI
|-----------------------------------------------------------------------------------
|
|
*/

  $("#show-nav").click(function() {
            if($(".navbar-costum.active").is(":visible")) {
                    $(".navbar-costum").removeClass("active");

                    $("#show-nav .glyphicon").addClass("glyphicon-menu-hamburger");
                    $("#show-nav .glyphicon").removeClass("glyphicon-remove");
                    $("#show-nav").removeClass("glyphicon-menu-hamburger");

                    $(".menu-right").removeClass("active");

                    $(".logo.red").removeClass("active");

                    $("#show-search").removeClass("active");
                    $("#show-lang").removeClass("active");

            } else {
                    $(".navbar-costum").addClass("active");

                     $("#show-nav").addClass("glyphicon-remove");

                     $("#show-nav .glyphicon").addClass("glyphicon-remove");
                     $("#show-nav .glyphicon").removeClass("glyphicon-menu-hamburger");
                     $("#show-nav").removeClass("glyphicon-remove");

                     $(".menu-right").addClass("active");

                     $(".logo.red").addClass("active");

                     $("#show-search").addClass("active");
                    $("#show-lang").addClass("active");
            }
  })
$(".nav li a").click(function() {
    $(".navbar-collapse").removeClass("in"); 
})

/*
|-----------------------------------------------------------------------------------
| SLIDESHOW FACILITY, NEWS, GALLERIES
|-----------------------------------------------------------------------------------
|
|
*/

  // SHOW HIDDEN BOX PAGING SLIDE
  $("#show-box-gall").click(function() {
            if($("#box-gall-slick.show").is(":visible")) {
                    $("#box-gall-slick").removeClass("show");
                    $("#show-box-gall").removeClass("active");

                    $('.gall-control').addClass("active");

                    $('#slidetext').addClass("turun");
            } else {
                    $("#box-gall-slick").addClass("show");
                    $("#show-box-gall").addClass("active");

                    $('.gall-control').removeClass("active");

                    $('#slidetext').removeClass("turun");
            }

  });

  $("#show-box-fac").click(function() {
            if($("#box-fac-slick.show").is(":visible")) {
                    $("#box-fac-slick").removeClass("show");
                    $("#show-box-fac").removeClass("active");

                    $('.fac-control').addClass("active");
            } else {
                    $("#box-fac-slick").addClass("show");
                    $("#show-box-fac").addClass("active");

                    $('.fac-control').removeClass("active");
            }

  });

  $("#show-box-news").click(function() {
            if($("#box-news-slick.show").is(":visible")) {
                    $("#box-news-slick").removeClass("show");
                    $("#show-box-news").removeClass("active");

                    $('.news-control').addClass("active");
            } else {
                    $("#box-news-slick").addClass("show");
                    $("#show-box-news").addClass("active");

                    $('.news-control').removeClass("active");
            }

  });
  

  /*
|-----------------------------------------------------------------------------------
| SLICK
|-----------------------------------------------------------------------------------
|
|
*/

        $('.autoplay').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 5000,
                speed: 300
        });   
  /*
  
<!--
  <script>
           // dropdown hover
           // pada bagian menu
           $(function(){
            $(".dropdown.li-nav").hover(            
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                        $(this).toggleClass('open');
                        $('b', this).toggleClass("caret caret-up");                
                    },
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                        $(this).toggleClass('open');
                        $('b', this).toggleClass("caret caret-up");                
                    });
            }); 
  </script>
-->
*/

/*
|-----------------------------------------------------------------------------------
| Mengambil Jumlah dan posisi slide Gallery
|-----------------------------------------------------------------------------------
|
|
*/

            // GALLERY
            // GET PAGING SLIDE NUMBER 
            var semua = $('.galleries .item').length;
            var currentIndex = $('.galleries .item.active').index() + 1;
            $('#slidetext').html('<span class=font-merah>' + currentIndex + '</span> | '  + semua);

            // This triggers after each slide change
            $('#gallCarousel').on('slid.bs.carousel', function () {
              currentIndex = $('.galleries .item.active').index() + 1;

              // Now display this wherever you want
              var text = '<span class=font-merah>' + currentIndex + '</span> | ' + semua;
              $('#slidetext').html(text);
            });
 
  /*


  <!-- ANIMATION -->
  <!-- =============================================================================================== -->
  <!-- =============================================================================================== -->
  <!-- =============================================================================================== -->
*/

                    //window.setTimeout(function() {
                        
                        $('#slides').superslides({
                          animation: 'fade',
                            play: 5000,
                            animation_speed: 1500
                        });
                        
                    //}, 15000);

            $(document).ready(function() {

                    /*$('.logo').css({'display': 'none'});
                    $('.onepage-pagination').css({'display': 'none'});
                    $('.box-scroll-down').css({'display': 'none'});
                    $('.menu-right').css({'display': 'none'});
                    $('.footer').css({'display': 'none'});
                    $('#slides').css({'display': 'none'});


                    $('.landing-anime').css({'opacity':'0'});
                    $('#text-one').css({'display': 'none'});
                    $('#text-two').css({'display': 'none'});
                    $('#text-three').css({'display': 'none'});
                    $('#land-logo').css({'display': 'none'});*/

                    window.setTimeout(function() {
                        $('#landing-anime').css({'opacity':'1'});
                        $('.menu-right').css({'opacity': '1'});
                        $('#land-logo').css({'opacity': '0'});
                        $(".navbar-costum").addClass("active");

                        $("#show-nav").addClass("glyphicon-remove");
   
                        $("#show-nav .glyphicon").addClass("glyphicon-remove");
                        $("#show-nav .glyphicon").removeClass("glyphicon-menu-hamburger");
                        $("#show-nav").removeClass("glyphicon-remove");
   
                        $(".menu-right").addClass("active");
   
                        $(".logo.red").addClass("active");
   
                        $("#show-search").addClass("active");
                        $("#show-lang").addClass("active");

                    }, 0);

                    window.setTimeout(function() {
                        $('#text-one').css({'opacity': '1'});
                        $('#text-one').css({
                                                                //'transform': 'translateY(0px)',
                                                                /*'-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',*/
                                                          });
                        $('.menu-right').css({'opacity': '1'});
                        $('#land-logo').css({'opacity': '0'});
                        $(".navbar-costum").addClass("active");

                        $("#show-nav").addClass("glyphicon-remove");
   
                        $("#show-nav .glyphicon").addClass("glyphicon-remove");
                        $("#show-nav .glyphicon").removeClass("glyphicon-menu-hamburger");
                        $("#show-nav").removeClass("glyphicon-remove");
   
                        $(".menu-right").addClass("active");
   
                        $(".logo.red").addClass("active");
   
                        $("#show-search").addClass("active");
                        $("#show-lang").addClass("active");

                    }, 3000);

                    window.setTimeout(function() {
                        $('#text-one').css({'opacity': '0'});
                        $('#text-two').css({'opacity': '1'});
                        $('#text-two').css({
                                                                //'transform': 'translateY(0px)',
                                                                /*'-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',*/
                                                          });

                         $('#land-logo').css({'opacity': '1'});
                         $('#land-logo').css({
                                                                //'transform': 'translateY(0px)',
                                                                /*'-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',*/
                                                          });
                        $('.menu-right').css({'opacity': '1'});
                        $('#land-logo').css({'opacity': '0'});
                        $(".navbar-costum").addClass("active");

                        $("#show-nav").addClass("glyphicon-remove");
   
                        $("#show-nav .glyphicon").addClass("glyphicon-remove");
                        $("#show-nav .glyphicon").removeClass("glyphicon-menu-hamburger");
                        $("#show-nav").removeClass("glyphicon-remove");
   
                        $(".menu-right").addClass("active");
   
                        $(".logo.red").addClass("active");
   
                        $("#show-search").addClass("active");
                        $("#show-lang").addClass("active");

                    }, 7000);

                     window.setTimeout(function() {
                        $('#text-two').css({'opacity': '0'});
                        $('#text-three').css({'opacity': '1'});
                        $('#text-three').css({
                                                                //'transform': 'translateY(0px)',
                                                               /* '-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',*/
                                                          });
                        $('.menu-right').css({'opacity': '1'});
                        $('#land-logo').css({'opacity': '0'});
                        $(".navbar-costum").addClass("active");

                        $("#show-nav").addClass("glyphicon-remove");
   
                        $("#show-nav .glyphicon").addClass("glyphicon-remove");
                        $("#show-nav .glyphicon").removeClass("glyphicon-menu-hamburger");
                        $("#show-nav").removeClass("glyphicon-remove");
   
                        $(".menu-right").addClass("active");
   
                        $(".logo.red").addClass("active");
   
                        $("#show-search").addClass("active");
                        $("#show-lang").addClass("active");

                    }, 10000);

                    window.setTimeout(function() {
                        $('.logo').css({'opacity': '1'});
                        $('.onepage-pagination').css({'opacity': '1'});
                        $('.box-scroll-down').css({'opacity': '1'});
                        $('.footer').css({'opacity': '1'});
                        $('.menu-right').css({'opacity': '1'});
                        $('#land-logo').css({'opacity': '0'});
                        $(".navbar-costum").addClass("active");

                        $("#show-nav").addClass("glyphicon-remove");
   
                        $("#show-nav .glyphicon").addClass("glyphicon-remove");
                        $("#show-nav .glyphicon").removeClass("glyphicon-menu-hamburger");
                        $("#show-nav").removeClass("glyphicon-remove");
   
                        $(".menu-right").addClass("active");
   
                        $(".logo.red").addClass("active");
   
                        $("#show-search").addClass("active");
                        $("#show-lang").addClass("active");
                    }, 13000);

                    window.setTimeout(function() {
                        $('#landing-anime').css({'opacity': '0', 'z-index': '1'});
                        
                        $('#slides').css({'opacity': '1', 'z-index': '2'});
                    }, 15000);

            });


/*$(document).ready(function() {

   $('a.link').on('click touchend', function(e) {
      var el = $(this);
      var link = el.attr('href');
      window.location = link;
   });

}); */