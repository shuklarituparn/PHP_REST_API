<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/products.php";


$database = new Database();
$db = $database->connect();
$product = new Product($db);

$product->id=isset($_GET["id"])?$_GET["id"]:die(); //if the id is set we take it or we make the program exit using  the die function
$product->readOne();



