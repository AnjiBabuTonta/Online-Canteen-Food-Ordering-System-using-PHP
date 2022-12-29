<!DOCTYPE html>
<html lang="en" class="h-100">

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
    <link href="../img/Color Icon with background.png" rel="icon">
    <link href="../css/main.css" rel="stylesheet">
    <title>Shop List | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">

    <?php include('nav_header_admin.php')?>

    <div class="container p-2 pb-0" id="admin-dashboard">
        <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>

            <?php
            if(isset($_GET["up_spf"])){
                if($_GET["up_spf"]==1){
                    ?>
            <!-- START SUCCESSFULLY UPDATE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully updated shop profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_shop_list.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY UPDATE PROFILE -->
            <?php }else{ ?>
            <!-- START FAILED UPDATE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to update shop profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_shop_list.php">X</a></span>

                </div>
            </div>
            <!-- END FAILED UPDATE PROFILE -->
            <?php }
                }
            if(isset($_GET["del_shp"])){
                if($_GET["del_shp"]==1){
                    ?>
            <!-- START SUCCESSFULLY DELETE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully deleted shop profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_shop_list.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY DELETE PROFILE -->
            <?php }else{ ?>
            <!-- START FAILED DELETE PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to delete shop profile.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_shop_list.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED DELETE PROFILE -->
            <?php }
                }
            if(isset($_GET["add_shp"])){
                if($_GET["add_shp"]==1){
                    ?>
            <!-- START SUCCESSFULLY ADD PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully add new shop.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_shop_list.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY ADD PROFILE -->
            <?php }else{ ?>
            <!-- START FAILED ADD PROFILE -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to add new shop.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_shop_list.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED ADD PROFILE -->
            <?php }
                }
            ?>

            <h2 class="pt-3 display-6">Shop List</h2>
            <form class="form-floating mb-3" method="GET" action="admin_shop_list.php">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="username" name="un" placeholder="Username"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["un"];?>" <?php } ?>>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="shopname" name="sn" placeholder="Shop Name"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["sn"];?>" <?php } ?>>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" value="1" class="btn btn-success">Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='admin_shop_list.php'">Clear</button>
                        <a href="admin_shop_add.php" class="btn btn-primary">Add new shop</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container pt-2" id="cust-table">

        <?php
            if(!isset($_GET["search"])){
                $search_query = "SELECT s_id,s_username,s_name,s_location,s_email,s_phoneno FROM shop;";
            }else{
                $search_un=$_GET["un"];
                $search_sn=$_GET["sn"];
                $search_query = "SELECT s_id,s_username,s_name,s_location,s_email,s_phoneno FROM shop
                WHERE s_username LIKE '%{$search_un}%' AND s_name LIKE '%{$search_sn}%';";
            }
            $search_result = $mysqli -> query($search_query);
            $search_numrow = $search_result -> num_rows;
            if($search_numrow == 0){
        ?>
        <div class="row">
            <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">No shop found!</span>
                <a href="admin_shop_list.php" class="text-white">Clear Search Result</a>
            </div>
        </div>
        <?php } else{ ?>
        <div class="table-responsive">
        <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-5">
            <caption><?php echo $search_numrow;?> shop(s) <?php if(isset($_GET["search"])){?><br /><a
                    href="admin_shop_list.php" class="text-decoration-none text-danger">Clear Search
                    Result</a><?php } ?></caption>
            <thead class="bg-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Shop name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; while($row = $search_result -> fetch_array()){ ?>
                <tr>
                    <th><?php echo $i++;?></th>
                    <td><?php echo $row["s_username"];?></td>
                    <td><?php echo $row["s_name"];?></td>
                    <td class="text-wrap"><?php echo $row["s_location"];?></td>
                    
                    
                    
                    <td class="small"><?php echo $row["s_email"];?><br/><?php echo "(+91) ".$row["s_phoneno"];?></td>
                    <td>
                        <a href="admin_shop_detail.php?s_id=<?php echo $row["s_id"]?>"
                            class="btn btn-sm btn-primary">View</a>
                        <a href="admin_shop_edit.php?s_id=<?php echo $row["s_id"]?>"
                            class="btn btn-sm btn-outline-success">Edit</a>
                        <a href="admin_shop_delete.php?s_id=<?php echo $row["s_id"]?>"
                            class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <?php }
            $search_result -> free_result();
        ?>
    </div>

    <?php include('admin_footer.php')?>
</body>

</html>