<?php
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
	// API
	$r->addRoute("GET", "/chat", "chat/all");
	$r->addRoute("POST", "/chat/create", "chat/create");
	$r->addRoute("GET", "/chat/{uid:\d+}", "chat/info");
	$r->addRoute("POST", "/chat/{uid:\d+}/message", "chat/msg/create");
	$r->addRoute("GET", "/chat/{uid:\d+}/message", "chat/msg/read");
	$r->addRoute("POST", "/chat/{uid:\d+}/invite", "chat/invite");

	// Page
	$r->addRoute("GET", "/login", "page/login");
	$r->addRoute("GET", "/info", "page/info");
});
?>
