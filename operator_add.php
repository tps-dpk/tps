<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<? include ("inc/form.php"); ?>



<div id="Form">
<h2>Mitarbeiter hinzuf&uuml;gen</h2>
<br />
<form method="get" action="#" name="operator" id="operator_form">
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th>Attribute</th>
      <th>Wert</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label for="benutzername">Benutzername: </label></td>
      <td><input name="benutzername" id="benutzername" title="Benutzername ist notwendig" class="required validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="passwort">Passwort: </label></td>
      <td><input name="passwort" id="passwort" title="Passwort ist notwendig" class="required" type="text" /></td>
    </tr>
    <tr>
      <td><label for="mitarbeitertyp">Mitarbeitertyp: </label></td>
      <td><input name="mitarbeitertyp" id="mitarbeitertyp" title="Mitarbeitertyp ist notwendig" class="required" type="text" /></td>
    </tr>
    <tr>
      <td><label for="vorname">Vorname: </label></td>
      <td><input name="vorname" id="vorname" title="Vorname ist notwendig" class="required validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="nachname">Nachname: </label></td>
      <td><input name="nachname" id="nachname" title="Nachname ist notwendig" class="required validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="status">Telefonnumer: </label></td>
      <td><input name="status" id="status" title="Telefonnummer ist notwendig" class="required" type="text" /></td>
    </tr>
   </tbody>
</table>
<input name="submit" value="Submit Form" class="button" type="submit">
</form>
</div>

 
<p id="info"></p>
<p id="warning"></p>

<? include ("inc/footer.php"); ?>