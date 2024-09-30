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

  var swiper = new Swiper(".list-img-slide", {
    slidesPerView: 4,
    spaceBetween: 15,
    loop: true,
    // centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
    },
    // pagination: {
    //   el: ".swiper-pagination",
    //   clickable: true,
    // },
  });


}(jQuery));