var htmlDirection = $('html').attr('dir');
if (htmlDirection == 'rtl') {
  var is_RTL = true
} else {
  var is_RTL = false;
}

$(document).ready(function () {
  // Dark Mode Control
  // var dark = document.getElementById('dark');

  // if($('#dark').length){
  //   dark.onclick = function(){
  //       document.body.classList.toggle('dark-theme');
  //       if(document.body.classList.contains('dark-theme')){
  //           dark.src = "image/sun.png";
  //       }else{
  //           dark.src = "image/moon.png";
  //       }
  //       return false;
  //   }
  // }

  $(".home-2-icon").click(function () {
    $(".search-box").slideToggle();
  });
  $('.search-icon').click(function () {
    $('.search-control').addClass('active');
    $('.cross-icon').show();
    $(this).hide();
  })
  $('.cross-icon').click(function () {
    $('.search-control').removeClass('active');
    $('.search-icon').show();
    $(this).hide();
  })
  // Mobile Search
  $('.m-search-icon').click(function () {
    $('.inline-form').addClass('active');
    $('.m-cross-icon').show();
    $(this).hide();
  })
  $('.m-cross-icon').click(function () {
    $('.inline-form').removeClass('active');
    $('.m-search-icon').show();
    $(this).hide();
  })
  // Nice Select
  $('.select-control').niceSelect();
});

// Web Ui Popover
$('#course_1').webuiPopover({
  url: '#feature_1',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_2').webuiPopover({
  url: '#feature_2',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_3').webuiPopover({
  url: '#feature_3',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_4').webuiPopover({
  url: '#feature_1',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_5').webuiPopover({
  url: '#feature_5',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});


// 2nd Step Course 
$('#course_6').webuiPopover({
  url: '#feature_6',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_7').webuiPopover({
  url: '#feature_7',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_8').webuiPopover({
  url: '#feature_8',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_9').webuiPopover({
  url: '#feature_9',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});
$('#course_10').webuiPopover({
  url: '#feature_10',
  trigger: 'hover',
  animation: 'pop',
  cache: false,
  multi: true,
  direction: 'rtl',
  placement: 'horizontal',
});

// Parent  Submenu Show
$('#headerOne').click(function () {
  $('#navOne').toggleClass('active');
  $('#navTwo').removeClass('active');
  $('#navThree').removeClass('active');
  $('#navFour').removeClass('active');
})
$('#headerTwo').click(function () {
  $('#navTwo').toggleClass('active');
  $('#navOne').removeClass('active');
  $('#navThree').removeClass('active');
  $('#navFour').removeClass('active');
})
$('#headerThree').click(function () {
  $('#navThree').toggleClass('active');
  $('#navOne').removeClass('active');
  $('#navTwo').removeClass('active');
  $('#navFour').removeClass('active');
})
$('#headerFour').click(function () {
  $('#navFour').toggleClass('active');
  $('#navOne').removeClass('active');
  $('#navTwo').removeClass('active');
  $('#navThree').removeClass('active');
})
//  Child Submenu Show
$('#showMenu-one').click(function () {
  $('#hideSub-menu-one').toggleClass('active');

})
$('#showMenu-two').click(function () {
  $('#hideSub-menu-two').toggleClass('active');
})
$('#showMenu-three').click(function () {
  $('#hideSub-menu-three').toggleClass('active');
})
$('#showMenu-four').click(function () {
  $('#hideSub-menu-four').toggleClass('active');
})
$('#showMenu-five').click(function () {
  $('#hideSub-menu-five').toggleClass('active');
})
// $(document).ready(function(){
//   $("#navbarDropdown").click(function(){
//     $(".navbarHover").slideToggle();
//   });
// });
$(document).ready(function () {
  $(".search-btnh").click(function () {
    $(".search_input").slideToggle();
  });
});

$(document).ready(function () {
  $(".hoverSearch").click(function () {
    $(".hoverInput").slideToggle();
  });
});

