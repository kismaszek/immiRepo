$(function(){
	
	$( "#datepicker" ).datepicker();

	$("#dev-header").click(
		function(){
			$("#dev-content").slideToggle();
		}
	)


	/*
	$("button").click(function(event){
			
			event.preventDefault();
			
			//Szülő form
			var form = $(this).parent("form");

			//Adatok felfűzése string formába
			var serializedData = form.serialize();

			//Ajax hívás
			var request = $.ajax(
					{
						url: "ajax/ajax.php",
						type: "post",
						data: "serializedData"
					}
			);

			request.done(function(response,textStatus,jqXHR){
					console.log("ok");
			});

			// callback handler that will be called on failure
	    	request.fail(function (jqXHR, textStatus, errorThrown){
	        // log the error to the console
	        console.error(
	            "The following error occured: "+
	            textStatus, errorThrown
	        );
	   	});
	});
	*/
	
});