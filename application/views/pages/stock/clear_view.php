<div class="row">
	<div class="span10 offset1">
		<div class="well">
    		<h3 class="header"><?= $page_heading ?></h3>
    	</div>
		<div class="well" >
			<?php if($stock->num_rows() > 0){?>
				<?php foreach ($stock->result() as $value) {?>
					<form class="form-horizontal" id="add_pdt" method="post" accept-charset="utf-8" 
						  action="<?php echo site_url(); ?>/stock/clear_confirm" >
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="pdt_id">Product ID* :</label>
								<div class="controls">
									<input class="input-large" value="<?php echo $value -> pdt_id; ?>" name="pdt_id" id="pdt_id" type="text" disabled/>
									<input class="input-large" value="<?php echo $value -> pdt_id; ?>" name="pdt_id" id="pdt_id" type="hidden"/>	
								</div>
							</div>
					
							<script>
								$(document).ready(function() {
									$("#show_incomplete_bill").hide();
									var k='<?php echo $value -> pdt_id; ?>';
										$.ajax({
											type : "POST",
											url : "/index.php/home/alertincomplete_pdt/",
											data : {
												term : k,
											},
											success : function(data) {
												if(data=='inStock')
												{
													alert('Incomplete Purchase Bill(s) found for this item. Please submit or cancel it and then continue.');
													$("#show_incomplete_bill").show();
													$("#hide_incomplete_bill").hide();
												} else if(data=='inSalesinStock'){
													alert('In complete Purchase Bills found,Please clear it');
													$("#show_incomplete_bill").show();
													$("#hide_incomplete_bill").hide();
												}
											},
										});
								});
							</script>
	               			<div class="control-group">
								<label class="control-label" for="pdt_name">Product Name* :</label>
								<div class="controls">
									<input class="input-large" value="<?php echo $value -> pdt_name; ?>" name="pdt_name" id="pdt_name" type="text" disabled/>
									<input class="input-large" value="<?php echo $value -> pdt_name; ?>" name="pdt_name" id="pdt_name" type="hidden"/>
								</div>
							</div>
	                  		<div class="control-group">
								<label class="control-label" for="pdt_name">Available Stock* :</label>
								<div class="controls">
									<input class="input-small" value="<?php
										if ($value -> available_stock == '' || $value -> available_stock == 0 || $value -> available_stock == null) {
											echo 'Out Of Stock';
										} else {
											echo number_format($value -> available_stock, 2, '.', '');
										};
									?>" name="pdt_name" id="current_value" type="text" disabled/>
									<input class="input-small" value="<?php
										if ($value -> available_stock == '' || $value -> available_stock == 0 || $value -> available_stock == null) {
											echo '';
										} else {
											echo $value -> stock_unit;
										};
									?>" type="text" disabled/>
									<input class="input-large" value="<?php
										if ($value -> available_stock != '') {
											echo $value -> available_stock;
										} else {
											echo 0;
										};
									?>" name="pdt_name" id="current_value" type="hidden"/>
								</div>
							</div>
						
							<?php if($value->available_stock!=''&& $value->available_stock!=0){?>
								<div class="form-actions">
									<div id="hide_incomplete_bill">
				                    	<?php echo anchor('stock/confirmClearStock/'.$value->pdt_id,'Clear stock', 
				                              array('onclick'=>"return confirm('The Stock details for this product will be set to zero. Do you want to continue ?')", 
				                    	      'class'=>"btn btn-danger",'style'=> "margin-left:228px;"))
				                    	?>
				                	 	<a class="btn" href="<?php echo site_url('/stock/clearStock/'); ?>">Cancel</a>
					  				</div>
									
									<div id="show_incomplete_bill">
					 					<a class="btn" style="margin-left:228px;" href="<?php echo site_url('/stock/clear/'); ?>">Back</a>
					   					<a class="btn" href="<?php echo site_url('/stock/incompletebill/'); ?>">Go to Incomplete Bills</a>
					   				</div>
								</div>
							<?php }else{ ?>
								<div class="alert alert-block alert-error fade in">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<p>This item is already out of stock ! Do you want to add stock for this?</p>
									<p>
									  <a class="btn btn-danger" href="<?php echo site_url('stock/addStock')?>">Add Stock</a> <a class="btn" href="<?php echo site_url('stock/clearStock'); ?>">No Thanks</a>
									</p>
	  							</div>
							<?php } ?>
						</fieldset>
					</form>
				<?php }
			}else{ ?>
    			<div class="well">
           	 		<div class="alert alert-block alert-error fade in">
						<button type="button" class="close" data-dismiss="alert">×</button>
    					<p>Sorry, this item does not exist !</p>
						<p>
  							<a class="btn btn-danger" href="<?php echo site_url('product/add')?>">Add Product</a> <a class="btn" href="<?php echo site_url('stock/clear'); ?>">No Thanks</a>
						</p>
					</div>
            	</div>
			<?php } ?>
		</div>
	</div>
</div><!--row closed-->