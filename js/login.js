function login()
{
var username = $("#username").val();
var password = $("#password").val();</p>
if ((username == '') || (password == ''))
{
    $("#info").html('');
    $("#warning").html("Benutzername und Kennwort erforderlich !");
} 
else
{
   $.get("login.php?username="+username+"&password="+password, function(rc) {
   if (rc == 0)
{
	$("#warning").html("Ihr Benutzer und/oder Kennwort sind falsch");
	$("#info").html('');
}
       else if (rc == 1)
{
$("#info").html('');
$("warning").html('');
$("#loginDiv").html("Login erfolgreich");
setTimeout("window.location.reload()",1000);
setTimeout("tb_remove()",3000);
}
});
}
return false;
}
