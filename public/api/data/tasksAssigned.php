<?php
require_once "api/db.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	$showDetails = $_GET['showDetails'] ?? false;

    $result = command($db, "SELECT COUNT(user) AS 'amountOverall'
    FROM TaskUser
	WHERE user = ?", [
		bind(1, $uid, PDO::PARAM_STR)
	])->fetch();

    if ($showDetails) {
        $projectShares = command($db, "SELECT ProjectTask.project AS 'projectUID', Project.name AS 'projectName', COUNT(ProjectTask.project) AS 'amountAssigned'
        FROM (`TaskUser` INNER JOIN `ProjectTask` ON ProjectTask.task = TaskUser.task) INNER JOIN `Project` ON Project.uid = ProjectTask.project
        WHERE TaskUser.user = ?
        GROUP BY ProjectTask.project;" , [
            bind(1, $uid, PDO::PARAM_STR)
        ])->fetchall();

        $result += ["details" => $projectShares];
    }

    return $result;
}
?>