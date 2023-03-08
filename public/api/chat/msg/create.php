<?php
require_once "api/db.php";
require_once "api/chat/access.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	$body = body();
	typecheck($body, "content", "string", "is_string");

	// Transaction Begin
	$db->beginTransaction();

	vacs_thread($db, $uid, $user);

	command($db, "INSERT INTO Message (thread, owner, content) VALUES (?, ?, ?)", [
		bind(1, $uid, PDO::PARAM_STR),
		bind(2, $user, PDO::PARAM_STR),
		bind(3, $body->content, PDO::PARAM_STR)
	]);
	$message_uid = $db->lastInsertId();

	$db->commit();
	// Transaction Commit

	return ["uid" => $message_uid];
}

?>
