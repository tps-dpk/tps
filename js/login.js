function login()
{
var username = $("#username").val();
var password = $("#password").val();

console.log(username);
console.log(password);

if ((username == '') || (password == '')) {
    $("#info").html('');
    $("#warning").html("Benutzername und Kennwort erforderlich !");
    console.log("vars not defined");
} else {
   $.get("connect.php?username="+username+"&password="+password, function(rc) {
   console.log("start");
   console.log(rc);
   if (rc == 0) {
	   $("#warning").html("Ihr Benutzer und/oder Kennwort sind falsch");
	   $("#info").html('');
           console.log("login failed");
   } else if (rc == 1) {
           console.log("login successful");
	   
	   $("#warning").html('');
	   $("#info").html("Login erfolgreich");
        window.location.pathname="/tps/loggedin.php";
    	setTimeout("window.location.reload()",2000);
    } else {
        console.log("returncode undefined");
    	$("#info").html("kein gueltige Rueckgabewert ("+rc+") beim connect.php");
    	$("warning").html('');
    }
    console.log("end");
  });
}

return false;
}
