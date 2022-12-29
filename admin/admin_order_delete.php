<?php
    session_start();
    if($_SESSION["utype"]!="ADMIN"){
        header("location: ../restricted.php");
        exit(1);
    }
    include('../conn_db.php');
    $orh_id = $_GET["orh_id"];

    $delete_query = "DELETE FROM order_header WHERE orh_id = '{$orh_id}';";
    $delete_result = $mysqli -> query($delete_query);

    if($delete_result){
        header("location: admin_order_list.php?del_ord=1");
    }else{
        header("location: admin_order_list.php?del_ord=0");
    }

?>