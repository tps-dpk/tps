<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>

<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


include 'lib/mysql.php'; 
$sql = "SELECT benutzername, vorname, nachname, status FROM mitarbeiter where mitarbeitertyp = 'DP'";
$stmt = $db_connection->prepare($sql);
$stmt->execute();
$stmt->bind_result($benutzername,$vorname,$nachname,$status );

?>

<div id="Form">
<h2>Anmeldung</h2>
<br />
<form method="get" action="#" accept-charset="utf-8"  >
<table cellpadding="5" cellspacing="5" border="0">
  <tbody>
    <tr>
      <td><label for="benutzername">Benutzername: </label></td>
      <td>
		<select name="benutzername" class="validate-not-first" title="Benutzername ist notwendig" onchange="javascript:document.getElementById('username').value=this.form.benutzername.options[this.form.benutzername.selectedIndex].value">
				<option value="">Select:</option>
<?php
while ($stmt->fetch()) {
?>

                <option value="<?php echo $benutzername?>"><?php echo "$vorname $nachname"?></option>
<?php
}
?>
        </select>
        <p id="msg">test</p>
        <input name="username" id="username" type="hidden"/>
	  </td>
    </tr>
    <tr>
      <td><label for="password">Kennwort: </label></td>
      <td><input name="password" id="password" title="Passwort ist notwendig" class="required" type="password" /></td>
    </tr>
   </tbody>
</table>
<input type="submit" onclick="login()" value="Login">
</form>

</div>


<div id="Messages">
<p id="info">Wenn Sie noch keine Zugangsdaten oder an dieser Stelle ein Fehler auftritt oder Sie sich bei der Eingabe von Email und Kennwort unsicher sind, kontaktieren Sie Ihren IT Administrator (TPS).</p>
<p id="warning"></p>
</div>




<? include ("inc/footer.php"); ?>
