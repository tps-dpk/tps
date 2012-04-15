<?php


/**
 * @return void
 */
function connect () { 
    $con = mysql_connect('localhost', 'tps', 'tpspassw0rd') or exit(mysql_error());
    mysql_select_db('tps', $con) or exit(mysql_error());
}


/**
 * @param string $name
 * @param string $pass
 * @return boolean
 */
function check_user ( $name, $pass ) {
    // magic quotes anpassen
    if ( get_magic_quotes_gpc() ) {
        $name = stripslashes($name);
        $pass = stripslashes($pass);
    }
    // escapen von \\, \x00, \n, \r, \, ', " und \x1a
    $name = mysql_real_escape_string($name);
    // escapen von Backticks (`)
    $name = preg_replace(/\x60/, '\\\x60', $name);
    // escapen von % und _
    $name = str_replace('%', '\%', $name);
    $name = str_replace('_', '\_', $name);

    $sql = 'SELECT UserId FROM users WHERE UserName = \'' . $name . '\' AND UserPass=\'' . md5($pass) . '\'';
    if ( !$result = mysql_query($sql) ) {
        exit(mysql_error());
    }
    if ( mysql_num_rows($result) == 1 ) {
        $user = mysql_fetch_assoc($result);
        return ( $user['UserId'] );
    } else {
        return ( false );
    }
}


/**
 * @param int $userid
 * @return void
 */
function login ( $userid ) {
    $sql = 'UPDATE users SET UserSession = \'' . session_id() . '\' WHERE UserId = ' . ((int)$userid);
    if ( !mysql_query($sql) ) {
        exit(mysql_error());
    }
}


/**
 * @return boolean
 */
function logged_in () { 
    $sql = 'SELECT UserId FROM users WHERE UserSession = \'' . session_id() . '\'';
    if ( !$result = mysql_query($sql) ) {
        exit(mysql_error());
    }
    return (mysql_num_rows($result) == 1);
}


/**
 * @return void
 */
function logout () { 
    $sql = 'UPDATE users SET UserSession = NULL WHERE UserSession = \'' . session_id() . '\'';
    if ( mysql_query($sql) ) {
        exit(mysql_error());
    }
}

connect();

?>
