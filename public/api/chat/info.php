<?php
require_once "api/db.php";
require_once "api/chat/access.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	// Find the Thread
	$thread = command($db, "SELECT Thread.*
	FROM Thread
	WHERE Thread.uid = ?", [
		bind(1, $uid, PDO::PARAM_INT)
	])->fetch();
	if ($thread == false) throw new Err(404, "Thread $uid does not exist!");

	// Check if the User is part of this thread
	vacs_thread($db, $uid, $user);

	// All Users in the Thread
	$users = command($db, "SELECT User.uid, User.email, User.name
	FROM User INNER JOIN ThreadViewer ON User.uid = ThreadViewer.user
	WHERE ThreadViewer.thread = ?", [
		bind(1, $uid, PDO::PARAM_INT)
	])->fetchAll();

	return [...$thread, "users" => $users];
}
?>
