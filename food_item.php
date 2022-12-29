<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start();
        include("conn_db.php");
        include('head.php');
        if(!(isset($_GET["s_id"])||isset($_GET["f_id"]))){
            header("location: restricted.php");
            exit(1);
        }
        if(!isset($_SESSION["cid"])){
            header("location: cust_login.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <script type="text/javascript" src="js/input_number.js"></script>
    <script type="text/javascript">
        function changeshopcf(){
            return window.confirm("Do you want to change the shop?\nDon't worry we will do it for you automatically.");
        }
    </script>
    <title>Food Item | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php 
        include('nav_header.php');
        $s_id = $_GET["s_id"];
        $f_id = $_GET["f_id"];
        $query = "SELECT f.* FROM food f INNER JOIN shop s ON f.s_id = s.s_id WHERE f.s_id = {$s_id} AND f.f_id = {$f_id} LIMIT 0,1";
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
                <div class="form-amount">
                    <form class="mt-3" method="POST" action="add_item.php">
                        <div class="input-group mb-3">
                            <button id="sub_btn" class="btn btn-outline-secondary" type="button" title="subtract amount" onclick="sub_amt('amount')">
                                <i class="bi bi-dash-lg"></i>
                            </button>
                            <input type="number" class="form-control text-center border-secondary" id="amount"
                                name="amount" value="1" min="1" max="99">
                            <button id="add_btn" class="btn btn-outline-secondary" type="button" title="add amount" onclick="add_amt('amount')">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                        <input type="hidden" name="s_id" value="<?php echo $s_id?>">
                        <input type="hidden" name="f_id" value="<?php echo $f_id?>">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="addrequest" name="request" placeholder=" ">
                            <label for="addrequest" class="d-inline-text">Additional Request (Optional)</label>
                            <div id="addrequest_helptext" class="form-text">
                                Such as less sugar.
                            </div>
                        </div>
                        <button class="btn btn-success w-100" type="submit" title="add to cart" name="addtocart"
                        <?php
                            $cartsearch_query1 = "SELECT COUNT(*) AS cnt FROM cart WHERE c_id = {$_SESSION['cid']}";
                            $cartsearch_row1 = $mysqli -> query($cartsearch_query1) -> fetch_array();
                            if($cartsearch_row1["cnt"]>0){
                                $cartsearch_query2 = $cartsearch_query1." AND s_id = {$s_id}";
                                $cartsearch_row2 = $mysqli -> query($cartsearch_query2) -> fetch_array();
                                if($cartsearch_row2["cnt"]==0){?>
                                    onclick="javascript: return changeshopcf();"<?php 
                                } 
                            }
                        ?>
                        >
                        <i class="bi bi-cart-plus"></i> Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $result -> free_result();?>
    </div>
    <?php include('footer.php')?>
</body>

</html>