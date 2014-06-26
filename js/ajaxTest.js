$(function(){

	$(".addToCartBtn").click(function(event))
	{
		event.preventDefault();

		var frm = $(this).parent("form");

		$.ajax({
			type: "POST",
			//url: frm.attr("action"),
			url: "ajax/ajax frm.attr("action"),
			data: frm.serialize();
			success: function(pageData){
				alert("siker");
			}
		});
	}

	$("#ajaxTest").click(function(event)){
		event.preventDefault();
		var url = $(this).attr("href");
		$.ajax({
			type: 'POST',
			url: 'ajax/ajaxTest.php',
			data: {url: url},
			success: function(pageData){
				$("#modal").html
			}
		});
	}
}
	);