<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start(); include("conn_db.php"); include("head.php");?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | FOODCAVE </title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/main1.css">
</head>
<body class="d-flex flex-column h-100">
    <?php include('nav_header.php')?>
    <div class="d-flex text-center text-white position-relative promo-banner-bg py-3">
        <div class="p-lg-2 mx-auto my-5">
            <h1 class="display-5 fw-normal">Welcome to FOODCAVE</h1>
            <p class="lead fw-normal">Food ordering system of SVEC Tadepalligudem</p>
            <span class="xsmall-font text-muted"></span>
        </div>
    </div>
    <div class="container p-5" id="recommended-shop">
        <h2 class="border-bottom pb-2"><i class="bi bi-shop align-top"></i> Recommended For You</h2>

        <!-- GRID SHOP SELECTION -->
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3">

            <?php
            $query = "SELECT s_id,s_name,s_pic FROM shop";
            $result = $mysqli -> query($query);
            if($result -> num_rows > 0){
            while($row = $result -> fetch_array()){
        ?>
            <!-- GRID EACH SHOP -->
            <div class="col">
                <a href="<?php echo "shop_menu.php?s_id=".$row["s_id"]?>" class="text-decoration-none text-dark">
                    <div class="card rounded-25">
                        <img <?php
                            if(is_null($row["s_pic"])){echo "src='img/default.png'";}
                            else{echo "src=\"img/{$row['s_pic']}\"";}
                        ?> style="width:100%; height:175px; object-fit:cover;"
                            class="card-img-top rounded-25 img-fluid" alt="<?php echo $row["s_name"]?>">
                        <div class="card-body">
                            <h4 name="shop-name" class="card-title"><?php echo $row["s_name"]?></h4>
                            <p class="card-subtitle">
                                
                            </p>
                            
                            <div class="text-end">
                                <a href="<?php echo "shop_menu.php?s_id=".$row["s_id"]?>"
                                    class="btn btn-sm btn-outline-dark">Go to shop</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END GRID EACH SHOP -->
            <?php }
        }else{
            ?>
            <div class="row row-cols-1 w-100">
                <div class="col mt-4 pt-3 px-3 bg-danger text-white rounded text-center">
                    <i class="bi bi-x-circle-fill"></i>
                    <p class="ms-2 mt-2">No shop currently avaliable to order.</p>
                </div>
            </div>
            <?php
        }
        $result -> free_result();
        ?>
        </div>
        <!-- END GRID SHOP SELECTION -->

    </div>
    <?php include('footer.php')?>
    
        
</body>
</html>