<?php include 'header.php';
require 'database-config.php';
?>
      <div class="card mb-3">
        <div class="card-header">
          My Pets<a href="#" class="btn btn-success pull-right" data-toggle="modal" id="addlinks"><span class="glyphicon glyphicon-plus"></span>Add new pet</a></div>
        <div class="card-body">
          <?php 
          $sql = "SELECT * FROM pet";

          $result = mysqli_query($conn, $sql);
          if (!$result) {
            die("Can't query date. Error occure".mysqli_error($conn));
          }
          if (mysqli_num_rows($result) > 0) {

           while($row = mysqli_fetch_assoc($result)) {
            echo '<a class="pet-link" href="detail.php?id='.$row["id"].'">';
            echo '<div class="product-container">';
            echo '<img class="img-responsive" id="thumbnail" src="'.$row["image"].'">';
            echo '<h3>'.$row["name"].'</h3>';
            echo '</div>';
            echo '</a>';
           }
          }else {
        echo "0 results";
        }
        mysqli_close($conn);
        ?> 
        </div>
        <div class="card-footer small text-muted"></div>
        </div>
    </div>
        <!-- Add Products -->
        <!-- Modal -->
        <div id="add" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form id="add-product-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> New Product</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                            
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand" class="form-control">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price" id="price" required>
                            </div>
                            <div class="form-group">
                                <label for="volume">Volume</label>
                                <input type="text" class="form-control" name="volume" id="volume" required>
                            </div>
                            <div class="form-group">
                                <label for="alcohol">Alcohol</label>
                                <input type="text" class="form-control" name="alcohol" id="alcohol" required>
                            </div>
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
                            
                            <h4 class="modal-title">Update Product</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                            
                            <div class="form-group">
                                <input type="hidden" name="id" id="uid">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="uname" required>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Brand</label><br>
                                <select class="form-control" name="brand_id" id="ubrand">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price" id="uprice" required>
                            </div>
                            <div class="form-group">
                                <label for="volume">Volume</label>
                                <input type="text" class="form-control" name="volume" id="uvolume" required>
                            </div>
                            <div class="form-group">
                                <label for="alcohol">Alcohol</label>
                                <input type="text" class="form-control" name="alcohol" id="ualcohol" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="udescription"></textarea>
                                
                            </div>
                            <div class="form-group">
                              <label for="">Image</label>
                              <input type="file" name="fileToUpload" id="ufileToUpload">
                              <img src="#" id="uimage-preview" style="height: 150px">
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
                            
                            <h4 class="modal-title">Delete Product</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <input type="hidden" name="id" id="did">
                                
                            </div>
                            Delete this product?
                            
                            
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
<script type="text/javascript" src="script.js"></script>

