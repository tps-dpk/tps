<? include ("inc/header.php"); ?>
<? include ("inc/form.php"); ?>



<?php
error_reporting(-1);
ini_set('display_errors','On');

if ( empty($_SESSION['username'])) { 
        include 'lib/redirect.php';
        movePage(403,"login.php");
        exit;
};


if (isset($_GET['function'])) {
        $function = $_GET['function'];
}else {
        $function = 'unbekannt';
};

if (isset($_GET['submit'])) {
        $action = $_GET['submit'];
}else {
        $action = 'unbekannt';
}

// $_GET laden
$attribute = array("auftragsnummer","beschreibung","zeit_von","zeit_bis","auftragsstatus","kundennummer","benutzername");
foreach($attribute AS $attribut) {
        if (isset($_GET[$attribut])) {
                $a[$attribut] = $_GET[$attribut];
        }else {
                $a[$attribut] = "";
        }
}

$auftragsstatusb['A']="Angenommen";
$auftragsstatusb['R']="Abgelehnt";
$auftragsstatusb['F']="Abgeschlossen";
$auftragsstatusb['C']="Angelegt";
$auftragsstatusb['D']="Gel&ouml;scht";

// Alle Variablen sind Schreib geschützt.
foreach($attribute AS $attribut) {
        $visible[$attribut]="readonly";
};

// Wenn Auftragstatus Angelegt oder Abgelehnt ist, 
// können die Attribute angepasst werden.
if (( $a['auftragsstatus'] == "C" OR
    $a['auftragsstatus'] == "R" OR
    $function == "hinzufuegen" ) AND
    $function != "loeschen") {
        foreach( array( "beschreibung",
                        "zeit_von",
                        "zeit_bis",
                        "kundennummer",
                        "benutzername") AS $attribute) {
	        $visible[$attribute]="writeable";
        };
}

// Wenn schreib geschützt, dann darf auch kein Datum selektiert werden können!
if ($visible['zeit_bis']=="readonly") {
    $zeit_von_id="zeit_von_";
    $zeit_bis_id="zeit_bis_";
}else{
    $zeit_von_id="zeit_von";
    $zeit_bis_id="zeit_bis";
}

// Default Wert für Auftragsstatus
if ($a['auftragsstatus']=="") {
    $a['auftragsstatus']="C";
}

$info="";
$warnung="";
?>

<?php 
include 'lib/mysql.php';

