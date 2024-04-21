<?php


header("Access-Control-Allow-Origin: *");  //allowing all the user
header("Content-Type: application/json; charset=UTF-8");  //returning json
header("Access-Control-Allow-Methods: POST");  //only method allowed is post
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once "../config/database.php";  //connection to the db

include_once "../objects/products.php";  //creating the product
include_once "../config/core.php";

$database= new Database();
$db=$database->connect();  //connecting to the databases
$product= new Product($db); //passing the db instance


$keywords=isset($_GET["s"])?$_GET["s"]:"";
$stmt=$product->search($keywords);
$num=$stmt->rowCount();

if($num>0){
    $product_arr=array();
    $product_arr["records"]=array();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );
        array_push($products_arr["records"], $product_item);
    }
    http_response_code(200);
    return json_encode($product_arr);
}else{
    http_response_code(404);
    return json_encode(array("message"=>"not found"));

}


