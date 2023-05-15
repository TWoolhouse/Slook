<?php
require_once "api/db.php";
require_once "api/img.php";

function entry_point($uid) {
	$db = db();
	$user = user();

	// TODO: Add timespan
	$timespan = $_GET['timespan'] ?? null;
	$step = $_GET["step"] ?? 1;

	date_default_timezone_set('Europe/London');

	$tasks = command($db, "SELECT Task.uid, Task.name, Task.created, Task.started, Task.completed
	FROM Task INNER JOIN TaskUser ON Task.uid = TaskUser.task
	WHERE TaskUser.user = ?
	ORDER BY Task.created ASC", [
		bind(1, $uid, PDO::PARAM_INT)
	])->fetchAll();

	if (ging()) {
		$prev = [
			"todo" => null,
			"in" => null,
			"done" => null,
		];
		$data = [
			"days" => [],
			"todo" => [],
			"in" => [],
			"done" => [],
		];

		$first = intdiv(floatval(date_create()->diff(date_create($tasks[0]["created"]))->format("%a")), $step) * $step;

		foreach (range($first, 0, -$step) as $_ => $i) {
			$date = date_create_immutable_from_format("U", strtotime("-$i days"));

			$status_of = function ($t, $key) use (& $date) {
				return ($t[$key] != null && $date->diff(date_create($t[$key]))->invert == 1);
			};

			$todo = array_filter($tasks, function ($t) use(& $status_of) {
				return $status_of($t, "created") && !($status_of($t, "started") || $status_of($t, "completed"));
			});
			$in = array_filter($tasks, function ($t) use(& $status_of) {
				return $status_of($t, "started") && !$status_of($t, "completed");
			});
			$done = array_filter($tasks, function ($t) use(& $status_of) {
				return $status_of($t, "completed");
			});

			$now = [
				"todo" => count($todo),
				"in" => count($in),
				"done" => count($done),
			];
			if ($i == $first || $i == 0) {
				$prev = $now;
				foreach ($prev as $key => $value) {
					$data[$key][] = $value;
				}
				$data["days"][] = $i;
			} else {
				foreach ($now as $key => $n) {
					if ($prev[$key] != $n) {
						$prev = $now;
						foreach ($prev as $key => $value) {
							$data[$key][] = $value;
						}
						$data["days"][] = $i;
						break;
					}
				}
			}
		}

		$days = array_map(function ($x) use ($first) { return -$x; }, $data["days"]);

		$graph = gprocess(gfig("Tasks", "Days Ago", "Count", true,
			gplot($days, $data["todo"], "Todo", "-", "o"),
			gplot($days, $data["in"], "In Progress", "-", "o"),
			gplot($days, $data["done"], "Complete", "-", "o")
		));
		return $graph;
	} else {
		return $tasks;
	}
}
?>
