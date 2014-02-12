<!-- //<div class="container"> -->
	<script type="text/javascript">
	tinymce.init({
	    selector: "textarea",
	    theme: "modern",
	    height: 300,
	    plugins: [
	         "link lists",
	         "wordcount",
	         "emoticons"
	   ],
	   content_css: "css/content.css",
	   toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor emoticons", 
	}); 
	</script>
	<form role="form" class="form-horizontal" method="post" action="<?=URL?>process/sendEmail">
		<div class="form-group">
    		<label class="col-sm-2 control-label">Kirim sebagai</label>
			<div class="col-md-4">
				<select name="sebagai" class="form-control input-sm">
					<option value='1'>cs@edusarana.com</option>
				</select>
			</div>
		</div>
		<div class="form-group">
    		<label class="col-sm-2 control-label">Kirim kepada</label>
			<div class="col-md-6">
				<input type="text" name="kepada" class="form-control input-sm"> 
			</div>
		</div>
		<div class="form-group">
    		<label class="col-sm-2 control-label">Subjek</label>
			<div class="col-md-6">
				<input type="text" name="subjek" class="form-control input-sm"> 
			</div>
		</div>
		<div class="form-group">
    		<label class="col-sm-2 control-label">Pesan</label>
			<div class="col-md-8">
				<textarea name="isi"></textarea> 
			</div>
		</div>
		<div class="col-md-offset-2">
			<button class="btn btn-default btn-sm">Kirim</button>
		</div>
	</form>
<!-- </div> -->