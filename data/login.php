<?php

error_reporting(E_ALL);

require("functions.php");

if (empty($_REQUEST["name"]) || empty($_REQUEST["password"])) {
	sendUnauthorized();
}

$dbConnection = connect_db();
$sql = "SELECT COUNT(*) FROM mitarbeiter WHERE benutzername = ? AND passwort = ? AND mitarbeitertyp = \"OM\"";
$statement = $dbConnection->prepare($sql);
$statement->bind_param("ss", strtoupper($_REQUEST["name"]), $_REQUEST["password"]);
$statement->execute();
$statement->bind_result($count);

if ($statement->fetch() && $count == 1) {
	session_start();
	$_SESSION["benutzername_om"] = strtoupper($_REQUEST["name"]);
	echo "Ok";
} else {
	sendUnauthorized();
}

?>
