<? include ("inc/header.php"); ?>
<? include ("inc/widget.php"); ?>
<h2>Kunden</h2>
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


include 'lib/mysql.php'; 
$sql = 'SELECT kundennummer, name, strasse, hausnummer, plz, ort, telefonnummer FROM kunde';
$stmt = $db_connection->prepare($sql);
$stmt->execute();
$stmt->bind_result($kundennummer,$name,$strasse,$hausnummer,$plz,$ort,$telefonnummer);

?>

</br>
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th>bearbeiten</th>
      <th>löschen</th>
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
      <td align="center"><a href="/customer_edit?kundennumer=<?php echo $kundennummer; ?>"><img src="img/icon_edit.png" ></a></td>
      <td align="center"><a href="/customer_delete?kundennumer=<?php echo $kundennummer; ?>"><img src="img/icon_delete.png"></a></td>
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

<? include ("inc/footer.php"); ?>
