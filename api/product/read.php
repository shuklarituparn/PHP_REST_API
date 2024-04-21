<?php

header("Access-Control-Allow-Origin: *"); //anyone can request the data
header("Content-Type: application/json; charset=UTF-8");

include  "../config/database.php";
include  "../objects/products.php";

$database= new Database(); //Instance of new db that I made in Database

    $db = $database->connect();


$product=new Product($db);  //initializing the product object

$stmt=$product->read(); //read the data from the db
$num=$stmt->rowCount(); //number of rows in the databases

if ($num>0){   //if we find more than  I record we store it in array
    $product_array=array();
    $product_array["records"]=array(); //under the record we store all the found record

    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){  //return each row as indexed by column number
        extract($row);
        $product_info=array(
            "id"=>$id, //in here just a comma
            "name"=>$name,
            "description"=>html_entity_decode($description), //using this so as to decode it for html way
            "price"=>$price,
            "category_id"=>$category_id,
            "category_name"=>$category_name
        );

        array_push($product_array["records"], $product_info);

    }
    http_response_code(200);
    return json_encode($product_array);
}else{
    http_response_code(404);
    return json_encode(array("message"=>"no records found"), JSON_UNESCAPED_UNICODE);
}



