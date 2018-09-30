<?php
	use google\appengine\api\users\User;
	use google\appengine\api\users\Userservice;
	$user = UserService::getCurrentUser();
	$uid = $user->getUserId();
	$uem = $user->getEmail();
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto:100" rel="stylesheet">
	<link rel="stylesheet" href="static/style.css" type="text/css" />
	<script src="static/script.js" ></script>


</head>
<body>
<div class="back">
	
		<header class="header"><h1> FortNotification </h1></header>

		<div class="content2">


			<?php

	include "db.php";
			$tempDat = $db->prepare("select * from users where id = \"".$uid."\"");
			$tempDat->execute();
			$data = $tempDat->fetchAll();
			if (count($data) == 0){
				require_once("NewFile.php");
			}else{
				require_once("updateFile.php");
			}
			
		?>
	</div>
	
</div>
</body>