<?php

session_start(); 
include_once('sessionhelpers.inc.php'); 

echo '<p>Sie sind '; 
if ( !logged_in() ) {
    echo 'nicht ';
}
echo 'eingeloggt.</p>';

logout();

echo '<p>Sie sind ';
if ( !logged_in() ) {
    echo 'nicht ';
}
echo 'eingeloggt.</p>';

echo '<p><a href="login.php">Einloggen</a></p>';

?>