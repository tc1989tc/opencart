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
      <h2><?php echo $heading_title; ?></h2>
      <!-- Add you store information -->
      <form class="form-horizontal" role="form" method="post" action="<?php echo $addStoreLink;?>">
			   <div class="form-group">
			      <label for="store_name" class="col-sm-2 control-label"><?php echo $store_name;?></label>
			      <div class="col-sm-10">
			         <input type="text" class="form-control" id="storeName" name="storeName"
			            placeholder="<?php echo $store_name_place;?>">
			      </div>
			   </div>
			   <div class="form-group">
			      <label for="store_description" class="col-sm-2 control-label"><?php echo $store_description; ?></label>
			      <div class="col-sm-10">
			         <textarea class="form-control" rows="5" placeholder="<?php echo $store_description_place;?>" id="storeDesc" name="storeDesc"></textarea>
			      </div>
			   </div>
			   <div class="form-group">
			      <label for="store_address" class="col-sm-2 control-label"><?php echo $store_address; ?></label>
			      <div class="col-sm-10">
			         <input type="text" class="form-control" id="storeAddress" name="storeAddress"
			            placeholder="<?php echo $store_address_place; ?>">
			      </div>
			   </div>
			   <div class="form-group">
			      <label for="store_email" class="col-sm-2 control-label"><?php echo $store_email;?></label>
			      <div class="col-sm-10">
			         <input type="email" class="form-control" id="storeEmail" name="storeEmail"
			            placeholder="<?php echo $store_email_place;?>">
			      </div>
			   </div>
			   <div class="form-group">
			      <label for="store_telephone" class="col-sm-2 control-label"><?php echo $store_telephone;?></label>
			      <div class="col-sm-10">
			         <input type="tel" class="form-control" id="storeTelephone" name="storeTelephone"
			            placeholder="<?php echo $store_telephone_place;?>">
			      </div>
			   </div>
			   <div class="form-group">
			      <div class="col-sm-offset-2 col-sm-10">
			         <button type="submit" class="btn btn-default"><?php echo $button_submit;?></button>
			      </div>
			   </div>
			</form>

      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>