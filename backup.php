<?php
//Backs up DB to cloudstore
include "db.php";
$tempDat = $db->prepare("select * from users");
$tempDat->execute();
$data = $tempDat->fetchAll();

$userStr = "";
foreach($data as $row)
{
	$userStr .= $row['email'].", ".$row['id']."\r\n";
}

$tempDat = $db->prepare("select * from items");
$tempDat->execute();
$items = $tempDat->fetchAll();

$itemsStr = "";
foreach($items as $row) {
	$itemsStr .= $row['name'].", ".$row['uid']."\r\n";
}

echo $itemsStr;

echo "<br />";

echo $userStr;

$time = time();

$filename = 'gs://fortnotification.appspot.com/sqlBackup/'.$time.'/users.txt';
			
$handle = fopen($filename,'w');
fwrite($handle, $userStr);
fclose($handle);
$filename = 'gs://fortnotification.appspot.com/sqlBackup/'.$time.'/items.txt';
$handle = fopen($filename,'w');
fwrite($handle, $itemsStr);
fclose($handle);


?>