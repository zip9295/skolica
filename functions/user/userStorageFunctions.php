<?php



function getUsersJsonDataRaw() {
	$UsersJson = file_get_contents("storage.json");
	$cachedUsersJson = file_get_contents("cached.json");
	if (file_exists("cached.json") && strlen($cachedUsersJson) > 0) {
		$file = $cachedUsersJson;
	}
	elseif (file_exists("cached.json") && strlen($cachedUsersJson) == 0) {
		file_put_contents("cached.json",$UsersJson);
		$file = $UsersJson;
	}
	else {
	$file = $UsersJson;
}
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


