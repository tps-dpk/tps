<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

function get_customer() {
  include '../lib/mysql.php'; 
  $sql = 'SELECT * FROM kunde';
  $stmt = $db_connection->prepare($sql);
  $stmt->execute();
  $stmt->bind_result($kundennummer,$name,$strasse,$hausnummer,$plz,$ort,$telefonnummer);


  $result   = array();
  #$json   = array();

  while ($stmt->fetch()) {
        $result[]=array( 'kundennummer'=>$kundennummer,'name'=>$name,'strasse'=>$strasse,'hausnummer'=>$hausnummer,'plz'=>$plz,'ort'=>$ort,'telefonnummer'=>$telefonnummer );
    }

  #header("Content-Type: text/json");
  #echo json_encode($json);
  
  return $result;

}

function create_table() {

foreach (get_cusotmer() as $ref) { 
?>
    <tr>
       <td><?php echo $ref[kundennummer]; ?></td>
       <td><?php echo $ref[kundennummer]; ?></td>
       <td><?php echo $ref[kundennummer]; ?></td>
       <td><?php echo $ref[kundennummer]; ?></td>
       <td><?php echo $ref[kundennummer]; ?></td>
    </tr>
<?php

}

}


?>