if (mysqli_connect_errno() == 0) {

	$sql = "SELECT benutzername, vorname, nachname, status FROM mitarbeiter where mitarbeitertyp = 'OM' ";
	$user = $db_connection->prepare($sql);
	$user->execute();
	$user->bind_result($benutzername_,$vorname_,$nachname_,$status_ );
        while ($user->fetch()) {
            $user_d[$benutzername_]="$vorname_ $nachname_";
        }

	$sql = 'SELECT kundennummer, name, strasse, hausnummer, plz, ort, telefonnummer FROM kunde';
	$customer = $db_connection->prepare($sql);
	$customer->execute();
	$customer->bind_result($kundennummer_,$name_,$strasse_,$hausnummer_,$plz_,$ort_,$telefonnummer_);
        while ($customer->fetch()) {
            $customer_d[$kundennummer_]="$name_ (K-NR: $kundennummer_)";
        }

	if ($action =="hinzufuegen" ) { 
                $a['auftragsstatus']="C";
		$sql = 'INSERT INTO auftrag 
                        (`beschreibung`, `zeit_von`, `zeit_bis`, `auftragsstatus`, `kundennummer`, `benutzername`) 
                        VALUES (?, ?, ?, ?, ?, ? )';
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssis', 
                        $a['beschreibung'], 
                        $a['zeit_von'], 
                        $a['zeit_bis'],
                        $a['auftragsstatus'],
                        $a['kundennummer'],
                        $a['benutzername'] );
		$statement->execute();

		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1) {
			$info="Auftrag (".$a['beschreibung'].") wurde angelegt";
                        // attribute loeschen
                        foreach( array( "auftragsnummer",
                                        "beschreibung",
                                        "zeit_von",
                                        "zeit_bis",
                                        "kundennummer",
                                        "benutzername") AS $attribut) { 
                            $a[$attribut] = ""; 
                        };
		} else {
			$warnung="Der Auftrag-Eintrag konnte nicht hinzugef&uuml;gt werden.";
		}	
		unset($statement);
	} elseif ( $action == "bearbeiten") { 
	
                $auftragsstatus_="C";
		$sql = 'UPDATE auftrag 
                        SET beschreibung = ?, 
                        zeit_von = ?, 
                        zeit_bis = ?, 
                        auftragsstatus = ?, 
                        kundennummer = ?, 
                        benutzername = ? 
                        where auftragsnummer = ?';
	
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssisi', 
                                $a['beschreibung'], 
                                $a['zeit_von'], 
                                $a['zeit_bis'], 
                                $auftragsstatus_, 
                                $a['kundennummer'], 
                                $a['benutzername'], 
                                $a['auftragsnummer'] );
		$statement->execute();

		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1) {
			$info="Auftrag (".$a['beschreibung'].") konnte ge&auml;ndert werden.";
                        $a['auftragsstatus']="C";
		} else {
                        $result = $statement->errno;
			$warnung="Der Auftrag-Eintrag konnte nicht ge&auml;ndert werden. ($result)";
		}
		unset($statement);
	} elseif ( $action == "loeschen") { 
		$sql = 'SELECT count(*)
                        FROM auftrag
                        WHERE auftragsnummer = ? 
                        and ( auftragsstatus = "C" or auftragsstatus = "R") ';
		$statement = $db_connection->prepare($sql);
		$statement->bind_param( 's', $a['auftragsnummer']);
		$statement->execute();
		$statement->bind_result( $count );
		$statement->fetch();
		unset($statement);
	
		if ( $count == 1 ) {
	
			$sql = 'DELETE FROM auftrag WHERE auftragsnummer = ?';
	
			$statement = $db_connection->prepare( $sql );
			$statement->bind_param( 's', $a['auftragsnummer'] );
			$statement->execute();
			// Pruefen ob der Eintrag efolgreich war
			if ($statement->affected_rows == 1) {
				$info="Auftrag (".$a['beschreibung'].") wurde gel&ouml;scht.";
                                $a['auftragsstatus'] = "D"; 

			} else {
				$warnung="Der Auftrag-Eintrag konnte nicht gel&ouml;scht werden.";
			}
		} else {
			$warnung="Auftrag (".$a['beschreibung'].") kann nur im Angelegt- bzw. in Abgelehnt-Status (C/R) gel&ouml;scht werden.";
		}
	
	};
} else {
		$warnung='DB Problem!';
}

?>

<div id="Form">
<?php

if ($function =="bearbeiten" ) { 
	$action_text="bearbeiten"; 
} elseif ( $function == "loeschen") { 
	$action_text="l&ouml;schen"; 
} elseif ( $function == "hinzufuegen" ) {
	$action_text="hinzuf&uuml;gen";
} ;

?>
<h2>Auftrag <?php echo $action_text;  ?></h2>
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
      <td><a><?php echo $a['auftragsnummer'] ;?></a></td>
    </tr>
    <tr>
      <td><label for="beschreibung">Beschreibung: </label></td>
      <td><input name="beschreibung" id="beschreibung" class="required" title="Beschreibung ist notwendig" type="text" value="<?php echo $a['beschreibung'];?>" <?php echo $visible['beschreibung']?> size="40"/></td>
    </tr>
    <tr>
      <td><label for="zeit_von">Von: </label></td>
      <td><input name="zeit_von" id="<?php echo $zeit_von_id; ?>" class="required" type="Text" title="Zeit_von ist notwendig"value="<?php echo $a['zeit_von'];?>" <?php echo $visible['zeit_von']?> size="18"> </td>
    </tr>
    <tr>
      <td><label for="zeit_bis">Bis: </label></td>
      <td><input name="zeit_bis" id="<?php echo $zeit_bis_id; ?>" class="required" type="text" title="Zeit_bis ist notwendig"value="<?php echo $a['zeit_bis'];?>" <?php echo $visible['zeit_bis'] ?> size="18"/></td>
    </tr>
    <tr>
      <td><label for="auftragsstatus">Auftragsstatus: </label></td>
      <td><a><?php $as_ = $a['auftragsstatus'];echo $auftragsstatusb[$as_] ;?></a></td>
    </tr>
    <tr>
      <td><label for="kundennummer">Kunde: </label></td>
      <td>
