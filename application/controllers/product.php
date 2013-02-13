<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product extends MY_Controller {
	/**
	 * The constructor
	 */
	public function __construct() {
		parent::__construct();
		$this -> load -> model('product_model');
	}

	/** Add New Product Page **/
	public function addProduct() {
		//$this -> add('app_js', 'pages/product/product');
		$this -> set('title', 'Nanma :: Add Product');
		$this -> set('page', 'pages/product/add_view');
		$this -> set('page_heading', 'Add New Product');
		$this->set('submit_value', 'Create');
		$this -> set('action', '/product/addNewProduct');
		$this -> render();
	}
	
	public function addNewProduct() {
		$this -> load -> model('quota_model');
		$this -> load -> model('stock_model');
		$this -> load -> model('sales_model');
		
		//set validation rules
		$bpl_quota = $this -> input -> post('bpl_quota');
		$apl_quota = $this -> input -> post('apl_quota');
		$is_quota_limited = $this -> input -> post('is_quota_limited');
		
		$this -> form_validation -> set_rules('pdt_id', 'Product ID', 'required|xss_clean|is_unique[product.pdt_id]');
		$this -> form_validation -> set_rules('pdt_name', 'Product name', 'required|xss_clean|is_unique[product.pdt_name]');
		$this -> form_validation -> set_rules('pdt_name_ml', 'Product name in Malayalam', 'required');
		$this -> form_validation -> set_rules('pdt_description', 'Product description', 'required');
		$this -> form_validation -> set_rules('quality', 'Quality', '');
		$this -> form_validation -> set_rules('pdt_sell_price', 'Product selling price', 'required|numeric');
		$this -> form_validation -> set_rules('pdt_sell_price_unit', 'Product selling price Unit', 'required');
		$this -> form_validation -> set_rules('pdt_purchase_price', 'Purchase price', 'required|numeric');
		$this -> form_validation -> set_rules('pdt_purchase_price_unit', 'Purchase price Unit', 'required');
		$this -> form_validation -> set_rules('hs_unit', 'Highest Unit', 'required');
		$this -> form_validation -> set_rules('ls_unit', 'Lowest Unit', '');
		$this -> form_validation -> set_rules('is_quota_limited', 'is_quota_limited', 'trim');
		$this -> form_validation -> set_rules('apl_quota', 'APL Quota', 'trim');
		$this -> form_validation -> set_rules('bpl_quota', 'BPL Quota', 'trim');

		if ($is_quota_limited == "Y") {
			if ($bpl_quota == '') {
				//$this -> form_validation -> set_rules('apl_quota', 'APL Quota', 'trim|required');
			} elseif ($apl_quota == '') {
				$this -> form_validation -> set_rules('bpl_quota', 'BPL Quota', 'trim|required');
			}
		} else {
			$this -> form_validation -> set_rules('apl_quota', 'APL Quota', '');
			$this -> form_validation -> set_rules('bpl_quota', 'BPL Quota', '');
		}

		$jsond = array();
		//if valid
		if ($this -> form_validation -> run() == TRUE) {
			$product_data = array('pdt_id' => set_value('pdt_id'), 
			                      'pdt_name' => set_value('pdt_name'), 
			                      'pdt_name_ml' => set_value('pdt_name_ml'), 
			                      'pdt_description' => set_value('pdt_description'),
			                      'quality' => set_value('quality'), 
			                      'pdt_sell_price' => set_value('pdt_sell_price'),			                      
			                      'pdt_sell_price_unit' => set_value('pdt_sell_price_unit'),
								  'pdt_purchase_price' => set_value('pdt_purchase_price'),			                      
			                      'pdt_purchase_price_unit' => set_value('pdt_purchase_price_unit'),
			                      'hs_unit' => set_value('hs_unit'), 
			                      'ls_unit' => set_value('ls_unit'),
			                      'is_quota_limited' => set_value('is_quota_limited'),
			                      'apl_quota' => set_value('apl_quota'),
	             				  'bpl_quota' => set_value('bpl_quota')
							);
								  
			$this -> product_model -> addNewProduct($product_data);
			$this -> product_model -> addProductPurchaseDetails($product_data);
			$this -> stock_model -> createNewStockRecord();

			if ($is_quota_limited == 'Y') {
				//$this -> quota_model -> add_new_quota();
			}

			$jsond['type'] = 'success';
			$jsond['msg'] = 'Product created successfully.';
		} else {
			$jsond['type'] = 'error';
			$this -> form_validation -> set_error_delimiters('
			<li>
				', '
			</li>');
			$jsond['errors'] = array(
				 'pdt_id' => form_error('pdt_id'), 
	             'pdt_name' => form_error('pdt_name'), 
	             'pdt_name_ml' => form_error('pdt_name_ml'), 
	             'pdt_description' => form_error('pdt_description'), 
	             'quality' => form_error('quality'), 
	             'pdt_sell_price' => form_error('pdt_sell_price'), 
	             'pdt_sell_price_unit' => form_error('pdt_sell_price_unit'),
	             'pdt_purchase_price' => form_error('pdt_purchase_price'), 
	             'pdt_purchase_price_unit' => form_error('pdt_purchase_price_unit'),
	             'hs_unit' => form_error('hs_unit'), 
	             'ls_unit' => form_error('ls_unit'), 
	             'is_quota_limited' => form_error('is_quota_limited'),
	             'apl_quota' => form_error('apl_quota'),
	             'bpl_quota' => form_error('bpl_quota')
			);
		}
		echo json_encode($jsond);
	}

	public function searchProduct() {
		$this -> set('title', 'Nanma :: Manage Product');
		$this -> set('page', 'pages/product/search_view');
		$this -> set('page_heading', 'Manage Product');
		$this -> render();
	}

	/** Search for a product ID from Manage Product page **/
	function autoCompleteProductID() {
		$keyword = $this -> input -> post('term');
		$data['response'] = 'false';
		$query = $this -> product_model -> autoCompleteProductID($keyword);
		if ($query -> num_rows() > 0) {
			//Set response
			$data['response'] = 'true';
			//Create array
			$data['message'] = array();
			foreach ($query->result() as $row) {
				//Add a row to array
				$data['message'][] = array('label' => $row -> pdt_id, 'value' => $row -> pdt_id);
			}
		}
		echo json_encode($data);
	}

	/** Search for a product name from Manage Product page **/
	function autoCompleteProductName() {
		$keyword = $this -> input -> post('term');
		$data['response'] = 'false';
		$query = $this -> product_model -> autoCompleteProductName($keyword);
		if ($query -> num_rows() > 0) {
			//Set response
			$data['response'] = 'true';
			//Create array
			$data['message'] = array();
			foreach ($query->result() as $row) {
				//Add a row to array
				$data['message'][] = array('label' => $row -> pdt_name, 'value' => $row -> pdt_name);
			}
		}
		echo json_encode($data);
	}

	function fetchProductDetailsWithID() {
		$key = $this -> input -> get('key');
		$query = $this -> product_model -> fetchProductDetailsWithID($key);
		if ($query -> num_rows() > 0) {
			echo "<legend>Search Result</legend>";
			echo "<table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
			echo " <th>Product ID</th>";
			echo "<th>Product Name</th>";
			echo "<th>Created Date</th>";
			echo "<th>Quality</th>";
			echo "<th>Price per unit</th>";
			echo "<th>Action</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			foreach ($query->result() as $row) :
				$price_per_unit = $row -> pdt_sell_price_unit;
				if ($price_per_unit == 'Pieces') {
					$p_u = 'Piece';
				} else {
					$p_u = $row -> pdt_sell_price_unit;
				}
				echo "<tr >";
				echo "<td>" . $row -> pdt_id . "</td>";
				echo "<td>" . $row -> pdt_name . "</td>";
				echo "<td>" . $row -> pdt_date . "</td>";
				echo "<td>" . $row -> quality . "</td>";
				echo "<td>" . $row -> pdt_sell_price . "/" . $p_u . "</td>";
				echo '<td><a class="btn btn-mini btn-primary" href="' . site_url() . '/product/updateProduct/' . $row -> pdt_id . '"><i class="icon-edit icon-white"></i> Update</a>';
				echo '<a class="btn btn-mini btn-danger" href="' . site_url() . '/product/deleteProduct/' . $row -> pdt_id . '" onclick="return confirm(\'You are about to delete this Product.\\n\\n   Do you want to continue?\')"><i class="icon-trash icon-white"></i> Delete</a>';
				echo '</td>';
				echo "</tr>";
			endforeach;
			
			echo "</tbody>";
			echo "</table>";
		} else {
			echo "<div class='alert alert-error fade in'>Not found ! Please check if the product name you entered is correct !</div>";
		}
	}

	function fetchProductDetailsWithName() {
		$key = $this -> input -> get('key');
		$query = $this -> product_model -> fetchProductDetailsWithName($key);
		if ($query -> num_rows() > 0) {
			echo "<legend>Search Result</legend>";
			echo "<table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
			echo " <th>Product ID</th>";
			echo "<th>Product Name</th>";
			echo "<th>Created Date</th>";
			echo "<th>Quality</th>";
			echo "<th>Price per unit</th>";
			echo "<th>Action</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			foreach ($query->result() as $row) :
				$price_per_unit=$row -> pdt_sell_price;
				if($price_per_unit=='Pieces')
				{
					$p_u='Piece';	
				}else{
					$p_u=$row -> pdt_sell_price_unit;
				}
				echo "<tr >";
				echo "<td>" . $row -> pdt_id . "</td>";
				echo "<td>" . $row -> pdt_name . "</td>";
				echo "<td>" . $row -> pdt_date . "</td>";
				echo "<td>" . $row -> quality . "</td>";
				echo "<td>" . $row -> pdt_sell_price . "/" . $p_u . "</td>";
				echo '<td><a class="btn btn-mini btn-primary" href="' . site_url() . '/product/updateProduct/' . $row -> pdt_id . '"><i class="icon-edit icon-white"></i> Update</a>';
				echo '<a class="btn btn-mini btn-danger" href="' . site_url() . '/product/deleteProduct/' . $row -> pdt_id . '" onclick="return confirm(\'You are about to delete this Product,\\n\\n   Do you want to continue ?\')"><i class="icon-trash icon-white"></i> Delete</a>';
				echo '</td>';
				echo "</tr>";
			endforeach;
			
			echo "</tbody>";
			echo "</table>";
		} else {
			echo "<div class='alert alert-error fade in'>Not found ! Please check if the product name you entered is correct !</div>";
		}
	}
	
	function updateProduct($pdt_id) {
		$pdt_id = rawurldecode($pdt_id);
		$product = $this -> product_model -> getProductDetails($pdt_id);
		if($product != FALSE)
		{
			$this->set('product', $product);
			$this -> set('title', 'Nanma :: Update Product');
			$this -> set('page_heading', 'Update Product');
			$this -> add('app_js', 'pages/product/product');
			$this -> set('page', 'pages/product/update_view');
			//$this->set('submit_value', 'Update');
			//$this -> set('action', '/product/searchProduct');
			$this->render();
		}
	}
	
	/** Trigerred upon clicking Submit in the Manage Product page **/
	function confirmUpdate() {
		//set validation rules
		$pdt_id = $this -> input -> post('pdt_id');
		$this -> form_validation -> set_rules('pdt_id', 'Product ID', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_idx', 'Product ID', 'required');
		$this -> form_validation -> set_rules('pdt_name', 'Product name', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_description', 'Product description', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_name_ml', 'Product name in Malayalam', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_sell_price', 'Selling Price', 'required|numeric|xss_clean');
		$this -> form_validation -> set_rules('ls_unit', 'Lowest Unit', 'xss_clean');
		$this -> form_validation -> set_rules('hs_unit', 'Highest Unit', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_sell_price_unit', 'Selling Price Unit', 'required|xss_clean');
		$this -> form_validation -> set_rules('quality', 'Quality', 'xss_clean');
		$this -> form_validation -> set_rules('pdt_purchase_price', 'Purchase Price', 'required|numeric');
		$this -> form_validation -> set_rules('pdt_purchase_price_unit', 'Purchase Price Unit', 'required');

		//if not valid
		if ($this -> form_validation -> run() == FALSE) {
			//$data['query'] = $this -> product_model -> getProductDetails($pdt_id);
			//$this -> load -> view('pages/product/update_error_view', $data);
			$this -> load -> view('pages/product/update_error_view');
		} else {
			//if valid
			$product_data = array(
					  'pdt_id' => set_value('pdt_id'), 
                      'pdt_name' => set_value('pdt_name'), 
                      'pdt_name_ml' => set_value('pdt_name_ml'), 
                      'pdt_description' => set_value('pdt_description'),
                      'quality' => set_value('quality'), 
                      'pdt_sell_price' => set_value('pdt_sell_price'),			                      
                      'pdt_sell_price_unit' => set_value('pdt_sell_price_unit'),
					  'pdt_purchase_price' => set_value('pdt_purchase_price'),			                      
                      'pdt_purchase_price_unit' => set_value('pdt_purchase_price_unit'),
                      'hs_unit' => set_value('hs_unit'), 
                      'ls_unit' => set_value('ls_unit')
				);
			$this -> product_model -> updateProduct($product_data);
			$this -> product_model -> updateProductPurchase($product_data);
			redirect('product/updateProduct/' . $pdt_id);
		}
	}

	/** Trigerred upon clicking Delete in the Manage Product page **/
	function deleteProduct($pdt_id) {
		$this -> load -> model('stock_model');
		$this -> add('app_js', 'pages/product/delete_product');
		
		$pdt_id = rawurldecode($pdt_id);
		
		$this -> db -> delete('product', array('pdt_id' => $pdt_id));
		$this -> db -> delete('purchase_product', array('pdt_id' => $pdt_id));
		$this -> stock_model -> del_stock_from_pdt($pdt_id);
		//$this -> quota_model -> del_quota_from_pdt($pdt_id);
		
		//$jsond = array();
		if($this->db->_error_message() == "") {
			//$jsond['type'] = 'success';
			//$jsond['msg']  = 'Product deleted successfully.';
		} else{
			//$jsond['type'] = 'error';
			//$jsond['msg']  = 'Error while deleting product!';
		}
		//echo json_encode($jsond);
		redirect('product/searchProduct');
	}
	
	
	/** Requests from Billing screen - START **/
	function getProductDetailsToBill() {
		$keyword = $this -> input -> post('term');
		$query = $this -> product_model -> autoCompleteProductID($keyword);
		$data['response'] = 'true';
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('pdt_sell_price' => $row -> pdt_sell_price, 'pdt_des' => $row -> pdt_description, 'pdt_sell_price_unit' => $row -> pdt_sell_price_unit);
			echo json_encode($data);
		} else {
			$data = array('pdt_price' => 'undefined', 'undefined');
			echo json_encode($data);
		}
	}
	
	function isQuotaLimited() {
		$keyword = $this -> input -> post('term');
		$query = $this -> product_model -> is_quota_limited($keyword);
		$data['response'] = 'true';
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('is_quota_limited' => $row -> is_quota_limited);
			echo json_encode($data);
		}
	}
	
	
	/** Requests from Billing screen - END **/
}
