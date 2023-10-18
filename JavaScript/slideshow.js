document.addEventListener('DOMContentLoaded', function () {
    // Get the container for the slideshow
    const slideshowContainer = document.querySelector('.slideshow-container');

    // Retrieve the recipes from local storage
    const recetas = JSON.parse(localStorage.getItem('recipes')) || [];

    // Loop through the recipes and create slides with images
    recetas.forEach(function (receta) {
        // Create a slide container
        const slide = document.createElement('div');
        slide.classList.add('mySlides');

        // Create an image element
        const image = document.createElement('img');
        image.src = receta.imagen; // Set the image source from the recipe object

        // Append the image to the slide
        slide.appendChild(image);

        // Append the slide to the slideshow container
        slideshowContainer.appendChild(slide);
    });

    // Function to handle slideshow
    function showSlidesLoop() {
        const slides = document.querySelectorAll('.mySlides');
        let slideIndex = 0;

        function displaySlide(index) {
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
            }
            slides[index].style.display = 'block';
        }

        function nextSlide() {
            displaySlide(slideIndex);
            slideIndex = (slideIndex + 1) % slides.length;
            setTimeout(nextSlide, 4000); // Change image every 4 seconds
        }

        // Start the slideshow
        nextSlide();
    }

    showSlidesLoop(); // Start the slideshow loop
});
