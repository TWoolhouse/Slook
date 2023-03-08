<?php
require_once "api/db.php";
require_once "api/chat/access.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	$body = body();
	typecheck($body, "others", "User[uid][]", "is_array");

	// Transaction Begin
	$db->beginTransaction();

	vacs_thread($db, $uid, $user);

	$existing = array_map(function($user) {
		return $user["uid"];
	},
	command($db, "SELECT User.uid
	FROM User INNER JOIN ThreadViewer ON User.uid = ThreadViewer.user
	WHERE ThreadViewer.thread = ?", [
		bind(1, $uid, PDO::PARAM_INT)
	])->fetchAll());

	$new_users = array_diff($body->others, $existing);
	foreach ($new_users as $user) {
		command($db, "INSERT INTO ThreadViewer VALUES (?, ?)", [
			bind(1, $uid, PDO::PARAM_INT),
			bind(2, $user, PDO::PARAM_INT)
		]);
	}

	$db->commit();
	// Transaction Commit

	return $new_users;
}

?>
