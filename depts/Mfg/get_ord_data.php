<?php

include 'connection.php';

if(isset($_POST['num'])){

    $order_no = $_POST['num'];

    $search = "SELECT orders.order_no, orders.client_name, orders.metal, orders.category, 
                orders.astmt_weight, orders.due_date, category.id AS cat_id, category.category_name 
                FROM orders JOIN category ON orders.category = category.id WHERE order_no='$order_no'";
    $search_res = mysqli_query($conn, $search);

    $fetch = mysqli_fetch_assoc($search_res);
    echo $fetch['metal']."/".$fetch['cat_id']."/".$fetch['category_name']."/".$fetch['astmt_weight']."/".$fetch['due_date'];

}

?>