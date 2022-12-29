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
    <link href="../css/main1.css" rel="stylesheet">
    <title>Admin Dashboard | FOODCAVE</title>
</head>

<body class="d-flex flex-column">

    <?php include('nav_header_admin.php')?>

    <div class="d-flex text-center text-white promo-banner-bg py-3">
        <div class="p-lg-2 mx-auto my-3">
            <h1 class="display-5 fw-normal">ADMIN DASHBOARD</h1>
            <p class="lead fw-normal">Food ordering system of SVEC Tadepalligudem</p></div>
    </div>

    <div class="container p-5" id="admin-dashboard">
        <h2 class="border-bottom pb-2"><i class="bi bi-graph-up"></i> System Status</h2>

        <!-- ADMIN GRID DASHBOARD -->
        <div class="row row-cols-1 row-cols-lg-2 align-items-stretch g-4 py-3">

            <!-- GRID OF CUSTOMER -->
            <div class="col">
                <a href="admin_customer_list.php" class="text-decoration-none text-dark">
                    <div class="card rounded-5 border-danger p-2">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="bi bi-person-fill"></i>
                                Customer</h4>
                            <p class="card-text my-2">
                                <span class="h5">
                                    <?php
                                    $cust_query = "SELECT COUNT(*) AS cnt FROM customer;";
                                    $cust_arr = $mysqli -> query($cust_query) -> fetch_array();
                                    echo $cust_arr["cnt"];
                                ?>
                                </span>
                                customer(s) in the system
                            </p>
                            <div class="text-end">
                                <a href="admin_customer_list.php" class="btn btn-sm btn-outline-dark">Go to Customer List</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END GRID OF CUSTOMER -->

            <!-- GRID OF SHOP -->
            <div class="col">
                <a href="admin_shop_list.php" class="text-decoration-none text-dark">
                    <div class="card rounded-5 border-success p-2">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="bi bi-shop"></i>
                                Food Shop</h4>
                            <p class="card-text my-2">
                                <span class="h5">
                                    <?php
                                    $cust_query = "SELECT COUNT(*) AS cnt FROM shop;";
                                    $cust_arr = $mysqli -> query($cust_query) -> fetch_array();
                                    echo $cust_arr["cnt"];
                                ?>
                                </span>
                                food shop(s) in the system
                            </p>
                            <div class="text-end">
                                <a href="admin_shop_list.php" class="btn btn-sm btn-outline-dark">Go to Food Shop List</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END GRID OF SHOP -->

            <!-- GRID OF FOOD -->
            <div class="col">
                <a href="admin_food_list.php" class="text-decoration-none text-dark">
                    <div class="card rounded-5 border-primary p-2">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="bi bi-card-list"></i>
                                Menu</h4>
                            <p class="card-text my-2">
                                <span class="h5">
                                    <?php
                                    $cust_query = "SELECT COUNT(*) AS cnt FROM food;";
                                    $cust_arr = $mysqli -> query($cust_query) -> fetch_array();
                                    echo $cust_arr["cnt"];
                                ?>
                                </span>
                                menu(s) in the system
                            </p>
                            <div class="text-end">
                                <a href="admin_food_list.php" class="btn btn-sm btn-outline-dark">Go to Menu List</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END GRID OF FOOD -->

            <!-- GRID OF ORDER -->
            <div class="col">
                <a href="admin_order_list.php" class="text-decoration-none text-dark">
                    <div class="card rounded-5 border-warning p-2">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="bi bi-card-list"></i>
                                Order</h4>
                            <p class="card-text my-2">
                                <span class="h5">
                                    <?php
                                    $cust_query = "SELECT COUNT(*) AS cnt FROM order_header;";
                                    $cust_arr = $mysqli -> query($cust_query) -> fetch_array();
                                    echo $cust_arr["cnt"];
                                ?>
                                </span>
                                order(s) in the system
                            </p>
                            <div class="text-end">
                                <a href="admin_order_list.php" class="btn btn-sm btn-outline-dark">Go to Order List</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END GRID OF ORDER -->


        </div>
        <!-- END ADMIN GRID DASHBOARD -->

    </div>
    <?php include('admin_footer.php')?>
</body>

</html>