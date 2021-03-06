<div class="row">
	<div class="span10 offset1">
		<div class="well">
			<h3 class="header"><?= $page_heading ?></h3>
		</div>
		<div class="well" >
			<form class="form-horizontal" id="add_pdt" method="post" accept-charset="utf-8"
			action="<?= $action ?>" >
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="pdt_id">Product ID* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_id'); ?>" name="pdt_id" id="pdt_id" type="text" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_name">Product Name* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_name'); ?>" name="pdt_name" id="pdt_name" type="text" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_name_ml">Product Name(Malayalam)* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_name_ml'); ?>" name="pdt_name_ml" id="pdt_name_ml" type="text" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_description">Product Description* :</label>
						<div class="controls">
							<input class="input-large" value="<?php echo set_value('pdt_description'); ?>" name="pdt_description" id="pdt_description" type="text" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="quality">Quality :</label>
						<div class="controls">
							<select class="input-large" name="quality" id="quality">
								<option value="">Select</option>
								<option value="First Quality"<?php echo set_select('quality', 'First Quality'); ?>>First Quality</option>
								<option value="Second Quality"<?php echo set_select('quality', 'Second Quality'); ?>>Second Quality</option>
								<option value="Third Quality"<?php echo set_select('quality', 'Third Quality'); ?>>Third Quality</option>
								<option value="Cheap Quality"<?php echo set_select('quality', 'Cheap Quality'); ?>>Cheap Quality</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_price">Selling Price* :</label>
						<div class="controls">
							<input class="input-small" name="pdt_sell_price" id="pdt_sell_price" value="<?php echo set_value('pdt_sell_price'); ?>" type="text" required/>
							per
							<select class="input-small" name="pdt_sell_price_unit" id="pdt_sell_price_unit" style="margin-left:3px;">
								<option value="">Select</option>
								<option value="Kg"<?php echo set_select('pdt_sell_price_unit', 'Kg'); ?>>Kg</option>
								<option value="L"<?php echo set_select('pdt_sell_price_unit', 'L'); ?>>L</option>
								<option value="Pieces"<?php echo set_select('pdt_sell_price_unit', 'Pieces'); ?>>Piece</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="pdt_purchase_price">Purchase Price* :</label>
						<div class="controls">
							<input class="input-small" value="<?php echo set_value('pdt_purchase_price'); ?>" name="pdt_purchase_price" id="pdt_purchase_price" type="text" required/>
							per
							<select class="input-small" name="pdt_purchase_price_unit" id="pdt_purchase_price_unit" style="margin-left:3px;">
								<option value="">Select</option>
								<option value="Kg"<?php echo set_select('pdt_purchase_price_unit', 'Kg'); ?>>Kg</option>
								<option value="L"<?php echo set_select('pdt_purchase_price_unit', 'L'); ?>>L</option>
								<option value="Pieces"<?php echo set_select('pdt_purchase_price_unit', 'Pieces'); ?>>Piece</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="higest">Highest Unit:</label>
						<div class="controls">
							<select class="input-large" name="hs_unit" id="hs_unit">
								<option value="">Select</option>
								<!--<option value="Tonne"<?php echo set_select('hs_unit', 'Tonne'); ?>>Tonne</option> -->
								<!-- <option value="Quintal"<?php echo set_select('hs_unit', 'Quintal'); ?>>Quintal</option> -->
								<option value="Kg"<?php echo set_select('hs_unit', 'Kg'); ?>>Kg</option>
								<option value="Gram"<?php echo set_select('hs_unit', 'Gram'); ?>>Gram</option>
								<option value="L"<?php echo set_select('hs_unit', 'L'); ?>>L</option>
								<option value="ml"<?php echo set_select('hs_unit', 'ml'); ?>>ml</option>
								<option value="Pieces"<?php echo set_select('hs_unit', 'Pieces'); ?>>Piece</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="lowest">Lowest Unit:</label>
						<div class="controls">
							<select class="input-large" name="ls_unit" id="ls_unit">
								<option value="">Select</option>
								<option value="Kg"<?php echo set_select('ls_unit', 'Kg'); ?>>Kg</option>
								<option value="Gram"<?php echo set_select('ls_unit', 'Gram'); ?>>Gram</option>
								<option value="L"<?php echo set_select('ls_unit', 'L'); ?>>L</option>
								<option value="ml"<?php echo set_select('ls_unit', 'ml'); ?>>ml</option>
								<option value="Pieces"<?php echo set_select('ls_unit', 'Pieces'); ?>>Piece</option>
							</select>
						</div>
					</div>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" id="is_quota_limited" name="is_quota_limited" value="Y" <?php echo set_checkbox('is_quota_limited', 'Y'); ?> >
							Enable Quota limit
						</label>
					</div>
					<div id="quota">
						<div class="control-group">
							<label class="control-label" for="pdt_name">BPL Quota limit* :</label>
							<div class="controls">
								<input class="input-medium" value="<?php echo set_value('bpl_quota'); ?>" name="bpl_quota" id="bpl_quota" type="text"/>
								<input class="input-mini" value="" name="bpl_quota_unit" id="bpl_quota_unit" type="text" disabled="true"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="pdt_name">APL Quota limit* :</label>
							<div class="controls">
								<input class="input-medium" value="<?php echo set_value('apl_quota'); ?>" name="apl_quota" id="apl_quota" type="text"/>
								<input class="input-mini" value="" name="apl_quota_unit" id="apl_quota_unit" type="text" disabled="true"/>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input class="btn btn-primary" value="<?= $submit_value ?>" name="submit"
						type="submit"  >
						<a class="btn" href="<?php echo site_url('/board'); ?>">Cancel</a>
					</div>
					<script src="<?php echo base_url(); ?>public/js/app/pages/product/product.js" type="text/javascript"></script>
					<script src="<?php echo base_url(); ?>public/js/app/pages/ajax_responses.js" type="text/javascript"></script>
				</fieldset>
			</form>
		</div>
	</div>
</div>