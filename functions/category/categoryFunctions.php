<?php

function saveCategoryForm($params)
{
    $userData = [
        'category' => $params['category'],
    ];
    $tmp = file_get_contents('category.json');
    if (strlen($tmp) === 0) {
        $data = [$userData];
    } else {
        $data = json_decode($tmp);
        $data[] = $userData;
    }
    return saveCategoriesJsonData($data);
}

function getCategory()
{
    $categories = file_get_contents('category.json');
    return json_decode($categories);
}

function getCategoryByName($name)
{
    foreach(getCategory() as $category) {
        if ($name == $category->category) {
            return $category;
        }
    }
}

function deleteCategory() {
    $dataArray = getCategoriesJsonData();
    $arrIndex = array();
    foreach($dataArray as $key => $value) {
        if ($key == $_GET["categoryId"]) {
        $arrIndex[] = $key;
        }
    }
    foreach ($arrIndex as $i) {
        unset($dataArray[$i]);
    }
    $dataArray = array_values($dataArray);
    saveCategoriesJsonData($dataArray);
}