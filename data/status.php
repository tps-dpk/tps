<?php

require("functions.php");

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

$dbConnection = connect_db();
$sql = "UPDATE auftrag SET auftragsstatus = ? WHERE auftragsnummer = ?";
$statement = $dbConnection->prepare($sql);
$statement->bind_param("si", $status, $_REQUEST["nummer"]);
$statement->execute();

if ($statement->affected_rows == 1) {
	echo "Ok";
} else {
	sendBadRequest();
}

?>
