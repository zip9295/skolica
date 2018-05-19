<?php
function resolveRoute($config)
{
    global $message;
    if (!isset($_GET['route'])) {
        $route = 'home';
    } else {
        $route = $_GET['route'];
    }
    switch ($route)
    {
        case 'loginForm':
            include('loginForm.phtml');
            break;

        case 'login':
            if (validateLoginForm($_POST) and login($_POST['email'], $_POST['password'])) {
                redirect($config['baseUrl'], '&message=loggedIn');

            } else {
                echo "Nisu dobri parametri";
                include('loginForm.phtml');
            }
            break;
        case 'userLogout' :
            logOut();
            redirect($config['baseUrl']);
            break;
        case 'registerForm':
            include('userForm.phtml');
            break;
        case 'userCreateForm':
            include('userForm.phtml');
            break;
        case 'articleCreateForm' :
            $categories= getCategory();
            include('articleForm.phtml');
            break;
        case 'categoryCreateForm' :
            $categories = getCategory();
            include 'categoryCreate.phtml';
            break;
        case 'userCreate':
            $valid = validateUserForm($_POST);
            if (!$valid) {
                global $message;
                $message = $valid;
            } else {
                if (!saveUser($_POST)) {
                    $message = 'Doslo je do greske prilikom snimanja korisnika';
                } else {
                    echo "Korisnik je uspesno sacuvan";
                }
            }
            break;
        case 'articleCreate' :
            if (!saveArticleForm($_POST)) {
                $message = 'Doslo je do greske prilikom snimanja clanka';
            } else {
                echo "Clanak uspesno sacuvan";

            }
            break;
        case 'categoryCreate' :
            if (!saveCategoryForm($_POST)) {
                $message = 'Doslo je do greske prilikom snimanja';
            } else {
                echo "Kategorija je uspesno snimljena u bazu";
                $categories = array();
                $categories = getCategory();
                include 'categoryCreate.phtml';
            }
            break;
        case 'userUpdateForm':
            $user = getUserByEmail($_GET['email']);
            include('userForm.phtml');
            break;
        case 'articleUpdateForm' :
            $categories= array();
            $categories= getCategory();
            $article = getArticleByTitle($_GET['title']);
            include 'articleForm.phtml';
            break;
        case 'userUpdate':
            userUpdate($_POST);
            break;
        case 'articleUpdate' :
            articleUpdate($_POST);
            break;
        case 'categoryUpdate' :
            categoryUpdate($_POST);
            break;
        case 'userList':
            if (isset($_GET['message']) && $_GET['message'] === 'logedIn') {
                $message = 'Uspesno ste se ulogovali';
            }
            $emailFilter = null;
            if (isset($_GET['emailFilter'])) {
                array_push($users, getUserByEmail($_GET['emailFilter']));
            } else {
                $users = getUsers();
            }
            include 'userList.phtml';
            break;
        case 'articleList' :
            $articles = array();
            $articleFilter = null;
            if (isset($_GET['articleFilter'])) {
                array_push($article, getArticleByTitle($_GET['articleFilter']));
            } else {
                $articles = getArticles();
            }
            include 'articleList.phtml';
            break;
        default:
            echo "default";
            break;
    }
}
















































?>