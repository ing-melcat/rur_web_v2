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
  <link href="styles/bootstrap.min.css" rel="stylesheet">

  <style>
.fixed-img {
  width: 60%;
  aspect-ratio: 16 / 9;  /* keeps consistent shape */
  object-fit: cover;
}
.fixed-img2 {
  width: 40%;
  aspect-ratio: 16 / 9;  /* keeps consistent shape */
  object-fit: cover;
}
.bg-darker {
  background-color: #0a0a0a !important; /* darker than Bootstrap's bg-dark */
}
.bg-dark-medium{
    background-color: #191616 !important; /* darker than Bootstrap's bg-dark */
}
.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
.card-body .card-text { margin-bottom: 0.25rem; /* reduce space */ }

.card{
  width: 22rem;
}

.card-img-top {
  width: 100%;        
  height: 270px;      
  object-fit: cover;  
}

#backToTopBtn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 99;
      background-color: #ecbf03;
      color: #0f1424;
      border: none;
      border-radius: 50%;
      padding: 15px;
      cursor: pointer;
      font-size: 18px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.2);
      display: none;
      transition: opacity 0.3s;
    }
    #backToTopBtn:hover {
      background-color: #0f1424;
      color: #ecbf03;
    }

    /* Change text color of nav links */
  .navbar-nav .nav-link {
    color: #0f1424;   /* Black text */
  }

  /* Optional: change color on hover */
  .navbar-nav .nav-link:hover {
    color: #fff;   
  }

  #rassor-team{
    color: #ecbf03;
  }

  /* General button styling */
.filter-btn {
  background-color: #0f1424;   
  color: #fff;                               
  font-weight: 100;            
  padding: 8px 16px;           
  margin: 0 5px;               
  border-radius: 2px;         
}

/* Hover effect */
.filter-btn:hover {
  background-color: #ecbf03;   /* dark gray on hover */
  color: #fff;                 /* white text */
}

/* Active filter highlight */
.filter-btn.active-filter {
  background-color: #ecbf03;     
  color: #fff;                 
}
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

.button-div{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 30vh;
}

</style>
</head>

<body class="p-5">
    <!--NavBar section -->
    <?php include 'components/nav-bar.php'; ?>
    <!--NavBar section -->

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ecbf03;">
  <div class="container">
    <a class="navbar-brand fw-bold" style="font-family: 'Roboto';">CATEGORIES</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <!-- Section links -->
        <li class="nav-item" data-status="active"><a class="nav-link fw-semibold" href="#founders">RUR FOUNDERS</a></li>
        <li class="nav-item" data-status="active"><a class="nav-link fw-semibold" href="#unipolito">UNIPOLITO</a></li>
        <li class="nav-item" data-status="active"><a class="nav-link fw-semibold" href="#deliver-e">DELIVER-E</a></li>
        <li class="nav-item" data-status="active"><a class="nav-link fw-semibold" href="#umo">UMO AI</a></li>
        <li class="nav-item" data-status="active"><a class="nav-link fw-semibold" href="#lumobox">LUMOBOX</a></li>
        <li class="nav-item" data-status="active"><a class="nav-link fw-semibold" href="#rassor">ROVER RASSOR</a></li>
        <li class="nav-item" data-status="active"><a class="nav-link fw-semibold" href="#line-fo">LINE FOLLOWER</a></li>
        <li class="nav-item" data-status="finalized"><a class="nav-link fw-semibold" href="#page">WEB PAGE</a></li>

        <!-- Filter controls -->
        <li class="nav-item d-flex align-items-center ms-3">
          <button class="filter-btn me-2" onclick="filterMenu('active', this)">Active</button>
          <button class="filter-btn" onclick="filterMenu('finalized', this)">Finalized</button>
          <button class="filter-btn ms-2" onclick="filterMenu('all', this)">All</button>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Floating Back to Top Button -->
  <button id="backToTopBtn" title="Go to top">TOP ↑</button>

<!--Sections start here-->
<h1 class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">RESEARCH UNIT OF ROBOTICS MEMBERS</h1>

<h5 class="text-secondary text-center m-a" style="font-family: 'Roboto'">The Research Unit of Robotics is an organization 
  dedicated to the development of robotics and AI products, focusing on delivering high quality solutions and innovations to 
  face real-world scenarios. 
</h5>

<h5 class="text-secondary text-center m-a" style="font-family: 'Roboto'"> In this page are included all the RUR members with finalized and active projects, each of them include their fields</h5>

