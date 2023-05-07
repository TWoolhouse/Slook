<?php
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
	// Chat API
	$r->addRoute("GET", "/chat", "chat/all");
	$r->addRoute("POST", "/chat/create", "chat/create");
	$r->addRoute("GET", "/chat/{uid:\d+}", "chat/info");
	$r->addRoute("POST", "/chat/{uid:\d+}/message", "chat/msg/create");
	$r->addRoute("GET", "/chat/{uid:\d+}/message", "chat/msg/read");
	$r->addRoute("POST", "/chat/{uid:\d+}/invite", "chat/invite");

	//Data Analytics API
	$r->addRoute("GET", "/data", "data/userInfo"); //All user info
	$r->addRoute("GET", "/data/{uid:\d+}/tasksAssigned", "data/tasksAssigned"); //Number of Tasks Assigned
	$r->addRoute("GET", "/data/{uid:\d+}/projectsLed", "data/projectsLed"); //Numbers of Projects Lead
	$r->addRoute("GET", "/data/{uid:\d+}/productivity", "data/efficiency"); //Avg tasks completed within timespan
	$r->addRoute("GET", "/data/{uid:\d+}/hoursAssigned", "data/hoursAssigned"); //Assigned Hours for user
	$r->addRoute("GET", "/data/estimatedCompletionTime", "data/taskETC"); //Estimate Completion of Task based on assignees & hours.

	// Pages
	$r->addRoute("GET", "/info", "page/info"); // dev
	$r->addRoute("GET", "/login", "page/login");
	$r->addRoute("GET", "/home", "page/home");
	$r->addRoute("GET", "/", "page/home");

	$r->addRoute("GET", "/msg", "page/chat");
});
?>
