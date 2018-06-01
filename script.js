console.log('connected');
$(document).ready(function(){
	getPets();
	$('#product-table').DataTable({
		responsive: true,
		autoWidth: false,
		searching: false,
		paging: false,
	});
	$("#addlinks").click(function(e){
		$("#add").modal();
	});
	$("#add-btn").click(function(event){	
		var productform = document.querySelector("#add-product-form");
		$.ajax({
			method: "POST",
			dataType: 'json',
			url: 'addPet.php',
			//dataType: 'json',
			processData:false,
			contentType: false,
			data: new FormData(productform),
		}).done(function(data){
			getPets();
			$("#add").modal("hide");		
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})
	})


	//Update

	$("#petls").on("click",".edit",function(e){
		//Đọc thông tin
		
		var id = $(this).parents(".info").attr("id");
		var name = $(this).parents(".info").find(".name").text();
		var bio = $(this).parents(".info").find(".bio").text();
		var image = $(this).parents(".info").find("img").attr("src");
		
		console.log(image);
		console.log(id);
		console.log(name);
		console.log(bio);
		//Hiển thị thông tin lên form cập nhật
		
		$("#uimage-preview").attr("src",image);
		
		$("#ufileToUpload").change(function(){
        loadImage(this);
      });
		$("#uid").val(id);
		$("#uname").val(name);
		$("#ubio").val(bio);
		
		function loadImage(input){
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e){
            $("#uimage-preview").attr("src",e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#ufileToUpload").change(function(){
        loadImage(this);
      });

		$("#update").modal();
		
		})// End update
	//Ẩn modal
	$("#save-btn").click(function(event){
		var productform = document.querySelector("#update-product-form");
		$.ajax({
			method: "POST",
			dataType: 'json',
			url: "updatePet.php",
			//dataType: 'json',
			processData:false,
			contentType:false,
			data: new FormData(productform),
		}).done(function(data){
				console.log(data);
				
				getPets();
			
			$("#update").modal("hide");
			


			
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})	
})

	//Delete
	$("#petls").on("click",".delete",function(e){
		var id = $(this).parents(".info").attr("id");
		$("#did").val(id);

	$("#delete").modal();
	})


		$("#yes-btn").click(function(event){
		event.preventDefault();
		var formData = $("#delete-product-form").serialize();
		console.log(formData);
		$.ajax({
			method: "POST",
			url: "deletePet.php",
			//dataType: 'json',
			data: formData,
		}).done(function(data){
			if(data.result){
				console.log(data);
				//Todo close modal

			//Todo delete input
				getPets();
				$("#delete").modal("hide");
			}else{

			}
			
			


			
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})
	})

})//End document.ready

function getPets(){
	$.ajax({
		url: 'getPets.php',
		method: 'POST',
		dataType: 'json',

		//data: 
	}).done(function(data){
		console.log(data);
		if(data.result){
			var rows = "";
			$.each(data.products, function(index, pet){
				rows +="<div class='info' id='"+pet.id+"'>"
				rows +="<button class='btn btn-primary edit pull-right'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
				rows +="<button class='btn btn-danger delete pull-right'><i class='fa fa-trash' aria-hidden='true'></i></button>";
				rows +="<br><br>";
				rows +='<a class="pet-link" href="detail.php?id='+pet.id+'">';			
				rows +='<span><img class="img-responsive" id="thumbnail" src="'+pet.image+'"></span>';	
				rows +='</a>';
				rows +='<span><h3 class="name">'+pet.name+'</h3><span>';
				rows +='<div class="bio">'+pet.bio+'</div>';
				rows +='</div>';
			})
			$("#petls").html(rows);
		}
	}).fail(function(jqXHR, statusText, errorThrown){
		console.log("Fail: "+ jqXHR.responseText);
		console.log(errorThrown);
	}).always(function(){

	})
}