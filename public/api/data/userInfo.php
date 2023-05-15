<?php
require_once "api/db.php";

function entry_point($email) {
	$db = db();
	$user = user();

	$result = command($db, "SELECT uid, name, email
	FROM User
	WHERE User.email = ?", [
		bind(1, $email, PDO::PARAM_STR)
	])->fetch();

	if ($result == false)
		throw new Err(404, "Email `$email` is not valid!");

	return $result;
}
?>
