<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rover RASSOR - documentation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      font-family: 'Roboto';
    }
    .sidebar {
      height: 100vh;
      position: sticky;
      top: 0;
      padding-top: 1rem;
      border-right: 1px solid #ddd;
      background-color: #ecbf03;
      color: #0f1424;
    }
    .content {
      padding: 2rem;
    }
    .nav-item a{
        font-family: 'Roboto';
        color: #fff;
    }
    .nav-item a:hover{
         font-family: 'Roboto';
        color: #0f1424;
    }
    .bottom-menu{
        background-color: #0f1424;
        color: #fff;
    }
    .grid-img {
    width: 100%;          
    height: 200px;        
    aspect-ratio: 1 / 1;
  }
  </style>
</head>
<body>
  <?php include '../components/nav-bar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 sidebar text-center">
        <div class="p-3 bottom-menu">
            <img src="../../resources/RUR_logo_white.png" 
                alt="Logo" 
                class="img-fluid mb-3" 
                style="max-width:120px;">
            <h5 class="fw-bold">ROVER RASSOR</h5>
            <h5 class="fw-bold">Documentation</h5>
        </div>
        <hr>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#intro">Introduction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#quickstart">QuickStart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#3dprinting">3D printing</a>
          </li>
          <li class="nav-item">
            <li class="nav-item">
            <a class="nav-link active" href="#webrtc">Web RTC</a>
          </li>
          <li class="nav-item">
        <li class="nav-item">
    <!-- Toggle link -->
    <a class="nav-link" data-bs-toggle="collapse" href="#setupSubmenu" role="button" aria-expanded="false" aria-controls="setupSubmenu">
      ROS2 +
    </a>

    <!-- Collapsible content -->
    <div class="collapse" id="setupSubmenu">
      <ul class="nav flex-column ms-3">
        <li class="nav-item">
          <a class="nav-link" href="#install">Installation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#config">Configuration</a>
        </li>
      </ul>
        </div>
    </li>
          <li class="nav-item">
            <a class="nav-link" href="#usage">Usage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#api">API Reference</a>
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 col-lg-10 content">
        <h1 class="fw-bold text-center mb-4">Research Unit of Robotics</h1>
          <?php include '../components/last_modified.php'; ?>
        <hr>
        <h4 id="intro">ROVER RASSOR Documentation</h4>
        <p>Welcome to the documentation. Use the menu on the left to navigate through sections. <b>The following documentation corresponds 
            to the beta phase of the project.</b> This project is being developed by the <b>Research Unit of Robotics (RUR)</b>
            in collaboration with the <b>University of Central Florida (UCF)</b> for the <b>Florida Space Institute (FSI)</b>
        </p>

        <div class="container">
          <div class="row">
            <div class="col-md-6 mb-3">
              <img src="/resources/ucf.png" alt="Image 1" class="grid-img">
            </div>
            <div class="col-md-6 mb-3">
              <img src="/resources/fsi.png" alt="Image 2" class="grid-img">
            </div>
            <div class="col-md-6 mb-3">
              <img src="/resources/RUR_logo_white.png" alt="Image 3" class="grid-img">
            </div>
            <div class="col-md-6 mb-3">
              <img src="/resources/unipoli.png" alt="Image 4" class="grid-img">
            </div>
          </div>
        </div>


        <section id="quickstart">
          <h5>Quick Start</h5>
          <p>Instructions on how to install and configure...</p>
        </section>

        <section id="3dprinting">
          <h5>3D printing</h5>
          <p>Examples and workflows...</p>
        </section>

        <section id="webrtc">
          <h5>WEB RTC</h5>
          <p>Examples and workflows...</p>
        </section>

        <section id="usage">
          <h5>Usage</h5>
          <p>Examples and workflows...</p>
        </section>

        <section id="api">
          <h5>API Reference</h5>
          <p>Details of available functions...</p>
        </section>
      </main>
    </div>
  </div>

  <?php include '../components/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
