<?php
require_once "api/db.php";

function entry_point() {
	$db = db();
	$user = user();

	$result = command($db, "SELECT Thread.uid, Thread.name
	FROM Thread INNER JOIN ThreadViewer ON Thread.uid = ThreadViewer.thread INNER JOIN User ON ThreadViewer.user = User.uid
	WHERE User.uid = ?", [
		bind(1, $user, PDO::PARAM_STR)
	])->fetchAll();

	return $result;
}
?>
