<?php
function extract_override() {
	return [
		"title" => $_GET["title"] ?? null,
		"xlabel" => $_GET["xlabel"] ?? null,
		"ylabel" => $_GET["ylabel"] ?? null,
	];
}

function gfig($title, $xlabel, $ylabel, ...$plots) {
	return [
		"title" => $title,
		"xlabel" => $xlabel,
		"ylabel" => $ylabel,
		"plots" => $plots,
	];
}

function gplot($x, $y, string $label, $type, $marker) {
	$cfg = ["type" => $type ?? "-"];
	if ($label !== null) {
		$cfg["label"] = $label;
	}
	if ($marker !== null) {
		$cfg["marker"] = $marker;
	}
	return [$x, $y, $cfg];
}

function gprocess($data) {
	$cfg = extract_override();

	if (isset($_GET["img"])) {
		require_once("img/lib.php");
		$graph = new graph();

		foreach ($data["plots"] as $_ => &$plot) {
			$x = $plot[0];
			$y = $plot[1];

			if ($x === null) {
				$plot[0] = $y;
				$plot[1] = null;
			}
		}
		$graph->plot($data["plots"]);

		foreach (["title", "xlabel", "ylabel"] as $_ => $key) {
			$c = $cfg[$key];
			if ($c !== null) {
				call_user_func([$graph, $key], $c ? $c : $data[$key]);
			}
		}
		$graph->legend();

		return [
			"graph" => $graph->output_gd_png_base64(),
		];
	}
	else {
		$from = $data["plots"];
		$plots = [];

		foreach ($from as $_ => &$plot) {
			$plots[] = [
				"x" => $plot[0],
				"y" => $plot[1],
				"style" => $plot[2],
			];
		}
		$data["plots"] = $plots;

		foreach (["title", "xlabel", "ylabel"] as $_ => $key) {
			$c = $cfg[$key];
			$data[$key] = $c ? $c : null;
		}

		return $data;
	}
}
?>
