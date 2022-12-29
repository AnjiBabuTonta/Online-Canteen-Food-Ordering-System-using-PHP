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
    <title>Customer Profile | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php')?>

    <div class="container px-5 py-4" id="cart-body">
        <div class="row my-4 pb-2 border-bottom">
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
                    <span class="ms-2 mt-2">Successfully updated customer password!</span>
                </div>
            </div>
            <!-- END SUCCESSFULLY UPDATE PASSWORD -->
            <?php }else{ ?>
            <!-- START FAILED UPDATE PASSWORD -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to update customer password.</span>
                </div>
            </div>
            <!-- END FAILED UPDATE PASSWORD -->
            <?php }
                }
            ?>

            <h2 class="pt-3 display-6"><i class="bi bi-person-circle"></i> My Profile</h2>
        </div>

        <a class="btn btn-sm btn-outline-secondary" href="admin_customer_pwd.php?c_id=<?php echo $_GET["c_id"]?>">
            <i  class="bi bi-key" ></i>
            Change password
        </a>
        <a class="btn btn-sm btn-primary mt-2 mt-md-0" href="admin_customer_edit.php?c_id=<?php echo $_GET["c_id"]?>">
            <i class="bi bi-pencil-square"></i>
            Update profile
        </a>
        <a class="btn btn-sm btn-danger mt-2 mt-md-0" href="admin_customer_delete.php?c_id=<?php echo $_GET["c_id"]?>">
            <i class="bi bi-trash"></i>
            Delete this profile
        </a>

        <!-- START CUSTOMER INFORMATION -->
        <?php
            //Select customer record from database
            $cid = $_GET["c_id"];
            $query = "SELECT c_username,c_firstname,c_lastname,c_email,c_gender,c_type FROM customer WHERE c_id = {$cid} LIMIT 0,1";
            $result = $mysqli ->query($query);
            $row = $result -> fetch_array();
        ?>
        <div class="row row-cols-1 mt-4">
            <dl class="row">
                <dt class="col-sm-3">Username</dt>
                <dd class="col-sm-9"><?php echo $row["c_username"];?></dd>

                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9"><?php echo $row["c_firstname"]." ".$row["c_lastname"];?></dd>

                <dt class="col-sm-3">Gender</dt>
                <dd class="col-sm-9"><?php 
                if($row["c_gender"]=="M"){echo "Male";}
                else if($row["c_gender"]=="F"){echo "Female";}
                ?>
                </dd>

                <dt class="col-sm-3">Account Type</dt>
                <dd class="col-sm-9"><?php 
                if($row["c_type"]=="STD"){echo "Student";}
                
                else if($row["c_type"]=="STF"){echo "Faculty Staff";}
                else if($row["c_type"]=="GUE"){echo "Guest";}
                else if($row["c_type"]=="ADM"){echo "Admin";}
                else{echo "Others";}
                ?>
                </dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9"><?php echo $row["c_email"];?></dd>
            </dl>
        </div>
        <!-- END CUSTOMER INFORMATION -->
    </div>
    <?php include('admin_footer.php')?>
</body>

</html>