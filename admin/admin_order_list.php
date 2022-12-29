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
    <link href="../img/ICON_F.png" rel="icon">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../img/Color Icon with background.png" rel="icon">
    <title>Order List | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">

    <?php include('nav_header_admin.php')?>

    <div class="container p-2 pb-0" id="admin-dashboard">
        <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>

            <?php
            if(isset($_GET["up_ods"])){
                if($_GET["up_ods"]==1){
                    ?>
            <!-- START SUCCESSFULLY UPDATE ORDER STATUS -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <i class="bi bi-check-circle ms-2"></i>
                    <span class="ms-2 mt-2">Successfully updated order status.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_order_list.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY UPDATE ORDER STATUS -->
            <?php }else{ ?>
            <!-- START FAILED UPDATE ORDER STATUS -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">Failed to update order status.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="admin_order_list.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED UPDATE ORDER STATUS -->
            <?php }
                }
            ?>

            <h2 class="pt-3 display-6">Order List</h2>
            <form class="form-floating mb-3" method="GET" action="admin_order_list.php">
                <div class="row g-2">
                    <div class="col">
                        <select class="form-select" id="c_id" name="c_id">
                            <option selected value="">Customer Name</option>
                            <?php
                                $option_query = "SELECT DISTINCT c.c_id, c.c_firstname,c.c_lastname
                                FROM order_header orh INNER JOIN customer c ON orh.c_id = c.c_id;";
                                $option_result = $mysqli -> query($option_query);
                                $opt_row = $option_result -> num_rows;
                                if($option_result -> num_rows != 0){
                                    while($option_arr = $option_result -> fetch_array()){
                            ?>
                            <option value="<?php echo $option_arr["c_id"]?>"><?php echo $option_arr["c_firstname"]." ".$option_arr["c_lastname"]?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" id="utype" name="ut">
                            <?php if(isset($_GET["search"])){?>
                            <option selected value="">Customer Type</option>
                            <option value="STD" <?php if($_GET["ut"]=="STD"){ echo "selected";}?>>Student</option>
                            <option value="STF" <?php if($_GET["ut"]=="STF"){ echo "selected";}?>>Faculty Staff</option>
                            <option value="GUE" <?php if($_GET["ut"]=="GUE"){ echo "selected";}?>>Visitor</option>
                            <option value="ADM" <?php if($_GET["ut"]=="ADM"){ echo "selected";}?>>Admin</option>
                            <option value="OTH" <?php if($_GET["ut"]=="OTH"){ echo "selected";}?>>Other</option>
                            <?php }else{ ?>
                            <option selected value="">Customer Type</option>
                            <option value="STD">Student</option>
                            <option value="STF">Faculty Staff</option>
                            <option value="GUE">Visitor</option>
                            <option value="ADM">Admin</option>
                            <option value="OTH">Other</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" id="s_id" name="s_id">
                            <option selected value="">Shop Name</option>
                            <?php
                                $option_query = "SELECT DISTINCT s.s_id, s.s_name
                                FROM order_header orh INNER JOIN shop s ON orh.s_id = s.s_id;";
                                $option_result = $mysqli -> query($option_query);
                                $opt_row = $option_result -> num_rows;
                                if($option_result -> num_rows != 0){
                                    while($option_arr = $option_result -> fetch_array()){
                            ?>
                            <option value="<?php echo $option_arr["s_id"]?>"><?php echo $option_arr["s_name"]?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" id="orderstatus" name="os">
                            <?php if(isset($_GET["search"])){?>
                            <option selected value="">Order Status</option>
                            <option value="VRFY" <?php if($_GET["os"]=="VRFY"){ echo "selected";}?>>Order Verifying</option>
                            <option value="ACPT" <?php if($_GET["os"]=="ACPT"){ echo "selected";}?>>Order Accepted</option>
                            <option value="PREP" <?php if($_GET["os"]=="PREP"){ echo "selected";}?>>Order Preparing</option>
                            <option value="RDPK" <?php if($_GET["os"]=="RDPK"){ echo "selected";}?>>Ready for Pick-Up</option>
                            <option value="FNSH" <?php if($_GET["os"]=="FNSH"){ echo "selected";}?>>Order Finished</option>
                            <option value="CNCL" <?php if($_GET["os"]=="CNCL"){ echo "selected";}?>>Order Cancelled</option>
                            <?php }else{ ?>
                            <option selected value="">Order Status</option>
                            <option value="VRFY">Order Verifying</option>
                            <option value="ACPT">Order Accepted</option>
                            <option value="PREP">Order Preparing</option>
                            <option value="RDPK">Ready for Pick-Up</option>
                            <option value="FNSH">Order Finished</option>
                            <option value="CNCL">Order Cancelled</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" value="1" class="btn btn-success"
                        <?php if($opt_row==0){echo "disabled";} ?>>Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='admin_order_list.php'">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
            if(isset($_GET["search"])){
                if($_GET["c_id"]!=''){ $cid_clause = " AND orh.c_id = '{$_GET['c_id']}' "; }else{ $cid_clause = " ";}
                if($_GET["s_id"]!=''){ $sid_clause = " AND orh.s_id = '{$_GET['s_id']}' "; }else{ $sid_clause = " ";}
                $query = "SELECT orh.orh_id,orh.orh_ordertime,c.c_firstname,c.c_lastname,orh.orh_orderstatus,p.p_amount,s.s_name,orh.t_id
                FROM order_header orh INNER JOIN customer c ON orh.c_id = c.c_id INNER JOIN payment p ON p.p_id = orh.p_id
                INNER JOIN shop s ON orh.s_id = s.s_id WHERE c.c_type LIKE '%{$_GET['ut']}%' 
                AND orh_orderstatus LIKE '%{$_GET['os']}%'".$cid_clause.$sid_clause." ORDER BY orh.orh_ordertime DESC;";
            }else{
                $query = "SELECT orh.orh_id,orh.orh_ordertime,c.c_firstname,c.c_lastname,orh.orh_orderstatus,p.p_amount,s.s_name,orh.t_id
                FROM order_header orh INNER JOIN customer c ON orh.c_id = c.c_id INNER JOIN payment p ON p.p_id = orh.p_id INNER JOIN shop s ON orh.s_id = s.s_id ORDER BY orh.orh_ordertime DESC;";
            }
            $result = $mysqli -> query($query);
            $numrow = $result -> num_rows;
            if($numrow > 0){
        ?>
        <div class="container align-items-stretch pt-2">
            <!-- GRID EACH MENU -->
            <div class="table-responsive">
            <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-3">
                <caption><?php echo $numrow;?> order(s) <?php if(isset($_GET["search"])){?><br /><a
                        href="admin_order_list.php" class="text-decoration-none text-danger">Clear Search
                        Result</a><?php } ?></caption>
                <thead class="bg-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order Cost</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; while($row = $result -> fetch_array()){ ?>
                    <tr>
                        <th><?php echo $i++;?></th>
                        <td><?php echo $row["t_id"];?></td>
                        <td><?php echo $row["s_name"];?></td>
                        <td>
                            <?php if($row["orh_orderstatus"]=="VRFY"){ ?>
                                <span class="fw-bold badge rounded-pill bg-info text-dark">Verifying</span>
                            <?php }else if($row["orh_orderstatus"]=="ACPT"){ ?>
                                <span class="fw-bold badge rounded-pill bg-secondary text-dark">Accepted</span>
                            <?php }else if($row["orh_orderstatus"]=="PREP"){ ?>
                                <span class="fw-bold badge rounded-pill bg-warning text-dark">Preparing</span>
                            <?php }else if($row["orh_orderstatus"]=="RDPK"){ ?>
                                <span class="fw-bold badge rounded-pill bg-primary text-white">Ready to pick up</span>
                            <?php }else if($row["orh_orderstatus"]=="FNSH"){?>
                                <span class="fw-bold badge rounded-pill bg-success text-white">Completed</span>
                            <?php }else if($row["orh_orderstatus"]=="CNCL"){?>
                                <span class="fw-bold badge rounded-pill bg-danger text-white">Cancelled</span>
                            
                            <?php } ?>
                        </td>
                        <td><?php 
                        $order_time = (new Datetime($row["orh_ordertime"])) -> format("F j, Y H:i");
                        echo $order_time;
                        ?></td>
                        <td><?php echo $row["c_firstname"]." ".$row["c_lastname"];?></td>
                        <td><?php echo $row["p_amount"]." INR";?></td>
                        <td>
                            <a href="admin_order_detail.php?orh_id=<?php echo $row["orh_id"]?>" class="btn btn-sm btn-primary">View</a>
                            <a href="admin_order_update.php?orh_id=<?php echo $row["orh_id"]?>" class="btn btn-sm btn-outline-success">Update Status</a>
                            <a href="admin_order_delete.php?orh_id=<?php echo $row["orh_id"]?>" class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
        <?php }else{ ?>
        <div class="container">
        <div class="row">
            <div class="col m-2 p-2 bg-danger text-white rounded text-start">
                <i class="bi bi-x-circle ms-2"></i><span class="ms-2 mt-2">No order found</span>
                <?php if(isset($_GET["search"])){ ?>
                <a href="admin_order_list.php" class="text-white">Clear Search Result</a>
                <?php } ?>
            </div>
        </div>
        </div>
        <!-- END GRID SHOP SELECTION -->
        <?php } ?>

    <?php include('admin_footer.php')?>
</body>

</html>