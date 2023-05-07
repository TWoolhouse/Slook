<?php
require_once "api/db.php";


function entry_point($uid) {
    $user = user();
    $db = db();

    $timespan = $_GET['timespan'] ?? 7;

    date_default_timezone_set('Europe/London');
    $now = date('Y-m-d H:i:s');
    $then = date('Y-m-d H:i:s', strtotime(strval($timespan) . " days ago"));

    $result = command($db, "SELECT COUNT(Task.uid) AS 'numOfTasksCompleted', COUNT(Task.uid)/? AS 'taskEfficiency'
    FROM Task INNER JOIN TaskUser ON Task.uid = TaskUser.task 
    WHERE TaskUser.user = ? 
    AND (Task.completed BETWEEN ? AND ?);", [
        bind(1, $timespan, PDO::PARAM_STR),
        bind(2, $uid, PDO::PARAM_STR),
        bind(3, $then, PDO::PARAM_STR),
        bind(4, $now, PDO::PARAM_STR)
    ])->fetch();

    return $result;
}
?>