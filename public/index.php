<?php
require "../bootstrap.php";
use Src\Controller\AnimeController;
use Src\Controller\AnimeCharController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

//ENDPOINTS OR RETURN 404
if($requestMethod == "GET" && $uri[1] == "info"){
    $routes->routes = array("/anime", "/anime/{id}", "/char", "/char/{id}");
    echo json_encode($routes);
    die;
}
if($requestMethod == "GET" && $uri[1] == "anime" && (int) $uri[2] == false){
    $controller = new AnimeController($dbConnection);
    $controller->findAll();
}
elseif($requestMethod == "GET" && $uri[1] == "anime" &&  (int) $uri[2] == true){    
    $animeID = $uri[2];
    $controller = new AnimeController($dbConnection);
    $controller->find($animeID);
}
if($requestMethod == "GET" && $uri[1] == "char" && (int) $uri[2] == false){
    $controller = new AnimeCharController($dbConnection);
    $controller->findAll();
}
elseif($requestMethod == "GET" && $uri[1] == "char" &&  (int) $uri[2] == true){    
    $animeID = $uri[2];
    $controller = new AnimeCharController($dbConnection);
    $controller->find($animeID);
}
else
    header("HTTP/1.1 404 Not Found");


// // all of our endpoints start with /person
// // everything else results in a 404 Not Found
// if ($uri[1] !== 'person') {
    
//     exit();
// }

// // the user id is, of course, optional and must be a number:
// $userId = null;
// if (isset($uri[2])) {
//     $userId = (int) $uri[2];
// }

// // pass the request method and user ID to the PersonController and process the HTTP request:
// $controller = new PersonController($dbConnection, $requestMethod, $userId);
// $controller->processRequest();