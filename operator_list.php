<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>

<?php

if ( empty($_SESSION['username'])) { 
include 'lib/redirect.php';
movePage(403,"login.php");
exit;
};

$mitarbeitertypb['OM']="Operator";
$mitarbeitertypb['DP']="Disponente";

include 'lib/mysql.php'; 
$sql = 'SELECT benutzername, passwort, mitarbeitertyp, vorname, nachname, status FROM mitarbeiter where mitarbeitertyp = "OM"';
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
      <th>B</th>
      <th>L</th>
      <th>Benutzername</th>
      <th>Vorname</th>
      <th>Nachnahme</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <!--Loop start, you could use a repeat region here-->
    
<?php
while ($stmt->fetch()) {
    if (isset($status) AND $status == "X") {
        $statusb="aktiv";
    } else {
        $statusb="deaktiv";
    }
?>
    <tr>
      <td align="center"><a href="operator.php?<?php echo "benutzername=$benutzername&pass=$passwort&mitarbeitertyp=$mitarbeitertyp&vorname=$vorname&nachname=$nachname&status=$status&function=bearbeiten"?>"><img src="images/icon_edit.png"  alt="bearbeiten" ></a></td>
      <td align="center"><a href="operator.php?<?php echo "benutzername=$benutzername&pass=$passwort&mitarbeitertyp=$mitarbeitertyp&vorname=$vorname&nachname=$nachname&status=$status&function=loeschen"?>"><img src="images/icon_delete.png" alt="l&ouml;schen"></a></td>
      <td><?php echo $benutzername ?></td>
      <td><?php echo $vorname ?></td>
      <td><?php echo $nachname ?></td>
      <td><?php echo $statusb ?></td>
    </tr>
<?php
}
?>
    <!--Loop end-->
  </tbody>
</table>
</div>
<? include ("inc/footer.php"); ?>
