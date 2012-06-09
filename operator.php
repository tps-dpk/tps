<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<? include ("inc/form.php"); ?>
<? include ("lib/redirect.php"); ?>

<?php

#error_reporting(-1);
#ini_set('display_errors','On');

if ( empty($_SESSION['username'])) { 
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
$attribute = array("benutzername","pass","mitarbeitertyp","vorname","nachname","status");
foreach($attribute AS $attribut) {
        if (isset($_GET[$attribut])) {
                $a[$attribut] = $_GET[$attribut];
        }else {
                $a[$attribut] = "";
        }
}

// Alle Variablen sind Schreib geschützt.
foreach($attribute AS $attribut) {
        $visible[$attribut]="readonly";
};

// Beim hinzufügen müssen die Attribute bearbeitet werden können.
if ( $function == "hinzufuegen") {
        foreach( $attribute AS $attribute) {
                $visible[$attribute]="writeable";
        };
} elseif ( $function == "bearbeiten") {
        foreach( array( "pass",
                        "vorname",
                        "nachname",
                        "status") AS $attribute) {
                $visible[$attribute]="writeable";
        };
}

$mitarbeitertypb['OM']="Operative Mitarbeiter";
$mitarbeitertypb['DP']="Disponent";

$flag="";
$info="";
$warnung="";
?>




<?php 
include 'lib/mysql.php';

if (mysqli_connect_errno() == 0) {

	if ($action =="hinzufuegen" ) { 
                #---------------------
		$sql = 'INSERT INTO mitarbeiter (`benutzername`, `passwort`, `mitarbeitertyp`, `vorname`, `nachname`, `status`) VALUES (?, ?, ?, ?, ?, ? )';
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssss',$a['benutzername'], $a['pass'], $a['mitarbeitertyp'], $a['vorname'], $a['nachname'], $a['status'] );
		$statement->execute();
		// Pruefen ob der Eintrag efolgreich war
		if ($statement->affected_rows == 1) {
			$info="Mitarbeiter (".$a['benutzername'].") wurde angelegt";
                        // Attribute initialisieren
                        $attribute = array("benutzername","pass","mitarbeitertyp","vorname","nachname","status");
                        foreach($attribute AS $attribut) { 
                            $a[$attribut] = ""; 
                        }
		} else {
			$warnung="Der Eintrag konnte nicht hinzugef&uuml;gt werden.";
		}
	} elseif ( $action == "bearbeiten") { 
                #---------------------
                # bearbeiten
                #---------------------
	
		$sql = 'UPDATE mitarbeiter SET passwort = ?, mitarbeitertyp = ?, vorname = ?, nachname = ?, status = ? where benutzername = ?';
	
		$statement = $db_connection->prepare( $sql );
		$statement->bind_param( 'ssssss', $a['pass'], $a['mitarbeitertyp'], $a['vorname'], $a['nachname'], $a['status'], $a['benutzername'] );
		$statement->execute();
		// Pruefen ob die Bearbeitung efolgreich war
		if ($statement->affected_rows == 1) {
			$info="Mitarbeiter (".$a['benutzername'].") wurde ge&auml;ndert.";
		} else {
			$warnung="Der Eintrag konnte nicht ge&auml;ndert werden.";
		}
	} elseif ( $action == "loeschen") { 
                #---------------------
                # löschen
                #---------------------
		$sql = 'SELECT count(*)  FROM auftrag WHERE benutzername = ?';
		$statement = $db_connection->prepare($sql);
		$statement->bind_param( 's', $a['benutzername'] );
		$statement->execute();
		$statement->bind_result( $count );
		$statement->fetch();
		unset($statement);
	
		if ( $count == 0 ) {
	
			$sql = 'DELETE FROM mitarbeiter WHERE benutzername = ?';
	
			$statement = $db_connection->prepare( $sql );
			$statement->bind_param( 's', $a['benutzername'] );
			$statement->execute();
			// Pruefen ob der Eintrag efolgreich war
			if ($statement->affected_rows == 1) {
				$info="Mitarbeiter (".$a['benutzername'].") wurde gel&ouml;scht.";
                                $flag="deleted";
                                #movePage(200,"operator_list.php");
                                #exit;
			} else {
				$warnung="Der Eintrag konnte nicht gel&ouml;scht werden.";
			}
		} else {
			$warnung="Mitarbeiter (".$a['benutzername'].") hat Auftr&auml;ge ($count) zugeordnet und kann deshalb nicht gel&ouml;scht werden.";
		}
	
	};
} else {
		$warnung='DB Problem!';
} ?>


<?php

if ($function =="bearbeiten" ) {
            $action_text="bearbeiten";
} elseif ( $function == "loeschen") {
            $action_text="l&ouml;schen";
} elseif ( $function == "hinzufuegen" ) {
            $action_text="hinzuf&uuml;gen";
} ;

?>

<div id="Form">
<h2>Mitarbeiter <?php echo $action_text;  ?></h2>
<br />
<form method="get" action="#" name="operator" id="operator_form" >
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
      <td><input name="benutzername" id="benutzername" title="Benutzername ist notwendig" class="required" type="text" value="<?php echo $a['benutzername'];?>" <?php echo $visible['benutzername']?>/></td>
    </tr>
    <tr>
      <td><label for="pass">Passwort: </label></td>
      <td><input name="pass" id="pass" title="Passwort ist notwendig" class="required" type="password" value="<?php echo $a['pass'] ?>" <?php echo $visible['pass']?>/></td>
    </tr>
    <tr>
      <td><label for="mitarbeitertyp">Mitarbeitertyp: </label></td>
      <td>
<?php
if ( $visible['mitarbeitertyp']=="readonly" ) {
?>
        <a><?php $m_=$a['mitarbeitertyp']; echo $mitarbeitertypb[$m_] ?></a>
        <input name="mitarbeitertyp" id="mitarbeitertyp" type="hidden" value="<?php echo $a['mitarbeitertyp'] ?>"  />
<?php
} else { ?>

    	<select name="mitarbeitertyp" class="validate-not-first" title="Mitarbeitertyp ist notwendig" >
            <option value="">Auswahl:</option>
            <option value="OM" <?php if ( $a['mitarbeitertyp'] == "OM" ) { echo 'selected="selected"';}; ?>><?php echo $mitarbeitertypb['OM']?></option>
    	</select>
<?php } ?>
      </td>      
    </tr>
    <tr>
      <td><label for="vorname">Vorname: </label></td>
      <td><input name="vorname" id="vorname" title="Vorname ist notwendig" class="required" type="text" value="<?php echo $a['vorname'];?>" <?php echo $visible['vorname']?>/></td>
    </tr>
    <tr>
      <td><label for="nachname">Nachname: </label></td>
      <td><input name="nachname" id="nachname" title="Nachname ist notwendig" class="required" type="text" value="<?php echo $a['nachname'];?>" <?php echo $visible['nachname']?>/></td>
    </tr>
    <tr>
      <td><label for="status">Status: </label></td>
      <td>
<?php
if ( $visible['status']=="readonly" ) {
?>
        <input type="radio" name="status" class="validate-one-required" title="Status ist notwendig" <?php  if ( $a['status'] == "X" ) {  echo "checked"; } ?> value="X" readonly onclick="return(false);"> Aktiv  
        <input type="radio" name="status" <?php  if ( $a['status'] == "" ) {  echo "checked"; } ?> value="" readonly onclick="return(false);"> Deaktiv<br>
            
<?php
} else {
?>
      		<input type="radio" name="status" class="validate-one-required" title="Status ist notwendig" <?php  if ( $a['status'] == "X" ) {  echo "checked"; } ?> value="X"> Aktiv  
      		<input type="radio" name="status" <?php  if ( $a['status'] == "" ) {  echo "checked"; } ?> value=""> Deaktiv<br>
<?php
}
?>
      
      </td>
      
    </tr>
   </tbody>
</table>
<input name="function" id="function" type="hidden" value="<?php echo "$function";?>" />
<?php if ($flag != "deleted" ) { ?>
        <input name="submit" value="<?php echo $function;?>" class="button" type="submit">
<?php } ?>
<input type="button" VALUE="zur&uuml;ck" class="button" onClick="location.href='operator_list.php'">
</form>
</div>





<div id="Messages">
<p id="info"><?php echo $info;?></p>
<p id="warning"><?php echo $warnung;?></p>
</div>


<? include ("inc/footer.php"); ?>
