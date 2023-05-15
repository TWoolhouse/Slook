<?php
require_once "api/db.php";
require_once "api/img.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	$showProjects = isset($_GET['projects']);
	$showTasks = isset($_GET['tasks']);

	$result = command($db, "SELECT COUNT(user) AS 'count'
	FROM TaskUser
	WHERE user = ?", [
		bind(1, $uid, PDO::PARAM_STR)
	])->fetch();

	if ($showProjects) {
		$projectShares = command($db, "SELECT ProjectTask.project as uid, Project.name AS name, COUNT(ProjectTask.project) AS 'count'
		FROM (`TaskUser` INNER JOIN `ProjectTask` ON ProjectTask.task = TaskUser.task) INNER JOIN `Project` ON Project.uid = ProjectTask.project
		WHERE TaskUser.user = ?
		GROUP BY ProjectTask.project;" , [
			bind(1, $uid, PDO::PARAM_INT)
		])->fetchall();

		if (ging()) {
			$figures = [];
			$offset_index = count($projectShares) > 1 ? 0 : 1;
			$offset_size = count($projectShares) > 1 ? 0 : 2;
			foreach ($projectShares as $i => $project) {
				$hours = array_fill(0, count($projectShares) + $offset_size, 0);
				$hours[$i + $offset_index] = $project["count"];
				$figures[] = gplot(null, $hours, $project["name"], "bar", "s");
			}

			$result["projects"] = gprocess(gfig("Tasks Assigned", "Project", "Count", true,
				...$figures
			));
			$result["plot"] = "projects";
		} else {
			$result["projects"] = $projectShares;
		}
	}

	if ($showTasks) {
		$tasks = command($db, "SELECT TaskUser.task as uid
		FROM TaskUser
		WHERE TaskUser.user = ?
		GROUP BY TaskUser.task;" , [
			bind(1, $uid, PDO::PARAM_INT)
		])->fetchall();
		$ts = [];
		foreach ($tasks as $_ => $t) {
			$ts[] = $t["uid"];
		}
		$result["tasks"] = $ts;
	}

	return $result;
}
?>
