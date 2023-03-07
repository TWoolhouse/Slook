<?php
require_once './../vendor/autoload.php';

function execute_route(string $api, array &$route) {
	require_once ("./api/" . $api . ".php");
	return entry_point(...$route);
}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
	$r->addRoute('GET', '/chat/{uid:\d+}', "chat/all");
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
	$uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

header('Content-Type: application/json; charset=utf-8');
switch ($routeInfo[0]) {
	case FastRoute\Dispatcher::NOT_FOUND:
		// ... 404 Not Found
		echo json_encode(array(
			"status" => 404,
			"route" => $uri,
		));
		http_response_code(404);
		break;
	case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		$allowedMethods = $routeInfo[1];
		// ... 405 Method Not Allowed
		http_response_code(405);
		break;
	case FastRoute\Dispatcher::FOUND:
		$handler = $routeInfo[1];
		$vars = $routeInfo[2];
		echo json_encode(execute_route($handler, $vars));
		break;
}
?>
