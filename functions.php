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
function generateUser()
{
       $firstNames =['Petar', 'Marko', 'Lazar','Igor','Stefan','Nikola','Marija','Ana','Kristina'.'Nina','Aleksandra'];
       $lastNames=['Nikolic','Markovic','Jankovic','Ivanovic','Milosavljevic','Ivanovic','Milutinovic','Obradovic', 'Milojevic','Cocic','Tomic'];
       $emails=['n@example.com','s@example.com', 'i@example.com', 'u@example.com', 'b@example.com','qq@example.com', 'qwe@example.com', 'qwer@example.com', 'qwerty@example.com'];
       $usernames=['q','qw','qwe','qwer','qwerty','z','zx','zxc','zxcv','zxcvb','trewq','bvcxz'];
       return [
           'firstName'=>$firstNames[rand(0, count($firstNames)-1)],
           'lastName'=>$lastNames[rand(0, count($lastNames)-1)],
           'email'=>$emails[rand(0, count($emails)-1)],
           'status'=>rand(0,1),
           'age'=>rand(7,77),
           'password'=>"",
           'username'=>$usernames[rand(0, count($usernames)-1)]
       ];
}
function populateUsers($count) {
    for ($i=0;$i<$count;$i++){
        $user= generateUser();
        saveUser($user);
    }
    echo "Generisano ". $count. " korisnika";
}
function generateArticle()
{
    $names = ['test', 'test 1', 'test 2', 'test 3', 'test 4', 'test 5', 'test 6', 'test 7', 'test 8', 'test 9'];
    $titles = ['test', 'test 1', 'test 2', 'test 3', 'test 4', 'test 5', 'test 6', 'test 7', 'test 8', 'test 9'];
    $descriptions = ['test', 'test 1', 'test 2', 'test 3', 'test 4', 'test 5', 'test 6', 'test 7', 'test 8', 'test 9'];
    $bodies = ['Lorem ipsum commodo maecenas morbi justo condimentum vel sapien enim varius mattis.', 'Lorem ipsum blandit iaculis curae lorem, scelerisque leo imperdiet felis orci, diam convallis orci blandit.','Lorem ipsum nisi in nisi.', 'Lorem ipsum donec lacus ullamcorper platea aenean risus tempus.', 'Lorem ipsum diam lacinia netus ligula egestas accumsan augue sagittis proin leo ultrices.', 'Lorem ipsum nulla pellentesque mattis dolor at curabitur vel cras.', 'Lorem ipsum venenatis erat viverra ullamcorper tempor mauris tristique commodo.', 'Lorem ipsum quisque ante hac cras fermentum donec sociosqu inceptos rutrum potenti tristique.', 'Lorem ipsum nulla vulputate massa.'];
    return [
            'name'=>$names[rand(0, count($names)-1)],
            'title'=>$titles[rand(0, count($titles)-1)],
            'description'=>$descriptions[rand(0, count($descriptions)-1)],
            'body'=>$bodies[rand(0, count($bodies)-1)],
    ];

}
function populateArticles($count)
{
    for ($i=0;$i<$count;$i++) {
        $article= generateArticle();
        saveArticleForm($article);
}
    echo "Generisano ". $count. " artikala";
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
    if (!$pdo->exec($sql)) {
        var_dump($pdo->errorInfo()[2]);
        die();
        throw new \Exception($pdo->errorInfo()[2]);
    }
}
function saveArticleForm($params)
{
    $random1= rand(0,10);
    $random2= rand(0,10);
    global $pdo;
    $sql = "INSERT INTO `article` (`articleId`, `title`, `description`, `body`, `categoryId`, `userId`) 
                VALUES (NULL, '{$params['title']}', '{$params['description']}', '{$params['body']}}', '{$random1}', '{$random2}')";
    if (!$pdo->exec($sql)) {
        var_dump($pdo->errorInfo()[2]);
        die();
        throw new \Exception($pdo->errorInfo()[2]);
    }
}
function saveCategoryForm($params)
{
    global $pdo;
    $sql = "INSERT INTO `category` (`categoryId`, `name`, `parentId`) VALUES (NULL, '{$params['categoryName']}',NULL)";
    if (!$pdo->exec($sql)){
        var_dump($pdo->errorInfo()[2]);
        die();
        throw new \Exception($pdo->errorInfo()[2]);
    }
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
function categoryUpdate($params)
{
    global $pdo;
    $sql = "UPDATE `category` SET
    `name`=`{$params['name']}`
    WHERE `name`='{$_GET['categoryId']}'";
    if (!$pdo->exec($sql)) {
        var_dump($pdo->errorInfo()[2]);
        die();
        throw new \Exception($pdo->errorInfo()[2]);
    }
}
function getUsers($params = null)
{
    global $pdo;
    $sql= "SELECT * FROM `user` ";
    if (isset($params['offset'])) {
        $sql .=" LIMIT {$params['offset']}, {$params['limit']}";
        return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }else {
        return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }
}
function getUserByEmail($email)
{
    global $pdo;
    $sql = " SELECT * FROM `user` WHERE `email` = '{$email}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
function getUserById($userId)
{
    global $pdo;
    $sql= "SELECT * FROM `user` WHERE `userId` = '{$userId}'";
    $statment= $pdo->query($sql);
    if (!$statment){
        var_dump($pdo->errorInfo()[2]);
        die();
        throw new \Exception($pdo->errorInfo()[2]);
    }
    $statment->fetch(PDO::FETCH_OBJ);
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
function getCategories()
{
    global $pdo;
    $sql = " SELECT * FROM `category` ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
}
function getCategoryByName()
{
    global $pdo;
    $sql = "SELECT * FROM `category` WHERE `name` = '{$_GET['categoryName']}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
function getArticleWithCategoryName($articleId)
{
    global $pdo;
    $sql = "SELECT a.*, c.name as categoryName FROM `article` a JOIN `category` c USING(`categoryId`) where categoryId='{$articleId}'";
    return $pdo->query($sql)->fetch(PDO::FETCH_OBJ);
}
function getArticlesWithUsername()
{
    global $pdo;
    $sql = "SELECT a.*, c.username FROM `article` a JOIN `user` c USING (`userId`)";
    return $pdo->query($sql)->fetchALL(PDO::FETCH_OBJ);
}
function getUsersWithLimit ($page)
{
    $perPage = 20;
    $offset= ($page-1)*($perPage);
    global $pdo;
    $sql= "SELECT * FROM `user` LIMIT {$offset}, {$perPage} ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
}
function getCategoryesWithLimit ($page)
{
    $perPage = 20;
    $offset= ($page-1)*($perPage);
    global $pdo;
    $sql= "SELECT * FROM `category` LIMIT {$offset}, {$perPage} ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
}
function getArticlesWithLimit ($page)
{
    $perPage = 20;
    $offset= ($page-1)*($perPage);
    global $pdo;
    $sql= "SELECT a.*,c.`username` FROM `article` a JOIN `user` c USING (`userId`) LIMIT {$offset}, {$perPage} ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
}
function getUserCount ()
{
    global $pdo ;
    $sql = "SELECT COUNT(*) AS usersCount FROM `user`";
    return $pdo->query($sql)->fetch();
}
?>



