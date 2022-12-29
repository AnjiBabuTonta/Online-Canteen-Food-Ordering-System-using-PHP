<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        session_start(); 
        include("conn_db.php");
        if(!isset($_SESSION["cid"]) || !isset($_GET["orh"])){
            header("location: restricted.php");
            exit(1);
        }
        include('head.php');
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">

    <title>Successfully Order | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header.php')?>
    <div class="mt-5"></div>
    <div class="container form-signin text-center reg-success mt-auto">
            <i class="mt-4 bi bi-cart-check text-success h1 display-1"></i>
            <h4 class="mt-2 fw-normal text-bold">Your order has been verifying.</h4>
            
            <p class="mb-3 fw-normal text-bold text-wrap">We'll notify the shop in a few moments. <br/>You can check status in order history menu.</p>
            <a class="btn btn-outline-secondary btn-sm" href="index.php">Return to home</a>
            <a class="btn btn-success btn-sm" href="cust_order_history.php">Go to order history page</a>
    </div>
    <?php include('footer.php')?>
</body>

</html>