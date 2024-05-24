<?php
declare(strict_types=1);

use Controllers\AuthController;
use Controllers\PageController;
use Controllers\ProductController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require_once '../vendor/autoload.php';

session_start();

try {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    $method = $_SERVER['REQUEST_METHOD']; // GET -- POST

    $url_base = "19-php-hiking-project-aurelien-et-manon";

    echo $url_path;

    switch ($url_path) {
      case "/":
      case $url_base:
          $productController = new ProductController();
          $productController->index();
          break;
      case $url_base . "/product":
            $productController = new ProductController();
            $productController->show($_GET['productCode']);
            break;
      case $url_base . "/subscribe":
        //instantiate Auth
        $authController = new AuthController();
        //if GET
        if ($method == "GET") { $authController->showSubscriptionForm(); }
        //if POST
        if($method == "POST"){ $authController->subscribe($_POST["login"], $_POST["email"], $_POST["pass"]); }
        break;
      //case $url_base . "/login":
        //instantiate Auth
        //if GET
        //if POST
        // break;
      //case $url_base . "/logout":
        //instantiate Auth
        // logout()
        // break;
      default:
        $pageController = new PageController();
        $pageController->page_404();
    }
}
catch (Exception $e) {
    //echo $e->getMessage();
    $pageController = new PageController();
    $pageController->page_500($e->getMessage());
}