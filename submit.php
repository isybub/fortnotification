<?php


			use google\appengine\api\users\User;
			use google\appengine\api\users\Userservice;

			$user = UserService::getCurrentUser();
			$uid = $user->getUserId();
			$uem = $user->getEmail();
if(isset($_POST)){
	
	$data = $uem;
	$data .= $_POST['items'];
	$keywords = explode(', ', $_POST['items']);

}

	include "db.php";
		

		$queryStr = "INSERT into items (name,uid) values ";
		foreach($keywords as $a){
			$queryStr .= "(\"".$a."\",".$uid."), ";
		}
		$queryStr = substr($queryStr, 0, -2);

		$tempDat = $db->prepare("select * from users where id = \"".$uid."\"");
		$tempDat->execute();
		$data = $tempDat->fetchAll();
		if (count($data) == 0)
		{
			$sql =  "INSERT into users (id, email) VALUES (\"".$uid."\", \"".$uem."\")";
			$query = $db->prepare($sql);
			$query->execute();

		}
		else
		{
			$sql =  "DELETE from items where uid = \"".$uid."\"";
			$query = $db->prepare($sql);
			$query->execute();
		}

		$query = $db->prepare($queryStr);
		$query->execute();



	

?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto:100" rel="stylesheet">
	<link rel="stylesheet" href="static/style.css" type="text/css" />
	<script src="static/script.js" ></script>
</head>
<body>
<div class="back">
	<div class="lilBox">
	<h2>Your submission has been completed.</h2>
		<p>Thank you so much for using Fortnotification!</p><br />
		<a href="index.php">go back</a></div>
	</div>
</body>
</html>