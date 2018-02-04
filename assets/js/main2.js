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


/*

  <!-- NON ANIMATION FOR DETAIL -->
  <!-- =============================================================================================== -->
  <!-- =============================================================================================== -->
  <!-- =============================================================================================== -->
*/

            $(document).ready(function() {

                    window.setTimeout(function() {
                        $('#landing-anime').css({'opacity':'1'});
                    }, 0);

                    window.setTimeout(function() {
                        $('#text-one').css({'opacity': '1'});
                        $('#text-one').css({
                                                                //'transform': 'translateY(0px)',
                                                                '-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',
                                                          });
                    }, 0);

                    window.setTimeout(function() {
                        $('#text-one').css({'opacity': '0'});
                        $('#text-two').css({'opacity': '1'});
                        $('#text-two').css({
                                                                //'transform': 'translateY(0px)',
                                                                '-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',
                                                          });

                         $('#land-logo').css({'opacity': '1'});
                         $('#land-logo').css({
                                                                //'transform': 'translateY(0px)',
                                                                '-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',
                                                          });
                    }, 0);

                     window.setTimeout(function() {
                        $('#text-two').css({'opacity': '0'});
                        $('#text-three').css({'opacity': '1'});
                        $('#text-three').css({
                                                                //'transform': 'translateY(0px)',
                                                                '-webkit-transform': 'translateY(0px)',
                                                                '-moz-transform': 'translateY(0px)',
                                                                '-o-transform': 'translateY(0px)',
                                                                'transform': 'translateY(0px)',
                                                          });
                    }, 0);

                    window.setTimeout(function() {
                        $('.logo').css({'opacity': '1'});
                        $('.onepage-pagination').css({'opacity': '1'});
                        $('.box-scroll-down').css({'opacity': '1'});
                        $('.menu-right').css({'opacity': '1'});
                        $('.footer').css({'opacity': '1'});

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
                        $('#landing-anime').css({'opacity': '0', 'z-index': '1'});
                        
                         $('#slides').css({'opacity': '1', 'z-index': '2'});
                        $('#slides').superslides({
                          animation: 'fade',
                            play: 4000
                        });
                    }, 0);

            });


/*$(document).ready(function() {

   $('a.link').on('click touchend', function(e) {
      var el = $(this);
      var link = el.attr('href');
      window.location = link;
   });

}); */