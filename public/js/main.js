// back to top
$(document).ready(function(){
// Check distance to top and display back-to-top.
$( window ).scroll( function() {
	if ( $( this ).scrollTop() > 800 ) {
		$( '.back-to-top' ).addClass( 'show-back-to-top' );
	} else {
		$( '.back-to-top' ).removeClass( 'show-back-to-top' );
	}
});

// Click event to scroll to top.
$( '.back-to-top' ).click( function() {
	$( 'html, body' ).animate( { scrollTop : 0 }, 800 );
	return false;
});
// read more js
$('article').readmore({
    speed: 75,
    lessLink: '<a href="#" class="seeless">Less answer <span class="arrow-up"></span></a>',
    moreLink: '<a href="#" class="see-more">See more answer (8) <span class="arrow-down"></span></a>',
    collapsedHeight: 200,
  });

  $("article").slice(0,3).show();
  $(".loadmore").click(function(e){
    e.preventDefault();
    $("article:hidden").slice(0,3).fadeIn("slow");
    
    if($("article:hidden").length == 0){
       $(".loadmore").fadeOut("slow");
      }
  });
  });
// menu active
$(document).ready(function(){
  $('.menu-list-bottom .for-active a').click(function(){
    $('.for-active a').removeClass("active");
    $(this).addClass("active");
});
// thumbnail active
// $('.thumbnails li:second a').click(function(){
//     $('li:second a').removeClass("active");
//     $(this).addClass("active");
// });
$('.thumbnails li a').click(function(){
    $('.thumbnails li a').removeClass("active");
    $(this).addClass("active");
});
// owl carousel
$('.owl-carousel-one').owlCarousel({
    loop:true,
    margin:10,
    autoplay: false,
    nav: true,
    navText: [
        '<img src="../img/icon/left-arrow.png">',
        '<img src="../img/icon/right-arrow.png">'
    ],
	dots: false,
    responsive:{
        0:{
            items:1
        },
        575:{
            items:2
        },
        768:{
            items:2
        },
        992:{
            items:3
        },
        1200:{
            items:3,
            nav: true
        },
        1400:{
            items:4,
            nav: true
        }
    }
})
// carosel 2
$('.owl-carousel-two').owlCarousel({
    loop:true,
    margin:10,
    nav: true,
    autoplay: true,
    navText: [
        '<img src="../img/icon/left-arrow.png">',
        '<img src="../img/icon/right-arrow.png">'
    ],
	dots: false,
    responsive:{
        0:{
            items:1
        },
        575:{
            items:2
        },
        768:{
            items:3
        },
        992:{
            items:4,
            nav: true
        },
        1200:{
            items:4,
            nav: true
        },
        1400:{
            items:4,
            nav: true
        }
    }
})
// carosel 3
$('.owl-carousel-three').owlCarousel({
    loop:true,
    margin:10,
    nav: true,
    autoplay: true,
    navText: [
        '<img src="../img/icon/left-arrow.png">',
        '<img src="../img/icon/right-arrow.png">'
    ],
	dots: false,
    responsive:{
        0:{
            items:1
        },
        575:{
            items:2
        },
        768:{
            items:3,
            nav: true
        },
        992:{
            items:3,
            nav: true
        },
        1200:{
            items:3,
            nav: true
        },
        1400:{
            items:3,
            nav: true
        }
    }
})
// carosel 4
$('.owl-carousel-four').owlCarousel({
    loop:true,
    margin:10,
    nav: true,
    autoplay: true,
    navText: [
        '<img src="../img/icon/left-arrow.png">',
        '<img src="../img/icon/right-arrow.png">'
    ],
	dots: false,
    responsive:{
        0:{
            items:1
        },
        575:{
            items:2
        },
        768:{
            items:4,
            nav: true
        },
        992:{
            items:5,
            nav: true
        },
        1200:{
            items:5,
            nav: true
        },
        1400:{
            items:6,
            nav: true
        }
    }
})
// dropdown animation
$('.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
  });
  
  $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
  });
});
// bx slider
$(document).ready(function(){
    $('.slider').bxSlider({
        auto: true,
        pager: false,

    });
  });
//   item details 
// cart count
$(document).ready(function() {
    var cartCountValue = 0;
    var cartCount = $('.cart .count');
    $(cartCount).text(cartCountValue);
  
  
  
    $('.cart-btn').on('click', function() {
      var cartBtn = this;
      var cartCountPosition = $(cartCount).offset();
      var btnPosition = $(this).offset();
      var leftPos =
        cartCountPosition.left < btnPosition.left
          ? btnPosition.left - (btnPosition.left - cartCountPosition.left)
          : cartCountPosition.left;
      var topPos =
        cartCountPosition.top < btnPosition.top
          ? cartCountPosition.top
          : cartCountPosition.top;
      $(cartBtn)
        .append("<span class='count'>1</span>");
      
      $(cartBtn).find(".count").each(function(i,count){
        $(count).offset({
          left: leftPos,
          top: topPos
        })
        .animate(
          {
            opacity: 0
          },
          100,
          function() {
            $(this).remove();
            cartCountValue++;
            $(cartCount).text(cartCountValue);
          }
        );
      }); 
    });
  
    function getRndInteger(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
  });
// read more
$(function(){
    $('.example').expandable({
        'height': 160,
        'more': 'See More Answers (8)',
        'less': 'Less Answer',
        'no_less': false,
        'animation_duration': 500,
        expand_responsive : 768

      });
  });


  
  
// tooltip
// $(document).ready(function(){
//   $('[data-toggle="tooltip"]').tooltip();   
// });


