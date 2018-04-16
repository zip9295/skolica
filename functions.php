<?php
     function validateRegisterForm($params){
          if (!is_array($params)) {
               throw new Exception('Given param is not an array');
          }
          if(isset($params['email']) and isset($params['password']) and isset($params['password-2'])) {
               if(  (strlen($params['email']) > 6 and strlen($params['email'] <= 20) and strstr($params['email'], '@', true)) and
               (strlen($params['password']) > 6 and strlen($params['password']) <= 14) and ($params['password-2'] === $params['password'])) {
                    return true;
               }
               else {
                    echo "nije ok";
                    return false;
               }
          }
          else {
               return false;
          }
     }

function validateUserForm($params){
    if (!is_array($params)) {
        throw new Exception('Given param is not an array');
    }
    if(isset($params['email']) and isset($params['password']) and isset($params['password-2']) and isset($params['firstName']) and isset($params['lastName']) and isset($params['username'])) {
        if(
            (strlen($params['email']) > 6 and strlen($params['email'] <= 20) and strstr($params['email'], '@', true)) and
            (strlen($params['password']) > 6 and strlen($params['password']) <= 14) and
            ($params['password-2'] === $params['password']) and
            (strlen($params['firstName']) > 2 and strlen($params['firstName']) < 32) and
            (strlen($params['lastName']) > 2 and strlen($params['lastName']) < 32) and
            (strlen($params['username']) > 2 and strlen($params['username']) < 32)
            // (strlen($params['email']) > 6 and strlen($params['email'] <= 20) and strstr($params['email'], '@', true)) and
            // (strlen($params['password']) > 6 and strlen($params['password']) <= 14) and
            // ($params['password-2'] === $params['password']) and
            // (strlen($params['firstName']) > 2 and strlen($params['firstName']) < 32 and preg_match("/[^a-zA-Z\_-]/i", $params['firstName'])) and
            // (strlen($params['lastName']) > 2 and strlen($params['lastName']) < 32 and preg_match("/[^a-zA-Z\_-]/i", $params['lastName'])) and
            // (strlen($params['username']) > 2 and strlen($params['username']) < 32 and preg_match("/[^a-zA-Z0-9\_-]/i", $params['username']))
        ) {
            return true;
        }
        else {
            echo "nije ok";
            return false;
        }
    }
    else {
        return false;
    }
}
    function saveUser($params){

        $fileName = saveImage();
        $userData = [
            'email' => $params['email'],
            'password' => $params['password'],
            'firstName' => $params['firstName'],
            'lastName' => $params['lastName'],
            'username' => $params['username'],
            'image' => $fileName,
            'status' => $params['status']
        ];
        $tmp = file_get_contents('storage.json');
        if(strlen($tmp) === 0){
            $data = [$userData];
        }
        else {
            $data = json_decode($tmp);
            $data[] = $userData;
        }
        return file_put_contents('storage.json',json_encode($data));
    }
        function saveImage(){
            $fileName = APP_PATH . '/images/' . $_FILES['image']['name'];
            if(!move_uploaded_file($_FILES['image']['tmp_name'], $fileName)){
                echo "Nismo snimili sliku";
                die();
            }
            return 'images/'.$_FILES['image']['name'];
        }

     function registerUser($params){
          $data = file_get_contents('storage.json');
          $data .= json_encode(['email' => $params['email'], 'password' => $params['password'] ]) . PHP_EOL;
          file_put_contents('storage.json', $data);
     }

     function getUserByEmail($email){
          foreach (getUsers() as $user) {
               if($email === $user->email){
                    return $user;
               }
          }

          return false;
     }
     function login($email, $password){
          $user = getUserByEmail($email);
          if(!$user){
               return false;
          }
          if($password === $user->password){
              $_SESSION['isLoggedIn'] = true;
              return true;
          }
          return false;
     }

     function bootstrap(){
          session_start();
          error_reporting(E_ALL);
          ini_set('display_errors', 1);
     }
     /*
      * Get users from file storage
      * Return array
      */
     function getUsers () {
         $users = file_get_contents('storage.json');
         return json_decode($users);
     }
     function isLoggedIn () {
          if (isset($_SESSION['isLoggedIn'] ) && $_SESSION['isLoggedIn'] === true) {
               return true;
          }

          return false;
     }
     function redirect ($baseUrl, $route='', $statusCode= 302) {
          header ('location:'. $baseUrl. $route, $statusCode) ;
     }
     function logOut () {
          unset($_SESSION);
          session_destroy();
     }
 ?>
