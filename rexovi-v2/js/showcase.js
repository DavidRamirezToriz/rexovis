new Swiper('.showcase-swiper',{

    slidesPerView:3,

    spaceBetween:24,

    loop:true,

    speed:800,

    grabCursor:true,

    autoplay:{
        delay:3500,
        disableOnInteraction:false,
        pauseOnMouseEnter:true
    },

    breakpoints:{

        320:{
            slidesPerView:1.15
        },

        768:{
            slidesPerView:2
        },

        1200:{
            slidesPerView:3
        }

    }

});