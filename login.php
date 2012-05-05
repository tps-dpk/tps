<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>




<div id="Form">
<h2>Anmeldung</h2>
<br />
<form method="get" action="#" accept-charset="utf-8"  >
<table cellpadding="5" cellspacing="5" border="0" id="dataTable">
  <tbody>
    <tr>
      <td><label for="username">Benutzername: </label></td>
      <td><input name="username" id="username" title="Benutzername ist notwendig" class="required validate-alpha" type="text" /></td>
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
