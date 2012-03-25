<?php
/**
 * Created on 02.02.2009
 * @author David Krcek switch2mac.de
 */
session_start();
if (!empty($_SESSION['username'])) header( 'Location: ./loggedin.php' ) ;
 
echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>jQuery ThickBox Login Box</title>
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/thickBox-compressed.js"></script>
<script type="text/javascript" src="js/login.js"></script></meta>
<link rel="stylesheet" href="css/thickbox.css" type="text/css"
 media="screen" />
<link rel="stylesheet" href="css/login.css" type="text/css"
media="screen" />
</head>
<body>
'<a href="login.htm?height=200&width=300" class="thickbox">Login</a>'
</body> </html>
EOF
?>
