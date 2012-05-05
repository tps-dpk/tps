<?php

error_reporting(E_ALL);

require("../config.php");

function sendUnauthorized() {
	header("HTTP/1.0 401 Unauthorized");
	echo "Login failed!";
	exit;
}

function sendBadRequest() {
	header("HTTP/1.0 400 Bad Request");
	echo "Invalid request!";
	exit;
}

session_start();

if (empty($_SESSION["benutzername_om"])) {
	sendUnauthorized();
}

if (empty($_REQUEST["nummer"]) || empty($_REQUEST["status"])) {
	sendBadRequest();
}

$status = $_REQUEST["status"];

if ($status == "angenommen") {
	$status = "A";
} else if ($status == "abgelehnt") {
	$status = "R";
} else if ($status == "abgeschlossen") {
	$status = "F";
} else {
	sendBadRequest();
}

$dbConnection = new mysqli($dbHost, $dbUserName, $dbPassword, $dbName, $dbPort);
$sql = "UPDATE auftrag SET auftragsstatus = ? WHERE auftragsnummer = ?";
$statement = $dbConnection->prepare($sql);
$statement->bind_param("si", $status, $_REQUEST["nummer"]);
$statement->execute();

if ($statement->affected_rows == 1) {
	echo "ok";
} else {
	sendBadRequest();
}

?>
