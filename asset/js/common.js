
// $(function () {
//   $('.contents-list').slick({
//     infinite: true,
//     autoplay: true,
//     autoplaySpeed: 5000,
//     pauseOnFocus: false,
//     pauseOnHover: false,
//     pauseOnDotsHover: false,
//     arrows: true,
//     slidesToShow: 3,
//     centerMode: true,
//     centerPadding: '50px',
//     variableWidth: true,
//   });
// });



$(function () {
  $(".js-accordion-title").on("click", function() {
    console.log(123);
    $(this).next().slideToggle(200);
    $(this).toggleClass("open",200);
  });
});



$(function () {
  $('a[href^="#"]').click(function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    var speed = 500;
    $("html, body").animate({
      scrollTop: position
    }, speed, "swing");
    return false;
  });
});