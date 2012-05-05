<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<h2>Aufgaben</h2>
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


include 'lib/mysql.php'; 
$sql = 'SELECT auftragsnummer, beschreibung, zeit_von, zeit_bis, auftragsstatus, kundennummer,benutzername FROM auftrag';
$stmt = $db_connection->prepare($sql);
$stmt->execute();
$stmt->bind_result($auftragsnummer,$beschreibung,$zeit_von,$zeit_bis,$auftragsstatus,$kundennummer,$benutzername );

?>

</br>
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th>bearbeiten</th>
      <th>löschen</th>
      <th>Auftragsnummer</th>
      <th>Beschreibung</th>
      <th>von</th>
      <th>bis</th>
      <th>Status</th>
      <th>Kundennummer</th>
      <th>Mitarbeiter</th>
    </tr>
  </thead>
  <tbody>
<?php
while ($stmt->fetch()) {
?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td align="center"><a href="/task_edit?auftrag=<?php echo $auftragsnummer?>"><img src="img/icon_edit.png" ></a></td>
      <td align="center"><a href="/task_delete?auftrag=<?php echo $auftragsnummer?>"><img src="img/icon_delete.png"></a></td>
      <td><?php echo $auftragsnummer?></td>
      <td><?php echo $beschreibung?></td>
      <td><?php echo $zeit_von?></td>
      <td><?php echo $zeit_bis?></td>
      <td><?php echo $auftragsstatus?></td>
      <td><?php echo $kundennummer?></td>
      <td><?php echo $benutzername?></td> 
    </tr>
<?php
}
?>

    <!--Loop end-->
  </tbody>
</table>

<? include ("inc/footer.php"); ?>
