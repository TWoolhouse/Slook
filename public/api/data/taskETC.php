<?php
require_once "api/db.php";


function entry_point() {
    $db = db();
	$user = user();

	$taskID = $_GET['taskID'] ?? NULL;

    $result = command($db, "SELECT wokerhours / (SELECT COUNT(user)
    FROM TaskUser
	WHERE task = ?) AS 'ETC'
    FROM Task
	WHERE uid = ?", [
		bind(1, $taskID, PDO::PARAM_STR),
        bind(2, $taskID, PDO::PARAM_STR),
	])->fetch();

    $temp = command($db, "SELECT COUNT(user) AS 'usersAssigned'
    FROM TaskUser
	WHERE task = ?", [
		bind(1, $taskID, PDO::PARAM_STR),
	])->fetch();

    $result += $temp;

    return $result;
}
?>