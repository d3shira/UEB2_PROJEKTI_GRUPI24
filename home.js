
var swiper = new Swiper(". home-slider", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 7500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    loop:true,
  });

/*Blerta -mduhet qetu me shtu si ne video ama ka edhe diqka nalt qesaj temes edhe posht qasaj qe koka garant qikat e shtojne*/

var swiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    centeredSlides: true,
    autoplay: {
      delay: 7500,
      disableOnInteraction: false,
    },
    loop:true,
    breakpoints:{
   0:{
   slidesPerView:1,
   },
   640:{
   slidesPerView:2,
   },
   768:{
   slidesPerView:2,
   },
   1024:{
   slidesPerView:3,
   },
  },
 });