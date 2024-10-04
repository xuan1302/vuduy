(function ($) {
  AOS.init();
  
  //slide
  var home_slide = new Swiper(".slide-home", {
    slidesPerView: 1,
    spaceBetween: 0,
    // centeredSlides: true,
    loop: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination-slide-home",
      clickable: true,
    },
  });

  $('.content-process .item-process:nth-child(1)').addClass('active');
  $('.content-process .item-process').hover(
      function() {
        $(this).addClass('active').siblings().removeClass('active');
      },
      function() {
        $(this).removeClass('active');
        $('.content-process .item-process:nth-child(1)').addClass('active');
      }
  );

  $('.icon-menu-mobile').click(function () {

    setTimeout(()=>{
          $('.menu-responsive').addClass('show-mn');
        }
        , 100)
  })
  $('.icon-close-res-menu img').click(function () {
    $('.menu-responsive').removeClass('show-mn');
  })

  $(document).on("click", function(e) {
    if ($(e.target) != $(".menu-responsive") && $(".menu-responsive").hasClass("show-mn")) {
      $(".menu-responsive").removeClass("show-mn");
    }
  })

}(jQuery));