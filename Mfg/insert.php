<?php
include 'connection.php';
// ======= inserting reciept =======

    

        $reciept_num = $_POST['reciept_num'];
        $worker_name = $_POST['worker_name'];
        $status = $_POST['status'];
        $assign_date = $_POST['assign_date'];
        $deadline_date = $_POST['deadline_date'];
        $customer_order = $_POST['customer_order'];
        $prd_category = $_POST['prd_category'];
        $prd_metal = $_POST['prd_metal'];
        $prd_quality = $_POST['prd_quality'];
        $prd_weight = $_POST['prd_weight'];
        $material_given = $_POST['material_given'];
        $material_quality = $_POST['material_quality'];
        $material_weight = $_POST['material_weight'];

        echo $insert = "INSERT INTO mfg_work_reciept (reciept_no, worker, customer_order, prd_category, 
                    prd_metal, prd_quality, prd_weight, gvn_material_type, gvn_material_quality, 
                    gvn_material_weight, start_date, deadline_date, status) VALUES ('$reciept_num', 
                    '$worker_name', '$customer_order', '$prd_category', '$prd_metal', '$prd_quality', 
                    '$prd_weight', '$material_given', '$material_quality', '$material_weight', 
                    '$assign_date', '$deadline_date', '$status')";

     

// ======= inserting reciept end =======
?>