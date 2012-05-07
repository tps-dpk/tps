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
$sql = 'SELECT kundennummer, name, strasse, hausnummer, plz, ort, telefonnummer FROM kunde';
$stmt = $db_connection->prepare($sql);
$stmt->execute();
$stmt->bind_result($kundennummer,$name,$strasse,$hausnummer,$plz,$ort,$telefonnummer);

?>
<div id="Content">
<h2>Kunden</h2>
</br>
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th>Kundennummer</th>
      <th>Name</th>
      <th>Strasse</th>
      <th>Hausnummer</th>
      <th>PLZ</th>
      <th>Ort</th>
      <th>Telefonnumer</th>
    </tr>
  </thead>
  <tbody>
  
<?php
while ($stmt->fetch()) {
  #header("Content-Type: text/json");
  #echo json_encode($json);
?>

    <tr>
      <td align="center"><a href="customer.php?<?php echo "kundennummer=$kundennummer&name=$name&strasse=$strasse&hausnummer=$hausnummer&plz=$plz&ort=$ort&telefonnummer=$telefonnummer&function=edit"; ?>"><img src="images/icon_edit.png"  alt="bearbeiten" ></a></td>
      <td align="center"><a href="customer.php?<?php echo "kundennummer=$kundennummer&name=$name&strasse=$strasse&hausnummer=$hausnummer&plz=$plz&ort=$ort&telefonnummer=$telefonnummer&function=delete"; ?>"><img src="images/icon_delete.png" alt="löschen"></a></td>
      <td><?php echo $kundennummer; ?></td>
      <td><?php echo $name; ?></td>
      <td><?php echo $strasse; ?></td>
      <td><?php echo $hausnummer; ?></td>
      <td><?php echo $plz; ?></td>
      <td><?php echo $ort; ?></td>
      <td><?php echo $telefonnummer; ?></td>
    </tr>
<?php

}
?>
  </tbody>
</table>
</div>

<? include ("inc/footer.php"); ?>
