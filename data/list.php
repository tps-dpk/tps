<?php

error_reporting(E_ALL);

require("../config.php");

function sendUnauthorized() {
	header("HTTP/1.0 401 Unauthorized");
	echo "Login failed!";
	exit;
}

session_start();

if (empty($_SESSION["benutzername_om"])) {
	sendUnauthorized();
}

$dbConnection = new mysqli($dbHost, $dbUserName, $dbPassword, $dbName, $dbPort);
$sql = "SELECT a.auftragsnummer, a.zeit_von, a.zeit_bis, a.beschreibung, a.auftragsstatus, k.name, k.strasse, k.hausnummer, k.plz, k.ort, k.telefonnummer"
	. "FROM auftrag a, kunde k"
	. "WHERE a.benutzername = ?"
	. "AND (a.auftragsstatus = \"C\" OR a.auftragsstatus = \"A\")"
	. "AND a.kundennummer = k.kundennummer";
$statement = $dbConnection->prepare($sql);
$statement->bind_param("s", $_SESSION["benutzername_om"]);
$statement->execute();
$statement->bind_result($auftragsnummer, $von, $bis, $beschreibung, $status, $name, $str, $hnr, $plz, $ort, $telefon);

echo "{ \"arbeitsauftraege\": [";

while ($statement->fetch()) {

}

echo "] }";

?>
