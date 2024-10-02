(function ($) {
  AOS.init();
  
  //slide
  var slide_image_about_us = new Swiper(".slide-image-about-us", {
    slidesPerView: 2,
    spaceBetween: 8,
    loop:true,
    centeredSlides: true,
    pagination: {
      el: ".slide-image-pagination",
      clickable: true,
    },
  });

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
  $('.wc-tabs li a, .woocommerce-tabs ul.tabs li a').on('click', function(e) {
    e.preventDefault();
    console.log('aaaa');
    // Remove active class from all tabs
    $('.wc-tabs li, .woocommerce-tabs ul.tabs li').removeClass('active');
    $('.woocommerce-Tabs-panel').hide();

    // Add active class to the clicked tab and show its content
    $(this).closest('li').addClass('active');
    var panelId = $(this).attr('href');
    $(panelId).show();
});

  // Ensure the first tab and its content are active initially
  // $('.wc-tabs li:first-child, .woocommerce-tabs ul.tabs li:first-child').addClass('active');
  // $('.woocommerce-Tabs-panel:first-child').show();


}(jQuery));