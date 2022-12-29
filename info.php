<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">
    <style>
        html {
            height: 100%;
        }
    </style>

    <title>Info</title>
</head>

<body class="d-flex flex-column h-100">
    <header class="navbar navbar-expand-md navbar-light fixed-top bg-light shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
                <img src="../img/Color logo - no background.png" width="125" class="me-2" alt="EATERIO Logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <div class="d-flex text-end"></div>
            </div>
        </div>
    </header>
    <div class="mt-5"></div>
    <div class="container form-signin text-center restricted mt-auto">
            <i style="color:red;" class="mt-4 bi bi-telephone  h6 display-2"><br></i>
            <h3>know about us...</h3>
            <h2>FOOD CAVE</h2>
            <a class="btn btn-danger btn-sm w-50" href="index.php">Home</a>
    </div>



    <?php include('footer.php')?>
</body>


</html>
