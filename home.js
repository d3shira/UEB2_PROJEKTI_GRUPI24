
let section = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header .navbar a');

window.onscroll = () =>{
  section.forEach(sec =>{

    let top = window.scrollY;
    let height = sec.offsetHeight;
    let offset = sec.offsetTop -150;
    let id = sec.getAttribute('id');

    if(top => offset && top < offset + height){
      navLinks.forEach(links =>{
        links.classList.remove('active');
        document.querySelector('header .navbar a[href*='+id+']).classList.add('active);
      });
    };
  });
}

var swiper = new Swiper(". home-slider", {
    spaceBetween: 20,
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

<<<<<<< HEAD








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
=======
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
>>>>>>> 447f1cf1ea399eed34722d9c5f173b0b87595c05
