<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        session_start(); 
        if($_SESSION["utype"]!="ADMIN"){
            header("location: ../restricted.php");
            exit(1);
        }
        include("../conn_db.php"); 
        include('../head.php');
        include("range_fn.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <script type="text/javascript" src="../js/revenue_date_selection.js"></script>
    <title>Revenue Report | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <?php include('nav_header_admin.php'); ?>

    <div class="container form-signin">
        <a class="nav nav-item text-decoration-none text-muted" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <form method="GET" action="shop_report_summary.php" class="form-floating">
            <h2 class="mt-4 mb-3"><i class="bi bi-coin"></i> Revenue Report</h2>
            <p>Please select the option below to see your sales and revenue report.</p>
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


    <?php include('admin_footer.php')?>
</body>

</html>