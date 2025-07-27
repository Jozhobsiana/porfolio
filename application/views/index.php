<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $home['title'] ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: MyPackaging
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-my-packaging/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex flex-column justify-content-center">

    <i class="header-toggle d-xl-none bi bi-list"></i>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i><span>Home</span></a></li>
        <li><a href="#about"><i class="bi bi-person navicon"></i><span>About</span></a></li>
        <li><a href="#social-media"><i class="bi bi-person-circle navicon"></i><span>Social Media</span></a></li>
        <li><a href="#video"><i class="bi bi-images navicon"></i><span>Video Highlights</span></a></li>
        <li><a href="#packaging"><i class="bi bi-box-seam-fill navicon"></i><span>Packaging Design</span></a></li>
        <li><a href="#module-design"><i class="bi bi-image-fill navicon"></i><span>Module Design</span></a></li>
        <li><a href="#ecommerce-content"><i class="bi bi-bag navicon"></i><span>Ecommerce Content</span></a></li>
        <li><a href="#tarpaulin"><i class="bi bi-view-list navicon"></i><span>Tarpaulin</span></a></li>
      </ul>
    </nav>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="<?= base_url('assets/uploads/' . $home['background']) ?>" alt="">

      <div class="container" data-aos="zoom-out">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <h2><?= $home['title'] ?></h2>
            <p><?= $home['content'] ?></p>
            <!-- <div class="social-links">
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
            </div> -->
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Me</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            <img src="<?= base_url('assets/uploads/' . $about_me['background']) ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 content">
            <?= $about_me['content'] ?>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

<!-- Social Media Section -->
<section id="social-media" class="social-media section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Social Media</h2>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row d-flex flex-wrap justify-content-center">

     <?php if (!empty($social_media)): ?>
        <?php foreach ($social_media as $item): ?>
          <div class="col-lg-4 col-md-6 portfolio-item">
            <a href="<?= base_url('assets/uploads/' . $item['filename']) ?>" 
               class="glightbox" data-gallery="portfolio-gallery">
              <img src="<?= base_url('assets/uploads/' . $item['filename']) ?>" class="img-fluid" alt="">
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No Social Media found.</p>
      <?php endif; ?>

    </div>
  </div>
</section>


<!-- Video Highlights Section -->
<section id="video" class="video section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Video Highlights</h2>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4 justify-content-center">
      <?php if (!empty($video_highlights)): ?>
        <?php foreach ($video_highlights as $video): ?>
          <div class="col-md-6 col-lg-4 d-flex justify-content-center">
            <video controls preload="metadata" style="width: 100%; max-height: 250px; object-fit: cover;">
              <source src="<?= base_url('assets/uploads/videos/' . $video['filename']) ?>" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No video highlights available.</p>
      <?php endif; ?>
    </div>
  </div>
</section><!-- /Video Highlights Section -->


<!-- Packaging Section -->
<section id="packaging" class="packaging section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Packaging Design</h2>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row" data-aos="fade-up" data-aos-delay="100">

     <?php if (!empty($packaging_design)): ?>
        <?php foreach ($packaging_design as $item): ?>
          <div class="col-lg-4 col-md-6 portfolio-item">
            <a href="<?= base_url('assets/uploads/' . $item['filename']) ?>" 
               class="glightbox" data-gallery="portfolio-gallery">
              <img src="<?= base_url('assets/uploads/' . $item['filename']) ?>" class="img-fluid" alt="">
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No Packaging Design items found.</p>
      <?php endif; ?>


    </div>
  </div>
</section><!-- /Packaging Section -->


<!-- Module Design Section -->
<section id="module-design" class="module-design section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Module Design</h2>
  </div><!-- End Section Title -->
  <div class="container">
    <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
     <?php if (!empty($module_design)): ?>
        <?php foreach ($module_design as $item): ?>
          <div class="col-lg-4 col-md-6 portfolio-item">
            <a href="<?= base_url('assets/uploads/' . $item['filename']) ?>" 
               class="glightbox" data-gallery="portfolio-gallery">
              <img src="<?= base_url('assets/uploads/' . $item['filename']) ?>" class="img-fluid" alt="">
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No Module Design items found.</p>
      <?php endif; ?>
    </div>
  </div>
</section><!-- /Module Design Section -->

<!-- E-Commerce Content Section -->
<section id="ecommerce-content" class="ecommerce-content section">
  <div class="container section-title" data-aos="fade-up">
    <h2 >E-Commerce Content</h2>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="d-flex overflow-auto gap-4 pb-3" style="scroll-snap-type: x mandatory;">
      <?php if (!empty($ecommerce)): ?>
        <?php foreach ($ecommerce as $item): ?>
          <div class="flex-shrink-0" 
               style="width: 300px; height: 200px; scroll-snap-align: start; border-radius: 12px; overflow: hidden; background: #f5f5f5;">
            <img src="<?= base_url('assets/uploads/' . $item['filename']) ?>" 
                 alt="" 
                 class="img-fluid w-100 h-100 glightbox" 
                 style="object-fit: cover;">
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No e-commerce content found.</p>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- E-Tarpaulin Section -->
<section id="tarpaulin" class="tarpaulin section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Tarpaulin</h2>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="d-flex overflow-auto gap-4 pb-3" style="scroll-snap-type: x mandatory;">
      <?php if (!empty($tarpaulin)): ?>
        <?php foreach ($tarpaulin as $item): ?>
          <div class="flex-shrink-0" 
               style="width: 300px; height: 200px; scroll-snap-align: start; border-radius: 12px; overflow: hidden; background: #f5f5f5;">
            <img src="<?= base_url('assets/uploads/' . $item['filename']) ?>" 
                 alt="" 
                 class="img-fluid w-100 h-100 glightbox" 
                 style="object-fit: cover;">
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No Tarpaulin content found.</p>
      <?php endif; ?>
    </div>
  </div>
</section>
  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container">
      <h3 class="sitename"><?= $home['title'] ?></h3>
      <div class="container">
        <div class="copyright">
          <span>Copyright</span> <strong class="px-1 sitename">Alex Smith</strong> <span>All Rights Reserved</span>
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you've purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distribuited by <a href="https://themewagon.com">ThemeWagon</a>
         <br>
          Redesign by Dan Lloyd Cortel</a>

        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>