<?php
       session_start();
       require_once('login.class');
 // Benutzernamen holen
$username = $_GET['username'];
// Kennwort holen
$password = $_GET['password'];
// PHP Login Instanz erzeugen
$login = new login();
// Loginroutine aufrufen
if($login->checklogin($username, $password)) {
	$_SESSION['username'] = $username;
	// Login war erfolgreich
	echo 1;
}
else {
	// Login fehlgeschlgen
	echo 0;
}
?>