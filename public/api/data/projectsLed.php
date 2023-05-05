<?php
require_once "api/db.php";


function entry_point($uid) {
    $db = db();
	$user = user();

	$showDetails = $_GET['details'] ?? false;

    $result = command($db, "SELECT COUNT(uid) AS 'amountOfProjectsLed'
    FROM Project
	WHERE leader = ?", [
		bind(1, $uid, PDO::PARAM_STR)
	])->fetch();

    if ($showDetails) {
        $projectShares = command($db, "SELECT uid AS 'projectUID', name AS 'projectName'
        FROM `Project`
        WHERE leader = ?;" , [
            bind(1, $uid, PDO::PARAM_STR)
        ])->fetchall();

        $result += ["projects" => $projectShares];
    }

    return $result;
}
?>