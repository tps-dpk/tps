<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include '../lib/mysql.php';

// Benutzernamen holen
$username = $_GET['username'];
// Kennwort holen
$password = $_GET['password'];

$sql = 'SELECT passwort FROM mitarbeiter WHERE benutzername = ?';
$statement = $db_connection->prepare($sql);
$statement->bind_param("s", $username);
$statement->execute();
$statement->bind_result($dbpw);

while ($statement->fetch()) {
    if ($password == $dbpw) {
        session_start();
        $_SESSION['username'] = $username;
        // Login war erfolgreich
        echo 1;
    } else {
	// Login fehlgeschlgen
	echo 0;
    }
}
?>
