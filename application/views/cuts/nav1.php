<div class="navbar" style="margin-top:-3px; margin-left:-1px;">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav">
				<a class="brand" href="#" style="margin-left:50px;">Nanma</a>
				<li>
					<a href="<?php echo site_url(); ?>">Home</a>
				</li>
				<!--class="active"-->
				<li class="dropdown" id="accountmenu">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Product<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('product/addProduct'); ?>"><i class="icon-gift"></i> Add New Product</a>
						</li>
						<li>
							<a href="<?php echo site_url('product/searchProduct'); ?>"><i class="icon-search"></i> Manage Product</a>
						</li>
					</ul>
				</li>
				<li class="dropdown" id="accountmenu">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Stock <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="nav-header">
							Manage Stock
						</li>
						<li>
							<a href="<?php echo site_url('stock/addStock'); ?>"><i class="icon-th"></i> Add Stock &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F3 </a>
						</li>
						<li>
							<a href="<?php echo site_url('stock/clearStock'); ?>"><i class="icon-trash"></i> Clear Stock </a>
						</li>
						<li class="divider"></li>
						<li class="nav-header">
							Purchase Reports
						</li>
						<li>
							<a href="<?php echo site_url('stock/incompletebill'); ?>"><i class="icon-th-list"></i> Get Incomplete Bills</a>
						</li>
						<li>
							<a href="<?php echo site_url('stock/billsearch'); ?>"><i class="icon-search"></i> Find a Purchase Bill</a>
						</li>
						<li>
							<a href="<?php echo site_url('stock/report'); ?>"><i class="icon-edit"></i> Stock Purchase Audit</a>
						</li>
						<li class="divider"></li>
						<li class="nav-header">
							Stock Level Reports
						</li>
						<li>
							<a href="<?php echo site_url('stock/reportall'); ?>"><i class="icon-list-alt"></i> Get Full Stock</a>
						</li>
						<li>
							<a href="<?php echo site_url('stock/search'); ?>"><i class="icon-file"></i> Single Product Stock</a>
						</li>
					</ul>
				</li>
				<li class="dropdown" id="accountmenu">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Sales<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('sales/'); ?>"><i class="icon-shopping-cart"></i> Billing&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F2</a>
						</li>
						<li class="divider"></li>
						<li class="nav-header">
							Sale Reports
						</li>
						<li>
							<a href="#"><i class="icon-list-alt"></i> Get Sale Volume</a>
							<ul class="dropdown-menu">

								<li>
									<a href="<?php echo site_url('sales/sales_report'); ?>"><i class="icon-align-left"></i> Full Volume</a>
								</li>
								<li>
									<a href="<?php echo site_url('sales/sales_report_single_item'); ?>"><i class="icon-align-right"></i> Single Product</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="<?php echo site_url('sales/salesreportonstock'); ?>"><i class="icon-th"></i> Sale Vs Purchase </a>
						</li>
						<li>
							<a href="<?php echo site_url('sales/billsearch'); ?>"><i class="icon-edit"></i> Find a Sale Bill </a>
						</li>
						<li>
							<a href="<?php echo site_url('sales/incompletebill'); ?>"><i class="icon-th-list"></i> Get Incomplete Bills</a>
						</li>
					</ul>
				</li>
				<li class="dropdown" id="accountmenu">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Customer<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('customer/add'); ?>"><i class="icon-user"></i> Register Customer&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F1</a>
						</li>
						<li>
							<a href="<?php echo site_url('customer/search'); ?>"><i class="icon-edit"></i> Manage Customer</a>
						</li>
					</ul>
				<li class="dropdown" id="accountmenu">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Quota<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('quota/add'); ?>"><i class="icon-folder-close"></i> Manage Quota</a>
						</li>
					</ul>
				</li>
				<li class="dropdown" id="accountmenu">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Cash Book<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('cashbook/opening'); ?>"><i class="icon-folder-open"></i> Opening Balance&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F4</a>
						</li>
						<li>
							<a href="<?php echo site_url('cashbook/closing'); ?>"><i class="icon-folder-close"></i> Closing Balance</a>
						</li>
						<li class="divider"></li>
						<li class="nav-header">
							Reports
						</li>
						<li>
							<a href="<?php echo site_url('cashbook/cash_report_get'); ?>"><i class="icon-edit"></i> History Records</a>
						</li>
					</ul>
			</ul>
			</li>
			</ul>
			<ul class="nav pull-right">
				<li id="fat-menu" class="dropdown">
					<?php $username = $this -> session -> userdata('username'); ?>
					<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $username; ?>
					<b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
						<li>
							<a tabindex="-1" href="<?php echo site_url('admin/add_user'); ?>">Add User</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo site_url('admin/list_user'); ?>">Delete User</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo site_url('admin/change_password'); ?>">Change Password</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo site_url('/logout'); ?>">Logout</a>
						</li>
					</ul>
		</div>
	</div>
</div>