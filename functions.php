<?php
include("functions/user/userValidation.php");
include("functions/user/userStorageFunctions.php");
include("functions/user/userFunctions.php");
include("functions/article/articleStorageFunctions.php");
include("functions/article/articleValidation.php");
include("functions/article/articleFunctions.php");
include("functions/category/categoryStorageFunctions.php");
include("functions/category/categoryValidation.php");
include("functions/category/categoryFunctions.php");

function saveImage()
{
    $fileName = APP_PATH . '/images/' . $_FILES['image']['name'];
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $fileName)) {
        echo "greska";
    }
    return 'images/' . $_FILES['image']['name'];

}

function bootstrap()
{
    define('APP_PATH', __DIR__);
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

function redirect($baseUrl, $route = '', $statusCode = 302)
{
    header('Location: ' . $baseUrl . $route, $statusCode);
}






?>



