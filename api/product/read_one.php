<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/products.php";


$database = new Database();
try {
    $db = $database->connect();
} catch (Exception $e) {
    echo  $e->getMessage();
}
$product = new Product($db);

$product->id=isset($_GET["id"])?$_GET["id"]:die(); //if the id is set we take it or we make the program exit using  the die function
$product->readOne();

if($product->name!=null){
    $product_array=array(
        "id"=>$product->id,
        "name"=>$product->name,
        "description"=>html_entity_decode($product->description),
        "price"=>$product->price,
        "category_id"=>$product->category_id,
        "category_name"=>$product->category_name
    );
    http_response_code(200);
    echo json_encode($product_array);

}else{
    http_response_code(404);
    echo json_encode(array("message"=>"not found"),JSON_UNESCAPED_UNICODE);
}




