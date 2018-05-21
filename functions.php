<?php
function bootstrap()
{
    define('APP_PATH', __DIR__);
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    return connectToMySql();
}
function connectToMysql()
{
    $dsn = 'mysql:host=localhost;dbname=skolica';
    $username = 'root';
    $password = '';
    $pdo = new PDO($dsn, $username, $password);
    return $pdo;
}
function redirect($baseUrl, $route = '', $statusCode = 302)
{
    header('location:' . $baseUrl . $route, $statusCode);
}
function createPasswordHash($password)
{
    return md5($password);
}
function validateLoginForm($params)
{
    if (!is_array($params)) {
        throw new Exception('Given param is not an array');
    }
    if (isset($params['email']) and isset($params['password'])) {
        if ((strlen($params['email']) > 6 and strlen($params['email'] <= 20) and strstr($params['email'], '@', true)) and
            (strlen($params['password']) > 6 and strlen($params['password']) <= 14)
        ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function validateRegisterForm($params)
{
    if (!is_array($params)) {
        throw new Exception('Given param is not an array');
    }
    if (isset($params['email']) and isset($params['password']) and isset($params['password-2'])) {
        if ((strlen($params['email']) > 6 and strlen($params['email'] <= 20) and strstr($params['email'], '@', true)) and
            (strlen($params['password']) > 6 and strlen($params['password']) <= 14) and ($params['password-2'] === $params['password'])
        ) {
            return true;
        } else {
            echo "nije ok";
            return false;
        }
    } else {
        return false;
    }
}
function validateUserForm($params)
{
    if (!is_array($params)) {
        throw new Exception('Given param is not an array');
    }
    if (isset($params['email']) and isset($params['password']) and isset($params['password-2']) and isset($params['firstName']) and isset($params['lastName']) and isset($params['username'])) {
        if (
            (strlen($params['email']) > 6 and strlen($params['email'] <= 20) and strstr($params['email'], '@', true)) and
            (strlen($params['password']) > 6 and strlen($params['password']) <= 14) and
            ($params['password-2'] === $params['password']) and
            (strlen($params['firstName']) > 2 and strlen($params['firstName']) < 32) and
            (strlen($params['lastName']) > 2 and strlen($params['lastName']) < 32) and
            (strlen($params['username']) > 2 and strlen($params['username']) < 32)
        ) {
            return true;
        } else {
            echo "nisu ispunjeni svi uslovi";
            return false;
        }
    } else {
        return false;
    }
}
function validateArticleForm()
{
    if (isset($_POST['body']) and strlen($_POST['body']) < 1 or isset($_POST['category']) and strlen($_POST['category']) < 1 or isset($_POST['user']) and strlen($_POST['user']) < 1) {
        return false;
    }
    return true;

}
function login($email, $password)
{
    $user = getUserByEmail($email);
    if (!$user) {
        return false;
    }
    if ($user->password === createPasswordHash($password)) {
        $_SESSION['isLoggedIn'] = true;
        return true;
    }
    return false;
}
function isLoggedIn()
{
    if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] === true) {
        return true;
    }

    return false;
}
function logOut()
{
    unset($_SESSION);
    session_destroy();
}
function saveUser($params)
{
    global $pdo;
    $password = createPasswordHash($params['password']);
    $sql = "INSERT INTO `user` (userId, firstName,lastName, email, password, username, age, status) VALUES (null, '{$params['firstName']}', '{$params['lastName']}', '{$params['email']}', '{$password}', '{$params['username']}', '{$params['age']}', '{$params['status']}')";
    return $pdo->query($sql)->execute();
}
function saveArticleForm($params)
{
    global $pdo;
    $sql = "INSERT INTO `article` (`articleId`, `title`, `description`, `body`, `categoryId`, `userId`) 
                VALUES (NULL, '{$params['title']}', '{$params['description']}', '{$params['body']}}', '{}', '{}')";
    return $pdo->query($sql)->execute();
}
function saveCategoryForm($params)
{
    global $pdo;
    $sql = "INSERT INTO `category` (`categoryId`, `name`, `parentId`) VALUES (NULL, '{$params['categoryName']}', '{}')";
    return $pdo->query($sql)->execute();
}
function userUpdate($params)
{
    global $pdo;
    $user = getuserById($_GET['userId']);
    if ($params['password'] === ''){
        $password = $user['password'];
    }else {
        $password = createPasswordHash($params['password']);
    }
    $sql = "UPDATE `user` SET 
        `email` = '{$params['email']}',
        `password`= '{$password}',
        `firstName`= '{$params['firstName']}',
        `lastName`= '{$params['lastName']}',
        `username`= '{$params['username']}',
        `status`= '{$params['status']}',
        `age`= '{$params['age']}'
    WHERE `userId`='{$_GET['userId']}'";
    if (!$pdo->exec($sql)) {
        var_dump($pdo->errorInfo()[2]);
        die();
        throw new \Exception($pdo->errorInfo()[2]);
    }
}
function articleUpdate($params)
{
    global $pdo;
    $sql = "UPDATE `article` SET 
        `title`='{$params['title']}',
        `description`='{$params['description']}', 
        `body`='{$params['body']}' 
    WHERE `articleId`='{$_GET['articleId']}'";

    if (!$pdo->exec($sql)) {
        var_dump($pdo->errorInfo()[2]);
        die();
        throw new \Exception($pdo->errorInfo()[2]);
    }
}

function getUsers()
{
    global $pdo;
    $sql = " SELECT * FROM `user` ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
}
function getUserByEmail($email)
{
    global $pdo;
    $sql = " SELECT * FROM `user` WHERE email = '{$email}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
function getUserById($userId)
{
    global $pdo;
    $sql= "SELECT * FROM `user` WHERE `userId` = '{$userId}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
function getArticles()
{
    global $pdo;
    $sql = " SELECT * FROM `article` ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
}
function getArticleByTitle($title)
{
    global $pdo;
    $sql = " SELECT * FROM `article` WHERE title = '{$title}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
function getArticleById ($articleId)
{
    global $pdo;
    $sql= "SELECT * FROM `article` WHERE `articleId` = '{$articleId}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
function getCategory()
{
    global $pdo;
    $sql = " SELECT * FROM `category` ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
}
function getArticleWithCategoryName($articleId)
{
    global $pdo;
    $sql = "SELECT a.*, c.name as categoryName FROM `article` a JOIN `category` c USING(`categoryId`) where categoryId='{$articleId}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
?>