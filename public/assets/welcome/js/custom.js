
/*----------------------------------------------
Index Of Script
------------------------------------------------

Page Loader
Back To Top
Header
Scrolling
counter
Owl Carousel
Progress Bar
Parallax
Wow Animation

------------------------------------------------
Index Of Script
----------------------------------------------*/

$(document).ready(function() {

    /*------------------------
         Page Loader
        --------------------------*/
        jQuery("#load").fadeOut();
        jQuery("#loading").delay(0).fadeOut("slow");


        $(".navbar a").on("click", function(event) {
            if (!$(event.target).closest(".nav-item.dropdown").length) {
                $(".navbar-collapse").collapse('hide');
            }
        });

        /*------------------------
         Back To Top
        --------------------------*/
        $('#back-to-top').fadeOut();
        $(window).on("scroll", function() {
            if ($(this).scrollTop() > 250) {
                $('#back-to-top').fadeIn(1400);
            } else {
                $('#back-to-top').fadeOut(400);
            }
        });
        // scroll body to 0px on click
        $('#top').on('click', function() {
            $('top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });


    /*------------------------
    Header
    --------------------------*/
     $('.navbar-nav li a').on('click', function(e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - 0
        }, 1500);
        e.preventDefault();
    });
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 70) {
            $('header').addClass('menu-sticky');
        } else {
            $('header').removeClass('menu-sticky');
        }
    });


/*------------------------
        About menu
        --------------------------*/


        // function sticky_relocate() {
        //     var window_top = $(window).scrollTop();
        //     var div_top = $('.main-sticky').offset().top + 500;
        //     if (window_top > div_top) {
        //       $('.our-info').addClass('menu-sticky');
        //     } else {
        //       $('.our-info').removeClass('menu-sticky');
        //     }
        //   }

        //   $(function() {
        //     $(window).scroll(sticky_relocate);
        //     sticky_relocate();
        //   });



$(document).ready(function(){
    $('.our-info ul.about-us li a').on('click',function() {
    $('.our-info ul.about-us li a.active').removeClass('active');
    $(this).addClass('active');
});
});




    /*------------------------
    Owl Carousel
    --------------------------*/
    $('.owl-carousel').each(function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
            items: $carousel.data("items"),
            loop: $carousel.data("loop"),
            margin: $carousel.data("margin"),
            nav: $carousel.data("nav"),
            dots: $carousel.data("dots"),
            autoplay: $carousel.data("autoplay"),
            autoplayTimeout: $carousel.data("autoplay-timeout"),
             navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            responsiveClass: true,
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: $carousel.data("items-mobile-sm")
                },
                // breakpoint from 480 up
                480: {
                    items: $carousel.data("items-mobile")
                },
                // breakpoint from 786 up
                786: {
                    items: $carousel.data("items-tab")
                },
                // breakpoint from 1023 up
                1023: {
                    items: $carousel.data("items-laptop")
                },
                1199: {
                    items: $carousel.data("items")
                }
            }
        });
    });






    /*------------------------
        Wow Animation
    --------------------------*/
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        wow.init();

    /*------------------------
        Inside Animation
    --------------------------*/

     var background = {}
  
      background.initializr = function (){
        
        var $this = this;
         

       
        //option
        $this.id = "background_css3";
        $this.style = {bubbles_color:"#000",stroke_width:0, stroke_color :"black"};
        $this.bubbles_number = 30;
        $this.speed = [1500,8000]; //milliseconds
        $this.max_bubbles_height = $this.height;
        $this.shape = false // 1 : circle | 2 : triangle | 3 : rect | false :random
        
        if($("#"+$this.id).lenght > 0){
          $("#"+$this.id).remove();
        }
        $this.object = $("<div style='z-inde:-1;margin:0;padding:0; overflow:hidden;position:absolute;bottom:0' id='"+$this.id+"'> </div>'").appendTo("container-inside");
        
        $this.ww = $(window).width()
        $this.wh = $(window).height()
        $this.width = $this.object.width($this.ww);
        $this.height = $this.object.height($this.wh);
        
        
        $("#container-inside").prepend("<style>.shape_background {transform-origin:center; width:80px; height:80px; background: "+$this.style.bubbles_color+"; position: absolute; z-index: 999;}</style>");
        
        
        for (i = 0; i < $this.bubbles_number; i++) {
            $this.generate_bubbles()
        }
        
      }


    background.generate_bubbles = function() {
         var $this = this;
         var base = $("<div class='shape_background'></div>");
         var shape_type = $this.shape ? $this.shape : Math.floor($this.rn(1,3));
         if(shape_type == 1) {
           var bolla = base.css({borderRadius: "50%"})
         }else if (shape_type == 2){
           var bolla = base.css({width:0, height:0, "border-style":"solid","border-width":"0 40px 69.3px 40px","border-color":"transparent transparent "+$this.style.bubbles_color+" transparent", background:"transparent"}); 
         }else{
           var bolla = base; 
         }    
         var rn_size = $this.rn(.8,1.2);
         bolla.css({"transform":"scale("+rn_size+") rotate("+$this.rn(-360,360)+"deg)", top:$this.wh+100, left:$this.rn(-60, $this.ww+60)});        
         bolla.appendTo($this.object);
         bolla.transit({top: $this.rn($this.wh/2,$this.wh/2-60), "transform":"scale("+rn_size+") rotate("+$this.rn(-360,360)+"deg)", opacity: 0},$this.rn($this.speed[0],$this.speed[1]), function(){
           $(this).remove();
           $this.generate_bubbles();
         })
       
    }


    background.rn = function(from, to, arr) {
      if(arr){
              return Math.random() * (to - from + 1) + from;
      }else{
        return Math.floor(Math.random() * (to - from + 1) + from);
      }
        }
    background.initializr()


});

