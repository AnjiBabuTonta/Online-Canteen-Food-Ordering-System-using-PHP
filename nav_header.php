<header class="navbar navbar-expand-md navbar-light bg-light fixed-top shadow-sm mb-auto">
  <div class="container-fluid mx-4">
    <a class="navbar-brand" href="index.php">
        <img src="img/Color logo - no background.png" alt="FOODCAVE LOGO" width="125" class="me-2">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link px-2 text-dark" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-2 text-dark" href="shop_list.php">Shop List</a>
        </li>
        <?php if(isset($_SESSION['cid'])){ ?>
            <li class="nav-item">
                <a href="cust_order_history.php" class="nav-link px-2 text-dark">Order History</a>

            </li>
        <?php } ?>
      </ul>
      <div class="d-flex">
        <?php if(!isset($_SESSION['cid'])){ ?>
            <a href="cust_regist.php" class="btn btn-outline-secondary me-2">Sign Up</a>
            <a href="cust_login.php" class="btn btn-success">Log In</a>
        <?php }else{ ?>
            <ul class="navbar nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a href="cust_cart.php" class="btn btn-light" type="button">My Cart
                        <?php
                        $incart_query="SELECT SUM(ct_amount) AS incart_amt FROM cart WHERE c_id={$_SESSION['cid']}";
                        $incart_result = $mysqli -> query($incart_query) -> fetch_array();
                        $incart_amt = $incart_result["incart_amt"];
                        if($incart_amt>0){ ?>
                        <span class="ms-1 badge bg-success">
                            <?php echo $incart_amt;?>
                        </span>
                        <?php }else{ ?>
                            <span class="ms-1 badge bg-secondary">0</span>
                        <?php } ?>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="cust_profile.php" class="nav-link px-2 text-dark">
                        Welcome, <?=$_SESSION['firstname']?>
                        <i class="bi bi-person-circle"></i>

                    </a>

                </li>
                <li class="nav-item">
                    <a href="logout.php" class="mx-2 mt-1 mt-md-0 btn btn-outline-danger">Log Out</a>

                </li>

            </ul>
        <?php } ?>

      </div>
    </div>
  </div>
</header>