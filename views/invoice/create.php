<script>
tinymce.init({
    selector: "textarea#kepada",
    theme: "modern",
   	content_css: "css/content.css",
   	menubar: false,
   	statusbar: false,
   	toolbar: 'align left'
 }); 

tinymce.init({
    selector: "div#tagihankepada",
    inline: true,
    toolbar: "undo redo",
    menubar: false
});

</script>


<h4>Create Invoice</h4>
<hr>
<div class="invoice-create">
<form class="form-horizontal" role="form" method='post' action='<?=URL?>invoice/create'>
  <div class="form-group">
    <label class="col-sm-2 control-label">Dari</label>
    <div class="col-sm-4">
      <select class="form-control input-sm" name="dari">
      	<option value='1'>Edusarana</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Ditagihkan Kepada</label>
    <div class="col-sm-4">
      <!-- <div id="tagihankepada">
      	<p>Nama Perusahaan</p>
      	<p>Nama Pembeli</p>
      	<p>Alamat</p>
      	<p>Kota, Provinsi, Kode Pos</p>
      	<p>Indonesia</p>
      </div> -->
      <textarea id="kepada" name="kepada"></textarea>
    </div>
    <div class="col-sm-3" class="example">
    	Nama Perusahaan (optional)<br>
      	Nama Pembeli<br>
      	Alamat<br>
      	Kota, Provinsi, Kode Pos<br>
      	Indonesia
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Jatuh Tempo</label>
    <div class="col-sm-2">
    	<input type="number" name="jatuhtempo" class="form-control input-sm" value="10">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-2">
    	<select name="status" class="form-control">
    		<option value='0'>Belum Lunas</option>
    		<option value='1'>Lunas</option>
    	</select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">PO Nomor</label>
    <div class="col-sm-2">
    	<input type="text" name="po" id="po" class="form-control input-sm">
    </div>
  </div>
  <div class="col-sm-offset-2">
  	
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Create</button>
    </div>
  </div>
</form>
<hr>
</div>