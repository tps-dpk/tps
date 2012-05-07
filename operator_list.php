<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>

<?php

if ( empty($_SESSION['username'])) { 
include 'lib/redirect.php';
movePage(403,"login.php");
exit;
};

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


include 'lib/mysql.php'; 
$sql = 'SELECT benutzername, passwort, mitarbeitertyp, vorname, nachname, status FROM mitarbeiter';
$stmt = $db_connection->prepare($sql);
$stmt->execute();
$stmt->bind_result($benutzername,$passwort,$mitarbeitertyp,$vorname,$nachname,$status );

?>

<div id="Content">
<h2>Mitarbeiter</h2>
</br>
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th></th>
      <th></th>
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
      <td align="center"><a href="operator.php?<?php echo "benutzername=$benutzername&passwort=$passwort&mitarbeitertyp=$mitarbeitertyp&vorname=$vorname&nachname=$nachname&status=$status&function=edit"?>"><img src="images/icon_edit.png"  alt="bearbeiten" ></a></td>
      <td align="center"><a href="operator.php?<?php echo "benutzername=$benutzername&passwort=$passwort&mitarbeitertyp=$mitarbeitertyp&vorname=$vorname&nachname=$nachname&status=$status&function=delete"?>"><img src="images/icon_delete.png" alt="löschen"></a></td>
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
</div>
<? include ("inc/footer.php"); ?>
