<?php include 'header.php';
require 'database-config.php';
session_start(); 
$my_var= $_SERVER['PHP_SELF'];
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

 		<!-- Image Modal -->
 		<div id="modal-image"></div>
        <!-- Add Products -->
        <!-- Modal -->
        <div id="add" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form id="add-product-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> New Image</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <img src="#" id="image-preview" style="height: 150px">
                            </div>
                                
                            </div>
                            
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="add-btn" style="width: 20%">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End add -->
        <!-- Edit Products -->
        <!-- Modal -->
        <div id="update" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form id="update-product-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h4 class="modal-title">Edit Description</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="uid">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="udescription"></textarea>                               
                            </div>                          
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="save-btn" style="width: 20%">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End update Products -->

        <div id="delete" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form id="delete-product-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" align="left">
                            
                            <h4 class="modal-title">Delete Pet</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <input type="hidden" name="id" id="did">
                                
                            </div>
                            Delete this Pet?
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="yes-btn" style="width: 20%">Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
include 'footer.php'
 ?> 
    <!-- My Script -->
    <script type="text/javascript">
    	var my_var = <?php echo json_encode($my_var); ?>;
    </script>
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