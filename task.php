<? include ("inc/header.php"); ?>
<? include ("inc/form.php"); ?>


<?php
$auftragsnummer = $_GET['auftragsnummer'];
$beschreibung = $_GET['beschreibung'];
$zeit_von = $_GET['zeit_von'];
$zeit_bis = $_GET['zeit_bis'];
$auftragsstatus = $_GET['auftragsstatus'];
$kundennummer = $_GET['kundennummer'];
$benutzername = $_GET['benutzername'];
$function = $_GET['function'];

if ($function =="edit" ) { 
	$action="ändern"; 
	$visible['auftragsnummer']="readonly";
} elseif ( $function == "delete") { 
	$action="löschen"; 
	$visible['auftragsnummer']="readonly";
	$visible['beschreibung']="readonly";
	$visible['zeit_von']="readonly";
	$visible['zeit_bis']="readonly";
	$visible['auftragsstatus']="readonly";
	$visible['kundennummer']="readonly";
	$visible['benutzername']="readonly";
} else { 
	$action="hinzuf&uuml;gen"; 
};
?>

<div id="Form">
<h2>Aufgabe <?php echo $action;  ?></h2>
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
      <td><input name="auftragsnummer" id="auftragsnummer" class="required validate-number" type="text" value="<?php echo "$auftragsnummer";?>" <?php echo $visible['auftragsnummer']?>/></td>
    </tr>
    <tr>
      <td><label for="beschreibung">Beschreibung: </label></td>
      <td><input name="beschreibung" id="beschreibung" class="required validate-alpha" type="text" value="<?php echo "$beschreibung";?>" <?php echo $visible['beschreibung']?> size="40"/></td>
    </tr>
    <tr>
      <td><label for="zeit_von">Von: </label></td>
      <td><input name="zeit_von" id="zeit_von" class="required" type="text" value="<?php echo "$zeit_von";?>" <?php echo $visible['zeit_von']?> size="18"/></td>
    </tr>
    <tr>
      <td><label for="zeit_bis">Bis: </label></td>
      <td><input name="zeit_bis" id="zeit_bis" class="required" type="text" value="<?php echo "$zeit_bis";?>" <?php echo $visible['zeit_bis']?> size="18"/></td>
    </tr>
    <tr>
      <td><label for="auftragsstatus">Auftragsstatus: </label></td>
      <td><input name="auftragsstatus" id="auftragsstatus" class="validate-alpha" type="text" value="<?php echo "$auftragsstatus";?>" <?php echo $visible['auftragsstatus']?> size="1"/></td>
    </tr>
    <tr>
      <td><label for="kundennummer">Kundennummer: </label></td>
      <td><input name="kundennummer" id="kundennummer" class="validate-number" type="text" value="<?php echo "$kundennummer";?>" <?php echo $visible['kundennummer']?>/></td>
    </tr>
    <tr>
      <td><label for="benutzername">Benutzername: </label></td>
      <td><input name="benutzername" id="benutzername" class="validate-alpha" type="text" value="<?php echo "$benutzername";?>" <?php echo $visible['benutzername']?>/></td>
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