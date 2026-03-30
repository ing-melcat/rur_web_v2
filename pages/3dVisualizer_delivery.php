<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Unit of Robotics</title>
    <link rel="icon" type="image/png" href="../resources/RUR_logo_white.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #fff;
        }

        .model-container {
            height: 500px;
            width: 700px;
        }

        model-viewer {
            height: 100%;
            width: 100%;
        }
        .main-section{
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            background-color: #e4e0e011;
        }
        .btn-primary{
            background-color: #ecbf03;
            border-color: #ecbf03;
        }
        .btn-primary:hover{
            background-color: #0f1424;
            border-color: #0f1424;
        }
    </style>
</head>

<body class="p-5">
    <?php include 'components/nav-bar.php'; ?>
    <div class="main-section w-100 mt-1" style="font-family: 'Roboto';">
        <h1 class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto';">Research Unit of Robotics</h1>
    <h4>Introducing Delivery BOT v1</h4>
    <?php 
    
    $glbPath = '../resources/assets/DeliveryBotv1.glb';

    include 'components/3dVisualizer.php'; 
    
    ?>
    </div>

    <!--DELIVER-E information div -->
    <div class="card" style="font-family: 'Roboto';">
        <div class="card-header">
            DELIVER-E
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
            <p>Self driving robot that delivers snacks in the university</p>
            <p class="text-secondary">The robot is designed to be autonomous and to deliver snacks in the university, the client 
                can request a deliver through the mobile app, and enjoy their favorite snacks in their classroom, the robot will 
                carry them to the destination
            </p>
            </blockquote>
        </div>
    </div>

    <hr class="mb-5">

    <!-- Download app div-->
    <div style="font-family: 'Roboto'; background-color: #e4e0e011;" class="text-center div-download">
        <h1>Download our mobile App!</h1>
        <p class="text-secondary">If you want to test our robot and control it, download our apk and use it</p>
        <a href="/resources/RUR_logo_white.png" class="btn btn-primary mb-5" download>Download DELIVER-E App for Android</a>
        <hr>
    </div>

    <!--members list-->
    <?php 
        $page = "/pages/members.php";
        $section = "deliver-e";
        $link = $page . "#" . $section;
    include "components/members_for_project_page.php"; ?>

    <!-- Toast element -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <strong class="me-auto">DELIVER-E</strong>
        <small>Just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Download our mobile app and start using our robot! 
        <a href="/resources/RUR_logo_white.png" download>click here!</a>
        </div>
    </div>
    </div>

<!--<?php include 'components/page_on_build.php'; ?>-->

    <?php include 'components/footer.php'; ?>

<!--Toast Element script-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Wait 5 seconds
            setTimeout(function () {
            var toastEl = document.getElementById('myToast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
            }, 5000);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.2.0/model-viewer.min.js"></script>
</body>

</html>