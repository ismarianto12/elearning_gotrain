(function ($) {
  "use strict";

  var Medi = {
    init: function () {
      this.Basic.init();
    },

    Basic: {
      init: function () {
        this.scrollTop();
        this.BackgroundImage();
        this.MobileMenu();
        this.Niceselect();
      },
      scrollTop: function () {
        $(window).on("scroll", function () {
          var ScrollBarPosition = $(this).scrollTop();
          if (ScrollBarPosition > 200) {
            $(".scroll-top").fadeIn();
          } else {
            $(".scroll-top").fadeOut();
          }
        });
        $(".scroll-top").on("click", function () {
          $("body,html").animate({
            scrollTop: 0,
          });
        });
      },
      BackgroundImage: function () {
        $("[data-background]").each(function () {
          $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
        });
      },
      MobileMenu: function () {
        $(".open_mobile_menu").on("click", function () {
          $(".mobile_menu_wrap").toggleClass("mobile_menu_on");
        });
        $(".open_el_mobile_menu").on("click", function () {
          $(".el_mobile_menu_wrap").toggleClass("h-full");
        });
        $(".open_mobile_menu").on("click", function () {
          $("body").toggleClass("mobile_menu_overlay_on");
        });
        if ($(".mobile_menu li.dropdown ul").length) {
          $(".mobile_menu li.dropdown").append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
          $(".mobile_menu li.dropdown .dropdown-btn").on("click", function () {
            $(this).prev("ul").slideToggle(500);
          });
        }
      },
      Niceselect: function () {
        $(document).ready(function () {
          if($(".sSelect").length){
            $(".sSelect").niceSelect();
          }
        });
      }
    },
  };
  jQuery(document).ready(function () {
    Medi.init();
  });
})(jQuery);