// $(document).ready(function(){
//   $(".menu_pro_tgl").click(function(){
//     $(".menu_pro_tgl_bg").slideToggle();
//   });
// });
// $(document).ready(function(){
//   $(".menu_wisth_tgl").click(function(){
//     $(".menu_pro_wish").slideToggle();
//   });
// });
$(document).ready(function () {
  $(".menu_pro_cart_tgl").click(function () {
    $(".menu_pro_cart").slideToggle();
  });
});
$(document).ready(function () {
  $('.dropdown-submenu a.test').on("click", function (e) {
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});







/* Store the element in el */
let el = document.getElementById('tilt')
if (el) {
  /* Get the height and width of the element */
  const height = el.clientHeight
  const width = el.clientWidth

  /*
    * Add a listener for mousemove event
    * Which will trigger function 'handleMove'
    * On mousemove
    */
  el.addEventListener('mousemove', handleMove)

  /* Define function a */
  function handleMove(e) {
    /*
      * Get position of mouse cursor
      * With respect to the element
      * On mouseover
      */
    /* Store the x position */
    const xVal = e.layerX
    /* Store the y position */
    const yVal = e.layerY

    /*
      * Calculate rotation valuee along the Y-axis
      * Here the multiplier 20 is to
      * Control the rotation
      * You can change the value and see the results
      */
    const yRotation = 20 * ((xVal - width / 2) / width)

    /* Calculate the rotation along the X-axis */
    const xRotation = -20 * ((yVal - height / 2) / height)

    /* Generate string for CSS transform property */
    const string = 'perspective(500px) scale(1.1) rotateX(' + xRotation + 'deg) rotateY(' + yRotation + 'deg)'

    /* Apply the calculated transformation */
    el.style.transform = string
  }

  /* Add listener for mouseout event, remove the rotation */
  el.addEventListener('mouseout', function () {
    el.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
  })

  /* Add listener for mousedown event, to simulate click */
  el.addEventListener('mousedown', function () {
    el.style.transform = 'perspective(500px) scale(0.9) rotateX(0) rotateY(0)'
  })

  /* Add listener for mouseup, simulate release of mouse click */
  el.addEventListener('mouseup', function () {
    el.style.transform = 'perspective(500px) scale(1.1) rotateX(0) rotateY(0)'
  })

}










//video box

new VenoBox({
  selector: '.venobox'
});

//  slider

$(document).ready(function () {
  $('.slide-items').owlCarousel({
    rtl: is_RTL,
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }

  })

  // Instructor Slider
  $('.instructor-slider').owlCarousel({
    rtl: is_RTL,
    loop: true,
    margin: 10,
    nav: true,
    navText: false,
    dots: false,
    autoplay: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1
      },
      520: {
        items: 2
      },
      768: {
        items: 3
      },
      992: {
        items: 4
      }
    }
  })




  // $('.course-group-slider').owlCarousel({
  //     loop:true,
  //     margin:10,
  //     nav:true,
  //     dots: false,
  //     navText:['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>'],
  //     responsive:{
  //         0:{
  //             items:1
  //         },
  //         600:{
  //             items:1
  //         },
  //         1000:{
  //             items:4
  //         }
  //     }
  // })

});


// $('.slide-items-2').owlCarousel({
//   loop:true,
//   margin:10,
//   nav:true,
//   dots: false,
//   navText:['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>'],
//   responsive:{
//       0:{
//           items:1
//       },
//       600:{
//           items:2
//       },
//       1000:{
//           items:2
//       }
//   }
// })



// Slick Carousel

