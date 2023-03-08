<?php
require_once './../vendor/autoload.php';
require_once "router.php";
require_once "result.php";

// Current User Information
function user() {
	return $_COOKIE["uid"] ?? throw new Err(401, "Missing User Authorisation");
}
function body() {
	$input_body = file_get_contents('php://input');
	return json_decode($input_body, false);
}
function typecheck($body, $name, $type, $predicate=NULL) {
	if (!isset($body->$name)) throw new Err(422, "Missing Body Parameter! `$name`: $type");
	if ($predicate != NULL)
		if (!$predicate($body->$name)) throw new Err(422, "Body Parameter Invalid! `$name`: $type");
}

// Handlers
function execute_route_api(string $api, array &$route) {
	header('Content-Type: application/json; charset=utf-8');
	try {
		try {
			require_once ("./api/" . $api . ".php");
			$result = entry_point(...$route);
			echo json_encode($result);
		} catch (Err $e) {
			throw $e;
		} catch (PDOException $e) {
			throw new Err(500, "SQL Error", $e);
		} catch (\Throwable $e) {
			throw new Err(500, "API Route Error", $e);
		}
	} catch (Err $e) {
		http_response_code($e->getCode());
		echo json_encode($e->export());
	}
}
function execute_route_page(string $page, array &$route) {
	require_once ("./" . $page . ".php");
}


// ENTRY POINT

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
	$uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
	case FastRoute\Dispatcher::NOT_FOUND:
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode([
			"status" => 404,
			"route" => $uri,
		]);
		http_response_code(404);
		break;
	case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		$allowed_methods = implode(", ", $routeInfo[1]);
		header("Allow: $allowed_methods");
		http_response_code(405);
		break;
	case FastRoute\Dispatcher::FOUND:
		$handler = $routeInfo[1];
		$vars = $routeInfo[2];

		if (str_starts_with($handler, "page"))
			execute_route_page($handler, $vars);
		else
			execute_route_api($handler, $vars);
		break;
}
?>
