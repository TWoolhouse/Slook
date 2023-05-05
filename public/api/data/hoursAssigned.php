<?php
require_once "api/db.php";


function entry_point($uid) {
    $db = db();
	$user = user();

	$displayProjects = $_GET['displayProjects'] ?? false;

    $result = command($db, "SELECT SUM(Task.wokerhours/(
        SELECT COUNT(user)
        FROM TaskUser
        WHERE TaskUser.task = Task.uid
    )) AS 'hoursOverall'
    FROM Task INNER JOIN TaskUser ON Task.uid = TaskUser.task
    WHERE TaskUser.user = ?", [
		bind(1, $uid, PDO::PARAM_STR)
	])->fetch();

    if ($displayProjects) {
        $projectShares = command($db, "SELECT Project.uid, Project.name, SUM(Task.wokerhours/(
            SELECT COUNT(user)
            FROM TaskUser
            WHERE TaskUser.task = Task.uid
        )) AS 'hoursAssigned'
        FROM Task, TaskUser, ProjectTask, Project
        WHERE Task.uid=TaskUser.task
        AND Task.uid = ProjectTask.task
        AND ProjectTask.project = Project.uid
        AND TaskUser.user = ?
        GROUP BY Project.name" , [
            bind(1, $uid, PDO::PARAM_STR)
        ])->fetchall();

        $result += ["projects" => $projectShares];
    }

    return $result;
}
?>