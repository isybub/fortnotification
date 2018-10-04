<?php



require_once('Auth.php');
require_once('Client.php');
require_once 'php/google-api-php-client/vendor/autoload.php';


	include "db.php";

	
$api = new FortniteClient;
$api->setKey("12d728272eb70aefdded110f702c80fa");
$store = getStore($api);
function getStore($api){
	$return = json_decode($api->httpCall('store/get', ['language' => 'en']),true);

	if(isset($return->error))
	{
		return $return->errorMessage;
	}
	else
	{
		return $return;
	}
}

$itemsAll = $store['items'];
$strbuild = "";
foreach($itemsAll as $a){
	$strbuild .= '"'.$a["name"].'"'.",";
}
$strbuild = substr($strbuild, 0, -1);


		

$tempDat = $db->prepare("select * from users");
$tempDat->execute();
$data = $tempDat->fetchAll();


foreach($data as $user){
	
	$tempDat = $db->prepare("select name FROM items WHERE uid = \"".$user['id']."\" And name in (".$strbuild.")");
	echo "select name FROM items WHERE uid = \"".$user['id']."\" And name in (".$strbuild.")";
	echo '<br />';
	$tempDat->execute();
	$matches= $tempDat->fetchAll();
	print_r($matches);
	echo '<br />';

	$msg = "Hello! The fortnite store currently has an item that you want!";
	$msg .= "\nYou were looking for:\n";

	$tempDat = $db->prepare("select name FROM items WHERE uid = \"".$user['id']."\"");
	$tempDat->execute();
	$data = $tempDat->fetchAll();
	
	$str = "";
	foreach ($data as $row) {
 		$str .= $row['name'].", ";
 	}
 	$str = substr($str, 0, -2);
 	$msg .= $str;
	$msg .= "\n\nThe item store has:\n";
	if(count($matches)>0){
		foreach($matches as $m){
			$msg .= " ".$m['name'].",";
		}
 		$msg = substr($msg, 0, -1);
		$msg .= "\nThank you so much for using FortNotification!";
		$from = "isybub6@gmail.com";
		$headers = 'From: ' . $from . "\r\n";
		mail($user['email'],"FortNotification: You've got items!", $msg,$headers);
		echo $msg;
	}
}


?>

