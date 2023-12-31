<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="cssStyles\header_page_style.css">
  <title>Dynamic Auto-Scroll Slider</title>
  <style>
    /* Add your styles here */
    .slider {
      position: relative;
      margin: auto;
      overflow: hidden;
    }

    .image-container {
      display: flex;
      transition: transform 2s ease-in-out; /* Adjust the transition duration here */
    }

    .slide {
      width: 100%;
    }
  </style>
</head>
<body>

<div class="slider" id="home">
  <div class="image-container">
    <?php
    $imageDirectory = "includes";
    $imageCount = 3; // Change this to the actual number of images

    for ($i = 1; $i <= $imageCount; $i++) {
      echo '<img src="' . $imageDirectory . '/headerImage' . $i . '.png" class="slide">';
    }
    ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Auto-scrolling function
    function nextSlide() {
      const container = document.querySelector('.image-container');
      const slides = document.querySelectorAll('.slide');
      const currentSlide = document.querySelector('.slide:first-child');

      container.style.transition = 'transform 2s ease-in-out'; // Adjust the transition duration here

      container.style.transform = `translateX(${-currentSlide.offsetWidth}px)`;

      setTimeout(() => {
        container.appendChild(currentSlide);
        container.style.transition = 'none';
        container.style.transform = 'translateX(0)';
      }, 2000); // Adjust the delay before resetting the transition and moving the slide back
    }

    // Call the nextSlide function every 5 seconds (adjust as needed)
    setInterval(nextSlide, 5000); // Adjust the interval duration here
  });
</script>

</body>
</html>
