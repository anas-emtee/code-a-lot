<?php
function getContent($name){
	$content = [];
	$con = Dbcon();

	$query = "SELECT `title`, `content` FROM `web_content` WHERE `name`='".$name."'";
	if($result = mysqli_query($con,$query)){
		$row = mysqli_fetch_array($result);
		$content = $row;
	}else{
		$content = ["Not Found", "Requested Content Not Found"];
	}
	
	mysqli_close($con);
	return $content;
}

?>
