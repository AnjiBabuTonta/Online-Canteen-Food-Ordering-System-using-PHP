<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        include("../conn_db.php"); 
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
        if(isset($_POST["upd_confirm"])){
            $s_id = $_POST["s_id"];
            $s_name = $_POST["s_name"];
            $s_username = $_POST["s_username"];
            $s_location = $_POST["s_location"];
            $s_email = $_POST["s_email"];
            $s_phoneno = $_POST["s_phoneno"];
            $update_query = "UPDATE shop SET s_username = '{$s_username}', s_name = '{$s_name}', s_location = '{$s_location}', 
             s_email = '{$s_email}', s_phoneno = '{$s_phoneno}'
            WHERE s_id = {$s_id};";
            $update_result = $mysqli -> query($update_query);
            if(!empty($_FILES["s_pic"]["name"])){
                //Image upload
                $target_dir = '/img/';
                $temp = explode(".",$_FILES["s_pic"]["name"]);
                $target_newfilename = "shop".$s_id.".".strtolower(end($temp));
                $target_file = $target_dir.$target_newfilename;
                if(move_uploaded_file($_FILES["s_pic"]["tmp_name"],SITE_ROOT.$target_file)){
                    $update_query = "UPDATE shop SET s_pic = '{$target_newfilename}' WHERE s_id = {$s_id};";
                    $update_result = $mysqli -> query($update_query);
                }else{
                    $update_result = false;
                }
            }
            if($update_result){header("location: admin_shop_list.php?up_spf=1");}
            else{header("location: admin_shop_list.php?up_spf=0");}
            exit(1);
        }
        include('../head.php');
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link href="../img/Color Icon with background.png" rel="icon">
    <title>Update shop information | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php')?>

    <div class="container form-signin mt-auto w-50">
        <a class="nav nav-item text-decoration-none text-muted" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <?php 
            //Select customer record from database
            $s_id = $_GET["s_id"];
            $query = "SELECT s_username,s_name,s_location,s_email,s_phoneno FROM shop WHERE s_id = {$s_id} LIMIT 0,1";
            $result = $mysqli ->query($query);
            $row = $result -> fetch_array();
        ?>
        <form method="POST" action="admin_shop_edit.php" class="form-floating" enctype="multipart/form-data">
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-pencil-square me-2"></i>Update Shop Information</h2>
            
            
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="shopusername" placeholder="Username" name="s_username"
                value="<?php echo $row["s_username"];?>" required>
                <label for="shopname">Username</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="shopname" placeholder="Shop Name" value="<?php echo $row["s_name"];?>" name="s_name" required>
                <label for="shopname">Shop Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" placeholder="E-mail" name="s_email" value="<?php echo $row["s_email"];?>" required>
                <label for="email">E-mail</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="shoplocation" placeholder="Location" value="<?php echo $row["s_location"];?>" name="s_location" required>
                <label for="shoplocation">Shop Location</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="shopphoneno" placeholder="Phone Number" value="<?php echo $row["s_phoneno"];?>" name="s_phoneno" required>
                <label for="shopphoneno">Phone Number</label>
            </div>
            
            <div class="mb-2">
                <label for="formFile" class="form-label">Upload shop image</label>
                <input class="form-control" type="file" id="s_pic" name="s_pic" accept="image/*">
            </div>
            <input type="hidden" name="s_id" value="<?php echo $s_id;?>">
            <button class="w-100 btn btn-success mb-3" name="upd_confirm" type="submit">Update Shop</button>
        </form>
    </div>

    <?php include('admin_footer.php')?>
</body>

</html>