import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';


document.addEventListener('DOMContentLoaded', function() {
    if(document.querySelector('.slider')) {
        const opciones = {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 2
                }
            },
            freeMode: true
        }
       
        Swiper.use([Navigation]);
        new Swiper('.slider', opciones)
    }
});

