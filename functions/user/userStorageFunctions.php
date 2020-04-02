<?php



function getUsersJsonDataRaw() {
	$file = file_get_contents("storage.json");
	return $file;
}

function getUsersJsonDataDecoded() {
	$file = getUsersJsonDataRaw();
    $data = json_decode($file, true);
    return $data;
}

function saveUsersJsonDataRaw($data) {
	file_put_contents('storage.json', $data);
}

function saveUsersJsonDataEncode($data) {
	file_put_contents('storage.json', json_encode($data));
}


