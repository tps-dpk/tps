<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<? include ("inc/form.php"); ?>




<div id="Form">
<h2>Aufgabe hinzuf&uuml;gen</h2>
<br />
<form method="get" action="#" name="task" id="task_form">
<table>
  <thead>
    <tr>
      <th>Attribute</th>
      <th>Wert</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label for="auftragsnummer">Auftragsnummer: </label></td>
      <td><input name="auftragsnummer" id="auftragsnummer" class="required validate-number" type="text" /></td>
    </tr>
    <tr>
      <td><label for="beschreibung">Beschreibung: </label></td>
      <td><input name="beschreibung" id="beschreibung" class="required validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="zeit_von">Von: </label></td>
      <td><input name="zeit_von" id="zeit_von" class="required" type="text" /></td>
    </tr>
    <tr>
      <td><label for="zeit_bis">Bis: </label></td>
      <td><input name="zeit_bis" id="zeit_bis" class="required" type="text" /></td>
    </tr>
    <tr>
      <td><label for="auftragsstatus">Auftragsstatus: </label></td>
      <td><input name="auftragsstatus" id="auftragsstatus" class="validate-alpha" type="text" /></td>
    </tr>
    <tr>
      <td><label for="kundennummer">Kundennummer: </label></td>
      <td><input name="kundennummer" id="kundennummer" class="validate-number" type="text" /></td>
    </tr>
    <tr>
      <td><label for="benutzername">Benutzername: </label></td>
      <td><input name="benutzername" id="benutzername" class="validate-alpha" type="text" /></td>
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