$('.clients-logo-carousel').slick({
  rtl: is_RTL,
  dots: false,
  arrows: false,
  infinite: true,
  autoplay: true,
  speed: 700,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: false,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 420,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }
  ]
});
// Course Slider Index
$('.course-group-slider').slick({
  rtl: is_RTL,
  dots: false,
  arrows: true,
  autoplay: false,
  // centerPadding: '20px',
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [

    {
      breakpoint: 992,
      settings: {
        centerMode: false,
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 768,
      settings: {
        centerMode: false,
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 576,
      settings: {
        centerMode: false,
        slidesToShow: 1,
      },
    },
  ],
});

// Client Review Slider
// Slick Carousel 
$('.testimonials-slide-say').slick({
  rtl: is_RTL,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.testimonials-slide-author'
});
$('.testimonials-slide-author').slick({
  rtl: is_RTL,
  centerMode: true,
  autoplay: false,
  centerPadding: '20px',
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplaySpeed: 2000,
  asNavFor: '.testimonials-slide-say',
  dots: false,
  nav: true,
  navText: ['<i class="fa-solid fa-left-long"></i>', '<i class="fa-solid fa-right-long"></i>'],
  centerMode: true,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 3
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});


// New theme
$(".schedule-slide-day").slick({
  rtl: is_RTL,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  centerMode: true,
  asNavFor: ".schedule-slide-month",
});
$(".schedule-slide-month").slick({
  rtl: is_RTL,
  centerMode: true,
  autoplay: false,
  centerPadding: "20px",
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 1,
  autoplaySpeed: 2000,
  asNavFor: ".schedule-slide-day",
  dots: false,
  nav: true,
  navText: ['<i class="fa-solid fa-left-long"></i>', '<i class="fa-solid fa-right-long"></i>'],
  centerMode: true,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 4,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
      },
    },
  ],
});
$(".brand-4").slick({
  rtl: is_RTL,
  centerMode: true,
  autoplay: true,
  centerPadding: "0px",
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplaySpeed: 2000,
  dots: false,
  arrows: false,
  nav: true,
  centerMode: true,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 3000,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});
$(".brand-slider-5").slick({
  rtl: is_RTL,
  centerMode: true,
  autoplay: true,
  centerPadding: "0px",
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplaySpeed: 2000,
  arrows: false,
  dots: false,
  nav: true,
  centerMode: true,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 4,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
      },
    },
  ],
});
$(".testimonial-5").slick({
  rtl: is_RTL,
  centerMode: true,
  autoplay: true,
  centerPadding: "0px",
  infinite: true,
  autoplay: false,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplaySpeed: 2000,
  dots: true,
  arrows: false,
  nav: true,
  centerMode: true,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});



// Set the skill level for Skill 1 (between 0 and 5)
let skillLevel1 = 3;

// Get the skill bar element for Skill 1
let skillBar1 = document.getElementById("skill-bar-1");

if ($('#skill-bar-1').length > 0) {
  // Add the class for the skill level to the skill bar
  skillBar1.classList.add("skill-" + skillLevel1);
}





//Header search bar
$('#headerSearchBarLg').on('focus', function () {
  if ($('#headerSearchBarLg').val() == '') {
    $('#headerSearchBarLg').removeClass('focused');
    $('button.header-search-icon').hide();
    $('label.header-search-icon').show();
  } else {
    $('#headerSearchBarLg').addClass('focused');
    $('button.header-search-icon').show();
    $('label.header-search-icon').hide();
  }
});

$('#headerSearchBarLg').on('focusout', function () {
  if ($('#headerSearchBarLg').val() == '') {
    $('#headerSearchBarLg').removeClass('focused');
    $('button.header-search-icon').hide();
    $('label.header-search-icon').show();
  } else {
    $('#headerSearchBarLg').addClass('focused');
    $('button.header-search-icon').show();
    $('label.header-search-icon').hide();
  }
});

$('#headerSearchBarLg').on('keyup', function () {
  if ($('#headerSearchBarLg').val() == '') {
    $('#headerSearchBarLg').removeClass('focused');
    $('button.header-search-icon').hide();
    $('label.header-search-icon').show();
  } else {
    $('#headerSearchBarLg').addClass('focused');
    $('button.header-search-icon').show();
    $('label.header-search-icon').hide();
  }
});




const searchInputDropdown = document.querySelector('.search-input-form button.btn.dropdown-toggle')
searchInputDropdown.addEventListener('show.bs.dropdown', event => {
  setTimeout(function(){
    $('#headerSearchBarLg').focus();
    var headerSearchBarLg = $('#headerSearchBarLg')[0];
    var textLength = headerSearchBarLg.value.length;
    // Set the selection range to the end of the text
    headerSearchBarLg.setSelectionRange(textLength, textLength);
  }, 200);
});
//End header search bar
