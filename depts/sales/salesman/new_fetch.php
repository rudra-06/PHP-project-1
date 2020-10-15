<?php
session_start();

if($_SESSION['user'] == ''){

    $_SESSION['user'] = '';
    header('location:index.php');
 
} else {
include 'connection.php';

$user = $_SESSION['user'];

    

    $item_code = $_POST['code'];

    $search = "SELECT *,count(*) AS cnt FROM products WHERE code='$item_code'";
    $search_res = mysqli_query($conn, $search);

    if(mysqli_num_rows($search_res) > 0){

        $result = array();
        
        while($row = mysqli_fetch_assoc($search_res)){
            echo$count[] = $row['cnt'];
            foreach($row as $r){echo $r."-";}

            

        }

    }
    
}
?>