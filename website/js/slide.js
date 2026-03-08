$('#team').owlCarousel({
  loop: true,
  margin: 20,
  nav: false,
  dots: false,
  autoplay: true,
  autoplayTimeout: 2500,
  responsive: {
    0: { items: 1 },         
    768: { items: 2 },       
    992: { items: 3 },     
    1200: { items: 3 }      
  }
});

 
    $('#logo-item').owlCarousel({
      loop: true,
      autoplay: true,
      autoplaySpeed: 5000,     
      autoplayHoverPause: true,
      margin: 40,
      dots: false,
      nav: false,
      slideTransition: 'linear',
      responsive: {
        0: { items: 2 },
        576: { items: 3 },
        768: { items: 4 },
        992: { items: 5 },
        1200: { items: 5}
      }
    });

$('#service').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    autoHeight: false,
    autoplay: true,
    autoplaytimeout:1000,
    dots:false,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:true
        }
    }
})

