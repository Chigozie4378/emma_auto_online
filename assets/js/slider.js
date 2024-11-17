document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.querySelector('#imageCarousel');
    const bsCarousel = new bootstrap.Carousel(carousel, {
        interval: 2000, // Speed of transition between slides
        wrap: true
    });

    // Listen for slide events to move one image at a time.
    carousel.addEventListener('slide.bs.carousel', function (event) {
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;

        items.forEach((item, index) => {
            item.classList.remove('active');
            if (index === (event.to % totalItems)) {
                item.classList.add('active');
            }
        });
    });
});