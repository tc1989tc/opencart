<?php echo $header; ?>
<div class="container">
	<div class="row ">
		<div class="col-md-4 col-sm-3 col-md-offset-4">
		<h1 class="h1"><?php echo $store_name; ?></h2>
		</div>
	</div>
	<div class="row">
	<div class="col-md-4 col-sm-3 col-md-offset-4">
		<p><?php echo $store_introduce; ?></p>
	</div>
	</div>
	<div class="row">
	<div class="col-md-4 col-sm-3 col-md-offset-4">
		<address>
			<strong><?php echo $store_address; ?></strong><br>
			<abbr title="Phone">P:</abbr><?php echo $store_phone; ?><br>
			<strong>Email</strong><br>
			<a href="mailto:#"><?php echo $store_email; ?></a>
		</address>
	</div>
	</div>
	<?php if ($customerhasProduces) { ?>
	<div class="row">
	<div class="col-md-4 col-sm-3 col-md-offset-4">
		<table class="table table-bordered">
			<thead>
				<th>Image</th>
				<th>introduce</th>
			</thead>
			<tbody>
			<?php foreach ($customerProduces as $product) { ?>
				<tr>
					<td><image class="img-rounded" src="<?php echo $product['image'];?>"></td>
					<td><a href="<?php echo $product[product_link];?>"><?php echo $product['name'];?></a></td>
				<tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	</div>
	<?php } ?>
</div>
<?php echo $footer; ?>