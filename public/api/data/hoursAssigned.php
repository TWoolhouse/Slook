<?php
require_once "api/db.php";
require_once "api/img.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	$displayProjects = isset($_GET['projects']);

	$result = command($db, "SELECT SUM(Task.workerhours/(
		SELECT COUNT(user)
		FROM TaskUser
		WHERE TaskUser.task = Task.uid
	)) AS 'hours'
	FROM Task INNER JOIN TaskUser ON Task.uid = TaskUser.task
	WHERE TaskUser.user = ?", [
		bind(1, $uid, PDO::PARAM_STR)
	])->fetch();

	if ($result == false)
		throw new Err(404, "User `$uid` does not exist!");

	$result["hours"] = floatval($result["hours"]);

	if ($displayProjects) {
		$projectShares = command($db, "SELECT Project.uid, Project.name, SUM(Task.workerhours/(
			SELECT COUNT(user)
			FROM TaskUser
			WHERE TaskUser.task = Task.uid
		)) AS 'hours'
		FROM Task, TaskUser, ProjectTask, Project
		WHERE Task.uid=TaskUser.task
		AND Task.uid = ProjectTask.task
		AND ProjectTask.project = Project.uid
		AND TaskUser.user = ?
		GROUP BY Project.uid" , [
			bind(1, $uid, PDO::PARAM_STR)
		])->fetchall();

		if (ging()) {
			$figures = [];
			$offset_index = count($projectShares) > 1 ? 0 : 1;
			$offset_size = count($projectShares) > 1 ? 0 : 2;
			foreach ($projectShares as $i => $project) {
				$hours = array_fill(0, count($projectShares) + $offset_size, 0);
				$hours[$i + $offset_index] = $project["hours"];
				$figures[] = gplot(null, $hours, $project["name"], "bar", "s");
			}

			$result["projects"] = gprocess(gfig("Hours Assigned", "Project", "Hours", true,
				...$figures
			));
			$result["plot"] = "projects";
		} else {
			$result["projects"] = $projectShares;
		}

	}

	return $result;
}
?>
