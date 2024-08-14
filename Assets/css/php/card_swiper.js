

/*Main Swiper */
var swiper = new Swiper('.swiper-container', {
 
  loop: true,
  autoplay: {
      delay: 3000, 
      disableOnInteraction: false, 
  },
  slidesPerView: 3, 
  spaceBetween: -100, 
  effect: 'slide', 
  
  pagination: {
      el: '.swiper-pagination',
  },
  
  navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
  },
});


/*Second Swiper */

var swiper = new Swiper('.swiper-container1', {
 
 loop: true,
 autoplay: {
     delay: 5000, 
     disableOnInteraction: false, 
 },
 slidesPerView: 3, 
 spaceBetween: -100, 
 effect: 'slide', 

 pagination: {
     el: '.swiper-pagination1',
 },

 navigation: {
     nextEl: '.swiper-button-next1',
     prevEl: '.swiper-button-prev1',
 },
});




/*Nig click sa nav kung mo scroll para naay space sa taas  */

window.addEventListener('scroll', function() {
  var aboutSection = document.getElementById('about');
  var navHeight = document.querySelector('nav').offsetHeight;
  if (window.scrollY >= aboutSection.offsetTop - navHeight) {
     
      document.body.style.marginTop = aboutSection.offsetHeight + '-100px';
  } else {
      
      document.body.style.marginTop = '0px';
  }
});


document.addEventListener("DOMContentLoaded", function() {
  var aboutLink = document.querySelector('a[href="#about"]');
  var aboutSection = document.getElementById('about');
  var navHeight = document.querySelector('header').offsetHeight; 
  var margin = 40;

  aboutLink.addEventListener('click', function(event) {
      event.preventDefault(); 
      var aboutOffset = aboutSection.offsetTop - navHeight - margin; 
      window.scrollTo({
          top: aboutOffset,
          behavior: 'smooth' 
      });
  });
});
document.addEventListener("DOMContentLoaded", function() {
  var aboutLink = document.querySelector('a[href="#section3"]');
  var aboutSection = document.getElementById('section3');
  var navHeight = document.querySelector('header').offsetHeight; 
  var margin = 40;

  aboutLink.addEventListener('click', function(event) {
      event.preventDefault(); 
      var aboutOffset = aboutSection.offsetTop - navHeight - margin; 
      window.scrollTo({
          top: aboutOffset,
          behavior: 'smooth' 
      });
  });
});
