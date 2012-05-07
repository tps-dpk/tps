<? include ("inc/header.php"); ?>
<? include ("inc/form.php"); ?>



<?php

if ( empty($_SESSION['username'])) { 
include 'lib/redirect.php';
movePage(403,"login.php");
exit;

};

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
} elseif ( $function == "add" ) {
	$auftragsstatus="C";
	$action="hinzuf&uuml;gen";
	$visible['auftragsstatus']="readonly";
	
} else { 
	$action="hinzuf&uuml;gen"; 
};

$auftragsstatusb['A']="Angenommen";
$auftragsstatusb['R']="Abgelehnt";
$auftragsstatusb['F']="Abgeschlossen";
$auftragsstatusb['C']="Angelegt";
?>

<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
include 'lib/mysql.php';

if (mysqli_connect_errno() == 0) {

	if ($submit =="add" ) { 
		$sql = 'INSERT INTO auftrag (`beschreibung`, `zeit_von`, `zeit_bis`, `auftragsstatus`, `kundennummer`, `benutzername`) VALUES (?, ?, ?, ?, ?, ? )';
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssis',$beschreibung, $zeit_von, $zeit_bis, $auftragsstatus, $kundennummer, $benutzername );
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
		$sql = 'SELECT count(*)  FROM auftrag WHERE auftragsnummer = ? and auftragsstatus = "C" ';
		$statement = $db_connection->prepare($sql);
		$statement->bind_param( 's', $auftragsnummer);
		$statement->execute();
		$statement->bind_result( $count );
		$statement->fetch();
		unset($statement);
	
		if ( $count == 1 ) {
	
			$sql = 'DELETE FROM auftrag WHERE auftragsnummer = ?';
	
			$statement = $db_connection->prepare( $sql );
			$statement->bind_param( 's', $auftragsnummer );
			$statement->execute();
			// Pruefen ob der Eintrag efolgreich war
			if ($statement->affected_rows == 1)
			{
				$info="Auftrag ($beschreibung) wurde gelöscht.";
			}
			else
			{
				$warnung="Der Auftrag-Eintrag konnte nicht gelöscht werden.";
			}
		} else {
			$warnung="Auftrag ($beschreibung) kann nur im Angelegt-Status (C) gelöscht werden.";
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
      <td><input name="beschreibung" id="beschreibung" class="required" title="Beschreibung ist notwendig" type="text" value="<?php echo "$beschreibung";?>" <?php echo $visible['beschreibung']?> size="40"/></td>
    </tr>
    <tr>
      <td><label for="zeit_von">Von: </label></td>
      <td><input name="zeit_von" id="zeit_von" class="required" type="Text" title="Zeit_von ist notwendig"value="<?php echo "$zeit_von";?>" <?php echo $visible['zeit_von']?> size="18"> </td>
    </tr>
    <tr>
      <td><label for="zeit_bis">Bis: </label></td>
      <td><input name="zeit_bis" id="zeit_bis" class="required" type="text" title="Zeit_bis ist notwendig"value="<?php echo "$zeit_bis";?>" <?php echo $visible['zeit_bis'] ?> size="18"/></td>
    </tr>
    <tr>
      <td><label for="auftragsstatus">Auftragsstatus: </label></td>
      <td><input name="auftragsstatus" id="auftragsstatus" class="required validate-alpha" type="text" value="<?php echo "$auftragsstatus";?>" <?php echo $visible['auftragsstatus']?> size="1"/></td>
    </tr>
    <tr>
      <td><label for="kundennummer">Kundennummer: </label></td>
      <td>
<?php
if ( $visible['kundennummer']=="readonly" ) {
?>      
      		<input name="kundennummer" id="kundennummer" class="required" type="text" value="<?php echo "$kundennummer";?>" <?php echo $visible['kundennummer']?>/></td>
<?php
} else {
?>
	 <select name="kundennummer" class="validate-not-first" title="Kundennummer ist notwendig" onchange="javascript:document.getElementById('username').value=this.form.kundennummer.options[this.form.kundennummer.selectedIndex].value">
				<option value="">Select:</option>
	<?php
	include 'lib/mysql.php'; 
	$sql = 'SELECT kundennummer, name, strasse, hausnummer, plz, ort, telefonnummer FROM kunde';
	$customer = $db_connection->prepare($sql);
	$customer->execute();
	$customer->bind_result($kundennummer_,$name_,$strasse_,$hausnummer_,$plz_,$ort_,$telefonnummer_);
	
	
    while ($customer->fetch()) {
    	if ( $kundennummer == $kundennummer_ ) {
	?>
    			<option value="<?php echo $kundennummer_?>" selected="selected"><?php echo "$name_"?> </option>
    <?php
    	} else {
    ?>
				<option value="<?php echo $kundennummer_?>"><?php echo "$name_"?></option>
    <?php
		}
	}
    ?>
        </select>
      
<?php
}
?>  
    </td>
    </tr>
    <tr>
      <td><label for="benutzername">Benutzername: </label></td>
      <td>

<?php
if ( $visible['benutzername']=="readonly" ) {
?>      
      		<input name="benutzername" id="benutzername" class="required" type="text" value="<?php echo "$benutzername";?>" <?php echo $visible['benutzername']?>/></td>
<?php
} else {
?>
		<select name="benutzername" class="validate-not-first" title="Benutzername ist notwendig" onchange="javascript:document.getElementById('username').value=this.form.benutzername.options[this.form.benutzername.selectedIndex].value">
				<option value="">Select:</option>
	<?php
	include 'lib/mysql.php'; 
	$sql = "SELECT benutzername, vorname, nachname, status FROM mitarbeiter where mitarbeitertyp = 'OM'";
	$user = $db_connection->prepare($sql);
	$user->execute();
	$user->bind_result($benutzername_,$vorname_,$nachname_,$status_ );
    while ($user->fetch()) {
    	if ( $benutzername == $benutzername_ ) {
	?>
    			<option value="<?php echo $benutzername_?>" selected="selected"><?php echo "$vorname_ $nachname_"?> </option>
    <?php
    	} else {
    ?>
				<option value="<?php echo $benutzername_?>"><?php echo "$vorname_ $nachname_"?></option>
    <?php
		}
	}
    ?>
        </select>
      
<?php
}
?>     
      
      
    </tr>
   </tbody>
</table>
<input name="function" id="function" type="hidden" value="<?php echo "$function";?>" />
<input name="submit" value="<?php echo $function;?>" class="button" type="submit">
<input type="button" VALUE="Zurück" class="button" onClick="location.href='task_list.php'">
</form>
</div>

<div id="Messages">
<p id="info"><?php echo $info;?></p>
<p id="warning"><?php echo $warnung;?></p>
</div>


<SCRIPT LANGUAGE="JavaScript">
$('#zeit_von').datetimepicker({
	dateFormat: "yy-mm-dd",
	dayNamesMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
	monthNamesShort: ["Jan", "Feb", "Mrz", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dez"],
	timeOnlyTitle: 'Zeit auswählen',
	timeText: "Zeit",
	hourText: "Stunde",
	minuteText: "Minute",
	secondText: "Sekunde",
	millisecText: "Milliecond",
	currentText: "Jetzt",
	closeText: "erledigt",
	timeFormat: 'hh:mm:ss',
    onClose: function(dateText, inst) {
        var endDateTextBox = $('#example16_end');
        if (endDateTextBox.val() != '') {
            var testStartDate = new Date(dateText);
            var testEndDate = new Date(endDateTextBox.val());
            if (testStartDate > testEndDate)
                endDateTextBox.val(dateText);
        }
        else {
            endDateTextBox.val(dateText);
        }
    },
    onSelect: function (selectedDateTime){
        var start = $(this).datetimepicker('getDate');
        $('#example16_end').datetimepicker('option', 'minDate', new Date(start.getTime()));
    }
});
$('#zeit_bis').datetimepicker({
	dateFormat: "yy-mm-dd",
	dayNamesMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
	monthNamesShort: ["Jan", "Feb", "Mrz", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dez"],
	timeOnlyTitle: 'Zeit auswählen',
	timeText: "Zeit",
	hourText: "Stunde",
	minuteText: "Minute",
	secondText: "Sekunde",
	millisecText: "Milliecond",
	currentText: "Jetzt",
	closeText: "erledigt",
	timeFormat: 'hh:mm:ss',
    onClose: function(dateText, inst) {
        var startDateTextBox = $('#example16_start');
        if (startDateTextBox.val() != '') {
            var testStartDate = new Date(startDateTextBox.val());
            var testEndDate = new Date(dateText);
            if (testStartDate > testEndDate)
                startDateTextBox.val(dateText);
        }
        else {
            startDateTextBox.val(dateText);
        }
    },
    onSelect: function (selectedDateTime){
        var end = $(this).datetimepicker('getDate');
        $('#example16_start').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
    }
});
</SCRIPT>

<? include ("inc/footer.php"); ?>