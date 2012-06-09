<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>



<?php

if ( empty($_SESSION['username'])) { 
include 'lib/redirect.php';
movePage(403,"login.php");
exit;
};

include 'lib/mysql.php'; 

// Kunden information
$sql = 'SELECT kundennummer, name, strasse, hausnummer, plz, ort, telefonnummer FROM kunde';
$customer = $db_connection->prepare($sql);
$customer->execute();
$customer->bind_result($kundennummer_,$name_,$strasse_,$hausnummer_,$plz_,$ort_,$telefonnummer_);
while ($customer->fetch()) {
    $customer_d[$kundennummer_]="$name_";
}

// Mitarbeiter information
$sql = "SELECT benutzername, vorname, nachname, status FROM mitarbeiter where mitarbeitertyp = 'OM'";
$user = $db_connection->prepare($sql);
$user->execute();
$user->bind_result($benutzername_,$vorname_,$nachname_,$status_ );
while ($user->fetch()) {
    $user_d[$benutzername_]="$vorname_ $nachname_";
}

// Aufträge
$sql = 'SELECT auftragsnummer, beschreibung, zeit_von, zeit_bis, auftragsstatus, kundennummer,benutzername FROM auftrag';
$stmt = $db_connection->prepare($sql);
$stmt->execute();
$stmt->bind_result($auftragsnummer,$beschreibung,$zeit_von,$zeit_bis,$auftragsstatus,$kundennummer,$benutzername );

$auftragsstatusb['A']="Angenommen";
$auftragsstatusb['R']="Abgelehnt";
$auftragsstatusb['F']="Abgeschlossen";
$auftragsstatusb['C']="Angelegt";
?>

<div id="Content">
<h2>Auftrag</h2>
</br>
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th>B</th>
      <th>L</th>
      <th>Auftragsnr.</th>
      <th>Beschreibung</th>
      <th>von</th>
      <th>bis</th>
      <th>Status</th>
      <th>Kunde</th>
      <th>Mitarbeiter</th>
    </tr>
  </thead>
  <tbody>
    <!--Loop start, you could use a repeat region here-->
<?php
while ($stmt->fetch()) {
?>
    
    <tr>
      <td align="center"><a href="task.php?<?php echo "auftragsnummer=$auftragsnummer&beschreibung=$beschreibung&zeit_von=$zeit_von&zeit_bis=$zeit_bis&auftragsstatus=$auftragsstatus&kundennummer=$kundennummer&benutzername=$benutzername&function=bearbeiten"; ?>"><img src="images/icon_edit.png" alt="bearbeiten"></a></td>
      <td align="center"><a href="task.php?<?php echo "auftragsnummer=$auftragsnummer&beschreibung=$beschreibung&zeit_von=$zeit_von&zeit_bis=$zeit_bis&auftragsstatus=$auftragsstatus&kundennummer=$kundennummer&benutzername=$benutzername&function=loeschen"; ?>"><img src="images/icon_delete.png" alt="l&ouml;schen"></a></td>
      <td><?php echo $auftragsnummer?></td>
      <td><?php echo $beschreibung?></td>
      <td><?php echo $zeit_von?></td>
      <td><?php echo $zeit_bis?></td>
      <td><?php echo $auftragsstatusb[$auftragsstatus] ?></td>
      <td><?php echo $customer_d[$kundennummer]?></td>
      <td><?php echo $user_d[$benutzername]?></td> 
    </tr>
<?php
}
?>

    <!--Loop end-->
  </tbody>
</table>
</div>


<? include ("inc/footer.php"); ?>
