<?php

function getUsersJsonData() {
	$file = file_get_contents("storage.json");
    $data = json_decode($file, true);
    return $data;
}

function saveUsersJsonData($data) {
	file_put_contents('storage.json', json_encode($data));
}


