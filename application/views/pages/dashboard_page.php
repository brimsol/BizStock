<div class="row" >
	<div class="span3">
		<div class="page-header">
			<h4>Product</h4>
		</div>
		<div class="well  ">
			<ul class="nav nav-list">

				<li>
					<a href="<?php echo site_url('product/addProduct'); ?>"><i class="icon-gift"></i> Add Product</a>
				</li>
				<li>
					<a href="<?php echo site_url('product/searchProduct'); ?>"><i class="icon-search"></i> Manage Product</a>
				</li>

			</ul>
		</div>
		<div class="page-header">
			<h4>Quota</h4>
		</div>
		<div class="well">
			<ul class="nav nav-list">
				<li>
					<a href="<?php echo site_url('quota/add'); ?>"><i class="icon-folder-close"></i> Manage Quota</a>
				</li>
			</ul>
		</div>
		<div class="page-header">
			<h4>Customer</h4>
		</div>
		<div class="well">
			<ul class="nav nav-list">
				<li>
					<a href="<?php echo site_url('customer/add'); ?>"><i class="icon-user"></i>Register Customer</a>
				</li>
				<li>
					<a href="<?php echo site_url('customer/search'); ?>"><i class="icon-edit"></i>Manage Customer</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="span3">
		<div class="page-header">
			<h4>Stock</h4>
		</div>
		<div class="well board-equal-height ">
			<ul class="nav nav-list">
				<li class="nav-header">
					Manage Stock
				</li>
				<li>
					<a href="<?php echo site_url('stock/addStock'); ?>"><i class="icon-th"></i> Add Stock</a>
				</li>
				<li>
					<a href="<?php echo site_url('stock/clearStock'); ?>"><i class="icon-trash"></i>Clear Stock </a>
				</li>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<li class="nav-header">
					Purchase Reports
				</li>
				
				<li>
					<a href="<?php echo site_url('stock/billsearch'); ?>"><i class="icon-search"></i> Find a Purchase Bill</a>
				</li>
				<li>
					<a href="<?php echo site_url('stock/incompletebill'); ?>"><i class="icon-th-list"></i> Get Incomplete Bills</a>
				</li>
				<li>
					<a href="<?php echo site_url('stock/report'); ?>"><i class="icon-edit"></i> Stock Purchase Audit</a>
				</li>

				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<li class="nav-header">
					Stock Level Reports
				</li>
				<li>
					<a href="<?php echo site_url('stock/reportall'); ?>"><i class="icon-list-alt"></i> Get Full Stock</a>
				</li>
				<li>
					<a href="<?php echo site_url('stock/search'); ?>"><i class="icon-file"></i> Get Single Product Stock </a>
				</li>
			</ul>
		</div>
	</div>
	<div class="span3">
		<div class="page-header">
			<h4>Sales</h4>
		</div>
		<div class="well board-equal-height ">
			<ul class="nav nav-list">
				<li class="nav-header">
					Manage Sales
				</li>
				<li>
					<a href="<?php echo site_url('sales'); ?>"><i class="icon-shopping-cart"></i>Billing</a>
				</li>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<li class="nav-header">
					Reports
				</li>
				<li>
					<a href="<?php echo site_url('sales/billsearch'); ?>"><i class="icon-search"></i> Find a Sales Bill</a>
				</li>
				<li>
					<a href="<?php echo site_url('sales/incompletebill'); ?>"><i class="icon-th-list"></i> Get Incomplete Bills</a>
				</li>
				<li>
					<a href="<?php echo site_url('sales/salesreportonstock'); ?>"><i class="icon-th"></i> Sales Income Report </a>
				</li>

				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<li class="nav-header">
					Get Sale Volume
				</li>
				<li>
					<a href="<?php echo site_url('sales/sales_report'); ?>"><i class="icon-align-left"></i> Get Full Volume</a>
				</li>
					<li>
					<a href="<?php echo site_url('sales/sales_report_single_item'); ?>"><i class="icon-align-right"></i> Get Single Product Sales </a>
				</li>
				
			</ul>
		</div>
		</div>
	<div class="span3">
		<div class="page-header">
			<h4>Cash Book</h4>
		</div>
		<div class="well ">
			<ul class="nav nav-list">
				<li>
					<a href="<?php echo site_url('cashbook/opening'); ?>"><i class="icon-folder-open"></i> Opening Balance</a>
				</li>
				<li>
					<a href="<?php echo site_url('cashbook/closing'); ?>"><i class="icon-folder-close"></i> Closing Balance</a>
				</li>
				<li class="nav-header">
					Reports
				</li>
				<li>
					<a href="<?php echo site_url('cashbook/cash_report_get'); ?>"><i class="icon-edit"></i> Previous Records</a>
				</li>
			</ul>
		</div>
	
		<div class="page-header">
			<h4>Backup</h4>
		</div>
		<div class="well" style="height: 40px;">
			<ul class="nav nav-list">
				<li>
					<a href="<?php echo site_url('home/backup'); ?>"><i class="icon-folder-close"></i> Get Full Backup</a>
				</li>
				<li>
					<a href="<?php echo site_url('home/restore'); ?>"><i class="icon-folder-open"></i> Restore Backup</a>
				</li>
				
			</ul>
		</div>
	
	<div class="well" style="height: 30px;">
	<ul class="nav nav-list"style="margin-top:-12px;" >
			<li class="nav-header">
					Mode Management
				</li>
				<li>
					<a href="<?php echo site_url('home/quota_mode'); ?>"><i class="icon-wrench"></i>Switch Mode</a>
				</li>
				</ul>
			</div>
	</div>
</div><!--row closed-->
