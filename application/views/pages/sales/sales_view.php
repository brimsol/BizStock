<div class="row">
	<?php
		if ($bill_num -> num_rows() > 0) {
			foreach ($bill_num->result() as $value) :
				$bill = $value -> bill_num + 1;
			endforeach;
		} else {
			$bill = 1;
		}
	?>

	<?php if($cust_details->num_rows() > 0){?>
		<?php foreach ($cust_details->result() as $value) {?>
			<div class="well">
				<h3 class="header"><?= $page_heading ?></h3>
			</div>
			<div class="well">
				<div class="input-prepend" align="">
					<span >Bill No. :</span>
					<input class="span2" id="bill_num" name='bill_num' value="<?php echo $bill; ?>" size="16" type="text" disabled/>
					<span style="margin-left:50px;">Ration Card No. :</span>
					<input class="span2" id="rc_num" name='rc_num' value="<?php echo $value -> rc_num; ?>" size="16" type="text" disabled/>
					<span style="margin-left:50px;">Card Type :</span>
					<input class="span2" id="bill_num" name='bill_num' value="<?php echo $value -> card_type; ?>" size="16" type="text" disabled/>
					<span style="margin-left:50px;">Purchase Date :</span>
					<input class="span2" id="prependedInput" value="<?php echo date('j F Y'); ?>" size="16" type="text" disabled/>
					<input id="rc_type" value="<?php echo $value -> card_type; ?>" type="hidden"/>
					<input id="week_num" type="hidden"/>
					<input id="is_quota_limited_flag" type="hidden"/>
				</div>
			</div>
			
			<div class="well">
				<table class="table table-bordered" id="myTable">
					<thead>
						<tr>
							<th>Product ID</th>
							<th>Product Description</th>
							<th>Total Quota</th>
							<th>Purchased Quantity</th>
							<th>Remaining Quota</th>
							<th>Price  (per unit)</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					<tbody>
						<tr id="" >
							<td>
								<input class="input-small" type="text" name="pdt_id" id="pdt_id" style="margin-left:-5px;" />
							</td>
							<td>
								<input class="input-small" type="text" name="pdt_des" id="pdt_des" style="margin-left:-5px;" disabled/>
							</td>
							<td>
								<input class="input-small" id="total_quota" name="total_quota" size="12" type="text" disabled/>
							</td>
							<td>
								<input class="input-small" id="purchased_quota"  name="purchased_quota" size="12" type="text" disabled/>
							</td>
							<td>
								<input class="input-small" id="remaining_quota"  name="remaining_quota"  size="12" type="text" disabled />
							</td>
							<td>
								<input class="input-small" id="price_per_unit" name="price_per_unit" size="12" type="text" disabled/>
								<input class="input-small" id="price_per_unit_h" name="price_per_unit_h" size="12" type="hidden"/>
								<input class="input-small" id="price_per_h" name="price_per_h" size="12" type="hidden"/>
							</td>
							<td>
								<input class="input-small" type="text" name="pdt_quantity" id="pdt_quantity" />
							</td>
							<td>
								<div id="insert_select">
									<select class="input-small" name="pdt_unit" id="pdt_unit" style="margin-left:-5px;" /></select>
								</div>
							</td>
							<td>
								<input class="input-small" id="sub_total" name="sub_total"  size="12" type="text" disabled/>
							</td>
						</tr>
					</tbody>
				</table>
				<div id="back1">
					<a href="<?php echo site_url('sales/'); ?>"> <input style="margin-left:520px;" class="btn" type="button" value="Back"/></a>
				</div>
				<div id="result">
					<script>
						function printPartOfPage(elementId) {
							var printContent = document.getElementById(elementId);
							var windowUrl = '/index.php/sales/bill_print/'+<?php echo $bill; ?>;
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
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Unit</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					
					<div class="clear"></div>
					<div class="form-horizontal">
						<div class="control-group" >
							<label class="control-label" style="margin-left:920px; color:#990000;" for="pdt_id" >Grant Total: Rs</label>
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
						<div class="form-actions">
							<div id="print"><a style=" margin-left:350px;" class="btn btn-medium btn-primary" onClick="JavaScript:printPartOfPage('printDiv');" href="<?php echo site_url('sales/checkout/' . $bill); ?>"><i class="icon-shopping-cart icon-white"></i>Checkout</a>	<a  class="btn btn-medium" style=" margin-left:10px;" href="<?php echo site_url('sales/'); ?>">Back</a>
								<a style="margin-left:400px;" class="btn btn-medium" id="cancelsale"  href="#">Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="purchasedresult" >
				<table class="table table-bordered" id="purchasedtable">
				<thead>
					<tr>
						<th>Product</th>
						<th>Quantity</th>
					</tr>
				</thead> <tbody>
				</tbody> </table>
			</div>
			
			<input class="input-mini" name="totalpurchased" id="totalpurchased" type="hidden"/>
			<script src="<?php echo base_url();?>public/js/app/pages/sales/sales.js" type="text/javascript"></script>
		<?php }
	}else{ ?>
		<div class="span10 offset1">
			<div class="well">
				<div class="alert alert-block alert-error fade in">
					<button type="button" class="close" data-dismiss="alert">
						×
					</button>
					<h4 class="alert-heading">Card error !</h4>
					<p>
						Sorry, This card is not registered. Do you want to register now?
					</p>
					<p>
						<a class="btn btn-danger" href="<?php echo site_url('customer/add_from_sales')?>?rc_num=<?=$rc_num ?>">Register Now</a><a class="btn" href="<?php echo site_url('sales/'); ?>">No Thanks</a>
					</p>
				</div>
			</div>
		</div>
	<?php } ?>
</div>