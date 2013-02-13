<div class="row">
	<?php 
		if($bill_num->num_rows() > 0){
			foreach ($bill_num->result() as $value):
				$bill=$value->purchase_bill_no+1;
			endforeach;
		}else{
			$bill=1;
		}
	?>
	<div class="well">
		<h3 class="header">Add Stock</h3>
	</div>
	<div class="well">
		<div class="input-prepend" align="">
			<span>Bill No. :</span>
			<input class="span2" id="bill_num" name='bill_num' value="<?php echo $bill; ?>" size="16" type="text" disabled/>
			<span style="margin-left:600px;">Stock Load Date :</span>
			<input class="span2" id="prependedInput" value="<?php echo date('j F Y'); ?>" size="16" type="text" disabled/>
		</div>
		<div class="well">
			<input type="hidden" id="bill_num" name="bill_num" value="<?php echo $bill; ?>" />
			<input type="hidden" id="new_pdt" name="new_pdt" value="N" />
			<input type="hidden" id="pdt_highest_unit_for_s" name="pdt_highest_unit_for_s"/>
			<table class="table table-bordered" id="myTable">
				<thead>
					<tr>
						<th><center>Product ID</center></th>
						<th><center>Description</center></th>
						<th id="pdt_name"><center>Product Name</center></th>
						<th id="pdt_ml"><center>Product Name(Malayalam)</center></th>
						<th><center>Selling Price</center></th>
						<th><center>Purchase Price</center></th>
						<th><center>Highest Unit</center></th>
						<th><center>Quality</center></th>
						<th><center>Current Stock</center></th>
						<th><center>Stock To Add</center></th>
					</tr>
				</thead>
				<tbody>
					<tr id="sasi" >
						<td>
							<input class="input-small" type="text" name="pdt_id" id="pdt_id" style="margin-left:-5px;" />
							<input class="input-small" type="hidden" name="pdt_idx" id="pdt_idx" style="margin-left:-5px;" />
						</td>
						<td>
							<input class="input-small" type="text" name="pdt_des" id="pdt_des" style="margin-left:-5px;" disabled="true" />
						</td>
						<td id="pdt_name1" >
							<input class="input-small" type="text" id="pdt_name2" name="pdt_name" style="margin-left:-5px;"/>
						</td>
						<td id="pdt_name_ml">
							<input class="input-medium" type="text" id="pdt_name_ml2" name="pdt_name_ml"  style="margin-left:-5px;"/>
						</td>
						<td>
							<input class="input-mini" id="pdt_sell_price" name="pdt_sell_price" size="12" type="text" disabled/>
							<select id="pdt_sell_price_unit" name="pdt_sell_price_unit" class="input-mini" disabled></select>
						</td>
						<td>
							<input class="input-mini" id="pdt_purchase_price" name="pdt_purchase_price" size="12" type="text" disabled/>
							<select id="pdt_purchase_price_unit" name="pdt_purchase_price_unit" class="input-mini" disabled></select>
						</td>
						<td>
							<select name="pdt_highest_unit" id="pdt_highest_unit" class="input-small" disabled></select>
						</td>
						<td>
							<select name="pdt_quality" id="pdt_quality" class="input-small" disabled></select>
						</td>
						<td>
							<input class="input-small" id="pdt_stock" name="pdt_stock" size="12" type="text" disabled/>
							<input class="input-small" id="pdt_stock_val"  name="pdt_stock_val" size="12"  type="hidden"/>
							<input class="input-small" id="pdt_stock_val_u"  name="pdt_stock_val_u" size="12"  type="hidden"/>
						</td>
						<td>
							<input class="input-mini" type="text" name="newstock" id="newstock" />
							<select class="input-mini" name="pdt_name" id="stk_unit" style="margin-left:12px;"></select>
							<input class="input-small" id="addedstock" name="addedstock" size="12" type="hidden" />
						</td>
						<td>
							<input class="input-medium" type="hidden" id="sub_total" name="sub_total"  "/>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="back">
				<a href="/board"> <input style="margin-left:520px;" class="btn btn-medium" type="button" value="Back"" /></a>
			</div>
		</div>
		<div class="alert alert-success fade in" id="succesmsg">
			Stock updated successfully.
		</div>
		<div id="result">
			<script>
				function printPartOfPage(elementId)
				{
					var printContent = document.getElementById(elementId);
					var windowUrl = '/index.php/stock/bill_print/'+<?php echo $bill; ?>;
					var windowName = 'Print' + new Date().getTime();
					var printWindow = window.open(windowUrl, windowName, 'left=5,top=5,width=600,height=600');
				
					printWindow.document.write(printContent.innerHTML);
					printWindow.document.close();
					printWindow.focus();
					printWindow.print();
					printWindow.close();
				}
			</script>
			<table class="table table-bordered" id="myresultTable">
				<thead>
					<tr>
						<th>Product Id</th>
						<th>Purchase Price</th>
						<th>Added stock</th>
						<th>Sub Total</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="form-horizontal">
				<div class="control-group" >
					<label class="control-label" style="margin-left:920px;color:#990000;" for="pdt_id" >Grant Total: Rs</label>
					<div class="controls">
						<input class="input-mini" name="total" id="total" type="text" disabled/>
					</div>
				</div>
				<div class="control-group" >
					<label class="control-label"  style="margin-left:920px;" for="pdt_id" >Tender Cash: Rs</label>
					<div class="controls">
						<input class="input-mini" name="total" id="tendercash" type="text"/>
					</div>
					<label class="control-label" style="margin-left:920px;"  for="pdt_id" >Balance: Rs</label>
					<div class="controls">
						<input class="input-mini" name="total" id="balance" type="text"/>
					</div>
				</div>
			</div>
			<div id="print">
				<a style=" margin-left:500px;" class="btn btn-medium btn-primary"  href="<?php echo site_url('stock/lockPurchaseBill/' . $bill); ?>">Submit</a><a href="<?php echo site_url(''); ?>">
				<input style="margin-left:10px;" class="btn btn-medium" type="button" value="Back"" /></a>
				<a class="btn btn-medium"  style=" margin-left:440px;" id="cancelload"  href="#">Cancel</a>
				</div></div>
				<script src="<?php echo base_url(); ?>public/js/app/pages/stock/stock.js" type="text/javascript"></script>
			</div>
		</div>
	</div>
</div>