<?php 
header("Content-Type:application/json");
require 'database-config.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['pet_name'])){
	
		$name = $_POST['pet_name'];
		$bio = str_replace("\r\n","<br>",$_POST['bio']);
		$target_dir = "img/";
		$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$image = $target_file;
		
		$sql = "INSERT INTO pet(name,bio,image) VALUES('".$name."','".$bio."','".$image."')";

		$result = mysqli_query($conn, $sql);
		if($result){
			$data["result"] = true;
			$date["message"] = "Add pet successfully";
			//echo header("location: index.php");
			//die();
		}else{
			$data["result"]=false;
			$data["message"] = "Can not add product. Error: ".mysqli_error($conn);
		}
	}else{
		$data["result"]=false;

		$data["message"]= "Invalid product information";
	}
mysqli_close($conn);
echo json_encode($data);
}

?>
	
