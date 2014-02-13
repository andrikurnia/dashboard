$(document).ready(function() {

	$(".load-link").click(function() {
		var data = $(this).attr('data');
		$('#loading-'+data).show();
	});

	$('#cancel').click(function() {
		$(this).fadeOut('fast');
		$('#edit').removeClass('block').hide('clip');
	});

	$(".edit").click(function() {
		var data = $(this).children().attr('data-id');
		$("#cancel").add().css('display','');
		$.ajax({
			type : "post",
			data : {"edit-id":''+ data +''},
			success : function(res) {
				$("#edit").html($(res).find("#edit").html())
							.addClass("block").show('clip');
			}
		});
	});
	
	$("[name='search_email']").keyup(function(e) {
	    var enter = e.which;
	    if(enter == 13) {
	        console.log($(this).val());
	    }
	});

	$('#settings-content').hide();
	$('#settings-content').fadeIn();

});