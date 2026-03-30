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
        }
    </style>
</head>

<body class="p-5">
    <?php include 'components/nav-bar.php'; ?>
    <div class="main-section">
        <h1 class="text-dark text-center m-4 fw-bold" style="font-family: 'Roboto';">Research Unit of Robotics</h1>
    <h4>Introducing UMO AI</h4>
    <?php 
    
    $glbPath = '../resources/assets/BMO.glb';

    include 'components/3dVisualizer.php'; 
    
    ?>
    </div>

    <?php include 'components/page_on_build.php'; ?>

    <?php include 'components/footer.php'; ?>

    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.2.0/model-viewer.min.js"></script>
</body>

</html>