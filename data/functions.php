<?php

function connect_db() {
	require("../config.php");

	return new mysqli($dbHost, $dbUserName, $dbPassword, $dbName, $dbPort);
}

function sendBadRequest() {
	header("HTTP/1.0 400 Bad Request");
	echo "Invalid request!";
	exit;
}

function sendUnauthorized() {
	header("HTTP/1.0 401 Unauthorized");
	echo "Not logged in!";
	exit;
}

?>
