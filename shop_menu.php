<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        session_start();
        include("conn_db.php");
        include('head.php');
        if(!isset($_GET["s_id"])){
            header("location: restricted.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <title>Shop Menu | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header.php')?>

    <?php
        $s_id = $_GET["s_id"];
        $query = "SELECT s_name,s_location,s_phoneno,s_pic
        FROM shop WHERE s_id = {$s_id} LIMIT 0,1";
        $result = $mysqli -> query($query);
        $shop_row = $result -> fetch_array();
    ?>

    <div class="container px-5 py-4" id="shop-body">
        <a class="nav nav-item text-decoration-none text-muted mb-3" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>

        <?php
            if(isset($_GET["atc"])){
                if($_GET["atc"]==1){
                    ?>
                    <!-- START SUCCESSFULLY ADD TO CART -->
                    <div class="row row-cols-1 notibar pb-3">
                        <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                            <i class="bi bi-check-circle"></i>
                            <span class="ms-2 mt-2">Add item to your cart successfully!</span>
                            <span class="me-2 float-end"><a class="text-decoration-none link-light" href="shop_menu.php?s_id=<?php echo $s_id;?>">X</a></span>
                        </div>
                    </div>
                    <!-- END SUCCESSFULLY ADD TO CART -->
            <?php }else{ ?>
                    <!-- START FAILED ADD TO CART -->
                    <div class="row row-cols-1 notibar">
                        <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                            <i class="bi bi-x-circle-fill"></i><span class="ms-2 mt-2">Failed to add item to your cart.</span>
                            <span class="me-2 float-end"><a class="text-decoration-none link-light" href="shop_menu.php?s_id=<?php echo $s_id;?>">X</a></span>
                        </div>
                    </div>
                    <!-- END FAILED ADD TO CART -->
            <?php }
                } ?>
        <div class="mb-3 text-wrap" id="shop-header">
            <div class="rounded-25 mb-4" id="shop-img" style="
                    background: url(
                        <?php
                            if(is_null($shop_row["s_pic"])){echo "'img/default.png'";}
                            else{echo "'img/{$shop_row['s_pic']}'";}
                        ?>
                    ); height: 300px;  width:50%;  background-size:cover; object-fit:fill;
                     background-repeat: no-repeat;
                    background-position: center;">
            </div>
            <h1 class="display-5 strong"><?php echo $shop_row["s_name"];?></h1>
            <ul class="list-unstyled">

                <li class=""><?php echo $shop_row["s_location"];?></li>

                <li class="">Contact number: <?php echo "(+91) ".$shop_row["s_phoneno"];?></li>
            </ul>
        </div>

        <!-- GRID MENU SELECTION -->
        <h3 class="border-top py-3 mt-2">Menu</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 align-items-stretch mb-1">

        <?php
            $result -> free_result();
            $query = "SELECT * FROM food WHERE s_id = {$s_id}";
            $result = $mysqli -> query($query);

            if($result ->num_rows > 0){
                while($food_row = $result->fetch_array()){
        ?>
            <!-- GRID EACH MENU -->
            <div class="col">
                <div class="card rounded-25 mb-4">
                    <a href="food_item.php?<?php echo "s_id=".$food_row["s_id"]."&f_id=".$food_row["f_id"]?>" class="text-decoration-none text-dark">
                        <div class="card-img-top">
                            <img
                                <?php
                                if(is_null($food_row["f_pic"])){echo "src='img/default.png'";}
                                else{echo "src=\"img/{$food_row['f_pic']}\"";}
                                ?>
                                style="width:100%; height:125px; object-fit:cover;"
                                class="img-fluid" alt="<?php echo $food_row["f_name"]?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fs-5"><?php echo $food_row["f_name"]?></h5>
                            <p class="card-text"><?php echo $food_row["f_price"]?> INR</p>
                            <a href="food_item.php?<?php echo "s_id=".$food_row["s_id"]."&f_id=".$food_row["f_id"]?>" class="btn btn-sm mt-3 btn-outline-secondary">
                                <i class="bi bi-cart-plus"></i>Add to cart
                            </a>
                        </div>
                    </a>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <!-- END GRID EACH SHOP -->

        </div>
        <!-- END GRID SHOP SELECTION -->

    </div>
    <?php include('footer.php')?>
</body>

</html>
