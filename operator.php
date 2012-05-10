<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<? include ("inc/form.php"); ?>

<?php

if ( empty($_SESSION['username'])) { 
include 'lib/redirect.php';
movePage(403,"login.php");
exit;
};


$benutzername = $_GET['benutzername'];
$passwort = $_GET['passwort'];
$mitarbeitertyp = $_GET['mitarbeitertyp'];
$vorname = $_GET['vorname'];
$nachname = $_GET['nachname'];
$status = $_GET['status'];
$function = $_GET['function'];
$submit = $_GET['submit'];



if ($function =="edit" ) { 
	$action="&auml;ndern"; 
	$visible['bunutzername']="readonly";
} elseif ( $function == "delete") { 
	$action="l&ouml;schen"; 
	$visible['bunutzername']="readonly";
	$visible['passwort']="readonly";
	$visible['mitarbeitertyp']="readonly";
	$visible['vorname']="readonly";
	$visible['nachname']="readonly";
	$visible['status']="readonly";
} else { 
    $function="add";
	$action="hinzuf&uuml;gen"; 
};

$mitarbeitertypb['OM']="Operative Mitarbeiter";
$mitarbeitertypb['DP']="Disponent";
?>




<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
include 'lib/mysql.php';

if (mysqli_connect_errno() == 0) {

	if ($submit =="add" ) { 
		$sql = 'INSERT INTO mitarbeiter (`benutzername`, `passwort`, `mitarbeitertyp`, `vorname`, `nachname`, `status`) VALUES (?, ?, ?, ?, ?, ? )';
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssss',$benutzername, $passwort, $mitarbeitertyp, $vorname, $nachname, $status );
		$statement->execute();
		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1)
		{
			$info="Mitarbeiter ($benutzername) wurde angelegt";
		}
		else
		{
			$warnung="Der Eintrag konnte nicht hinzugef&uuml;gt werden.";
		}

	
	
	
	} elseif ( $submit == "edit") { 
	
		$sql = 'UPDATE mitarbeiter SET passwort = ?, mitarbeitertyp = ?, vorname = ?, nachname = ?, status = ? where benutzername = ?';
	
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssss', $passwort, $mitarbeitertyp, $vorname, $nachname, $status, $benutzername );
		$statement->execute();
		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1)
		{
			$info="Mitarbeiter ($benutzername) wurde ge&auml;ndert.";
		}
		else
		{
			$warnung="Der Eintrag konnte nicht ge&auml;ndert.";
		}
	} elseif ( $submit == "delete") { 
		$sql = 'SELECT count(*)  FROM auftrag WHERE benutzername = ?';
		$statement = $db_connection->prepare($sql);
		$statement->bind_param( 's', $benutzername );
		$statement->execute();
		$statement->bind_result( $count );
		$statement->fetch();
		unset($statement);
	
		if ( $count == 0 ) {
	
			$sql = 'DELETE FROM mitarbeiter WHERE benutzername = ?';
	
			$statement = $db_connection->prepare( $sql );
			$statement->bind_param( 's', $benutzername );
			$statement->execute();
			// Pruefen ob der Eintrag efolgreich war
			if ($statement->affected_rows == 1)
			{
				$info="Mitarbeiter ($benutzername) wurde gel&ouml;scht.";
			}
			else
			{
				$warnung="Der Eintrag konnte nicht gel&ouml;scht werden.";
			}
		} else {
			$warnung="Mitarbeiter ($benutzername) hat Auftr&auml;ge ($count) zugeordnet und kann deshalb nicht gel&ouml;scht werden.";
		}
	
	};



} else {
		$warnung='DB Problem!';
}


error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>




<div id="Form">
<h2>Mitarbeiter <?php echo $action;  ?></h2>
<br />
<form method="get" action="#" name="operator" id="operator_form" accept-charset="utf-8" >
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
      <td>
<?php
if ( $visible['mitarbeitertyp']=="readonly" ) {
?>
	  	<input name="mitarbeitertyp" id="mitarbeitertyp" type="text" value="<?php echo "$mitarbeitertyp";?>" <?php echo $visible['mitarbeitertyp'];?> />
<?php
} else {
?>

    	<select name="mitarbeitertyp" class="validate-not-first" title="Mitarbeitertyp ist notwendig" >
            <option value="">Select:</option>
            <option value="DP" <?php if ( $mitarbeitertyp == "DP" ) { echo 'selected="selected"';}; ?>><?php echo $mitarbeitertypb['DP']?></option>
            <option value="OM" <?php if ( $mitarbeitertyp == "OM" ) { echo 'selected="selected"';}; ?>><?php echo $mitarbeitertypb['OM']?></option>
    	</select>
<?php
}
?>
      </td>      
      
      
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
      <td>
<?php
if ( $visible['status']=="readonly" ) {
?>
			<!---
            <input name="status" id="status" type="text" value="<?php echo "$status";?>" <?php echo $visible['status']; ?> />
            -->
            <input type="radio" name="status" class="validate-one-required" title="Status ist notwendig" <?php  if ( $status == "X" ) {  echo "checked"; } ?> value="X" readonly onclick="return(false);"> Aktiv  
      		<input type="radio" name="status" <?php  if ( $status == "" ) {  echo "checked"; } ?> value="" readonly onclick="return(false);"> Deaktiv<br>
            
<?php
} else {
?>
      		<input type="radio" name="status" class="validate-one-required" title="Status ist notwendig" <?php  if ( $status == "X" ) {  echo "checked"; } ?> value="X"> Aktiv  
      		<input type="radio" name="status" <?php  if ( $status == "" ) {  echo "checked"; } ?> value=""> Deaktiv<br>
<?php
}
?>
      
      </td>
      
    </tr>
   </tbody>
</table>
<input name="function" id="function" type="hidden" value="<?php echo "$function";?>" />
<input name="submit" value="<?php echo $function;?>" class="button" type="submit">
<input type="button" VALUE="Zur&uuml;ck" class="button" onClick="location.href='operator_list.php'">
</form>
</div>





<div id="Messages">
<p id="info"><?php echo $info;?></p>
<p id="warning"><?php echo $warnung;?></p>
</div>


<? include ("inc/footer.php"); ?>
