<?php 
header("Content-Type:application/json");
require 'database-config.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['pet_name'])){
		$id = $_POST['id'];
		$name = $_POST['pet_name'];
		$bio = str_replace("\r\n","<br>",$_POST['bio']);		
		$target_dir = "img/";
		$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$image = $target_file;
		if($image!='img/'){

		$sql = "UPDATE pet SET name='".$name."',bio='".$bio."', image='".$image."' WHERE id=".$id;
		    
		}else{
		    $sql = "UPDATE pet SET name='".$name."',bio='".$bio."' WHERE id=".$id;
		}

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
	
