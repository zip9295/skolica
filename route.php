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
            $categories = getCategories();
            include('articleForm.phtml');
            break;
        case 'categoryCreateForm' :
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
                saveCategoryForm($_POST);
                $categories = getCategories();
                include 'categoryCreate.phtml';
            break;
        case 'userUpdateForm':
            $user = getUserById($_GET['userId']);
            include('userForm.phtml');
            break;
        case 'articleUpdateForm' :
            $categories = getCategories();
            $article = getArticleWithCategoryName($_GET['articleId']);
            include 'articleForm.phtml';
            break;
        case 'categoryUpdateForm' :
            $category= getCategoryByName($_GET['categoryName']);
            include 'categoryCreate.phtml';
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
                $page = $_GET['page'];
                $perPage = 20;
                $offset= ($page-1)*($perPage);
                $users = getUsers(['offset'=>$offset, 'limit'=>$perPage]);
            }
            include 'userList.phtml';
            break;
        case 'articleList' :
            $articleFilter = null;
            if (isset($_GET['articleFilter'])) {
                array_push($article, getArticleByTitle($_GET['articleFilter']));
            } else {
                $articles= getArticlesWithLimit($_GET['page']);
            }
            include 'articleList.phtml';
            break;
        case 'categoryList' :
            $categories = getCategories();
            include 'categoryList.phtml';
            break;
        case 'populateUsersForm':
            include 'generateUsers.phtml';
            break;
        case 'populateUsers':
            populateUsers($_POST['count']);
            break;
        case 'populateArticlesForm':
            include 'generateArticles.phtml';
            break;
        case 'populateArticles':
            populateArticles($_POST['count']);
            break;
        default:
            echo "default";
            break;
    }
}
?>