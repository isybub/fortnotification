<?php


	use google\appengine\api\users\User;
	use google\appengine\api\users\Userservice;
	$user = UserService::getCurrentUser();
	$uid = $user->getUserId();
	$uem = $user->getEmail();

	include "db.php";

	$tempDat = $db->prepare("select name FROM items WHERE uid = \"".$uid."\"");
	$tempDat->execute();
	$data = $tempDat->fetchAll();
	$str = "";
	$str2 = "";
	foreach ($data as $row) {

 		$str .= $row['name'].", ";
 		$str2 .= '"'.$row["name"].'"'.",";
 	}
 	$str = substr($str, 0, -2);
	$str2 = substr($str2, 0, -1);


 	//Reccommendations
 	$tempDat = $db->prepare("select name, count(name) as freq FROM items  where name not in (".$str2.") group by name order by count(name)  desc limit 3");
 	$tempDat->execute();
	$data = $tempDat->fetchAll();
 
 	$rec = "";
 	foreach ($data as $row) {
 		$rec .= $row['name'].", ";
 	}
 	$rec = substr($rec, 0, -2);
	
	
/*
	$my_file = 'gs://fortnotification.appspot.com/files/'.$user->getEmail().'.txt';

	$data = file_get_contents($my_file);
	$data = explode(",",$data);
	array_shift($data);
	$data = implode(",",$data);
	$data = trim($data, " \t\n\r");*/

?>
<p> Update the file, entering items you wish to track separated by commas. </p>

<form action="submit.php" method="POST">
  <div>
    <?php echo '<textarea rows="4" cols="50" id="items" name="items">'.$str.'</textarea>'?>
  </div>
  <div>
  	<?php 
  	if(strlen($rec)>0){
	  	echo "Based on your current items we would recommend the following items: ";
	  	echo "<br />";
	  	echo $rec; 
  	}else{
  		echo "You are looking for all of the items everyone wants!"
  	}
  	?>
  </div>
  <div>
    <button>Submit</button>
  </div>
</form>