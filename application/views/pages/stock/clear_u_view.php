<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<h3 class="header">Clear Stock</h3>
		</div>
		<div class="well" >
			<?php if($stock->num_rows() > 0){ ?>
				<?php foreach ($stock->result() as $value) { ?>
					<form class="form-horizontal" id="add_pdt" method="post" accept-charset="utf-8"
					action="<?php echo site_url(); ?>/stock/clear_confirm" >
						<fieldset>
							<div class="alert alert-success fade in" id="succesmsg">
								Stock cleared successfully.
							</div>
							<div class="control-group">
								<label class="control-label" for="pdt_id">Product ID* :</label>
								<div class="controls">
									<input class="input-large" value="<?php echo $value -> pdt_id; ?>" name="pdt_id" id="pdt_id" type="text" disabled/>
									<input class="input-large" value="<?php echo $value -> pdt_id; ?>" name="pdt_id" id="pdt_id" type="hidden"/>
								</div>
							</div>
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
										if ($value -> available_stock == '' || $value -> available_stock == 0 || $value -> available_stock == null) {echo 'Out Of Stock';
										} else {echo $value -> available_stock;
										};
									?>" name="pdt_name" id="current_value" type="text" disabled/>
									<input class="input-small" value="<?php
										if ($value -> available_stock == '' || $value -> available_stock == 0 || $value -> available_stock == null) {echo '';
										} else {echo $value -> stock_unit;
										};
									?>" type="text" disabled/>
									<input class="input-large" value="<?php
										if ($value -> available_stock != '') {echo $value -> available_stock;
										} else {echo 0;
										};
									?>" name="pdt_name" id="current_value" type="hidden"/>
								</div>
							</div>
							<div class="form-actions">
								<a class="btn" style="margin-left:300px;" href="<?php echo site_url('/stock/clearStock/'); ?>">Back</a>
							</div>
						</fieldset>
					</form>
				<?php }
			}else{ ?>
				<div class="well">
					<div class="alert alert-block alert-error fade in">
						<button type="button" class="close" data-dismiss="alert"> × </button>
						<p>Sorry, this item does not exist !</p>
						<p>
							<a class="btn btn-danger" href="<?php echo site_url('product/add')?>">Add Product</a>
							<a class="btn" href="<?php echo site_url('stock/clearStock'); ?>">No Thanks</a>
						</p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div><!--row closed-->