<?php echo $header; ?>
<div class="container">
	<div class="row ">
		<div class="col-xs-6 col-sm-3">
		<h1 class="h1"><?php echo $store_name; ?></h2>
		</div>
	</div>
	<div class="row">
	<div class="col-xs-6 col-sm-3">
		<p><?php echo $store_introduce; ?></p>
	</div>
	</div>
	<div class="row">
	<div class="col-xs-6 col-sm-3">
		<address>
			<strong><?php echo $store_address; ?></strong><br>
			<abbr title="Phone">P:</abbr><?php echo $store_phone; ?><br>
			<strong>Email</strong><br>
			<a href="mailto:#"><?php echo $store_email; ?></a>
		</address>
	</div>
	</div>
	<div class="row">
	<div class="col-xs-6 col-sm-3">
		<table class="table table-bordered">
			<thead>
				<th>Image</th>
				<th>introduce</th>
			</thead>
			<tbody>
				<tr>
					<td><image class="img-rounded"></td>
					<td><a href="#">SPintroduce</a><td>
				<tr>
			</tbody>
		</table>
	</div>
	</div>
</div>
<?php echo $footer; ?>