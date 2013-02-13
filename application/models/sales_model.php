<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Sales_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function billnum() {
		$this -> db -> select_max('bill_num');
		$this -> db -> limit(1);
		return $this -> db -> get('sales');
	}

	function add_db($bill_num, $pdt_id, $pdt_des, $rc_num, $sub_total, $pdt_quantity, $pdt_unit, $price_per_h, $price_per_unit_h) {
		$date1 = date('Y-m-d');
		$data = array('bill_num' => $bill_num, 'pdt_id' => $pdt_id, 'pdt_des' => $pdt_des, 'rc_num' => $rc_num, 'sub_total' => $sub_total, 'pdt_quantity' => $pdt_quantity, 'pdt_unit' => $pdt_unit, 'price_per_h' => $price_per_h, 'price_per_unit_h' => $price_per_unit_h, 'bill_date' => $date1, );

		$this -> db -> insert('sales', $data);
	}

	function add_db_temp($bill_num, $pdt_id, $pdt_des, $rc_num, $sub_total, $pdt_quantity, $pdt_unit, $price_per_h, $price_per_unit_h) {
		$date1 = date('Y-m-d');
		$data = array('bill_num' => $bill_num, 'pdt_id' => $pdt_id, 'pdt_des' => $pdt_des, 'rc_num' => $rc_num, 'sub_total' => $sub_total, 'pdt_quantity' => $pdt_quantity, 'pdt_unit' => $pdt_unit, 'price_per_h' => $price_per_h, 'price_per_unit_h' => $price_per_unit_h, 'bill_date' => $date1, );

		$this -> db -> insert('sales_temp', $data);
	}

	function add_quota_hstory_db($bill_num, $week_num, $rc_num, $pdt_id, $pdt_quantity, $pdt_unit) {

		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$data = array('bill_num' => $bill_num, 'week_num' => $week_num, 'rc_num' => $rc_num, 'purchased_quantity' => $pdt_quantity, 'pdt_unit' => $pdt_unit, 'pdt_id' => $pdt_id, );

			$this -> db -> insert('quota_purchase_history', $data);
		} elseif ($mode == 'festival') {
			$data = array('bill_num' => $bill_num, 'week_num' => $week_num, 'rc_num' => $rc_num, 'purchased_quantity' => $pdt_quantity, 'pdt_unit' => $pdt_unit, 'pdt_id' => $pdt_id, );

			$this -> db -> insert('festival_quota_purchase_history', $data);
		}
	}

	function get_item($pdt_id, $bill_num) {

		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> where('bill_num', $bill_num);
		$this -> db -> order_by('bill_time', 'desc');
		$this -> db -> limit(1);
		return $this -> db -> get('sales');

	}

	function get_item_temp($pdt_id, $bill_num) {

		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> where('bill_num', $bill_num);
		$this -> db -> order_by('bill_time', 'desc');
		$this -> db -> limit(1);
		return $this -> db -> get('sales_temp');

	}

	function get_item_quota_purchase_hstory($pdt_id, $bill_num, $week_num) {

		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> where('bill_num', $bill_num);
			$this -> db -> where('week_num', $week_num);
			$this -> db -> order_by('purchased_date', 'desc');
			$this -> db -> limit(1);
			return $this -> db -> get('quota_purchase_history');
		} elseif ($mode == 'festival') {
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> where('bill_num', $bill_num);
			$this -> db -> where('week_num', $week_num);
			$this -> db -> order_by('purchased_date', 'desc');
			$this -> db -> limit(1);
			return $this -> db -> get('festival_quota_purchase_history');
		}
	}

	function auto_pdt_id_de($keyword) {

		$this -> db -> where('pdt_id', $keyword);
		return $this -> db -> get('purchase_product');

	}

	function purchasedquantity($pdt_id, $rc_num, $week_num) {

		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> where('rc_num', $rc_num);
			$this -> db -> where('week_num', $week_num);
			$this -> db -> group_by('rc_num');
			$this -> db -> select_sum('purchased_quantity');
			return $this -> db -> get('quota_purchase_history');
		} elseif ($mode == 'festival') {
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> where('rc_num', $rc_num);
			$this -> db -> where('week_num', $week_num);
			$this -> db -> group_by('rc_num');
			$this -> db -> select_sum('purchased_quantity');
			return $this -> db -> get('festival_quota_purchase_history');
		}
	}

	function salesreportdate() {

		$a = $this -> input -> post('sdate');
		$b = $this -> input -> post('edate');
		$sdate = date('Y-m-d', strtotime($a));
		$edate = date('Y-m-d', strtotime($b));
		$dateRange = "bill_date BETWEEN '$sdate' AND '$edate'";
		$this -> db -> select_sum('sub_total');
		$this -> db -> select('bill_num,bill_date');
		$this -> db -> group_by('bill_num');
		$this -> db -> where($dateRange, NULL, FALSE);
		return $this -> db -> get('sales');

	}

	function salesreportdateitem() {

		$a = $this -> input -> post('sdate');
		$b = $this -> input -> post('edate');
		$pdt_id = $this -> input -> post('pdt_id');
		$sdate = date('Y-m-d', strtotime($a));
		$edate = date('Y-m-d', strtotime($b));
		$dateRange = "bill_date BETWEEN '$sdate' AND '$edate'";
		$this -> db -> select_sum('sub_total');
		$this -> db -> select('bill_num,bill_date');
		$this -> db -> group_by('bill_num');
		$this -> db -> where($dateRange, NULL, FALSE);
		$this -> db -> where('pdt_id', $pdt_id);
		return $this -> db -> get('sales');

	}

	function bill_details() {
		$bill = $this -> input -> get('bill');
		$date = $this -> input -> get('date');
		//$this->db->select_sum('sub_total','ss');
		$this -> db -> select('pdt_quantity,pdt_id,price_per_unit_h,price_per_h,pdt_unit,sub_total');
		$this -> db -> where('bill_num', $bill);
		//$this -> db -> where('bill_date', $date);
		return $this -> db -> get('sales');

	}

	function bill_print($bill) {

		$sales_query = "SELECT pdt.pdt_id, pdt.pdt_name_ml, pdt.pdt_price, pdt.pdt_price_unit,
			sale.bill_num, sale.bill_date, sale.pdt_quantity, sale.pdt_unit ,sale.sub_total,sale.rc_num  
			FROM product pdt JOIN sales sale ON sale.pdt_id= pdt.pdt_id
			WHERE sale.bill_num='$bill'";

		return $this -> db -> query($sales_query);
	}

	function bill_print_s() {    $bill_num = $this -> input -> post('bill_num');
		$this -> db -> where('bill_num', $bill_num);

		return $this -> db -> get('sales');
	}

	function getdb($id) {

		$this -> db -> where('s_id', $id);

		return $this -> db -> get('sales');

	}

	function update_is_completed($bill_num) {

		$data = array('is_completed' => 'Y');
		$this -> db -> where('bill_num', $bill_num);
		$this -> db -> update('sales', $data);
	}

	function delete_temp($bill_num) {

		$this -> db -> where('bill_num', $bill_num);
		$this -> db -> delete('sales_temp', $data);
	}

	function getincompletebill() {
		$this -> db -> select_sum('sub_total');
		$this -> db -> select('bill_time,bill_num,bill_date');
		$this -> db -> where('is_completed', 'N');

		$this -> db -> group_by('bill_num');
		return $this -> db -> get('sales');
	}

	function sales_edit_in($bill) {
		/*$q = "SELECT sale.bill_num, sale.bill_date, sale.bill_time,
		 pdt.pdt_id, pdt.pdt_description,
		 pdt.pdt_price, pdt.pdt_price_unit,
		 sale.pdt_quantity, sale.pdt_unit, sale.sub_total,
		 sale.is_completed,
		 pdt.is_quota_limited,
		 sale.s_id AS S_S_ID, stemp.s_id AS STEMP_S_ID
		 FROM product pdt
		 JOIN sales sale ON sale.pdt_id= pdt.pdt_id
		 JOIN sales_temp stemp ON stemp.pdt_id=pdt.pdt_id AND stemp.bill_num=sale.bill_num
		 AND sale.is_completed='N'
		 AND sale.bill_num='$bill'";*/
		$this -> db -> select('sale.bill_num, sale.bill_date, sale.bill_time,
       pdt.pdt_id, pdt.pdt_description,
       pdt.pdt_price, pdt.pdt_price_unit,
       sale.pdt_quantity, sale.pdt_unit, sale.sub_total,
       sale.is_completed,
       pdt.is_quota_limited,sale.s_id AS S_S_ID, stemp.s_id AS STEMP_S_ID');
		$this -> db -> distinct();
		$this -> db -> from('product  pdt');
		$this -> db -> join('sales sale ', 'sale.pdt_id= pdt.pdt_id', 'left');
		$this -> db -> join('sales_temp stemp ', 'stemp.pdt_id=pdt.pdt_id', 'left');
		$this -> db -> where('sale.is_completed', 'N');
		$this -> db -> where('sale.bill_num', $bill);
		$this -> db -> group_by('sale.bill_time');

		return $this -> db -> get();
	}

	function sales_edit_in_q($bill) {
		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$q = "SELECT sale.bill_num, sale.bill_date, sale.bill_time,
	   pdt.pdt_id, pdt.pdt_description,
	   pdt.pdt_price, pdt.pdt_price_unit,
	   sale.pdt_quantity, sale.pdt_unit, sale.sub_total,
	   sale.is_completed,
	   pdt.is_quota_limited,
	   sale.s_id AS S_S_ID, stemp.s_id AS STEMP_S_ID,quota_ph.q_p_h_id
FROM product pdt
JOIN sales sale ON sale.pdt_id= pdt.pdt_id
JOIN sales_temp stemp ON stemp.pdt_id=pdt.pdt_id AND stemp.bill_num=sale.bill_num
JOIN quota_purchase_history quota_ph ON quota_ph.pdt_id=pdt.pdt_id AND quota_ph.bill_num=sale.bill_num
AND sale.is_completed='N'
AND sale.bill_num='$bill' GROUP BY sale.bill_time";

			return $this -> db -> query($q);
		} elseif ($mode == 'festival') {
			$q = "SELECT sale.bill_num, sale.bill_date, sale.bill_time,
	   pdt.pdt_id, pdt.pdt_description,
	   pdt.pdt_price, pdt.pdt_price_unit,
	   sale.pdt_quantity, sale.pdt_unit, sale.sub_total,
	   sale.is_completed,
	   pdt.is_quota_limited,
	   sale.s_id AS S_S_ID, stemp.s_id AS STEMP_S_ID,quota_ph.q_p_h_id
FROM product pdt
JOIN sales sale ON sale.pdt_id= pdt.pdt_id
JOIN sales_temp stemp ON stemp.pdt_id=pdt.pdt_id AND stemp.bill_num=sale.bill_num
JOIN festival_quota_purchase_history quota_ph ON quota_ph.pdt_id=pdt.pdt_id AND quota_ph.bill_num=sale.bill_num
AND sale.is_completed='N'
AND sale.bill_num='$bill' GROUP BY sale.bill_time";

			return $this -> db -> query($q);
		}

	}

	function salesreportonstock() {
		$a = $this -> input -> post('sdate');
		$b = $this -> input -> post('edate');
		$sdate = date('Y-m-d', strtotime($a));
		$edate = date('Y-m-d', strtotime($b));

		// $q = "SELECT stock.pdt_id AS pdt_id,stock.stock_load_unit AS stockloadunit,stock.current_unit_price AS PURCHASEDUNITPRICE,stock.pdt_price_unit AS PURCHASEDUNIT,
		// SUM(stock.stock_load_qty) AS PURCHASEDQUANTITY,
		// SUM(stock.sub_total) AS PURCHASEDSUBTOTAL,stock.stock_load_date,
		// sales.pdt_id,price_per_h AS SELLINGUNITPRICE,sales.price_per_unit_h,
		// SUM(sales.sub_total) AS SELLINGSUBTOTAL,SUM(sales.pdt_quantity) AS SOLDQUANTITY,
		// sales.pdt_unit AS SOLDUNIT
		// FROM stock_load_audit stock
		// JOIN sales sales ON stock.pdt_id= sales.pdt_id
		// WHERE stock.stock_load_date BETWEEN '$sdate' AND '$edate'";
		$sdate1 = strtotime($a);
		$edate2 = strtotime($b);
		if ($sdate1 == $edate2) {
			$q = "SELECT temp_table.pdt_id,
temp_table.stock_load_date,
temp_table.total_stock_load_qty AS PURCHASEDQUANTITY,
temp_table.total_sub_total AS PURCHASEDSUBTOTAL,
temp_table.total_purchase_unit AS PURCHASEDUNITPRICE,
temp_table.total_p_unit AS PURCHASEDUNIT,
temp_table.stk_unit AS stockloadunit,
SUM(sales.pdt_quantity) AS SOLDQUANTITY,
SUM(sales.sub_total) AS SELLINGSUBTOTAL,
sales.pdt_unit AS SOLDUNIT,
sales.price_per_h AS SELLINGUNITPRICE,
sales.price_per_unit_h
FROM

(SELECT stock.stock_load_unit As stk_unit,stock.pdt_price_unit AS total_p_unit,stock.current_unit_price AS total_purchase_unit,stock.stock_load_date,stock.pdt_id, SUM( stock.stock_load_qty) AS total_stock_load_qty, SUM( stock.sub_total) AS total_sub_total
FROM stock_load_audit stock GROUP BY stock.pdt_id) temp_table

LEFT JOIN sales as sales on temp_table.pdt_id=sales.pdt_id
WHERE temp_table.stock_load_date LIKE '$sdate%' group by pdt_id";
		} else {

			$q = "SELECT temp_table.pdt_id,
temp_table.stock_load_date,
temp_table.total_stock_load_qty AS PURCHASEDQUANTITY,
temp_table.total_sub_total AS PURCHASEDSUBTOTAL,
temp_table.total_purchase_unit AS PURCHASEDUNITPRICE,
temp_table.total_p_unit AS PURCHASEDUNIT,
temp_table.stk_unit AS stockloadunit,
SUM(sales.pdt_quantity) AS SOLDQUANTITY,
SUM(sales.sub_total) AS SELLINGSUBTOTAL,
sales.pdt_unit AS SOLDUNIT,
sales.price_per_h AS SELLINGUNITPRICE,
sales.price_per_unit_h
FROM

(SELECT stock.stock_load_unit As stk_unit,stock.pdt_price_unit AS total_p_unit,stock.current_unit_price AS total_purchase_unit,stock.stock_load_date,stock.pdt_id, SUM( stock.stock_load_qty) AS total_stock_load_qty, SUM( stock.sub_total) AS total_sub_total
FROM stock_load_audit stock GROUP BY stock.pdt_id) temp_table

LEFT JOIN sales as sales on temp_table.pdt_id=sales.pdt_id
WHERE temp_table.stock_load_date BETWEEN '$sdate' AND '$edate' group by pdt_id";
		}
		return $this -> db -> query($q);

	}

}
