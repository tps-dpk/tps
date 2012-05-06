<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<? include ("inc/form.php"); ?>

<?php
$benutzername = $_GET['benutzername'];
$passwort = $_GET['passwort'];
$mitarbeitertyp = $_GET['mitarbeitertyp'];
$vorname = $_GET['vorname'];
$nachname = $_GET['nachname'];
$status = $_GET['status'];
$function = $_GET['function'];

if ($function =="edit" ) { 
	$action="ändern"; 
	$visible['bunutzername']="readonly";
} elseif ( $function == "delete") { 
	$action="löschen"; 
	$visible['bunutzername']="readonly";
	$visible['passwort']="readonly";
	$visible['mitarbeitertyp']="readonly";
	$visible['vorname']="readonly";
	$visible['nachname']="readonly";
	$visible['status']="readonly";
} else { 
	$action="hinzuf&uuml;gen"; 
};
?>



<div id="Form">
<h2>Mitarbeiter <?php echo $action;  ?></h2>
<br />
<form method="get" action="#" name="operator" id="operator_form">
<table>
  <thead>
    <tr>
      <th>Attribute</th>
      <th>Wert</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label for="benutzername">Benutzername: </label></td>
      <td><input name="benutzername" id="benutzername" title="Benutzername ist notwendig" class="required validate-alpha" type="text" value="<?php echo "$benutzername";?>" <?php echo $visible['bunutzername']?>/></td>
    </tr>
    <tr>
      <td><label for="passwort">Passwort: </label></td>
      <td><input name="passwort" id="passwort" title="Passwort ist notwendig" class="required" type="password" value="<?php echo "$passwort";?>" <?php echo $visible['passwort']?>/></td>
    </tr>
    <tr>
      <td><label for="mitarbeitertyp">Mitarbeitertyp: </label></td>
      <td><input name="mitarbeitertyp" id="mitarbeitertyp" title="Mitarbeitertyp ist notwendig" class="required" type="text" value="<?php echo "$mitarbeitertyp";?>" <?php echo $visible['mitarbeitertyp']?>/></td>
    </tr>
    <tr>
      <td><label for="vorname">Vorname: </label></td>
      <td><input name="vorname" id="vorname" title="Vorname ist notwendig" class="required validate-alpha" type="text" value="<?php echo "$vorname";?>" <?php echo $visible['vorname']?>/></td>
    </tr>
    <tr>
      <td><label for="nachname">Nachname: </label></td>
      <td><input name="nachname" id="nachname" title="Nachname ist notwendig" class="required validate-alpha" type="text" value="<?php echo "$nachname";?>" <?php echo $visible['nachname']?>/></td>
    </tr>
    <tr>
      <td><label for="status">Status: </label></td>
      <td><input name="status" id="status" title="Telefonnummer ist notwendig" class="required" type="text" value="<?php echo "$status";?>" <?php echo $visible['status']?>/></td>
    </tr>
   </tbody>
</table>
<input name="function" id="function" type="hidden" value="<?php echo "$function";?>" />
<input name="submit" value="Submit Form" class="button" type="submit">
</form>
</div>

<div id="Messages">
<p id="info"></p>
<p id="warning"></p>
</div>


<? include ("inc/footer.php"); ?>