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
    <title>Order History | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header.php')?>

    <div class="container px-5 py-4" id="shop-body">
        <a class="nav nav-item text-decoration-none text-muted mb-3" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <div class="mb-3 text-wrap" id="shop-header">
            <h2 class="display-6 strong fw-normal">Order History</h2>
        </div>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active px-4" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#nav-ongoing"
                    type="button" role="tab" aria-controls="nav-ongoing"
                    aria-selected="true">&nbsp;Ongoing&nbsp;</button>
                <button class="nav-link px-4" id="completed-tab" data-bs-toggle="tab" data-bs-target="#nav-completed"
                    type="button" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <!-- ONGOING ORDER TAB -->
            <div class="tab-pane fade show active p-3" id="nav-ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                <?php
                $ongoing_query = "SELECT * FROM order_header WHERE c_id = {$_SESSION['cid']} AND orh_orderstatus <> 'FNSH';";
                $ongoing_result = $mysqli -> query($ongoing_query);
                $ongoing_num = $ongoing_result -> num_rows;
                if($ongoing_num>0){
            ?>
                <div class="row row-cols-1 row-cols-md-3">
                    <!-- START EACH ORDER DETAIL -->
                    <?php while($og_row = $ongoing_result -> fetch_array()){ ?>
                    <div class="col">
                        <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                            class="text-dark text-decoration-none">
                            <div class="card mb-3">
                                <?php if($og_row["orh_orderstatus"]=="VRFY"){ ?>
                                <div class="card-header bg-info text-dark justify-content-between">
                                  <small class="me-auto d-flex" style="font-weight: 500;">Verifying your order</small>
                                </div>
                                <?php  } else if($og_row["orh_orderstatus"]=="ACPT"){ ?>
                                <div class="card-header bg-secondary text-dark justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Accepted your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="PREP"){?>
                                <div class="card-header bg-warning justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Preparing your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="RDPK"){?>
                                <div class="card-header bg-primary text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Your order is ready for
                                        pick-up</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="CNCL"){?>
                                <div class="card-header bg-danger text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Cancelled</small>
                                </div>
                                <?php }else{?>
                                <div class="card-header bg-success text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Finished</small>
                                </div><?php } ?>
                                <div class="card-body">
                                    <div class="card-text row row-cols-1 small">
                                        <div class="col">Order #<?php echo $og_row["t_id"];?></div>

                                        <div class="col mb-2">From
                                            <?php
                                            $shop_query = "SELECT s_name FROM shop WHERE s_id = {$og_row['s_id']};";
                                            $shop_arr = $mysqli -> query($shop_query) -> fetch_array();
                                            echo $shop_arr["s_name"];
                                        ?>
                                        </div>
                                        <?php
                                        $ord_query = "SELECT COUNT(*) AS cnt,SUM(ord_amount*ord_buyprice) AS gt FROM order_detail
                                        WHERE orh_id = {$og_row['orh_id']}";
                                        $ord_arr = $mysqli -> query($ord_query) -> fetch_array();
                                    ?>
                                        <div class="col pt-2 border-top"><?php echo $ord_arr["cnt"]?> item(s)</div>
                                        <div class="col mt-1 mb-2"><strong class="h5"><?php echo $ord_arr["gt"]?>
                                                INR</strong></div>
                                        <div class="col text-end">
                                            <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                                                class="text-dark text-decoration-none">
                                                <i class="bi bi-arrow-right-square"></i> More Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                    <!-- END EACH ORDER DETAIL -->
                </div>
                <?php }else{ ?>
                <!-- IN CASE NO ORDER -->
                <div class="row row-cols-1">
                    <div class="col pt-3 px-3 bg-danger text-white rounded text-center">
                        <i class="bi bi-x-circle-fill"></i>
                        <p class="ms-2 mt-2">You don't have any order yet.</p>
                    </div>
                </div>
                <!-- END CASE NO ORDER -->
                <?php } ?>
            </div>


            <!-- COMPLETED ORDER TAB -->
            <div class="tab-pane fade p-3" id="nav-completed" role="tabpanel" aria-labelledby="completed-tab">
            <?php
                $ongoing_query = "SELECT * FROM order_header WHERE c_id = {$_SESSION['cid']} AND orh_orderstatus = 'FNSH' ;";
                $ongoing_result = $mysqli -> query($ongoing_query);
                $ongoing_num = $ongoing_result -> num_rows;
                if($ongoing_num>0){
            ?>
                <div class="row row-cols-1 row-cols-md-3">
                    <!-- START EACH ORDER DETAIL -->
                    <?php while($og_row = $ongoing_result -> fetch_array()){ ?>
                    <div class="col">
                        <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                            class="text-dark text-decoration-none">
                            <div class="card mb-3">
                                <?php if($og_row["orh_orderstatus"]=="VRFY"){ ?>
                                <div class="card-header bg-info text-dark justify-content-between">
                                  <small class="me-auto d-flex" style="font-weight: 500;">Verifying your order</small>
                                </div>
                              <?php }else if($og_row["orh_orderstatus"]=="ACPT"){ ?>
                                <div class="card-header bg-secondary text-dark justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Accepted your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="PREP"){?>
                                <div class="card-header bg-warning justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Preparing your order</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="RDPK"){?>
                                <div class="card-header bg-primary text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Your order is ready for
                                        pick-up</small>
                                </div>
                                <?php }else if($og_row["orh_orderstatus"]=="CNCL"){?>
                                <div class="card-header bg-danger text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Cancelled</small>
                                </div>
                                <?php }else{?>
                                <div class="card-header bg-success text-white justify-content-between">
                                    <small class="me-auto d-flex" style="font-weight: 500;">Order Finished</small>
                                </div>
                                <?php } ?>
                                <div class="card-body">
                                    <div class="card-text row row-cols-1 small">
                                        <div class="col">Order #<?php echo $og_row["t_id"];?></div>
                                        <div class="col mb-2">From
                                            <?php
                                            $shop_query = "SELECT s_name FROM shop WHERE s_id = {$og_row['s_id']};";
                                            $shop_arr = $mysqli -> query($shop_query) -> fetch_array();
                                            echo $shop_arr["s_name"];
                                        ?>
                                        </div>
                                        <?php
                                        $ord_query = "SELECT COUNT(*) AS cnt,SUM(ord_amount*ord_buyprice) AS gt FROM order_detail
                                        WHERE orh_id = {$og_row['orh_id']}";
                                        $ord_arr = $mysqli -> query($ord_query) -> fetch_array();
                                    ?>
                                        <div class="col pt-2 border-top"><?php echo $ord_arr["cnt"]?> item(s)</div>
                                        <div class="col mt-1 mb-2"><strong class="h5"><?php echo $ord_arr["gt"]?>
                                                INR</strong></div>
                                        <div class="col text-end">
                                            <a href="cust_order_detail.php?orh_id=<?php echo $og_row["orh_id"]?>"
                                                class="text-dark text-decoration-none">
                                                <i class="bi bi-arrow-right-square"></i>More Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                    <!-- END EACH ORDER DETAIL -->
                </div>
                <?php }else{ ?>
                <!-- IN CASE NO ORDER -->
                <div class="row row-cols-1">
                    <div class="col pt-3 px-3 bg-danger text-white rounded text-center">
                        <i class="bi bi-x-circle-fill"></i>
                        <p class="ms-2 mt-2">You don't have any order yet.</p>
                    </div>
                </div>
                <!-- END CASE NO ORDER -->
                <?php } ?>
            </div>
        </div>
    </div>
    <footer
        class="footer d-flex flex-wrap justify-content-between align-items-center px-5 py-3 mt-auto bg-secondary text-light">
        <span class="smaller-font">&copy; The Four Snippets <br /><span class="xsmall-font">Anji Harsha Poorna Balu</span></span>
        <ul class="nav justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-light" target="_blank" href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox">
                    <i class="bi bi-telephone"></i>
                </a>
            </li>
        </ul>
    </footer>
    
</body>

</html>
