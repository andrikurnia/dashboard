$(document).ready(function() {

	$(".load-link").click(function() {
		var data = $(this).attr('data');
		$('#loading-'+data).show();
	});

	$(".glyphicon-edit").click(function() {
		$("#cancel").add().css('display','');
	});

	$('#cancel').click(function() {
		$(this).fadeOut('fast');
		$('#edit').removeClass('block').hide(400);
	});

	$(".glyphicon-edit").click(function() {
		var data = $(this).attr('data-id');
		$.ajax({
			type : "post",
			data : {"edit-id":''+ data +''},
			success : function(res) {
				$("#edit").html($(res).find("#edit").html())
							.addClass("block").show(400);
			}
		});
	});

	$('#settings-content').hide();
	$('#settings-content').fadeIn();

});