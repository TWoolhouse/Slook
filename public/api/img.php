<?php
function extract_override() {
	return [
		"title" => $_GET["title"] ?? null,
		"xlabel" => $_GET["xlabel"] ?? null,
		"ylabel" => $_GET["ylabel"] ?? null,
	];
}

function gfig($title, $xlabel, $ylabel, $legend, ...$plots) {
	return [
		"title" => $title,
		"xlabel" => $xlabel,
		"ylabel" => $ylabel,
		"legend" => $legend,
		"plots" => $plots,
	];
}

function gplot($x, $y, $label, $type, $marker) {
	$cfg = ["type" => $type ?? "-"];
	if ($label !== null) {
		$cfg["label"] = $label;
	}
	if ($marker !== null) {
		$cfg["marker"] = $marker;
	}
	return [$x, $y, $cfg];
}

function ging() {
	return isset($_GET["img"]) || isset($_GET["imgr"]);
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
			call_user_func([$graph, $key], $c != null ? $c : $data[$key]);
		}
		if ($data["legend"])
			$graph->legend();

		return [
			"graph" => $graph->output_gd_png_base64(),
		];
	}
	elseif (isset($_GET["imgr"])) {
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
			if ($c !== null)
				$data[$key] = $c;
		}

		return $data;
	}
}
?>
