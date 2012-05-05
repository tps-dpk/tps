<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<h2>Operative Mitarbeiter</h2>
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


include 'lib/mysql.php'; 
$sql = 'SELECT benutzername, passwort, mitarbeitertyp, vorname, nachname, status FROM mitarbeiter';
$stmt = $db_connection->prepare($sql);
$stmt->execute();
$stmt->bind_result($benutzername,$passwort,$mitarbeitertyp,$vorname,$nachname,$status );

?>


</br>
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th>bearbeiten</th>
      <th>köschen</th>
      <th>Benutzername</th>
      <th>Mitarbeitertype</th>
      <th>Vorname</th>
      <th>Nachnahme</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <!--Loop start, you could use a repeat region here-->
    
<?php
while ($stmt->fetch()) {
?>
    <tr>
      <td align="center"><a href="/operator_edit?benutzernahme=<?php echo $benutzername?>"><img src="images/icon_edit.png" ></a></td>
      <td align="center"><a href="/operator_delete?benutzernahme=<?php echo $benutzername?>"><img src="images/icon_delete.png"></a></td>
      <td><?php echo $benutzername ?></td>
      <td><?php echo $mitarbeitertyp ?></td>
      <td><?php echo $vorname ?></td>
      <td><?php echo $nachname ?></td>
      <td><?php echo $status ?></td>
    </tr>
<?php
}
?>
    <!--Loop end-->
  </tbody>
</table>

<? include ("inc/footer.php"); ?>
