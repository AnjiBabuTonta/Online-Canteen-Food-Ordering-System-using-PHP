<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start(); include("conn_db.php"); include('head.php');?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">
    

    <title>Payment | FOODCAVE</title>
</head>

<body class="d-flex flex-column">
    <header class="navbar navbar-light fixed-top bg-light shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
            <img src="img/Color logo - no background.png" width="125" class="me-2" alt="FOODCAVE Logo">
            </a>
        </div>
    </header>
    <div class="container px-5 py-4" id="shop-body">
        <div class="row my-4">
            <a class="nav nav-item text-decoration-none text-muted mb-2" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
        </div>
        <div class="row row-cols-1 row-cols-md-2 mb-5">
            <div class="col mb-3 qr mb-md-0" >
                <img 
                    src="img/qr.jpeg"
                    
                    class="img-fluid rounded-25 float-start" 
                    alt="qr">
                   
            </div>
        
                
                
            <form method="POST" action="add_order.php" class="form-floating">
               
            
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-qr-code-scan"></i>Payment</h2>
            <div class="col my-3">
            <ul class="list-inline justify-content-between">
            <li class="list-inline-item fw-light me-5">Grand Total</li>
                                <li class="list-inline-item fw-bold h4">
                                    <?php
                                        
                                        $gt_query = "SELECT SUM(ct.ct_amount*f.f_price) AS grandtotal FROM cart ct INNER JOIN food f 
                                        ON ct.f_id = f.f_id WHERE ct.c_id = {$_SESSION['cid']} GROUP BY ct.c_id";
                                        $gt_arr = $mysqli -> query($gt_query) -> fetch_array();
                                        $order_cost = $gt_arr["grandtotal"];
                                        printf("%.2f INR",$order_cost);
                                        
                                    ?>
                                </li>

            </ul>

        </div> 
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                    required>
                <label for="name"> Name</label>
            </div>
            
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" required>
                <label for="email">E-mail</label>
            </div>
            
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="tid" placeholder="transactionid" name="tid" minlength="12"
                    maxlength="45" required>
                <label for="transactionid">Transaction Id</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="cftid" placeholder="confirmtransactionid"    minlength="12"
                    maxlength="45" name="cftid" required>
                <label for="cftid">Confirm Transaction Id</label>
                
            </div>
            
            
            
            
            
            <div class="form-floating">
                <div class="mb-2 form-check">
                    <input type="checkbox" class="form-check-input " id="tandc" name="tandc" required>
                    <label class="form-check-label small" for="tandc">I agree to the terms and conditions and the
                        privacy policy</label>
                </div>
            </div>
            <button class="w-100 btn btn-success mb-3" type="submit">Submit</button>
        </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php')?>
</body>

</html>
