<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/category.php";

$database = new Database();
try {
    $db = $database->connect();
} catch (Exception $e) {
}

$category = new Category($db);

$stmt = $category->readAll();
$num = $stmt->rowCount();

if ($num > 0) {

    $categories_arr = array();
    $categories_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
        $category_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description)
        );
        array_push($categories_arr["records"], $category_item);
    }
    http_response_code(200);

    return json_encode($categories_arr);
} else {
    http_response_code(404);
    return json_encode(array("message" => "not found"), JSON_UNESCAPED_UNICODE);
}