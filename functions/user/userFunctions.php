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
    $data = getUsersJsonDataRaw();
    $data .= json_encode(['email' => $params['email'], 'password' => $params['password']]) . PHP_EOL;
    saveUsersJsonDataRaw($data);
}

function saveUser($params)
{
   $data = getUsersJsonDataDecoded();

    $lastItemId = getLastUserID($data);
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
    $tmp = getUsersJsonDataRaw();
    if (strlen($tmp) === 0) {
        $data = [$userData];
    } else {
        $data = json_decode($tmp);
        $data[] = $userData;
    }

    saveUsersJsonDataEncode($data);
}

function deleteUser() {
    $data = getUsersJsonDataDecoded();
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
    saveUsersJsonDataEncode($data);
}


function updateUser() {
    $data = getUsersJsonDataDecoded();
    $image = saveImage();
    $dataX = mapUpdatedUser($data,$image);
    $dataNew = array_values($dataX);
    saveUsersJsonDataEncode($dataNew);
}

function createPasswordHash($password)
{
    return md5($password);
}

function getUsers()
{
    $users = getUsersJsonDataRaw();
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

function getLastUserID($data) {
    $lastItem = end($data);
    $lastItemId = $lastItem["id"];
    return $lastItemId;
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

function mapUpdatedUser($data,$image) {
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
    return $data;
}
