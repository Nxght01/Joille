<?php

ob_start();

require  __DIR__ . "/../vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

use CoffeeCode\Router\Router;

$route = new Router(url(),":");

$route->namespace("Source\App\Api");


$route->group("/users");

$route->post("/","Users:createUser");
$route->post("/login","Users:loginUser");
$route->post("/admin","Users:loginAdmin");
$route->post("/update","Users:updateUser");
$route->post("/set-password","Users:setPassword");

$route->group("null");


$route->group("/services");

$route->get("/list","Services:listService");
$route->get("/list/{id}","Services:listById");
$route->post("/insert-service","Services:insertServices");
$route->post("/update-service/{id}","Services:updateService");
$route->delete("/delete/{id}","Services:delete");

$route->group("null");

$route->group("/categories");

$route->get("/list","Categories:listCategory");
$route->get("/list/{id}","Categories:listById");
$route->post("/insert-category","Categories:insertCategories");
$route->post("/update-category/{id}","Categories:updateCategory");
$route->delete("/delete-category/{id}","Categories:deleteCategory");

$route->group("null");


$route->group("/admin");

$route->post("/","Admins:insert");

$route->group("null");

$route->dispatch();

/** ERROR REDIRECT */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();