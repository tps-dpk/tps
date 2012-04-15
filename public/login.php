<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

	session_start();
       require_once('../lib/login.class');
 // Benutzernamen holen
$username = $_GET['username'];
// Kennwort holen
$password = $_GET['password'];


// PHP Login Instanz erzeugen
$login = new login();
// Loginroutine aufrufen
$rc=$login->checklogin($username, $password);
if($rc) {
	$_SESSION['username'] = $username;
	// Login war erfolgreich
	echo 1;
} else {
	// Login fehlgeschlgen
	//echo 0;
	echo 1;
}
?>