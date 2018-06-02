<?php 
header("Content-Type:application/json");
require 'database-config.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['description'])){
		$id = $_POST['id'];
		$description = str_replace("\r\n","<br>",$_POST['description']);		

		$sql = "UPDATE image SET description='".$description."' WHERE id=".$id;		    

		$result = mysqli_query($conn, $sql);
		if($result){
			$data["result"] = true;
			$date["message"] = "Add pet successfully";
			//echo header("location: index.php");
			//die();
		}else{
			$data["result"]=false;
			$data["message"] = "Can not add pet. Error: ".mysqli_error($conn);
		}
	}else{
		$data["result"]=false;

		$data["message"]= "Invalid pet information";
	}
	echo json_encode($data);
}

?>
	
