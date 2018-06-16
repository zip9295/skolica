<?php
namespace config;
return [
    'user/loginForm' => ['\\Controller\\User' => 'loginForm'],
    'user/login' => ['user' => 'login'],
    'user/logout' => ['user' => 'logout'],
    'user/form' => ['user' => 'form'],
    'user/create' => ['user' => 'create'], 
    'user/update' => ['user' => 'update'],
    'user/getList' => ['\\Controller\\UserController' => 'getList'],
    'article/form' => ['article' => 'form'],
    'article/create' => ['article' => 'create'],
    'article/update' => ['article' => 'update'],
    'article/list' => ['article' => 'list'],
    'category/form' => ['category' => 'form'],
    'category/create' => ['category' => 'create'],
    'category/update' => ['category' => 'update'],
    'category/list' => ['category' => 'list'],
];
