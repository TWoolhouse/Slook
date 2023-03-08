<?php

function create_database_connection($hostname, $dbname, $username, $password) {
	try {
		$_db_connection = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		$_db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $_db_connection;
	} catch(PDOException $e) {
		throw new Err(500, "Database is unavalible!", $e);
	}
}

function db() {
	return create_database_connection("localhost", "slook", "dbagent", "slook");
}

function command(mixed &$database, string $statement, $bindings=[]) {
	try {
		$stmt = $database->prepare($statement);
		foreach ($bindings as $binding) {
			$stmt->bindParam(...$binding);
		}
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $stmt;
	} catch (\Throwable $e) {
		if ($database->inTransaction())
			$database->rollback();
		throw $e;
	}
}

function bind($slot, $value, $type) {
	return [$slot, $value, $type];
}

?>
