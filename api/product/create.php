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

