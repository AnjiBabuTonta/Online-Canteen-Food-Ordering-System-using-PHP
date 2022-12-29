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
    if(isset($_POST["upd_item"])){
        //Update button pressed
        $target_sid = $_POST["s_id"];
        $target_cid = $_SESSION["cid"];
        $target_fid = $_POST["f_id"];
        $amount = $_POST["amount"];
        $request = $_POST["request"];
        $cartupdate_query = "UPDATE cart SET ct_amount = {$amount}, ct_note = '{$request}' 
        WHERE c_id = {$target_cid} AND s_id = {$target_sid} AND f_id = {$target_fid}";
        $cartupdate_result = $mysqli -> query($cartupdate_query);
        if($cartupdate_result){
            header("location: cust_cart.php?up_crt=1");
        }else{
            header("location: cust_cart.php?up_crt=0");
        }
        exit(1);
    }

    include('head.php');
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <script type="text/javascript" src="js/input_number.js"></script>
    <title>Food Item | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php 
        include('nav_header.php');
        $s_id = $_GET["s_id"];
        $f_id = $_GET["f_id"];
        $query = "SELECT * FROM food WHERE s_id = {$s_id} AND f_id = {$f_id} LIMIT 0,1";
        $result = $mysqli -> query($query);
        $food_row = $result -> fetch_array();
    ?>

    <div class="container px-5 py-4" id="shop-body">
    <div class="row my-4">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
        </div>
        <div class="row row-cols-1 row-cols-md-2 mb-5">
            <div class="col mb-3 mb-md-0">
                <img 
                    <?php
                        if(is_null($food_row["f_pic"])){echo "src='img/default.png'";}
                        else{echo "src=\"img/{$food_row['f_pic']}\"";}
                    ?> 
                    class="img-fluid rounded-25 float-start" 
                    alt="<?php echo $food_row["f_name"]?>">
            </div>
            <div class="col text-wrap">
                <h1 class="fw-light"><?php echo $food_row["f_name"]?></h1>
                <h3 class="fw-light"><?php echo $food_row["f_price"]?> INR</h3>
                <ul class="list-unstyled mb-3 mb-md-0">
                    
                </ul>

                <?php
                    $ci_query = "SELECT ct_amount,ct_note FROM cart WHERE c_id = {$_SESSION['cid']} AND f_id = {$f_id} AND s_id = {$s_id}";
                    $ci_arr = $mysqli -> query($ci_query) -> fetch_array();
                ?>

                <div class="form-amount">
                    <form class="mt-3" method="POST" action="cust_update_cart.php">
                        <div class="input-group mb-3">
                            <button id="sub_btn" class="btn btn-outline-secondary" type="button" title="subtract amount"
                                onclick="sub_amt('amount')">
                                <i class="bi bi-dash-lg"></i>
                            </button>
                            <input type="number" class="form-control text-center border-secondary" id="amount"
                                name="amount" value="<?php echo $ci_arr["ct_amount"]?>" min="1" max="99">
                            <button id="add_btn" class="btn btn-outline-secondary" type="button" title="add amount"
                                onclick="add_amt('amount')">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                        <input type="hidden" name="s_id" value="<?php echo $s_id?>">
                        <input type="hidden" name="f_id" value="<?php echo $f_id?>">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="addrequest" name="request" value="<?php echo $ci_arr["ct_note"]?>" placeholder=" ">
                            <label for="addrequest" class="d-inline-text">Additional Request (Optional)</label>
                            <div id="addrequest_helptext" class="form-text">
                                Such as less sugar.
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-success" type="submit" title="Update item" name="upd_item" value="upd">
                            <i class="bi bi-cart"></i> Update item
                            </button>
                            <button class="btn btn-outline-danger" type="submit" formaction="remove_cart_item.php?rmv=1&s_id=<?php echo $s_id?>&f_id=<?php echo $f_id?>" value="rmv" title="remove from cart" name="rmv_item">
                            <i class="bi bi-cart-x"></i>Remove item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <?php include('footer.php')?>
</body>

</html>