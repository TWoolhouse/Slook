<?php
require_once "api/db.php";


function entry_point($uid) {
	$db = db();
	$user = user();

	$showUsers = isset($_GET["users"]);

	$result = command($db, "SELECT workerhours / (SELECT COUNT(user)
	FROM TaskUser
	WHERE task = ?) AS 'ETC', workerhours
	FROM Task
	WHERE uid = ?", [
		bind(1, $uid, PDO::PARAM_INT),
		bind(2, $uid, PDO::PARAM_INT),
	])->fetch();

	if ($result == false)
		throw new Err(404, "Task `$uid` does not exist!");

	$out = [
		"raw" => $result["workerhours"],
		"hours" => floatval($result["ETC"]),
	];

	if ($showUsers) {
		$users = command($db, "SELECT User.uid, User.name, User.email
		FROM TaskUser INNER JOIN User ON TaskUser.user = User.uid
		WHERE task = ?", [
			bind(1, $uid, PDO::PARAM_INT),
		])->fetchAll();
		$out["users"] = $users == false ? null : $users;
	}

	return $out;
}
?>
