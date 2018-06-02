<?php 
session_start();
header("Content-Type:application/json");
require 'database-config.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['description'])){
	
		$description = str_replace("\r\n","<br>",$_POST['description']);
		$target_dir = "img/";
		$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$image = $target_file;
		
		$sql = "INSERT INTO image(description,image,pet_id) VALUES('".$description."','".$image."','".$_SESSION["id"]."')";

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
mysqli_close($conn);
echo json_encode($data);
}

?>
	
