<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        include('../head.php');
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../img/Color Icon with background.png" rel="icon">
    <title>Shop Profile | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php')?>

    <?php
        $s_id = $_GET["s_id"];
        $query = "SELECT s_name,s_location,s_phoneno,s_pic
        FROM shop WHERE s_id = {$s_id} LIMIT 0,1";
        $result = $mysqli -> query($query);
        $shop_row = $result -> fetch_array();
    ?>

    <div class="container px-5 py-4" id="shop-body">
        <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <?php
            if(isset($_GET["up_pwd"])){
                if($_GET["up_pwd"]==1){
                    ?>
            <!-- START SUCCESSFULLY UPDATE PASSWORD -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully updated shop password.</span>
                </div>
            </div>
            <!-- END SUCCESSFULLY UPDATE PASSWORD -->
            <?php }else{ ?>
            <!-- START FAILED UPDATE PASSWORD -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to update shop password.</span>
                </div>
            </div>
            <!-- END FAILED UPDATE PASSWORD -->
            <?php }
                }
            ?>

        <div class="container row row-cols-6 row-cols-md-12 g-5 pt-4 mb-4" id="shop-header">
            <div class="rounded-25 col-6 col-md-4" id="shop-img" style="
                    background: url(
                        <?php
                            if(is_null($shop_row["s_pic"])){echo "'../img/default.png'";}
                            else{echo "'../img/{$shop_row['s_pic']}'";}
                        ?> 
                    ) center; height: 225px;
                    background-size: cover; background-repeat: no-repeat;object-fit:fill;
                    background-position: center;">
            </div>
            <div class="col-6 col-md-8">
                <h1 class="display-5 strong"><?php echo $shop_row["s_name"];?></h1>
                <ul class="list-unstyled">
                    
                    <li class=""><?php echo $shop_row["s_location"];?></li>
                    
                    <li class="">Telephone number: <?php echo "(+91) ".$shop_row["s_phoneno"];?></li>
                </ul>
                <a class="btn btn-sm btn-outline-secondary" href="admin_shop_pwd.php?s_id=<?php echo $s_id?>">
            <i class="bi bi-key"></i>
            Change password
        </a>
        <a class="btn btn-sm btn-primary mt-2 mt-md-0" href="admin_shop_edit.php?s_id=<?php echo $s_id?>">
            <i class="bi bi-pencil-square"></i>
            Update shop profile
        </a>
        <a class="btn btn-sm btn-danger mt-2 mt-md-0" href="admin_shop_delete.php?s_id=<?php echo $s_id?>">
            <i class="bi bi-trash"></i>
            Delete this shop
        </a>
            </div>
        </div>

        <!-- GRID MENU SELECTION -->
        <div class="container">
        <h3 class="border-top pt-3 my-2">
            <a class="text-decoration-none link-success" href="admin_shop_detail.php?s_id=<?php echo $s_id?>">Menus</a>
            <span class="text-secondary">/</span> 
            <a class="nav-item text-decoration-none link-secondary" href="admin_shop_order.php?s_id=<?php echo $s_id?>">Orders</a></span>
            <span class="text-secondary">/</span> 
            <a class="nav-item text-decoration-none link-secondary" href="admin_shop_revenue.php?s_id=<?php echo $s_id?>">Revenue</a></span>
        </h3>
            <form class="form-floating mb-1 " method="GET" action="admin_shop_detail.php">
                <div class="row g-2">
                    <div class="col">
                        <input type="hidden" name="s_id" value="<?php echo $s_id;?>">
                        <input type="text" class="form-control" id="foodname" name="fdn" placeholder="Food name"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["fdn"];?>" <?php } ?>>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" value="1" class="btn btn-success">Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='admin_shop_detail.php?s_id=<?php echo $s_id?>'">Clear</button>
                        <a href="admin_food_add.php?s_id=<?php echo $s_id?>" class="btn btn-primary">Add new food</a>
                    </div>
                </div>
            </form>
        </div>
        <?php
            $result -> free_result();
            if(isset($_GET["search"])){
                $query = "SELECT * FROM food WHERE s_id = {$s_id} AND f_name LIKE '%{$_GET['fdn']}%' ORDER BY f_price DESC;";
            }else{
                $query = "SELECT * FROM food WHERE s_id = {$s_id} ORDER BY f_price DESC;";
            }
            $result = $mysqli -> query($query);
            $numrow = $result -> num_rows;
            if($numrow > 0){
        ?>
        <div class="container align-items-stretch">
            <!-- GRID EACH MENU -->
            <div class="table-responsive">
            <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-3">
                <caption><?php echo $numrow;?> item(s) <?php if(isset($_GET["search"])){?><br /><a
                        href="admin_shop_detail.php?s_id=<?php echo $s_id?>" class="text-decoration-none text-danger">Clear Search
                        Result</a><?php } ?></caption>
                <thead class="bg-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu Name</th>
                        <th scope="col">Price</th>
                        
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; while($row = $result -> fetch_array()){ ?>
                    <tr>
                        <th><?php echo $i++;?></th>
                        <td><?php echo $row["f_name"];?></td>
                        <td><?php printf("%.2f INR",$row["f_price"]);?></td>
                        
                        <td>
                            <a href="admin_food_detail.php?f_id=<?php echo $row["f_id"]?>"
                                class="btn btn-sm btn-primary">View</a>
                            <a href="admin_food_edit.php?f_id=<?php echo $row["f_id"]?>"
                                class="btn btn-sm btn-outline-success">Edit</a>
                            <a href="admin_food_delete.php?f_id=<?php echo $row["f_id"]?>"
                                class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
        <?php }else{ ?>
        <div class="row">
            <div class="col m-2 p-2 bg-danger text-white rounded text-start">
                <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">No menu found in this shop</span>
                <a href="admin_shop_detail.php?s_id=<?php echo $s_id;?>" class="text-white">Clear Search Result</a>
            </div>
        </div>
        <!-- END GRID SHOP SELECTION -->
        <?php } ?>
    </div>
    <?php include('admin_footer.php')?>
</body>

</html>