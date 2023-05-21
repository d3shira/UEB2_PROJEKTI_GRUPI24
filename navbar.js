let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');



document.querySelector('#search-icon').onclick=()=>{
    document.querySelector('#search-form').classList.toggle('active');
}
document.querySelector('#close').onclick=()=>{
    document.querySelector('#search-form').classList.remove('active');
}




