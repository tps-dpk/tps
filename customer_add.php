<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<? include ("inc/form.php"); ?>





<div id="Form">
<h2>Kunde hinzuf&uuml;gen</h2>
<br />
<form method="get" action="#" name="customer" id="customer_form">
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th>Attribute</th>
      <th>Wert</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label for="name">Name: </label></td>
      <td><input name="name" id="name" title="Benutzername ist notwendig" class="required validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="strasse">Strasse: </label></td>
      <td><input name="strasse" id="strasse" title="Strasse ist notwendig" class="required validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="hausnummer">Hausnummer: </label></td>
      <td><input name="hausnummer" id="hausnummer" title="Hausnummer ist notwendig" class="required" type="text" /></td>
    </tr>
    <tr>
      <td><label for="plz">PLZ: </label></td>
      <td><input name="plz" id="plz" title="PLZ ist notwendig" class="required validate-number" type="text" /></td>
    </tr>
    <tr>
      <td><label for="ort">Ort: </label></td>
      <td><input name="ort" id="ort" title="Ort ist notwendig" class="validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="telefonnummer">Telefonnumer: </label></td>
      <td><input name="telefonnummer" id="telefonnummer" title="Telefonnummer ist notwendig" class="required validate-digits" type="text" /></td>
    </tr>
   </tbody>
</table>
<input name="submit" value="Submit Form" class="button" type="submit">
</form>
</div>

<div id="Messages">
<p id="info"></p>
<p id="warning"></p>
</div>


<? include ("inc/footer.php"); ?>