<? include ("../inc/header.php"); ?>
<? include ("../inc/widget.php"); ?>

<div id="Form">
<h2>Anmeldung</h2>

<div id="loginDiv">
<label for="username">Benutzername</label></div>
<input name="username" id="username" type="text" />
<label for="password">Kennwort</label> 
<input name="password" id="password" type="password" / size=8/>
<input value="Login" id="login" onclick="login()" type="submit" />
 
<p id="info">Wenn Sie noch keine Zugangsdaten oder an dieser Stelle ein Fehler auftritt oder Sie sich bei der Eingabe von Email und Kennwort unsicher sind, kontaktieren Sie Ihren IT Administrator (TPS).</p>
</div>

<p id="info"></p>
<p id="warning"></p>

<? include ("../inc/footer.php"); ?>
