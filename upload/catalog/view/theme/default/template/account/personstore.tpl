<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    	<?php if (!$hasStore) { ?>
  		<div class="col-sm-4 col-sm-offset-4">
    		<a href="<?php echo $applyStoreLink;?>"> Apply Store</a>
  		</div>
  		<?php } else {?>
  	
  		<div class="col-sm-8 col-sm-offset-4">
  		
    		<!-- Store inforation -->
    		<h2 class="h2"><?php echo $store_name; ?></h2>
    		<p><?php echo $store_introduce; ?></p>
    		<address>
				<strong><?php echo $store_address; ?></strong><br>
				<abbr title="Phone">P:</abbr><?php echo $store_phone; ?><br>
				<strong>Email</strong><br>
				<a href="mailto:#"><?php echo $store_email; ?></a>
				</address>
				<div class="buttons clearfix">
        	<div class="pull-right"><a href="<?php echo $editStore; ?>" class="btn btn-primary"><?php echo $button_editStore; ?></a></div>
      	</div>
			</div>
			
			
      <h2><?php echo $heading_title; ?></h2>
      <?php if ($products) { ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-center"><?php echo $column_image; ?></td>
            <td class="text-left"><?php echo $column_name; ?></td>
            <td class="text-left"><?php echo $column_model; ?></td>
            <td class="text-right"><?php echo $column_stock; ?></td>
            <td class="text-right"><?php echo $column_price; ?></td>
            <td class="text-right"><?php echo $column_action; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product) { ?>
          <tr>
            <td class="text-center"><?php if ($product['thumb']) { ?>
              <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
              <?php } ?></td>
            <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></td>
            <td class="text-left"><?php echo $product['model']; ?></td>
            <td class="text-right"><?php echo $product['stock']; ?></td>
            <td class="text-right"><?php if ($product['price']) { ?>
              <div class="price">
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <b><?php echo $product['special']; ?></b> <s><?php echo $product['price']; ?></s>
                <?php } ?>
              </div>
              <?php } ?></td>
            <td class="text-right">Eidt product</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      	<?php if($hasStore) { ?>
      	<div class="pull-left"><a href="<?php echo $addProductLink; ?>" class="btn btn-primary"><?php echo $button_addProduct; ?></a></div>
      	<?php } ?>
      </div>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>