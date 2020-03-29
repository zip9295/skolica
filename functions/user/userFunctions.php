<?php

function isLoggedIn()
{
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        return true;
    }

    return false;
}

function registerUser($params)
{
    $data = file_get_contents('storage.json');
    $data .= json_encode(['email' => $params['email'], 'password' => $params['password']]) . PHP_EOL;
    file_put_contents('storage.json', $data);
}

function saveUser($params)
{
   $data = getUsersJsonData();

    $lastItem = end($data);
    $lastItemId = $lastItem["id"];
    $userData = [
        "id" => ++$lastItemId,
        'email' => $params['email'],
        'password' => createPasswordHash($params['password']),
        'firstName' => $params['firstName'],
        'lastName' => $params['lastName'],
        'username' => $params['username'],
        'image' => saveImage(),
        'status' => $params['status']
    ];
    $tmp = file_get_contents('storage.json');
    if (strlen($tmp) === 0) {
        $data = [$userData];
    } else {
        $data = json_decode($tmp);
        $data[] = $userData;
    }

    saveUsersJsonData($data);
}

function deleteUser() {
    $data = getUsersJsonData();
    $arrIndex = array();
    foreach($data as $key => $value) {
        if ($key == $_GET["userId"]) {
        $arrIndex[] = $key;
        }
    }
    foreach ($arrIndex as $i) {
        unset($data[$i]);
    }
    $data = array_values($data);
    saveUsersJsonData($data);
}


function updateUser() {
    $data = getUsersJsonData();
    $image = saveImage();
    foreach ($data as $key =>$value) {
     if ($value["id"] == $_POST["id"]) {
        if ($_POST["password"] == "") {
            $data[$key]["password"] = $data[$key]["password"];
        }
        else {
            $data[$key]["password"] = md5($_POST["password"]);
        }     
         $data[$key]["username"] = $_POST["username"];
         $data[$key]["email"] = $_POST["email"];
         $data[$key]["firstName"] = $_POST["firstName"];
         $data[$key]["lastName"] = $_POST["lastName"];
         $data[$key]["status"] = $_POST["status"];
         if ($_FILES["image"]["error"] === 0) {
             $data[$key]["image"] = $image;
         }         
     }
    }
    $data = array_values($data);
    saveUsersJsonData($data);
}

function createPasswordHash($password)
{
    return md5($password);
}

function getUsers()
{
    $users = file_get_contents('storage.json');
    return json_decode($users);
}


function getUserByEmail($email)
{
    foreach (getUsers() as $user) {
        if ($email === $user->email) {
            return $user;
        }
    }

    return false;
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

function logOut()
{
    unset($_SESSION);
    session_destroy();
}

