<div class="row">
    <div class="span10 offset1">
   		<div class="well">
        	<h3 class="header"><?=$page_heading ?></h3>
        </div>
	    <div class="well" >
			<div class="form-horizontal">
				<div class="control-group">
					<label class="control-label" for="pdt_id" style="margin-left:255px;">Enter Product ID* :</label>
					<div class="controls">
						<input class="input-large" name="pdt_id" id="search_id_clear" type="text" />
					</div>
                    <p align="center" style="margin-top:25px; margin-left:50px;">OR</p>
				</div>
                <div class="control-group">
					<label class="control-label" for="pdt_id" style="margin-top:0px; width:165px;" >Enter Product Name* :</label>
					<div class="controls">
						<input class="input-large" name="pdt_name" id="search_name_clear" type="text" />
					</div>
				</div>
			</div>
			<script src="<?php echo base_url();?>public/js/app/pages/stock/autocomplete_stock.js" type="text/javascript"></script>
	    </div>
	</div>
</div><!--row closed-->