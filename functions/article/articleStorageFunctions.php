<?php

function getArticlesJsonData() {
	$data = file_get_contents('article.json');
    $dataArray = json_decode($data,true);
    return $dataArray;
}

function saveArticlesJsonData($data) {
	file_put_contents("article.json", json_encode($data));
}