<?php
require_once "api/db.php";
require_once "api/chat/access.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	$limit = min($_GET["limit"] ?? 20, 100);
	$cursor = $_GET["cursor"] ?? NULL;

	vacs_thread($db, $uid, $user);

	$bindings = [
		bind(":thread", $uid, PDO::PARAM_STR),
		bind(":limit", $limit, PDO::PARAM_INT)
	];

	$dir = isset($_GET["fwd"]) ? "ASC" : "DESC";
	if ($cursor != NULL) {
		array_push($bindings, bind(":cursor", $cursor, PDO::PARAM_INT));
		$d = $dir == "ASC" ? ">" : "<";
		$cursor = " AND Message.uid $d :cursor";
	} else {
		$cursor = "";
	}

	return command($db, "SELECT Message.*
	FROM Message
	WHERE Message.thread = :thread $cursor
	ORDER BY Message.uid $dir
	LIMIT :limit", $bindings)->fetchAll();
}

?>
