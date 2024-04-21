<?php


//Now we create the product
header("Access-Control-Allow-Origin: *");  //allowing all the user
header("Content-Type: application/json; charset=UTF-8");  //returning json
header("Access-Control-Allow-Methods: POST");  //only method allowed is post
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once "../config/database.php";  //connection to the db

include_once "../objects/products.php";  //creating the product

$database= new Database();
$db=$database->connect();  //connecting to the database
$product= new Product($db); //passing the db instance


$data=json_decode(file_get_contents("php://input"));

if(
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->category_id)
){
    $product->name=$data->name;
    $product->price=$data->price;
    $product->description=$data->description;
    $product->category_id=$data->category_id;
    $product->created=date("Y-M-D H:i:s"); //year month date, hours minutes seconds

    if ($product->create()){
        http_response_code(code);
        return json_encode(array("message"=>"product successfully created"),JSON_UNESCAPED_UNICODE);
    }else{
        http_response_code(503); //server unavailable
        return json_decode(array("message"=>"server unable"),JSON_UNESCAPED_UNICODE);
    }

}else{
    http_response_code(400);
    return json_encode(array("message"=>"incorrect request"));
}

