<?php

function saveArticleForm($params)
{
    //$fileName = saveImage();
    $articleData = [
        'title' => $params['title'],
        'description' => $params['description'],
        'body' => $params['body'],
        'category' => $params['category'],
        'user' => $params['user'],
        //'image' => $fileName,
    ];
    $tmp = file_get_contents('article.json');
    if (strlen($tmp) === 0) {
        $data = [$articleData];
    } else {
        $data = json_decode($tmp);
        $data[] = $articleData;
    }
    return saveArticlesJsonData($data);
}

function getArticleByTitle($title)
{
    foreach (getArticles() as $article) {
        if ($title === $article->title) {
            return $article;
        }
    }

    return false;
}

function deleteArticle() {
	$dataArray = getArticlesJsonData();
    $arrIndex = array();
    foreach($dataArray as $key => $value) {
        if ($key == $_GET["articleId"]) {
        $arrIndex[] = $key;
        }
    }
    foreach ($arrIndex as $i) {
        unset($dataArray[$i]);
    }
    $dataArray = array_values($dataArray);
    saveArticlesJsonData($dataArray);

}

function getArticles()
{
    $articles = file_get_contents('article.json');
    return json_decode($articles);
}

function saveArticle($params)
{
//    $articleData = [
//        'title' => $params['title']
//    ];

    $articles = [];
    foreach (getArticles() as $article) {
        if ($article->title === trim($params['title'])) {
            $articles[] = $params;
        } else {
            $articles[] = $params;
        }

    }

    return saveArticlesJsonData($articles);
}