<?php
if ( $visible['kundennummer']=="readonly" ) {
?>      
                <a><?php $k_=$a['kundennummer']; echo $customer_d[$k_]; ?></a>
      		<input name="kundennummer" id="kundennummer" class="" type="hidden" value="<?php echo $a['kundennummer'];?>" /></td>
<?php
} else {
?>
	 <select name="kundennummer" class="validate-not-first" title="Kunde ist notwendig" onchange="javascript:document.getElementById('username').value=this.form.kundennummer.options[this.form.kundennummer.selectedIndex].value">
				<option value="">Auswahl:</option>
	<?php
	include 'lib/mysql.php'; 
	$sql = 'SELECT kundennummer, name, strasse, hausnummer, plz, ort, telefonnummer FROM kunde';
	$customer = $db_connection->prepare($sql);
	$customer->execute();
	$customer->bind_result($kundennummer_,$name_,$strasse_,$hausnummer_,$plz_,$ort_,$telefonnummer_);
	
	
    while ($customer->fetch()) {
    	if ( $a['kundennummer'] == $kundennummer_ ) {
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
      <td><label for="benutzername" titel="Operative Mitarbeiter">OM:</label></td>
      <td>

<?php
if ( $visible['benutzername']=="readonly" ) {
?>      
                <a><?php $b_=$a['benutzername']; echo $user_d[$b_]; ?></a>
      		<input name="benutzername" id="benutzername" class="required" type="hidden" value="<?php echo $a['benutzername'];?>" /></td>
<?php
} else {
?>
		<select name="benutzername" class="validate-not-first" title="Mitarbeiter ist notwendig" onchange="javascript:document.getElementById('username').value=this.form.benutzername.options[this.form.benutzername.selectedIndex].value">
				<option value="">Auswahl:</option>
	<?php
	include 'lib/mysql.php'; 
	$sql = "SELECT benutzername, vorname, nachname, status FROM mitarbeiter where mitarbeitertyp = 'OM' AND status ='X' ";
	$user = $db_connection->prepare($sql);
	$user->execute();
	$user->bind_result($benutzername_,$vorname_,$nachname_,$status_ );
    while ($user->fetch()) {
    	if ( $a['benutzername'] == $benutzername_ ) {
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
<input name="auftragsnummer" id="auftragsnummer" type="hidden" value="<?php echo $a['auftragsnummer'];?>" />
<input name="auftragsstatus" id="auftragsstatus" type="hidden" value="<?php echo $a['auftragsstatus'];?>" />
<input name="function" id="function" type="hidden" value="<?php echo "$function";?>" />
<?php
if ($a['auftragsstatus'] != "C" AND 
    $a['auftragsstatus'] != "R" AND 
    ( $function == "bearbeiten" OR 
      $function == "loeschen" )) {
    $info="Auftrag (".$a['beschreibung'].") kann nur im Angelegt- bzw. in Abgelehnt-Status (C/R) bearbeitet bzw. gel&ouml;scht werden.";
}else { ?>
    <input name="submit" value="<?php echo $function;?>" class="button" type="submit">
<?php } ?>
<input type="button" VALUE="zur&uuml;ck" class="button" onClick="location.href='task_list.php'">
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
	hourText: "Std",
	minuteText: "Min",
	secondText: "Sek",
	millisecText: "MSek",
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
	hourText: "Std",
	minuteText: "Min",
	secondText: "Sek",
	millisecText: "MSek",
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
