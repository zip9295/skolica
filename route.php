<?php
function resolveRoute($config)
{
    global $message;
    if (!isset($_GET['route'])) {
        $route = 'home';
    } else {
        $route = $_GET['route'];
    }
    switch ($route) {
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
            $categories = getCategory();
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
            $user = getUserById($_GET['userId']);
            include('userForm.phtml');
            break;
        case 'articleUpdateForm' :
            $categories = getCategory();
            $article = getArticleWithCategoryName($_GET['articleId']);
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
            $users = [];
            if (isset($_GET['emailFilter'])) {
                array_push($users, getUserByEmail($_GET['emailFilter']));
            } else {
                $users = getUsers();
            }
            include 'userList.phtml';
            break;
        case 'articleList' :
            $article = [];
            $articleFilter = null;
            if (isset($_GET['articleFilter'])) {
                array_push($article, getArticleByTitle($_GET['articleFilter']));
            } else {
                $articles = getArticles();
            }
            include 'articleList.phtml';
            break;
        case 'populateUsersForm':
            include 'generateUsers.phtml';
            break;
        case 'populateUsers':
            populateUsers($_POST['count']);
            break;
        default:
            echo "default";
            break;
    }
}


//$page= $_GET($page)
//$perPage=20;
//$offset=($page-1)=$perPage
//LIMIT OFFSET, LIMIT
//Route=userList&page=1












































?>