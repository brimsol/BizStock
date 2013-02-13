<div class="row">
	<div class="span10 offset1">
		<div class="well">
    		<h3 class="header"><?= $page_heading ?></h3>
    	</div>
        <div class="well">
			<div class="form-horizontal">
			  	<fieldset>
			        <div class="control-group">
			            <label class="control-label" for="pdt_id"style="width:250px; margin-left:120px;">Enter Ration card number:</label>
			            <div class="controls">
			               <input class="search input-large" name="search_key" id="sales_pdt_id" type="text"/>
			                <div id="autocomplete_choices" class="autocomplete"></div>
			            </div>
					</div>
				</fieldset>
			</div>
			<div id="userresult2"></div>
			<script src="<?php echo base_url();?>public/js/app/pages/sales/customer_id.js" type="text/javascript"></script>
		</div>
	</div>
</div><!--row closed-->