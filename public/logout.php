<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
     session_start();
     session_destroy();
     header('Location: ../index.php');
?>
