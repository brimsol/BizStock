<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Stock extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('product_model');
		$this -> load -> model('stock_model');
		session_start();
		parent::__construct();
		if (!isset($_SESSION['username'])) {
			//redirect('admin');
		}
	}
	
	function addStock() {
		$bill_num = $this -> stock_model -> getLastPurchaseBillNumber();
		if($bill_num != FALSE) {
			$this -> set('bill_num', $bill_num);
			$this -> set('title', 'Nanma :: Add Stock');
			$this -> set('page', 'pages/stock/add_stock_view');
			$this -> set('page_heading', 'Add Stock');
			$this -> render();
		}
	}

	function getProductDetails() {
		$pdt_id = $this -> input -> post('term');
		$query = $this -> stock_model -> getProductDetails($pdt_id);
		$data['response'] = 'true';
		
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('pdt_sell_price' => $row -> SELLINGPRICE, 'pdt_sell_price_unit' => $row -> SELLINGUNIT,
			              'pdt_purchase_price' => $row -> pdt_purchase_price, 'pdt_purchase_price_unit' => $row -> pdt_purchase_price_unit,
						  'pdt_id' => $row -> pdt_id, 'pdt_name' => $row -> pdt_name,'pdt_des' => $row -> pdt_description, 
						  'pdt_highest_unit' => $row -> hs_unit, 'pdt_quality' => $row -> quality, );
			echo json_encode($data);
		} else {
			$data = array('new_product' => 'Y');
			echo json_encode($data);
		}
	}
	
	/** Get current stock for the item ID entered in the stock addition screen and sales screen **/
	function getCurrentStock() {
		$keyword = $this -> input -> post('term');
		$query = $this -> stock_model -> getCurrentStock($keyword);
		$data['response'] = 'true';
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('pdt_stock' => number_format($row -> available_stock, 2, '.', ''), 'stock_unit' => $row -> stock_unit);
			echo json_encode($data);
		} else {
			$data = array('pdt_stock' => 0, 'stock_unit' => 0);
			echo json_encode($data);
		}
	}
	
	/** Add each line to the DB **/
	function addStockToDB() {
		$bill_num = $this -> input -> post('bill_num');
		$pdt_id = $this -> input -> post('pdt_id');
		$flag = $this -> input -> post('new_pdt');
		if ($flag == 'Y') {
			$this -> product_model -> addNewPdtViaStockPage();
			$this -> product_model -> addPdtPurchaseDetViaStockPage();
		}
		$this -> stock_model -> modifyStock();
		$this -> stock_model -> stockLoadAudit();
		$query = $this -> stock_model -> getAuditRecord($pdt_id, $bill_num);
		
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) :
				echo "<tr id='" . $row -> spa_id . "'>";
				echo "<td>" . $row -> pdt_id . "</td>";
				echo "<td>" . $row -> current_unit_price . "/" . $row -> pdt_price_unit . "</td>";
				echo "<td>" . number_format($row -> stock_load_qty, 2, '.', '') . "  " . $row -> stock_load_unit . "</td>";
				//echo "<td>" . number_format($row -> stock_after_load,2,'.','') ."/" . $row ->stock_load_unit .  "</td>";
				echo "<td>" . number_format($row -> sub_total, 2, '.', '') . "</td>";
				echo "<td><input type='hidden' value='" . $row -> pdt_id . "' id='pdt_id_del" . $row -> spa_id . "'/>
					<input type='hidden' value='" . $row -> stock_load_qty . "' id='stk_added" . $row -> spa_id . "'/>
					<input type='hidden' value='" . $row -> stock_after_load . "' id='stk_after_add" . $row -> spa_id . "'/>
					<input type='hidden' id='forhiding' value='chumma'/>
					<button  id='" . $row -> spa_id . "'>Delete</button><button1 class='delete' id='" . $row -> spa_id . "'></button></td>";
				echo "<tr>";
			endforeach;
		}
	}
	
	/** Adjust/revert the stock if a line is removed from the order **/
	function updateStockUponLineRemoval() {
		$spa_id = $this -> input -> post('spa_id');
		$pdt_id = $this -> input -> post('pdt_id');
		$stock_added = $this -> input -> post('current_stock');
		$this -> stock_model -> updateStockUponLineRemoval($pdt_id, $stock_added);
		$this -> db -> delete('stock_load_audit', array('spa_id' => $spa_id));
	}
	
	/** Submit and lock a bill **/
	function lockPurchaseBill($bill_num) {
		$this -> stock_model -> lockPurchaseBill($bill_num);
		//$this -> ci_alerts -> set('success', 'Stock added successfully');
		redirect('stock/addStock');
	}
	
	/** Redirect to Clear Stock Page **/
	function clearStock() {
		$this -> set('title', 'Nanma :: Clear Stock');
		$this -> set('page', 'pages/stock/search_clear_view');
		$this -> set('page_heading', 'Clear Stock');
		$this -> render();
	}
	
	/** Render the Clear Stock page **/
	function renderClearStockPage($pdt_id) {
		$id = rawurldecode($pdt_id);
		$stock = $this -> stock_model -> getStockForThisPdtID($pdt_id);
		if($stock != FALSE){
			$this -> set('stock', $stock);
			$this -> set('title', 'Nanma :: Clear Stock');
			$this -> set('page_heading', 'Clear Stock');
			$this -> set('page', 'pages/stock/clear_view');
			$this->render();
		}
	}
	
	/** Upon clicking the 'Clear Stock' button **/
	function confirmClearStock($pdt_id) {
		$this -> stock_model -> confirmClearStock($pdt_id);
		//$this -> ci_alerts -> set('success', 'Stock cleared successfully');
		redirect('stock/getStockAfterClearance/'.$pdt_id);
	}
	
	function getStockAfterClearance($pdt_id) {
		$id = rawurldecode($pdt_id);
		$stock = $this -> stock_model -> getStockAfterClearance($id);
		if($stock != FALSE){
			$this -> set('stock', $stock);
			$this -> set('title', 'Nanma :: Clear Stock');
			$this -> set('page_heading', 'Clear Stock');
			$this -> set('page', 'pages/stock/clear_u_view');
			$this->render();
		}
		//$data['query'] = $this -> stock_model -> pdt_stock_id($id);
		//$this -> load -> view('stock/clear_u_view', $data);
	}
	
	
	
	/**
	 	function auto() {
		$keyword = $this -> input -> post('term');
		$data['response'] = 'false';
		$query = $this -> product_model -> auto_pdt($keyword);
		if ($query -> num_rows() > 0) {
			$data['response'] = 'true';
			//Set response
			$data['message'] = array();
			//Create array
			foreach ($query->result() as $row) {
				//Add a row to array
				$data['message'][] = array('label' => $row -> pdt_name, 'value' => $row -> pdt_name);
			}
		}
		echo json_encode($data);
	}
	 */
}
