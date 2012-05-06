<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

session_start();


$kundennummer = $_GET['kundennummer'];
$name = $_GET['name'];
$strasse = $_GET['strasse'];
$hausnummer = $_GET['hausnummer'];
$plz = $_GET['plz'];
$ort = $_GET['ort'];
$telefonnummer = $_GET['telefonnummer'];
$function = $_GET['function'];

if ($function == 'delete') {
	
}

//all attributes without kundennummer must be exist
if ( $name && $strasse && $hausnummer && $plz && $ort && $telefonnummer ) {
	// insert
} else {
	// error message
}

include 'lib/mysql.php'; 
if ($kundennumer) {
   // check customer
   $sql = 'SELECT kundennummer FROM kunde WHERE kundennummer = ?';
   $statement = $db_connection->prepare($sql);
   $statement->bind_param("s", $kundennummer);
   $statement->execute();
   $statement->bind_result($knr);
   $statement->fetch();
   if ($knr) {
	   //update customer
	   $sql = "update kunde set name=$name, strasse=$strasse, hausnummer=$hausnummer, plz=$plz, ort=$ort, telefonnummer=$telefonnummer where kundennumer = $kundennummer";
	   $statement = $db_connection->prepare($sql);
	   $statement->execute();
	   $statement->commit();
	   
   } else {
	   //customer dont exists
	   //error message
   }
	   
   
}else {
	// new customer
	$sql = "insert into kunde (name, strasse, hausnummer, plz, ort, telefonnummer) values ($name, $strasse, $hausnummer, $plz, $ort, $telefonnummer)";
	   $statement = $db_connection->prepare($sql);
	   $statement->execute();
	   $statement->commit();
}

?>