<hr class="my-4">
<h1 id="founders" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">FOUNDERS</h1>
<!-- Founders cards section -->
<div class="container mb-3">
  <div class="row justify-content-center">

    <?php
    $name = "Sergio Cruz";
    $img = "../resources/founders/sergio.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Teaching"],
        ["class" => "bg-primary", "text" => "Leadership"],
        ["class" => "bg-success", "text" => "Innovator"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
?>


    <?php
        $name = "Guillermo Rios";
        $img = "../resources/founders/guillermo.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-danger", "text" => "Software"],
            ["class" => "bg-primary", "text" => "Hardware"],
            ["class" => "bg-success", "text" => "WebRTC"]
        ];
        include 'components/card-template.php';
    ?>

    <?php
        $name = "Carlos Rios";
        $img = "../resources/founders/carlos.jpg";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-danger", "text" => "ROS2"],
            ["class" => "bg-primary", "text" => "AI"],
            ["class" => "bg-success", "text" => "Team Lead"]
        ];
        include 'components/card-template.php';
    ?>

    <?php
        $name = "Jazmin";
        $img = "../resources/founders/jazmin.jpg";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-warning", "text" => "Social Networks"],
            ["class" => "bg-primary", "text" => "Digital Design"],
            ["class" => "bg-success", "text" => "Branding"]
        ];
        include 'components/card-template.php';
    ?>

  </div>
</div>
<!-- Founders cards section -->

<hr class="my-4">

<h1 id="unipolito" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">UNIPOLITO TEAM</h1>
<!-- UNIPOLITO cards section -->
<div class="container mb-3 project" data-status="active">
  <div class="row justify-content-center">

    <?php
        $name = "Mariana Alondra";
        $img = "../resources/unknown.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-secondary", "text" => "Project Manager"],
            ["class" => "bg-primary", "text" => "Trello"],
            ["class" => "bg-success", "text" => "Team Lead"]
        ];
        include 'components/card-template.php';
    ?>

    <?php
        $name = "Valeria Carmona";
        $img = "../resources/unknown.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-secondary", "text" => "Hardware"],
            ["class" => "bg-primary", "text" => "Raspberry Pi"],
            ["class" => "bg-success", "text" => "Team Lead"]
        ];
        include 'components/card-template.php';
    ?>

    <?php
        $name = "Frida Olague";
        $img = "../resources/unknown.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-secondary", "text" => "Software"],
            ["class" => "bg-primary", "text" => "DataBases"],
            ["class" => "bg-success", "text" => "Digital Platforms"]
        ];
        include 'components/card-template.php';
    ?>

    <?php
        $name = "Guillermo Rios";
        $img = "../resources/founders/guillermo.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-danger", "text" => "Software"],
            ["class" => "bg-primary", "text" => "Hardware"],
            ["class" => "bg-success", "text" => "WebRTC"]
        ];
        include 'components/card-template.php';
    ?>

    <?php
        $name = "Carlos Rios";
        $img = "../resources/founders/carlos.jpg";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-danger", "text" => "ROS2"],
            ["class" => "bg-primary", "text" => "AI"],
            ["class" => "bg-success", "text" => "Team Lead"]
        ];
        include 'components/card-template.php';
    ?>

  </div>
  <div class="button-div">
    <button class="project-info"><a href="/pages/3dVisualizer_unipolitov4.php">Discover more about this project</a></button>
  </div>
  
</div>
<!-- UNIPOLITO cards section -->

<hr class="my-4">

