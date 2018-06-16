<?php
$message = '';
$config = include('config/config.php');
$config = array_merge(
    $config, include('config/config-local.php')
);
include ('src/Repository/RepositoryInterface.php');
include ('src/Mapper/MapperInterface.php');
include('route.php');
include('src/mapper/Article.php');
include ('src/Mapper/User.php');
include('src/Mapper/Category.php');
include ('src/Repository/User.php');
include('src/Repository/Category.php');
include ('src/Repository/Article.php');
include ('src/Model/Article.php');
include ('src/Model/Category.php');
include ('src/Model/User.php');
//include('header.phtml');
include ('src/Controller/BaseController.php');
include ('src/Controller/UserController.php');
include ('src/Service/Router.php');
include ('src/Service/UserService.php');
$routeConfig = include ('config/routes.php');
$router = new Service\Router($routeConfig);
$routeData = $router->resolve($_SERVER);
var_dump($routeData);
$controllerName = array_keys($routeData)[0];
$methodName = $routeData[$controllerName];
$userMapper = new Mapper\User(connectToDatabase());
$userRepository = new Repository\User($userMapper, new Service\UserService());
$controller = new $controllerName($userRepository, $config);
echo $controller->{$methodName}();








function connectToDatabase()
{
    $dsn = 'mysql:host=localhost;dbname=skolica';
    $username = 'root';
    $password = '';
    $pdo = new PDO($dsn, $username, $password);
    return $pdo;
}
