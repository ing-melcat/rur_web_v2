<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Research Unit of Robotics</title>
  <link rel="icon" type="image/png" href="../resources/RUR_logo_white.png">
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/product/">
  <link href="/style/product.css" rel="stylesheet">
  <link href="../styles/bootstrap.min.css" rel="stylesheet">
  <!-- GLightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<style>
    button.project-info{
  background-color: #ecbf03;
  color: #0f1424;
  cursor: pointer;
  width: 400px;
  height: 70px;
  justify-content: center;
  align-items: center;
}

button.project-info:hover{
  background-color: #0f1424;
  color: #ecbf03;
  cursor: pointer;
}

button.project-info a {
  display: block;
  text-decoration: none;
  text-align: center;
  color: #fff;
  font-weight: bold;
  font-family: 'Roboto';
}

button.project-info a:hover {
  display: block;
  text-decoration: none;
  text-align: center;
  color: #fff;
  font-weight: bold;
  font-family: 'Roboto';
}
</style>
</head>

<body class="p-5">
    <?php include 'components/nav-bar.php'; ?>

    <!-- Full Gallery Page -->

<h1 class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">Research Unit of Robotics Gallery</h1>
<div class="row g-3">
  <div class="col-6 col-md-4">
    <a href="/resources/rassor1.jpeg" class="glightbox" data-gallery="gallery1">
      <img src="/resources/rassor1.jpeg" class="img-fluid rounded shadow-sm" alt="Gallery Image 1">
    </a>
  </div>
  <div class="col-6 col-md-4">
    <a href="/resources/rur-members1.jpeg" class="glightbox" data-gallery="gallery1">
      <img src="/resources/rur-members1.jpeg" class="img-fluid rounded shadow-sm" alt="Gallery Image 2">
    </a>
  </div>
  <div class="col-6 col-md-4">
    <a href="/resources/rassor1.jpeg" class="glightbox" data-gallery="gallery1">
      <img src="/resources/rassor1.jpeg" class="img-fluid rounded shadow-sm" alt="Gallery Image 3">
    </a>
  </div>

  <div class="col-12 text-center mt-3">
    <button class="project-info"><a href="/index.php">Go home</a></button>
  </div>
    
</div>  



<?php include 'components/page_on_build.php'; ?>


  <!-- Last modified-->
  <?php include '../pages/components/last_modified.php'; ?>
  <!-- FOOTER -->
  <?php include 'components/footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- GLightbox JS -->
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const lightbox = GLightbox({
      selector: '.glightbox'
    });
  });
</script>

</body>
</html>