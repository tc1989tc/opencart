<?php echo $header; ?>
<div class="container">
	<div class="row ">
		<h1 class="h1 center-block"><?php echo $store_name; ?></h2>
	</div>
	<div class="row">
		<p class="center-block"><?php echo $store_introduce; ?></p>
	</div>
	<div class="row">
		<address class="center-block">
			<strong><?php echo $store_address; ?></strong><br>
			<abbr title="Phone">P:</abbr><?php echo $store_phone; ?><br>
			<strong>Email</strong><br>
			<a href="mailto:#"><?php echo $store_email; ?></a>
		</address>
	</div>
	<div class="row">
		<table class="table table-bordered center-block">
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
<?php echo $footer; ?>