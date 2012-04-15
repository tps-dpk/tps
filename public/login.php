<?php

session_start();
include_once('../lib/sessionhelpers.inc.php');

if ( isset($_POST['login']) ) {
    $userid = check_user($_POST['username'], $_POST['userpass']);
    if ( $userid ) {
        login($userid);
    } else {
        echo '<p>Ihre Anmeldedaten waren nicht korrekt!</p>';
    }
}

if ( !logged_in() ) {
    echo <<<END
<form method="post" action="login.php">
<label>Benutzername:</label> <input name="username" type="text"><br />
<label>Passwort:</label> <input name="userpass" type="password" id="userpass"><br />
<input name="login" type="submit" id="login" value="Einloggen">
</form>
END;
} else {
    echo '<p><a href="soll-geschuetzt-werden.php">Testseite</a></p>';
    echo '<p><a href="logout.php">Ausloggen</a></p>';
}

?>
