<?php
foreach ($this->list as $key) {
    $key = str_replace('resources/file/','',$key);
  echo '<a href="'.URL.'invoice/readinvoice/'.$key.'" target="_blank">'.$key.'</a><br>';
}
?>
<div class="invoice-list">
	<div class="col-sm-4" style="border:1px solid #ccc">
    <h1></h1>
  </div>
	<div class="col-sm-4" style="border:1px solid #ccc">A</div>
	<div class="col-sm-4" style="border:1px solid #ccc">A</div>
	<div class="col-sm-4" style="border:1px solid #ccc">A</div>
	<div class="col-sm-4" style="border:1px solid #ccc">A</div>
</div>