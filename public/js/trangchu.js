
var swiper = new Swiper(".flash-sale-swiper", {
    loop: true, // Vòng lặp vô hạn
    autoplay: {
        delay: 3000, // Tự động chuyển sau 3 giây
        disableOnInteraction: false
    },
    slidesPerView: 4, // Hiển thị 4 sản phẩm trên 1 lần
    spaceBetween: 10, // Khoảng cách giữa các slide
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    }
});


var swiper = new Swiper(".swiper-container", {
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
    },
    slidesPerView: 1,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    }
});

