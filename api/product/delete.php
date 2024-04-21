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
$product->id=$data->id;

if($product->delete()){
    http_response_code(200);
    return json_encode(array("message"=>"deleted successfully"),JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(503);
    return json_encode(array("message"=>"service unavailable"),JSON_UNESCAPED_UNICODE);
}
