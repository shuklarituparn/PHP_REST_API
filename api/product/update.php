<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once "../config/database.php";
include_once "../objects/products.php";


$database = new Database();
$db = $database->connect();

$product=new Product($db);

$data=json_decode(file_get_contents("php://input"));
$product->price=$data->price;
$product->name=$data->name;
$product->description=$data->description;
$product->category_id=$data->category_id;

if($product->update()){
    http_response_code(201);
    return json_encode(array("message"=>"updated"),JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(503);
    return json_encode(array("message"=>"service unavailable"),JSON_UNESCAPED_UNICODE);
}