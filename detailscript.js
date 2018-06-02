console.log('connected');
$(document).ready(function(){
	getDetail();
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
			url: 'addDetail.php',
			//dataType: 'json',
			processData:false,
			contentType: false,
			data: new FormData(productform),
		}).done(function(data){
			getDetail();
			$("#add").modal("hide");		
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})
	})


	//Update

	$("#modal-image").on("click",".edit",function(e){
		//Đọc thông tin

		var id = $(this).parents("span").attr("id");
		$("#image"+id).modal("hide");
		var description = $(this).parents("span").find(".description").text();
		
		console.log(description);
		console.log(id);
		$("#uid").val(id);
		$("#udescription").val(description);

		$("#update").modal();
      });

		
	// End update
	//Ẩn modal
	$("#save-btn").click(function(event){
		var productform = document.querySelector("#update-product-form");
		$.ajax({
			method: "POST",
			dataType: 'json',
			url: "updateDetail.php",
			//dataType: 'json',
			processData:false,
			contentType:false,
			data: new FormData(productform),
		}).done(function(data){
				console.log(data);
				
				getDetail();
			
			$("#update").modal("hide");

			


			
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})	
})

	//Delete
	$("#modal-image").on("click",".delete",function(e){
		var id = $(this).parents("span").attr("id");
		$("#image"+id).modal("hide");
		$("#did").val(id);

	$("#delete").modal();
	})


		$("#yes-btn").click(function(event){
		event.preventDefault();
		var formData = $("#delete-product-form").serialize();
		console.log(formData);
		$.ajax({
			method: "POST",
			url: "deleteDetail.php",
			//dataType: 'json',
			data: formData,
		}).done(function(data){
			if(data.result){
				console.log(data);
				//Todo close modal

			//Todo delete input
				getDetail();
				$("#delete").modal("hide");
			}else{

			}
			
			


			
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})
	})

})//End document.ready

function getDetail(){
	$.ajax({
		url: 'getDetail.php',
		method: 'POST',
		dataType: 'json',

		//data: 
	}).done(function(data){
		console.log(data);
		if(data.result){
			var rows = "";
			$.each(data.products, function(index, pet){
					
				rows +='<div class=col-sm-3>';
				rows +='<a href="#" class="imagemodal" data-toggle="modal" data-target="#image'+pet.id+'" id="'+pet.id+'">';		
				rows +='<img class="img-responsive" id="petimage" src="'+pet.image+'">';	
				rows +='</a><div>';
				// rows +="<button type='button' class='btn btn-primary edit'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
		  //       rows +="<button type='button' class='btn btn-danger delete'><i class='fa fa-trash' aria-hidden='true'></i></button>";
				
				rows +='</div></div>';
				
			})
			$(".row").html(rows);
			var modalrows = "";

			$.each(data.products, function(index, pet){
				modalrows += '<span id="'+pet.id+'">'
				modalrows += '<div id="image'+pet.id+'" class="modal fade" role="dialog">';
		        modalrows += '<div class="modal-dialog">';
		        modalrows += '<form id="image-modal-form" method="POST" action="'+my_var+'" enctype="multipart/form-data">';
		        modalrows += '<div class="modal-content">';
		        modalrows += '<div class="modal-header" id="button-image">';
		        modalrows +="<button type='button' class='btn btn-primary edit'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
		  		modalrows +="<button type='button' class='btn btn-danger delete'><i class='fa fa-trash' aria-hidden='true'></i></button>";
							
		        modalrows += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
		        modalrows += '</div>';
		        modalrows += '<div class="modal-body" id="detail-modal">';
		        modalrows += '<img class="img-responsive" id="big-image" src="'+pet.image+'">';
		        modalrows += '<h4 class="description">'+pet.description+'</h4>';
		        modalrows += '<div>'+pet.date+'</div>';
		        modalrows += '</div>';
		        modalrows += '</div>';
		        modalrows += '</form>';
		        modalrows += '</div>';
		        modalrows += '</div>';
		        modalrows += '</span>';
		
			})
			$("#modal-image").html(modalrows);
		}
	}).fail(function(jqXHR, statusText, errorThrown){
		console.log("Fail: "+ jqXHR.responseText);
		console.log(errorThrown);
	}).always(function(){

	})
}