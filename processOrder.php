<?php
  require("session.php");
  require("secrets.php");
  //header('Location:viewSanctionQuotes.php');
?>

<?php
$temp = str_ireplace("\$",'  ', $_POST['amount']);
echo $temp."<br>";
$url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
$data = array(
	'order' => $_POST['orderNum'],
	'associate' => $_POST['Asso_Id'],
	'custid' => $_POST['Cust_Id'],
	'amount' => $temp);

$options = array(
    'http' => array(
        'header' => array('Content-type: application/json', 'Accept: application/json'),
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$values = json_decode($result, true);

echo $values['order']."<br>";
echo $values['associate']."<br>";
echo $values['custid']."<br>";
echo $values['amount']."<br>";
echo $values['name']."<br>";
echo $values['processDay']."<br>";
echo $values['commission']."<br>";
echo $values['timeStamp']."<br>";
echo $values['_id']."<br>";

$temp = chop($values['commission'],"%");
$temp = floatval($temp) / 100;
echo $commission = floatval($values['amount']) - (floatval($values['amount']) * $temp);

if (isset($values['processDay']))
{
  $insertOrder = "insert into Ordered_Quote (Quote_Id, processDay, finalPrice, commiss) values (".$values['order'].", '".$values['processDay']."', ".$values['amount'].", ".$commission.");";

  $getCommis = "select Accu_Com from Associate where User_Id = ".$values['associate'].";";
  $result = $pdo->query($getCommis);
  $Commis = $result->fetch();
  $commissionNew = floatval($Commis['Accu_Com']) + $commission;
  $changeCom = "update Associate set Accu_Com = ".$commissionNew." where User_Id = ".$values['associate'].";";
  $changeStat = "update Quote set Status = 'Ordered' where Quote_Id = ".$values['order'].";";

  $pdo->query($insertOrder);
  $pdo->query($changeCom);
  $pdo->query($changeStat);
}
?>
