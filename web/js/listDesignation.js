$( document ).ready(function(){
	$('#designation').keyup(designationVerif);
	function designationVerif(){
		$.ajax({
				type: "POST",
				url: "designations.php",
				data : {'designation' : $("#designation").val()},
				dataType: 'json',
				success: function(data) {
					console.log(data);
					
					$("#designationList").empty();
					for(i=0;i<data.length;i++){
						//console.log(data[0][i]["Adresse"]);							
						$("#designationList").append("<option value='"+data[i]["designation"]+"''/>");
					}
					
				}
		});
	}

});