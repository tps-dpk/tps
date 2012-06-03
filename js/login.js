function login()
{
var username = $("#username").val();
var password = $("#password").val();

if ((username == '') || (password == '')) {
    $("#info").html('');
    $("#warning").html("Benutzername und Kennwort erforderlich !");
    setTimeout("window.location.reload()",4000);
    setTimeout("tb_remove()",3000);
} else {
   $.get("public/connect.php?username="+username+"&password="+password, function(rc) {
   if (rc == 0) {
	   $("#warning").html("Ihr Benutzer und/oder Kennwort sind falsch");
	   $("#info").html('');
   } else if (rc == 1) {
	   
	   $("#warning").html('');
	   $("#info").html("Login erfolgreich");
        window.location.pathname="/tps/loggedin.php";
    	setTimeout("window.location.reload()",2000);
    	setTimeout("tb_remove()",3000);
    } else {
    	$("#info").html("kein gueltige Rueckgabewert ("+rc+") beim Login.php");
    	$("warning").html('');
    }
  });
}

return false;
}
