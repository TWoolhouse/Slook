<?php
require_once "api/db.php";

function entry_point() {
	$db = db();
	$user = user();

	$body = body();
	typecheck($body, "name", "string", "is_string");
	typecheck($body, "with", "User[uid][]", "is_array");

	// Transaction Begin
	$db->beginTransaction();

	command($db, "INSERT INTO Thread (name) VALUES (?)", [
		bind(1, $body->name, PDO::PARAM_STR)
	]);
	$thread_id = $db->lastInsertId();

	array_push($body->with, $user);
	foreach (array_unique($body->with) as $user) {
		command($db, "INSERT INTO ThreadViewer VALUES (?, ?)", [
			bind(1, $thread_id, PDO::PARAM_INT),
			bind(2, $user, PDO::PARAM_INT)
		]);
	}

	$db->commit();
	// Transaction Commit

	return ["uid" => $thread_id];
}

?>
