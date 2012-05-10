<? include ("inc/header.php"); ?>
<? include ("inc/form.php"); ?>

<?php

if ( empty($_SESSION['username'])) { 
include 'lib/redirect.php';
movePage(403,"login.php");
exit;
};


$kundennummer = $_GET['kundennummer'];
$name = $_GET['name'];
$strasse = $_GET['strasse'];
$hausnummer = $_GET['hausnummer'];
$plz = $_GET['plz'];
$ort = $_GET['ort'];
$telefonnummer = $_GET['telefonnummer'];
$function = $_GET['function'];
$submit = $_GET['submit'];

if ($function =="edit" ) { 
	$action="&auml;ndern"; 
	$visible['kundennummer']="readonly";
} elseif ( $function == "delete") { 
	$action="l&ouml;schen"; 
	$visible['kundennummer']="readonly";
	$visible['name']="readonly";
	$visible['strasse']="readonly";
	$visible['hausnummer']="readonly";
	$visible['plz']="readonly";
	$visible['ort']="readonly";
	$visible['telefonnummer']="readonly";
} else { 
	$action="hinzuf&uuml;gen"; 
	$visible['kundennummer']="readonly";
};


?>


<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
include 'lib/mysql.php';

if (mysqli_connect_errno() == 0) {

	if ($submit =="add" ) { 
		$sql = 'INSERT INTO kunde (`name`, `strasse`, `hausnummer`, `plz`, `ort`, `telefonnummer`) VALUES (?, ?, ?, ?, ?, ? )';
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssiiss',$name, $strasse, $hausnummer, $plz, $ort, $telefonnummer );
		$statement->execute();
		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1)
		{
			$info="Kunde ($name) wurde angelegt";
		}
		else
		{
			$warnung="Der Kunden-Eintrag konnte nicht hinzugef&uuml;gt werden.";
		}

	
	
	
	} elseif ( $submit == "edit") { 
	
		$sql = 'UPDATE kunde SET name = ?, strasse = ?, hausnummer = ?, plz = ?, ort = ?, telefonnummer = ? where kundennummer = ?';
	
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'sssisss', $name, $strasse, $hausnummer, $plz, $ort, $telefonnummer, $kundennummer );
		$statement->execute();
		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1)
		{
			$info="Kunde ($name) wurde ge&auml;ndert.";
		}
		else
		{
			$warnung="Der Kunde-Eintrag konnte nicht ge&auml;ndert.";
		}
	} elseif ( $submit == "delete") { 
		$sql = 'SELECT count(*)  FROM auftrag WHERE kundennummer = ?';
		$statement = $db_connection->prepare($sql);
		$statement->bind_param( 's', $kundennummer );
		$statement->execute();
		$statement->bind_result( $count );
		$statement->fetch();
		unset($statement);
	
		if ( $count == 0 ) {
	
			$sql = 'DELETE FROM kunde WHERE kundennummer = ?';
	
			$statement = $db_connection->prepare( $sql );
			$statement->bind_param( 's', $kundennummer );
			$statement->execute();
			// Pruefen ob der Eintrag efolgreich war
			if ($statement->affected_rows == 1)
			{
				$info="Kunde ($name) wurde gel&ouml;scht.";
			}
			else
			{
				$warnung="Der Kunden-Eintrag konnte nicht gel&ouml;scht werden.";
			}
		} else {
			$warnung="Kunde ($name) hat Auftr&auml;ge ($count) zugeordnet und kann deshalb nicht gel&ouml;scht werden.";
		}
	
	};



} else {
		$warnung='DB Problem!';
}


error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<div id="Form">
<h2>Kunde <?php echo $action;  ?></h2>
<br />
<form method="get" action="#" name="customer" id="customer_form">
<table>
  <thead>
    <tr>
      <th>Attribute</th>
      <th>Wert</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label for="kundennummer">Kundennummer: </label></td>
      <td><input name="kundennummer" id="kundennummer" type="<?php if ($kundennummer) { echo "text"; } else { echo "hidden"; };  ?>" value ="<?php echo $kundennummer;?>" <?php echo $visible['kundennummer']?>/></td>
    </tr>
    <tr>
      <td><label for="name">Name: </label></td>
      <td><input name="name" id="name" title="Benutzername ist notwendig" class="required" type="text" value="<?php echo "$name";?>" <?php echo $visible['name']?>/></td>
    </tr>
    <tr>
      <td><label for="strasse">Strasse: </label></td>
      <td><input name="strasse" id="strasse" title="Strasse ist notwendig" class="required" type="text" value="<?php echo "$strasse";?>" <?php echo $visible['strasse']?> /></td>
    </tr>
    <tr>
      <td><label for="hausnummer">Hausnummer: </label></td>
      <td><input name="hausnummer" id="hausnummer" title="Hausnummer ist notwendig" class="required" type="text" value="<?php echo "$hausnummer";?>" <?php echo $visible['hausnummer']?> /></td>
    </tr>
    <tr>
      <td><label for="plz">PLZ: </label></td>
      <td><input name="plz" id="plz" title="PLZ ist notwendig" class="required validate-number" type="text" value="<?php echo "$plz";?>" <?php echo $visible['plz']?> /></td>
    </tr>
    <tr>
      <td><label for="ort">Ort: </label></td>
      <td><input name="ort" id="ort" title="Ort ist notwendig" class="required" type="text" value="<?php echo "$ort";?>" <?php echo $visible['ort']?>/></td>
    </tr>
    <tr>
      <td><label for="telefonnummer">Telefonnumer: </label></td>
      <td><input name="telefonnummer" id="telefonnummer" title="Telefonnummer ist notwendig" class="required validate-digits" type="text" value="<?php echo "$telefonnummer";?>" <?php echo $visible['telefonnummer']?>/></td>
    </tr>
   </tbody>
</table>

<input name="function" id="function" type="hidden" value="<?php echo "$function";?>" />
<input name="submit" value="<?php echo $function;?>" class="button" type="submit">
<input type="button" VALUE="Zur&uuml;ck" class="button" onClick="location.href='customer_list.php'">
</form>
</div>

<div id="Messages">
<p id="info"><?php echo $info;?></p>
<p id="warning"><?php echo $warnung;?></p>
</div>


<? include ("inc/footer.php"); ?>