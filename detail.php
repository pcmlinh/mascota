<?php include 'header.php';
require 'database-config.php';
session_start(); 
?>
<a href="#" class="btn btn-success pull-right" data-toggle="modal" id="addlinks"><span class="glyphicon glyphicon-plus"></span>Add new image</a>
<?php 

	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$_SESSION["id"]=$id;
	}
	// echo "Connected successfully";
	              
	$sql = "SELECT * FROM pet WHERE id=".$id."";

	$result = mysqli_query($conn, $sql);
	if (!$result) {
	    die("Can't query date. Error occure".mysqli_error($conn));
	}
	    if (mysqli_num_rows($result) > 0) {
	// output data of each row

	while($row = mysqli_fetch_assoc($result)) {
	    echo '<div class="container">';
	    echo '<img class="img-responsive" id="thumbnail" src="'.$row["image"].'">';
    	echo '</div>';
    }
                mysqli_close($conn);
        
        }	

	?>
	<section>
<div class="container">
	<div class="row">	
	     
	</div>
</div>
</section>
<?php
include 'footer.php'
 ?> 
    <!-- My Script -->
<script  type="text/javascript" >
      function loadImage(input){
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e){
            $("#image-preview").attr("src",e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#fileToUpload").change(function(){
        loadImage(this);
      });
    </script>
<script type="text/javascript" src="detailscript.js"></script>