<h1 id="deliver-e" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">DELIVER-E TEAM</h1>
<!-- DELIVER-E cards section -->
<div class="container mb-3">
  <div class="row justify-content-center">

  <?php
    $name = "Jonathan Fraga";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Hardware"],
        ["class" => "bg-primary", "text" => "Mechanics"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

   <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

   <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

   <?php
    $name = "Karolina";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

   <?php
    $name = "Joel";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "Mobile Apps"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

   <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

   <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

   <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>


  </div>
   <div class="button-div">
    <button class="project-info"><a href="/pages/3dVisualizer_delivery.php">Discover more about this project</a></button>
  </div>
</div>
<!-- DELIVER-E cards section -->

<hr class="my-4">

<h1 id="umo" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">UMO AI TEAM</h1>
<!-- UMO cards section -->
<div class="container mb-3">
  <div class="row justify-content-center">

  <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

  </div>
  <div class="button-div">
    <button class="project-info"><a href="/pages/3dVisualizer_UMO.php">Discover more about this project</a></button>
  </div>
</div>
<!-- UMO cards section -->

<hr class="my-4">

<h1 id="lumobox" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">LUMOBOX TEAM</h1>
<!-- LUMOBOX cards section -->
<div class="container mb-3">
  <div class="row justify-content-center">

    <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

  <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

  <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

  <?php
    $name = "Sergio Cruz";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>
  
  </div>
  <div class="button-div">
    <button class="project-info"><a href="/pages/3dVisualizer_lumobox.php">Discover more about this project</a></button>
  </div>
</div>
<!-- LUMOBOX cards section -->

<hr class="my-4">

<h1 id="rassor" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">ROVER RASSOR</h1>
<h1 id="rassor-team" class=" text-center m-4 fw-bold" style="font-family: 'Roboto'">RASSOR TEAM TRINITY</h1>
<!-- RASSOR cards section -->
<div class="container mb-3">
  <div class="row justify-content-center">

  <?php
        $name = "Jazmin";
        $img = "../resources/unknown.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-secondary", "text" => "Software"],
            ["class" => "bg-primary", "text" => "AI"],
            ["class" => "bg-success", "text" => "Team Lead"]
        ];
        include 'components/card-template.php';
    ?>

    <hr class="my-4">

    <h1 id="rassor-team" class=" text-center m-4 fw-bold" style="font-family: 'Roboto'">RASSOR TEAM FAT BOY</h1>

    <div class="container mb-3">
  <div class="row justify-content-center">

   <?php
        $name = "Jazmin";
        $img = "../resources/unknown.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-secondary", "text" => "Software"],
            ["class" => "bg-primary", "text" => "AI"],
            ["class" => "bg-success", "text" => "Team Lead"]
        ];
        include 'components/card-template.php';
    ?>
  
  </div>

  <div class="button-div">
    <button class="project-info"><a href="/pages/projects/rover_rassor.php">Discover more about this project</a></button>
  </div>

</div>
<!-- RASSOR cards section -->

<hr class="my-4">

<h1 id="line-fo" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">LINE FOLLOWER TEAM</h1>
<!-- LINE FOLLOWER cards section -->
<div class="container mb-3">
  <div class="row justify-content-center">

    <?php
        $name = "Jazmin";
        $img = "../resources/unknown.png";
        $description = "Some quick example text...";
        $link = "#";
        $badges = [
            ["class" => "bg-secondary", "text" => "Software"],
            ["class" => "bg-primary", "text" => "AI"],
            ["class" => "bg-success", "text" => "Team Lead"]
        ];
        include 'components/card-template.php';
    ?>

  </div>

  <div class="button-div">
    <button class="project-info"><a href="/pages/3dVisualizer_unipolitov4.php">Discover more about this project</a></button>
  </div>
</div>
<!-- LINE FOLLOWER cards section -->

<hr class="my-4">

<h1 id="page" class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto'">WEB PAGE TEAM</h1>
<!-- WEB PAGE cards section -->
<div class="container mb-3">
  <div class="row justify-content-center">

    <?php
    $name = "Carlos Omar Najera Arredondo";
    $img = "../resources/unknown.png";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "Web development"],
        ["class" => "bg-success", "text" => "Fullstack"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>

  <?php
    $name = "Carlos Manuel Rios Ruiz";
    $img = "../resources/founders/carlos.jpg";
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris";
    $link = "#";
    $badges = [
        ["class" => "bg-secondary", "text" => "Software"],
        ["class" => "bg-primary", "text" => "AI"],
        ["class" => "bg-success", "text" => "Team Lead"]
    ];

    // New fields
    $linkedin = "https://youtu.be/dQw4w9WgXcQ?si=D2zb6AcPb1q2VL5c";
    $github   = "https://docs.ros.org/en/rolling/Releases/Release-Jazzy-Jalisco.html";
    $contact  = "mailto:sergio@example.com";

    include 'components/card-template.php';
  ?>
  
  </div>
</div>
<!-- WEB PAGE cards section -->

  <!-- Last modified-->
  <?php include '../pages/components/last_modified.php'; ?>
  <!-- FOOTER -->
  <?php include 'components/footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  window.onscroll = function() {
    const btn = document.getElementById("backToTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  };

  document.getElementById("backToTopBtn").onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };
</script>

<script>
function filterMenu(status, btn) {
  const items = document.querySelectorAll('.navbar-nav .nav-item[data-status]');
  items.forEach(item => {
    if (status === 'all' || item.dataset.status === status) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });

  // Highlight the active filter button
  document.querySelectorAll('.filter-btn').forEach(button => {
    button.classList.remove('active-filter');
  });
  btn.classList.add('active-filter');
}
</script>


</body>

</body>
</html>