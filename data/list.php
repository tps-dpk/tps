<?php

error_reporting(E_ALL);

require("functions.php");

session_start();

if (empty($_SESSION["benutzername_om"])) {
	sendUnauthorized();
}

$dbConnection = connect_db();
$sql = "SELECT a.auftragsnummer, a.zeit_von, a.zeit_bis, a.beschreibung, a.auftragsstatus, k.name, k.strasse, k.hausnummer, k.plz, k.ort, k.telefonnummer"
	. " FROM auftrag a, kunde k"
	. " WHERE a.benutzername = ?"
	. " AND (a.auftragsstatus = \"C\" OR a.auftragsstatus = \"A\")"
	. " AND a.kundennummer = k.kundennummer";
$statement = $dbConnection->prepare($sql);
$statement->bind_param("s", $_SESSION["benutzername_om"]);
$statement->execute();
$statement->bind_result($auftragsnummer, $von, $bis, $beschreibung, $status, $name, $str, $hnr, $plz, $ort, $telefon);

header("Content-type: application/json");

echo "{ \"arbeitsauftraege\": [";

$first = true;

while ($statement->fetch()) {
	if ($status == "C") {
		$status = "neu";
	} else {
		$status = "angenommen";
	}

	if ($first) {
		$first = false;
	} else {
		echo ",";
	}
	
	echo " { ";
	echo "\"nummer\": " . $auftragsnummer . ", ";
	echo "\"von\": \"" . $von . "\", ";
	echo "\"bis\": \"" . $bis . "\", ";
	echo "\"beschreibung\": \"" . $beschreibung . "\", ";
	echo "\"status\": \"" . $status. "\", ";
	echo "\"kunde\": { ";
	echo "\"name\": \"" . $name . "\", ";
	echo "\"strasse\": \"" . $str . "\", ";
	echo "\"hausnummer\": \"" . $hnr . "\", ";
	echo "\"plz\": \"" . $plz . "\", ";
	echo "\"ort\": \"" . $ort . "\", ";
	echo "\"telefonnummer\": \"" . $telefon . "\"";
	echo " } } ";
}

echo "] }";

?>
