



  function loader(){
    document.querySelector('.loader-container').classList.add('fade-out');
  }

  function fadeOut(){
    setInterval(loader, 3000);
  }
  window.onload = fadeOut;

  .loader-container.fade-out{
    top:110%;
    opacity:0;
  }
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
