<?php


function saveCategoriesJsonData($data) {
	file_put_contents('category.json', json_encode($data));
}

function getCategoriesJsonData() {
	$data = file_get_contents('category.json');
    $dataArray = json_decode($data,true);
    return $dataArray;
}