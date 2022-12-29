<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    session_start();
    if(!isset($_SESSION["cid"])){
        header("location: restricted.php");
        exit(1);
    }
    include("conn_db.php");
    include('head.php');
    $no_order = false;
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <title>My Cart | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">

    <?php include('nav_header.php')?>

    <div class="container px-5 py-4" id="cart-body">
        <div class="row my-4">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>

            <?php 
            if(isset($_GET["up_crt"])){
                if($_GET["up_crt"]==1){
                    ?>
            <!-- START SUCCESSFULLY UPDATE CART -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully updated your item!</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_cart.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY UPDATE CART -->
            <?php }else{ ?>
            <!-- START FAILED UPDATE CART -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to update your item.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_cart.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED UPDATE CART -->
            <?php } 
                } 
            if(isset($_GET["rmv_crt"])){
                if($_GET["rmv_crt"]==1){
                    ?>
            <!-- START SUCCESSFULLY DELETE ITEM FROM CART -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully remove your item!</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_cart.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY DELETE ITEM FROM CART -->
            <?php }else{ ?>
            <!-- START FAILED DELETE ITEM FROM CART -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to remove your item.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_cart.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED DELETE ITEM FROM CART -->
            <?php } 
                }  ?>

            <h2 class="py-3 display-6 border-bottom">
                <i class="bi bi-cart"></i> My Cart
            </h2>
        </div>

        <?php 
            $ct_query = "SELECT * FROM cart WHERE c_id = {$_SESSION['cid']}";
            $cart_numrow = $mysqli -> query($ct_query) -> num_rows;
            if($cart_numrow > 0){
        ?>
        <!-- CASE: HAVE ITEM(S) IN THE CART -->
        <div class="row row-cols-1 row-cols-md-2 mb-5">
            <div class="col">
                <div class="row row-cols-1">
                    <div class="col">
                        <h5 class="fw-light">My Order</h5>
                        <p class="fw-light">From
                            <?php 
                                $cart_query = "SELECT s_id,s_name FROM shop s WHERE s_id = (SELECT s_id FROM cart WHERE c_id = {$_SESSION['cid']} LIMIT 0,1)";
                                $cart_result = $mysqli -> query($cart_query) -> fetch_array();
                                echo $cart_result["s_name"];
                                
                                
                            ?>
                        </p>
                    </div>

                    

                    <div class="col">
                        <ul class="list-group">
                            <!-- START CART ITEM -->
                            <?php
                                $cartdetail_query = "SELECT ct.ct_amount,ct.f_id,f_pic,f.f_name,f.f_price,ct.ct_note
                                FROM cart ct INNER JOIN food f ON ct.f_id = f.f_id WHERE ct.c_id = {$_SESSION['cid']}";
                                $cartdetail_result = $mysqli -> query($cartdetail_query);
                                while($row = $cartdetail_result -> fetch_array()){
                            ?>
                            <li
                                class="list-group-item d-flex border-0 pb-3 border-bottom w-100 justify-content-between align-items-center">
                                <div class="image-parent">
                                    <img <?php
                                        if(is_null($row["f_pic"])){echo "src='img/default.png'";}
                                        else{echo "src=\"img/{$row['f_pic']}\"";}
                                    ?> class="img-fluid rounded" style="width: 100px; height:100px; object-fit:cover;"
                                        alt="f_pic">
                                </div>
                                <div class="ms-3 mt-3 me-auto">
                                    <div class="fw-normal"><span class="h5"><?php echo $row["ct_amount"]?>x</span>
                                        <?php echo $row["f_name"]?>
                                        <p><?php printf("%.2f INR <small class='text-muted'>(%.2f INR each)</small>",$row["f_price"]*$row["ct_amount"],$row["f_price"])?><br />
                                            <span class="text-muted small"> <?php echo $row["ct_note"]?></span>
                                            
                                        </p>
                                        <?php
                                        $rmv = false;
                                        $rmv_link = false;
                                        if($rmv_link){?>
                                        <a href="remove_cart_item.php?rmv=1&s_id=<?php echo $cart_result["s_id"];?>&f_id=<?php echo $row["f_id"];?>"
                                            class="text-decoration-none text-danger nav nav-item small">Remove item</a>
                                        <?php }else {?>
                                        <a href="cust_update_cart.php?s_id=<?php echo $cart_result["s_id"];?>&f_id=<?php echo $row["f_id"];?>"
                                            class="text-decoration-none text-success nav nav-item small">Edit item</a>
                                        <?php } ?>
                                    </div>
                            </li>
                            <!-- END CART ITEM -->
                            <?php } ?>
                        </ul>
                        <div class="col my-3">
                            <ul class="list-inline justify-content-between">
                                <li class="list-item mb-2">
                                    <a href="remove_cart_all.php?rmv=1&s_id=<?php echo $cart_result["s_id"];?>"
                                        class="nav nav-item text-danger text-decoration-none small" name="rmv_all" id="rmv_all">
                                        Remove all item in cart
                                    </a>
                                </li>
                                <li class="list-inline-item fw-normal h5 me-5">Grand Total</li>
                                <li class="list-inline-item fw-bold h4">
                                    <?php
                                        
                                        $gt_query = "SELECT SUM(ct.ct_amount*f.f_price) AS grandtotal FROM cart ct INNER JOIN food f 
                                        ON ct.f_id = f.f_id WHERE ct.c_id = {$_SESSION['cid']} GROUP BY ct.c_id";
                                        $gt_arr = $mysqli -> query($gt_query) -> fetch_array();
                                        $order_cost = $gt_arr["grandtotal"];
                                        printf("%.2f INR",$order_cost);
                                        if($order_cost<20){
                                            $min_cost = false;  $no_order=true;
                                        }else{
                                            $min_cost = true;
                                        }
                                    ?>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mt-3 mt-md-0">
                <div class="row row-cols-1">
                    <div class="col mb-3">
                        <div class="card p-2 p-md-4 border-0 border-bottom">
                            <h5 class="card-title fw-light">My Information</h5>
                            <ul class="card-text list-unstyled m-0 p-0 small">
                                <?php 
                                    $cust_query = "SELECT c_email FROM customer WHERE c_id = {$_SESSION['cid']} LIMIT 0,1";
                                    $cust_arr = $mysqli -> query($cust_query) -> fetch_array();
                                ?>
                                <li>Name: <?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"]; ?></li>
                                <li>Email: <?php echo $cust_arr["c_email"]?> </li>
                            </ul>
                        </div>
                    </div>
                    
                    
                            <?php if($no_order){ ?>
                            <button type="submit" class="w-100 btn btn-danger disabled" name="place_order" id="place_order"
                                disabled>
                                <?php
                                    if(!$min_cost){
                                        echo "Your order is less than minimum amount.";
                                    }else{
                                        echo "Cannot proceed with payment";
                                    }
                                ?>
                            </button>
                            <?php }else{ ?>
                                
                                <a href="payment.php" class="  mt-2 ms-2 p-2 bg-primary text-white text-center rounded  border-0 text-decoration-none link-light">
                                <i class="bi bi-qr-code-scan"></i><span class="ms-2 mt-2 me-5"> Proceed with Payment</span>
                            </a>
                                
                            <?php } ?>
                        
                </div>
            </div>
        </div>
        <!-- END CASE: HAVE ITEM(S) IN THE CART -->
        <?php }else{ ?>
        <!-- CASE: NO ITEM IN THE CART -->
        <div class="row row-cols-1 notibar">
            <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">You have no item in the cart</span>
            </div>
        </div>
        <!-- END CASE: NO ITEM IN THE CART -->
        <?php } ?>

    </div>
    <?php include('footer.php')?>
</body>
</html>