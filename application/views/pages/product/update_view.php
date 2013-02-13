<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<h3 class="header"><?= $page_heading ?></h3>
		</div><?php echo validation_errors('<div class="alert alert-error fade in">', '</div>'); ?>
		<div class="well" >
			<?php if($product->num_rows() > 0){?>
			<?php foreach ($product->result() as $value) {?>
			<form class="form-horizontal" id="add_pdt" method="post" accept-charset="utf-8"
			action="<?php echo site_url(); ?>/product/confirmUpdate" >
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="pdt_id">Product ID* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_id'); ?><?php echo $value -> pdt_id; ?>" name="pdt_id" id="pdt_id" type="text" disabled/>
							<input class="input-large" value="<?php echo set_value('pdt_id'); ?><?php echo $value -> pdt_id; ?>" name="pdt_id" id="pdt_id" type="hidden"/>
							<input class="input-large" value="<?php echo set_value('pdt_idx'); ?><?php echo $value -> pdt_idx; ?>" name="pdt_idx" id="pdt_idx" type="hidden"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_name">Product Name* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_name'); ?><?php echo $value -> pdt_name; ?>" name="pdt_name" id="pdt_name" type="text" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_name_ml">Product Name(Malayalam)* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_name_ml'); ?><?php echo $value -> pdt_name_ml; ?>" name="pdt_name_ml" id="pdt_name" type="text" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_name">Product Description* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_description'); ?><?php echo $value -> pdt_description; ?>" name="pdt_description" id="pdt_name" type="text" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="quality">Quality :</label>
						<div class="controls">
							<select class="input-large" name="quality" id="pdt_name">
								<option value="">Select</option>
								<option value="First Quality"<?php echo set_select('quality', 'First Quality'); ?><?php
								if ($value -> quality == 'First Quality') {echo 'selected="selected"';
								};
								?>>First Quality</option>
								<option value="Second Quality"<?php echo set_select('quality', 'Second Quality'); ?><?php
								if ($value -> quality == 'Second Quality') {echo 'selected="selected"';
								};
								?>>Second Quality</option>
								<option value="Third Quality"<?php echo set_select('quality', 'Third Quality'); ?><?php
								if ($value -> quality == 'Third Quality') {echo 'selected="selected"';
								};
								?>>Third Quality</option>
								<option value="Cheap Quality"<?php echo set_select('quality', 'Cheap Quality'); ?><?php
								if ($value -> quality == 'Cheap Quality') {echo 'selected="selected"';
								};
								?>>Cheap Quality</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_name">Selling Price*  :</label>
						<div class="controls">
							<input class="input-small" value="<?php echo set_value('pdt_sell_price'); ?><?php echo $value->pdt_sell_price?>" name="pdt_sell_price" id="pdt_sell_price" type="float" required/>
							per
							<select class="input-small" name="pdt_sell_price_unit" id="pdt_sell_price_unit" style="margin-left:3px;">
								<option value="Kg"<?php echo set_select('pdt_sell_price_unit', 'Kg'); ?><?php
								if ($value -> pdt_sell_price_unit == 'Kg') {echo 'selected="selected"';
								};
								?>>Kg</option>

								<option value="L"<?php echo set_select('pdt_sell_price_unit', 'L'); ?><?php
								if ($value -> pdt_sell_price_unit == 'L') {echo 'selected="selected"';
								};
								?>>L</option>

								<option value="Pieces"<?php echo set_select('pdt_sell_price_unit', 'Pieces'); ?><?php
								if ($value -> pdt_sell_price_unit == 'Pieces') {echo 'selected="selected"';
								};
								?>>Piece</option>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="pdt_name">Purchase Price* :</label>
						<div class="controls">
							<input class="input-small" value="<?php echo set_value('pdt_purchase_price'); ?><?php echo $value->PURCHASEPRICE ?>" name="pdt_purchase_price" id="pdt_purchase_price" type="text" required/>
							per
							<select class="input-small" name="pdt_purchase_price_unit" id="pdt_purchase_price_unit" style="margin-left:3px;">
								<option value="Kg"<?php echo set_select('pdt_purchase_price_unit', 'Kg'); ?><?php
								if ($value -> PURCHASEPRICEUNIT == 'Kg') {echo 'selected="selected"';
								};
								?>>Kg</option>

								<option value="L"<?php echo set_select('pdt_purchase_price_unit', 'L'); ?><?php
								if ($value -> PURCHASEPRICEUNIT == 'L') {echo 'selected="selected"';
								};
								?>>L</option>

								<option value="Pieces"<?php echo set_select('pdt_purchase_price_unit', 'Pieces'); ?><?php
								if ($value -> PURCHASEPRICEUNIT == 'Pieces') {echo 'selected="selected"';
								};
								?>>Piece</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="higest">Highest Unit:</label>
						<div class="controls">
							<select class="input-large" name="hs_unit" id="ls_unit">
								<option value="">Select</option>
								<!--<option value="Tonne"<?php echo set_select('hs_unit', 'Tonne'); ?><?php if($value->hs_unit=='Tonne'){echo 'selected="selected"';}; ?>>Tonne</option>-->
								<!-- <option value="Quintal"<?php echo set_select('hs_unit', 'Quintal'); ?><?php if($value->hs_unit=='Quintal'){echo 'selected="selected"';}; ?>>Quintal</option>-->
								<option value="Kg"<?php echo set_select('hs_unit', 'Kg'); ?><?php
								if ($value -> hs_unit == 'Kg') {echo 'selected="selected"';
								};
								?>>Kg</option>
								<option value="Gram"<?php echo set_select('hs_unit', 'Gram'); ?><?php
								if ($value -> hs_unit == 'Gram') {echo 'selected="selected"';
								};
								?>>Gram</option>
								<option value="L"<?php echo set_select('hs_unit', 'L'); ?><?php
								if ($value -> hs_unit == 'L') {echo 'selected="selected"';
								};
								?>>L</option>
								<option value="ml"<?php echo set_select('hs_unit', 'ml'); ?><?php
								if ($value -> hs_unit == 'ml') {echo 'selected="selected"';
								};
								?>>ml</option>
								<option value="Pieces"<?php echo set_select('hs_unit', 'Pieces'); ?><?php
								if ($value -> hs_unit == 'Pieces') {echo 'selected="selected"';
								};
								?>>Piece</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="lowest">Lowest Unit:</label>
						<div class="controls">
							<select class="input-large" name="ls_unit" id="pdt_name">
								<option value="">Select</option>
								<option value="Kg"<?php echo set_select('ls_unit', 'Kg'); ?><?php
								if ($value -> ls_unit == 'Kg') {echo 'selected="selected"';
								};
								?>>Kg</option>
								<option value="Gram"<?php echo set_select('ls_unit', 'Gram'); ?><?php
								if ($value -> ls_unit == 'Gram') {echo 'selected="selected"';
								};
								?>>Gram</option>
								<option value="L"<?php echo set_select('ls_unit', 'L'); ?><?php
								if ($value -> ls_unit == 'L') {echo 'selected="selected"';
								};
								?>>L</option>
								<option value="ml"<?php echo set_select('ls_unit', 'ml'); ?><?php
								if ($value -> ls_unit == 'ml') {echo 'selected="selected"';
								};
								?>>ml</option>
								<option value="Pieces"<?php echo set_select('ls_unit', 'Pieces'); ?><?php
								if ($value -> ls_unit == 'Pieces') {echo 'selected="selected"';
								};
								?>>Piece</option>
							</select>
						</div>
					</div>
					<script src="<?php echo base_url(); ?>public/js/app/pages/product/product.js" type="text/javascript"></script>
					<div class="form-actions">
						<input class="btn btn-primary" value="Submit" name="submit"
						type="submit"  >
						<a class="btn" href="<?php echo site_url('/product/searchProduct'); ?>">Cancel</a>
					</div>
				</fieldset>
			</form>
			<?php }}else{ ?>
			<h1>Some error occured</h1>
			<?php } ?>
		</div>
	</div>
</div><!--row closed-->