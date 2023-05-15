<?php
require_once "api/db.php";


function entry_point($uid) {
	$db = db();
	$user = user();

	$showDetails = isset($_GET['projects']);

	$result = command($db, "SELECT COUNT(uid) AS 'leading'
	FROM Project
	WHERE leader = ?", [
		bind(1, $uid, PDO::PARAM_STR)
	])->fetch();

	if ($showDetails) {
		$projectShares = command($db, "SELECT uid, name
		FROM `Project`
		WHERE leader = ?;" , [
			bind(1, $uid, PDO::PARAM_INT)
		])->fetchall();

		$result += ["projects" => $projectShares];
	}

	return $result;
}
?>
