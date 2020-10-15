<?php

include 'connection.php';
$output = '';

$query = '';

if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query =  "
            SELECT products.code, products.metal, products.category_id, 
            products.weight, products.labour, products.price, category.id, category.category_name  FROM products 
            JOIN category ON products.category_id = category.id
            WHERE code REGEXP '".$search."'
            ";
            $result = mysqli_query($conn, $query);
}


while($row = mysqli_fetch_assoc($result))
{
 $data[] = $row;
}

echo json_encode($data);

?>