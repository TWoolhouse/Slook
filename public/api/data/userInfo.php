<?php
require_once "api/db.php";

function entry_point() {
	$db = db();
	$user = user();

    $inputUser = $_GET['email'] ?? NULL;

	$result = command($db, "SELECT uid, name, email, role 
    FROM User
	WHERE User.email = ?", [
		bind(1, $inputUser, PDO::PARAM_STR)
	])->fetch();

	return $result;
}
?>