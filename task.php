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
$submit = $_GET['submit'];

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

$auftragsstatusb['A']="angelegt";
$auftragsstatusb['R']="angenommen";
$auftragsstatusb['F']="abgeschlossen";
$auftragsstatusb['C']="abgelehnt";
?>

<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
include 'lib/mysql.php';

if (mysqli_connect_errno() == 0) {

	if ($submit =="add" ) { 
		$sql = 'INSERT INTO auftrag (`beschreibung`, `zeit_von`, `zeit_bis`, `auftragsstatus`, `kundennummer`, `benutzername`) VALUES (?, ?, ?, ?, ?, ? )';
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssiiss',$beschreibung, $zeit_von, $zeit_bis, $auftragsstatus, $kundennummer, $benutzername );
		$statement->execute();
		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1)
		{
			$info="Auftrag ($beschreibung) wurde angelegt";
		}
		else
		{
			$warnung="Der Auftrag-Eintrag konnte nicht hinzugef&uuml;gt werden.";
		}

	
	
	
	} elseif ( $submit == "edit") { 
	
		$sql = 'UPDATE auftrag SET beschreibung = ?, zeit_von = ?, zeit_bis = ?, auftragsstatus = ?, kundennummer = ?, benutzername = ? where auftragsnummer = ?';
	
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssisi', $beschreibung, $zeit_von, $zeit_bis, $auftragsstatus, $kundennummer, $benutzername, $auftragsnummer );
		$statement->execute();
		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1)
		{
			$info="Auftrag ($beschreibung) wurde geändert.";
		}
		else
		{
			$warnung="Der Auftrag-Eintrag konnte nicht geändert.";
		}
	} elseif ( $submit == "delete") { 
		$sql = 'SELECT count(*)  FROM auftrag WHERE auftragsnummer = ? ';
		$statement = $db_connection->prepare($sql);
		$statement->bind_param( 's', $auftragsnummer );
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
				$info="Kunde ($beschreibung) wurde gelöscht.";
			}
			else
			{
				$warnung="Der Kunden-Eintrag konnte nicht gelöscht werden.";
			}
		} else {
			$warnung="Kunde ($beschreibung) hat Aufträge ($count) zugeordnet und kann deshalb nicht gelöscht werden.";
		}
	
	};



} else {
		$warnung='DB Problem!';
}


error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
      <td><input name="auftragsnummer" id="auftragsnummer" type="<?php if ($auftragsnummer) { echo "text"; } else { echo "hidden"; };  ?>" value ="<?php echo $auftragsnummer;?>" <?php echo $visible['auftragsnummer']?>/></td>
    </tr>
    <tr>
      <td><label for="beschreibung">Beschreibung: </label></td>
      <td><input name="beschreibung" id="beschreibung" class="required" type="text" value="<?php echo "$beschreibung";?>" <?php echo $visible['beschreibung']?> size="40"/></td>
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
      <td><input name="auftragsstatus" id="auftragsstatus" class="required validate-alpha" type="text" value="<?php echo "$auftragsstatus";?>" <?php echo $visible['auftragsstatus']?> size="1"/></td>
    </tr>
    <tr>
      <td><label for="kundennummer">Kundennummer: </label></td>
      <td><input name="kundennummer" id="kundennummer" class="required validate-number" type="text" value="<?php echo "$kundennummer";?>" <?php echo $visible['kundennummer']?>/></td>
    </tr>
    <tr>
      <td><label for="benutzername">Benutzername: </label></td>
      <td><input name="benutzername" id="benutzername" class="required" type="text" value="<?php echo "$benutzername";?>" <?php echo $visible['benutzername']?>/></td>
    </tr>
   </tbody>
</table>
<input name="function" id="function" type="hidden" value="<?php echo "$function";?>" />
<input name="submit" value="<?php echo $function;?>" class="button" type="submit">
<input type="button" VALUE="Zurück" class="button" onClick="history.back()">
</form>
</div>

<div id="Messages">
<p id="info"><?php echo $info;?></p>
<p id="warning"><?php echo $warnung;?></p>
</div>

<? include ("inc/footer.php"); ?>