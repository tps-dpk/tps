<?php
    define ('MYSQL_HOST', 'localhost');
    define ('MYSQL_USER', 'tps');
    define ('MYSQL_PASS', 'tpspassw0rd');
    define ('MYSQL_DATA', 'tps');

    $db_connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DATA ) or die("Keine Verbindung zur DB möglich, ".mysql_error());
?> 
