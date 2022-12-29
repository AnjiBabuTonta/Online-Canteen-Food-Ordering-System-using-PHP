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
        include("range_fn.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <script type="text/javascript" src="../js/revenue_date_selection.js"></script>
    <link href="../img/Color Icon with background.png" rel="icon">
    <title>Shop Revenue Report | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100 bg-white">
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
        <div class="container row row-cols-6 row-cols-md-12 g-5 pt-4 mb-4" id="shop-header">
            <div class="rounded-25 col-6 col-md-4" id="shop-img" style="
                    background: url(
                        <?php
                            if(is_null($shop_row["s_pic"])){echo "'../img/default.png'";}
                            else{echo "'../img/{$shop_row['s_pic']}'";}
                        ?> 
                    ) center; height: 225px;
                    background-size: cover; background-repeat: no-repeat; object-fit:fill;
                    background-position: center;">
            </div>
            <div class="col-6 col-md-8">
                <h1 class="display-5 strong"><?php echo $shop_row["s_name"];?></h1>
                <ul class="list-unstyled">
                    
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
            <a class="text-decoration-none link-secondary" href="admin_shop_detail.php?s_id=<?php echo $s_id?>">Menus</a>
            <span class="text-secondary">/</span> 
            <a class="nav-item text-decoration-none link-secondary" href="admin_shop_order.php?s_id=<?php echo $s_id?>">Orders</a></span>
            <span class="text-secondary">/</span> 
            <a class="nav-item text-decoration-none link-success" href="admin_shop_revenue.php?s_id=<?php echo $s_id?>">Revenue</a></span>
        </h3>
        </div>
        <div class="container form-signin">
        <form method="GET" action="admin_shop_report.php" class="form-floating">
            <input type="hidden" name="s_id" value="<?php echo $s_id;?>">
            <p>Please select the option below to see sales and revenue report of this shop.</p>
            <!-- 1 Today / 2 Yesterday / 3 This Week / 4 Monthly / 5 Specific Period -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode1" value="1" checked onclick="switch_disable(0)">
                <label class="form-check-label" for="rev_mode1">
                    Today<br />(<?php echo date('F j, Y');?>)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode2" value="2" onclick="switch_disable(0)">
                <label class="form-check-label" for="rev_mode2">
                    Yesterday<br />(<?php echo (new Datetime()) -> sub(new DateInterval("P1D")) -> format('F j, Y');?>)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode3" value="3" onclick="switch_disable(0)">
                <label class="form-check-label" for="rev_mode3">
                    This Week<br /> (<?php 
                    $weekrange = rangeWeek(date('Y-n-j'));
                    $week_start = (new Datetime($weekrange["start"])) -> format('F j, Y');
                    $week_end = (new Datetime($weekrange["end"])) -> format('F j, Y');
                    echo "{$week_start} - {$week_end}";
                    ?>)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode4" value="4" onclick="switch_disable(0)">
                <label class="form-check-label" for="rev_mode4">
                    This Month<br /> (<?php 
                    $monthrange = rangeMonth(date('Y-n-j'));
                    $month_start = (new Datetime($monthrange["start"])) -> format('F j, Y');
                    $month_end = (new Datetime($monthrange["end"])) -> format('F j, Y');
                    echo "{$month_start} - {$month_end}";
                    ?>)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rev_mode" id="rev_mode5" value="5" onclick="switch_disable(1)">
                <label class="form-check-label" for="rev_mode5">
                    Specific Date<br />
                </label>
                <div class="row row-cols-2 g-0 mt-1 mb-2">
                    <div class="col">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="start_date" placeholder="Starting Date"
                                value="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d');?>" name="start_date"
                                oninput="update_minrange()" disabled>
                            <label for="start_date">Starting Date</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="end_date" placeholder="Ending Date"
                                value="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d');?>" name="end_date" disabled>
                            <label for="end_date">Ending Date</label>
                        </div>
                    </div>
                </div>
            </div>
            <button class="w-100 btn btn-outline-success my-3" type="submit">Generate Report</button>
        </form>
    </div>
    </div>
    <?php include('admin_footer.php')?>
</body>

</html>