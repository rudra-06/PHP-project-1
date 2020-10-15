<?php 

include 'connection.php';

if(isset($_POST['metal'])){
    
    $cat_id = $_POST['category'];

    $select = "SELECT category_name FROM category WHERE id='$cat_id'";
    $select_res = mysqli_query($conn, $select);

    $fetch = mysqli_fetch_assoc($select_res);

    $cat_name = $fetch['category_name'];
    $metal = $_POST['metal'];
    $count = 1;
    $digits = 4;
    $final_code = '';


    $mtl_code = generate_metal_code($metal);

    $cat_code = generate_cat_code($mtl_code, $cat_name);
    $final_code .= $cat_code;

    $start = get_last_item($conn);

    $number = generate_number($start, $count, $digits);
    $final_code .= $number;
    
    echo $final_code;

}


function generate_metal_code($metal){

    if($metal == 'gold'){

        $metal_code = 'G';
        return $metal_code;

    } else {

        $metal_code = 'SL';
        return $metal_code;

    }

}

// function to generate code as per the item category
function generate_cat_code($mtl_code, $cat_name){

    // code for bracelet
    if($cat_name == 'bracelet'){

        $brc_code = 'BRC';
        $length = strlen($mtl_code) + strlen($brc_code);

        $code_with_cat = str_pad($mtl_code, $length, $brc_code, STR_PAD_RIGHT);
        return $code_with_cat;

    } 
    // code for chain
    else if($cat_name == 'chain'){

        $brc_code = 'CH';
        $length = strlen($mtl_code) + strlen($brc_code);

        $code_with_cat = str_pad($mtl_code, $length, $brc_code, STR_PAD_RIGHT);
        return $code_with_cat;

    } 
    // code for ear ring
    else if($cat_name == 'ear ring'){

        $brc_code = 'ER';
        $length = strlen($mtl_code) + strlen($brc_code);

        $code_with_cat = str_pad($mtl_code, $length, $brc_code, STR_PAD_RIGHT);
        return $code_with_cat;

    } 
    // code for pendent
    else if($cat_name == 'pendent'){

        $brc_code = 'P';
        $length = strlen($mtl_code) + strlen($brc_code);

        $code_with_cat = str_pad($mtl_code, $length, $brc_code, STR_PAD_RIGHT);
        return $code_with_cat;

    } 
    // code for pendent set
    else if($cat_name == 'pendent set'){

        $brc_code = 'PSET';
        $length = strlen($mtl_code) + strlen($brc_code);

        $code_with_cat = str_pad($mtl_code, $length, $brc_code, STR_PAD_RIGHT);
        return $code_with_cat;

    } 
    // code for ring
    else if($cat_name == 'ring'){

        $brc_code = 'R';
        $length = strlen($mtl_code) + strlen($brc_code);

        $code_with_cat = str_pad($mtl_code, $length, $brc_code, STR_PAD_RIGHT);
        return $code_with_cat;

    } 
    // code for long set
    else if($cat_name == 'long set'){

        $brc_code = 'LSET';
        $length = strlen($mtl_code) + strlen($brc_code);

        $code_with_cat = str_pad($mtl_code, $length, $brc_code, STR_PAD_RIGHT);
        return $code_with_cat;

    }

}

// get last item from the products table
function get_last_item($conn){

    $select_id = "SELECT id FROM products";
    $select_id_res = mysqli_query($conn, $select_id);

    if(mysqli_num_rows($select_id_res) == 0){
        
        $start = '1';
        return $start;

    } else {

        $rows = mysqli_num_rows($select_id_res);
        $start = $rows + 1;
        return $start;

    }

}

// function to generate a number
function generate_number($start, $count, $digits){

    for($n = $start; $n < $start + $count; $n++){

        $itm_code = str_pad($n, $digits, "0", STR_PAD_LEFT);

    }
    return $itm_code;

}

?>