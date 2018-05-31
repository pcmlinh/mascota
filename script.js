console.log('connected');
$(document).ready(function(){
	getProducts();
	getBrands();
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

		// event.preventDefault();
		// var formData = $("#add-product-form").serialize();
				
		// // var formData = $("#add-product-form").serialize();
		
		// $.ajax({
		// 	method: "POST",
		// 	url: "addProduct.php",
		// 	//dataType: 'json',
		// 	data: formData,		
		var productform = document.querySelector("#add-product-form");
		$.ajax({
			method: "POST",
			dataType: 'json',
			url: 'addProduct.php',
			//dataType: 'json',
			processData:false,
			contentType: false,
			data: new FormData(productform),
		}).done(function(data){

			getProducts();
			$("#add").modal("hide");
			
			
			


			
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})
	})


	//Update

	$("tbody").on("click",".edit",function(e){
		//Đọc thông tin
		
		var id = $(this).parents("tr").attr("id");
		var name = $(this).parents("tr").find(".name").text();
		var brandid = $(this).parents("tr").find(".brand_id").text();
		var price = $(this).parents("tr").find(".price").text();
		var volume = $(this).parents("tr").find(".volume").text();
		var alcohol = $(this).parents("tr").find(".alcohol").text();
		var description = $(this).parents("tr").find(".description").text();
		var image = $(this).parents("tr").children("td").find("img").attr("src");
		
		
		getBrands(brandid);
		
		console.log(image);
		//Hiển thị thông tin lên form cập nhật
		
		$("#uimage-preview").attr("src",image);
		
		$("#ufileToUpload").change(function(){
        loadImage(this);
      });
		$("#uid").val(id);
		$("#uname").val(name);
		$("#uvolume").val(volume);
		$("#ualcohol").val(alcohol);
		$("#uprice").val(price);
		$("#udescription").val(description);
		$("#updatebrand").val(brandid);
		
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
			url: "updateProduct.php",
			//dataType: 'json',
			processData:false,
			contentType:false,
			data: new FormData(productform),
		}).done(function(data){
				console.log(data);
				
				getProducts();
			
			$("#update").modal("hide");
			


			
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})	
})
	//Xử lý submit form cập nhật
	$("#update").submit(function(event){
		
	})

	//Delete
	$("tbody").on("click",".delete",function(e){
		var id = $(this).parents("tr").attr("id");
		$("#did").val(id);

	$("#delete").modal();
	})


		$("#yes-btn").click(function(event){
		event.preventDefault();
		var formData = $("#delete-product-form").serialize();
		console.log(formData);
		$.ajax({
			method: "POST",
			url: "deleteProduct.php",
			//dataType: 'json',
			data: formData,
		}).done(function(data){
			if(data.result){
				console.log(data);
				//Todo close modal

			//Todo delete input
				getProducts();
				$("#delete").modal("hide");
			}else{

			}
			
			


			
		}).fail(function(jqXHR, statusText, errorThrown){
			console.log("Fail:"+ jqXHR.responseText);
			console.log(errorThrown);
		})
	})

})//End document.ready

function getProducts(){
	$.ajax({
		url: 'getProducts.php',
		method: 'POST',
		dataType: 'json',

		//data: 
	}).done(function(data){
		console.log(data);
		if(data.result){
			var rows = "";
			$.each(data.products, function(index, product){

				rows +="<tr id='"+product.id+"'>";
				rows +="<td class='image'><img class='thumbnail' width='70px' src="+product.image+"></td>";
				rows +="<td class='name'>"+product.product_name+"</td>";
				rows +="<td class='brand_id'>"+product.brand_id+"</td>";
				rows +="<td class='description'>"+product.description+"</td>";
				rows +="<td class='price'>"+product.price+"</td>";
				rows +="<td class='volume'>"+product.volume+"</td>";
				rows +="<td class='alcohol'>"+product.alcohol+"</td>";
				rows +="<td>";
				rows +="<button class='btn btn-primary edit'><i class='fa fa-pencil' aria-hidden='true'></i></button> ";
				rows +="<button class='btn btn-danger delete'><i class='fa fa-trash' aria-hidden='true'></i></button>";
				rows +="</td>";
				rows +="</tr>";
			})
			$("tbody").html(rows);
		}
	}).fail(function(jqXHR, statusText, errorThrown){
		console.log("Fail: "+ jqXHR.responseText);
		console.log(errorThrown);
	}).always(function(){

	})
}
function getBrands(brandid){
	$.ajax({
		url: 'getBrands.php',
		method: 'POST',
		dataType: 'json',

		//data: 
	}).done(function(data){
		console.log(data);
		if(data.result){
			var rows = "";
				//rows +="<option hidden selected></option>";
			$.each(data.brands, function(index, brand){
				if (brandid == brand.id){
					rows +="<option value='"+brand.id+"' class='ubrand' selected>"+brand.name+"</option>";
				}else{
					rows +="<option value='"+brand.id+"' class='ubrand'>"+brand.name+"</option>";
				}
			})
			$("#ubrand").html(rows);
			$("#brand").html(rows);
		}
	}).fail(function(jqXHR, statusText, errorThrown){
		console.log("Fail: "+ jqXHR.responseText);
		console.log(errorThrown);
	}).always(function(){

	})
}
