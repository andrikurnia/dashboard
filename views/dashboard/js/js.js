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

	$('#settings-content').hide();
	$('#settings-content').fadeIn();

});