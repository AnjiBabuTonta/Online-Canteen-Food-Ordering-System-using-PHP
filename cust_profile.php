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
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <title>My Profile | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
<?php include('nav_header.php')?>

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
                        <i class="bi bi-check-circle"></i>
                            <span class="ms-2 mt-2">Successfully updated your password!</span>
                            <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_profile.php">X</a></span>
                        </div>
                    </div>
                    <!-- END SUCCESSFULLY UPDATE PASSWORD -->
            <?php }else{ ?>
                    <!-- START FAILED UPDATE PASSWORD -->
                    <div class="row row-cols-1 notibar">
                        <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                        <i class="bi bi-x-circle"></i><span class="ms-2 mt-2">Failed to update your password.</span>
                            <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_profile.php">X</a></span>
                        </div>
                    </div>
                    <!-- END FAILED UPDATE PASSWORD -->
            <?php }
                }
            if(isset($_GET["up_prf"])){
                if($_GET["up_prf"]==1){
                    ?>
                    <!-- START SUCCESSFULLY UPDATE PASSWORD -->
                    <div class="row row-cols-1 notibar">
                        <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                        <i class="bi bi-check-circle"></i>
                            <span class="ms-2 mt-2">Successfully updated your profile!</span>
                            <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_profile.php">X</a></span>
                        </div>
                    </div>
                    <!-- END SUCCESSFULLY UPDATE PASSWORD -->
            <?php }else{ ?>
                    <!-- START FAILED UPDATE PASSWORD -->
                    <div class="row row-cols-1 notibar">
                        <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                        <i class="bi bi-x-circle"></i><span class="ms-2 mt-2">Failed to update your profile.</span>
                            <span class="me-2 float-end"><a class="text-decoration-none link-light" href="cust_profile.php">X</a></span>
                        </div>
                    </div>
                    <!-- END FAILED UPDATE PASSWORD -->
            <?php }
                }
            ?>

            <h2 class="pt-3 display-6"><i class="bi bi-person-circle"></i> My Profile</h2>
        </div>

        <a class="btn btn-sm btn-outline-secondary me-2" href="cust_update_pwd.php">
        <i class="bi bi-key"></i>
            Change password
        </a>
        <a class="btn btn-sm btn-primary mt-2 mt-md-0" href="cust_update_profile.php">
        <i class="bi bi-pencil-square"></i>
            Update my profile
        </a>

        <!-- START CUSTOMER INFORMATION -->
        <?php
            //Select customer record from database
            $query = "SELECT c_username,c_firstname,c_lastname,c_email,c_gender,c_type FROM customer WHERE c_id = {$_SESSION['cid']} LIMIT 0,1";
            $result = $mysqli ->query($query);
            $row = $result -> fetch_array();
        ?>
        <div class="row row-cols-1 mt-4">
            <dl class="row">
                <dt class="col-sm-3">Username</dt>
                <dd class="col-sm-9"><?php echo $row["c_username"];?></dd>

                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9"><?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"];?></dd>

                <dt class="col-sm-3">Gender</dt>
                <dd class="col-sm-9"><?php 
                if($row["c_gender"]=="M"){echo "Male";}
                else if($row["c_gender"]=="F"){echo "Female";}
                ?>
                </dd>

                <dt class="col-sm-3">Role</dt>
                <dd class="col-sm-9"><?php 
                if($row["c_type"]=="STD"){echo "Student";}
                
                else if($row["c_type"]=="STF"){echo "Faculty Staff";}
                else if($row["c_type"]=="GUE"){echo "Guest";}
                else{echo "Others";}
                ?>
                </dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9"><?php echo $row["c_email"];?></dd>
            </dl>
        </div>
        <!-- END CUSTOMER INFORMATION -->
    </div>
    <?php include('footer.php')?>
</body>

</html>