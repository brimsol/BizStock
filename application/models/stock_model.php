<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Stock_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function createNewStockRecord() {
		$pdt_id = $this -> input -> post('pdt_id');
		$pdt_name = $this -> input -> post('pdt_name');
		$stock_unit = $this -> input -> post('hs_unit');
		$product_data = array('pdt_id' => $pdt_id, 'pdt_name' => $pdt_name, 'available_stock' => 0, 'stock_unit' => $stock_unit);
		$this -> db -> insert('stock', $product_data);
	}

	function getLastPurchaseBillNumber() {
		$this -> db -> limit(1);
		$this -> db -> select_max('purchase_bill_no');
		return $this -> db -> get('stock_load_audit');
	}

	function getProductDetails($keyword) {
		$q = "SELECT pp.*, p.pdt_sell_price AS SELLINGPRICE, p.pdt_sell_price_unit AS SELLINGUNIT 
		          FROM purchase_product pp JOIN product p 
		          ON p.pdt_id= pp.pdt_id WHERE pp.pdt_id='$keyword'";
		return $this -> db -> query($q);
	}

	function getCurrentStock($id) {
		$this -> db -> where('pdt_id', $id);
		return $this -> db -> get('stock');
	}
	
	function modifyStock() {
		$pdt_id = $this -> input -> post('pdt_id');
		$stock_unit = $this -> input -> post('stock_unit');
		$new_stock = $this -> input -> post('new_stock');
		$pdt_name = $this -> input -> post('pdt_name');
		$data = array('pdt_id' => $pdt_id, 'pdt_name' => $pdt_name, 'available_stock' => $new_stock, 'stock_unit' => $stock_unit);
		$this -> db -> replace('stock', $data);
	}

	function stockLoadAudit() {
		$bill_num = $this -> input -> post('bill_num');
		$pdt_id = $this -> input -> post('pdt_id');
		$pdt_description = $this -> input -> post('pdt_des');
		$pdt_quality = $this -> input -> post('pdt_quality');
		$pdt_purchase_price = $this -> input -> post('pdt_purchase_price');
		$pdt_purchase_price_unit = $this -> input -> post('pdt_purchase_price_unit');
		$highest_unit = $this -> input -> post('pdt_h_unit');
		$stock_before_load = $this -> input -> post('stock_before_load');
		$stock_going_to_add = $this -> input -> post('stock_going_to_add');
		$stock_after_load = $this -> input -> post('added_stock');
		$stock_unit = $this -> input -> post('stock_unit');
		$sub_total = $this -> input -> post('sub_total');
		$data = array('purchase_bill_no' => $bill_num, 'pdt_id' => $pdt_id, 'pdt_description' => $pdt_description, 
					  'pdt_quality' => $pdt_quality, 'current_unit_price' => $pdt_purchase_price, 
					  'pdt_price_unit' => $pdt_purchase_price_unit, 'highest_unit' => $highest_unit, 
		              'stock_before_load' => $stock_before_load, 'stock_load_qty' => $stock_going_to_add, 
		              'stock_after_load' => $stock_after_load, 'stock_load_unit' => $stock_unit, 'sub_total' => $sub_total);
		$this -> db -> insert('stock_load_audit', $data);
	}

	function getAuditRecord($pdt_id, $bill_num) {
		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> where('purchase_bill_no', $bill_num);
		$this -> db -> order_by('stock_load_date', 'desc');
		$this -> db -> limit(1);
		return $this -> db -> get('stock_load_audit');
	}

	function updateStockUponLineRemoval($pdt_id, $stock_added) {
		$this -> db -> select('available_stock');
		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> limit(1);
		$query = $this -> db -> get('stock');
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				$available_stock = $row -> available_stock;
				$new_stock = $available_stock - $stock_added;
			}
		}
		$data = array('available_stock' => $new_stock, );
		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> update('stock', $data);
	}
		
	function lockPurchaseBill($bill_num) {
		$data = array('is_completed' => 'Y');
		$this -> db -> where('purchase_bill_no', $bill_num);
		$this -> db -> update('stock_load_audit', $data);
	}	
		
	/** Fetch the currect stock for the item to render on the Clear Stock page **/
	function getStockForThisPdtID($id){     
		 $this->db->where('pdt_id', $id);
         return $this->db->get('stock');
    }	
		
	/** Clear Stock **/	
	function confirmClearStock($pdt_id) {
		$id = rawurldecode($pdt_id);
		$data = array('available_stock' => 0,);
		$this -> db -> where('pdt_id', $id);
		$this -> db -> update('stock', $data);
	}
	
	/** Retrieve the stock value after clearance (it will always be zero) **/
	function getStockAfterClearance($id){
		 $this->db->where('pdt_id', $id);
         return $this->db->get('stock');
    }
	
	
		
		
		
		
		
		
	function update_db($pdt_id, $new_stock) {
		$data = array('available_stock' => $new_stock, );
		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> update('stock', $data);
	}

	function add_new_stock() {
		$pdt_id = $this -> input -> post('pdt_id');
		$pdt_name = $this -> input -> post('pdt_name');
		$stock_unit = $this -> input -> post('stock_unit');
		$add_stock = $this -> input -> post('new_value');
		$data = array('pdt_id' => $pdt_id, 'pdt_name' => $pdt_name, 'available_stock' => $add_stock, 'stock_unit' => $stock_unit);
		$this -> db -> insert('stock', $data);
	}

	function update_stock() {
		$pdt_idx = $this -> input -> post('pdt_idx');
		$pdt_id = $this -> input -> post('pdt_id');
		$pdt_name = $this -> input -> post('pdt_name');
		$stock_unit = $this -> input -> post('stock_unit');
		$add_stock = $this -> input -> post('new_value');
		$data = array('available_stock' => $add_stock, 'stock_unit' => $stock_unit);
		$this -> db -> where('pdt_idx', $pdt_idx);
		$this -> db -> update('stock', $data);
	}


	function pdt_stock_name($id) {

		$this -> db -> where('pdt_name', $id);
		return $this -> db -> get('stock');

	}

	function auto_pdt_id($keyword) {

		$this -> db -> like('pdt_id', $keyword, 'after');
		return $this -> db -> get('stock');
	}

	function auto_pdt_name($keyword) {

		$this -> db -> like('pdt_name', $keyword, 'after');
		return $this -> db -> get('stock');
	}

	function dpdt_id($keyword) {

		$this -> db -> where('pdt_id', $keyword);
		return $this -> db -> get('stock');
	}

	function dpdt_name($keyword) {

		$this -> db -> where('pdt_name', $keyword);
		return $this -> db -> get('stock');
	}

	function bill_print($bill) {
		$this -> db -> where('purchase_bill_no', $bill);

		return $this -> db -> get('stock_load_audit');
	}

	function bill_print_s() {
		$bill_num = $this -> input -> post('bill_num');
		$this -> db -> where('purchase_bill_no', $bill_num);

		return $this -> db -> get('stock_load_audit');
	}

	function stockreportdate() {

		$a = $this -> input -> post('sdate');
		$b = $this -> input -> post('edate');
		$sdate = date('Y-m-d', strtotime($a));
		$edate = date('Y-m-d', strtotime($b));
		$sdate1 = strtotime($a);
		$edate2 = strtotime($b);
		if ($sdate1 == $edate2) {
			$dateRange = "stock_load_date LIKE '$sdate%'";
		} else {
			$dateRange = "stock_load_date BETWEEN '$sdate' AND '$edate'";
		}
		$this -> db -> select('purchase_bill_no,stock_load_date');
		$this -> db -> select_sum('sub_total');
		$this -> db -> group_by('purchase_bill_no');
		$this -> db -> where($dateRange, NULL, FALSE);
		return $this -> db -> get('stock_load_audit');

	}

	function bill_details() {
		$bill = $this -> input -> get('bill');
		$date = $this -> input -> get('date');
		//$this->db->select_sum('sub_total','ss');

		$this -> db -> where('purchase_bill_no', $bill);
		//$this->db->where('stock_load_date',$date);
		return $this -> db -> get('stock_load_audit');

	}

	function del_stock_from_pdt($id) {

		$this -> db -> delete('stock', array('pdt_id' => $id));
	}

	function reportall($limit, $offset) {
		$q = "SELECT s.available_stock,s.stock_unit, p.pdt_id,p.pdt_price_unit,p.pdt_price,p.pdt_description
  FROM product p JOIN stock s ON s.pdt_id= p.pdt_id LIMIT $limit OFFSET $offset";

		return $this -> db -> query($q);
	}

	function getincompletebill() {
		$this -> db -> select_sum('sub_total');

		$this -> db -> select('stock_load_date,purchase_bill_no');
		$this -> db -> where('is_completed', 'N');
		$this -> db -> group_by('purchase_bill_no');
		return $this -> db -> get('stock_load_audit');
	}

}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */
