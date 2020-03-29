<?php

function validateArticleForm()
{
    if (isset($_POST['body']) && strlen($_POST['body']) < 1 || isset($_POST['category']) && strlen($_POST['category']) < 1 || isset($_POST['user']) && strlen($_POST['user']) < 1) {
        return false;
    }
    return true;

}