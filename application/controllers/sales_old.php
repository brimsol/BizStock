<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sales extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('product_model');
		$this -> load -> model('customer_model');
		$this -> load -> model('sales_model');
		$this -> load -> model('stock_model');
		$this -> load -> model('week_model');
		session_start();
		parent::__construct();
		if (!isset($_SESSION['username'])) {
			redirect('admin');
		}
	}

	function index() {

		$this -> load -> view('sales/search_view');

	}

	function checkcard($rc_num) {

		$data['query'] = $this -> customer_model -> carddetails($rc_num);
		$data['query2'] = $this -> sales_model -> billnum();
		$data['rc_num'] = $rc_num;
		$this -> load -> view('sales/sales_view', $data);

	}

	function add_db() {

		$pdt_id = $this -> input -> post('pdt_id');
		$pdt_des = $this -> input -> post('pdt_des');
		$total_quota = $this -> input -> post('total_quota');
		$purchased_quota = $this -> input -> post('purchased_quota');
		$remaining_quota = $this -> input -> post('remaining_quota');
		$price_per_unit_h = $this -> input -> post('price_per_unit_h');
		$price_per_h = $this -> input -> post('price_per_h');
		$pdt_quantity = $this -> input -> post('pdt_quantity');
		$pdt_unit = $this -> input -> post('pdt_unit');
		$sub_total = $this -> input -> post('sub_total');
		$bill_num = $this -> input -> post('bill_num');
		$rc_num = $this -> input -> post('rc_num');
		$week_num = $this -> input -> post('week_num');
		$new_stock = $this -> input -> post('new_stock');
		$is_quota_limited_flag = $this -> input -> post('is_quota_limited_flag');
		$this -> sales_model -> add_db($bill_num, $pdt_id, $pdt_des, $rc_num, $sub_total, $pdt_quantity, $pdt_unit, $price_per_h, $price_per_unit_h);
		$this -> sales_model -> add_db_temp($bill_num, $pdt_id, $pdt_des, $rc_num, $sub_total, $pdt_quantity, $pdt_unit, $price_per_h, $price_per_unit_h);
		$this -> stock_model -> update_db($pdt_id, $new_stock);
		if ($is_quota_limited_flag == 'Y') {
			$this -> sales_model -> add_quota_hstory_db($bill_num, $week_num, $rc_num, $pdt_id, $pdt_quantity, $pdt_unit);
			$query2 = $this -> sales_model -> get_item_quota_purchase_hstory($pdt_id, $bill_num, $week_num);
			$query = $this -> sales_model -> get_item($pdt_id, $bill_num);
			$temp_sl = $this -> sales_model -> get_item_temp($pdt_id, $bill_num);
			if ($temp_sl -> num_rows() > 0) {
				foreach ($temp_sl->result() as $row) :
					$st_id = $row -> s_id;
				endforeach;
			}
			if ($query2 -> num_rows() > 0) {
				foreach ($query2->result() as $row) :
					$q_p_h_id = $row -> q_p_h_id;
				endforeach;
			}
			if ($query -> num_rows() > 0) {

				foreach ($query->result() as $row) :
					$u = $row -> pdt_unit;
					$pdt_quantity = $row -> pdt_quantity;
					if ($u == 'Kg') {

						$newr = $pdt_quantity;
					} else if ($u == 'L') {

						$newr = $pdt_quantity;
					} else if ($u == 'Pieces') {

						$newr = $pdt_quantity;
					} else if ($u == 'Gram') {

						$newr = $pdt_quantity * 1000;
					} else if ($u == 'ml') {

						$newr = $pdt_quantity * 1000;
					}
					echo "<tr id='" . $row -> s_id . "'>";
					echo "<td>" . $row -> pdt_des . "</td>";
					echo "<td>" . number_format($row -> price_per_h,2,'.','') . "/" . $row -> price_per_unit_h . "</td>";
					echo "<td>" . number_format($newr,2,'.','') . "</td>";
					echo "<td>" . $row -> pdt_unit . "</td>";
					echo "<td class='subtotal'>" . number_format($row -> sub_total,2,'.','') . "</td>";
					//echo "<td id='test'>dele</td";
					//<input type='submit' value='delete'/>
					echo "<td>
					<input type='hidden' value='" . $row -> pdt_id . "' id='pdt_id_del" . $row -> s_id . "'/>
					<input type='hidden' value='" . $row -> pdt_id . "' id='pdt_id_del" . $row -> s_id . "'/>
					<input type='hidden' value='" . $newr . "' id='pdt_quantity_del" . $row -> s_id . "'/>
					<input type='hidden' value='" . $row -> pdt_unit . "' id='pdt_unit_del" . $row -> s_id . "'/>
					<input type='hidden' value='" . $q_p_h_id . "' id='q_p_h_id" . $row -> s_id . "'/>
					<input type='hidden' value='" . $st_id . "' id='st_id" . $row -> s_id . "'/>
					<input type='hidden' value='" . $is_quota_limited_flag . "' id='is_quota_limited_flag" . $row -> s_id . "'/>
					<button id='" . $row -> s_id . "'>Delete</button><button1 class='delete' id='" . $row -> s_id . "'></button>
					</td>";
					echo "<tr/>";

				endforeach;
			} else {
				echo "<div class='alert alert-error fade in'>Not found ! Please check if the product name you entered is correct !</div>";
			}
		} else {
			// $data['query']=$this->customer_model->carddetails($rc_num);
			// $this->load->view('sales/sales_view',$data);
			$query = $this -> sales_model -> get_item($pdt_id, $bill_num);
			$temp_sl = $this -> sales_model -> get_item_temp($pdt_id, $bill_num);
			if ($temp_sl -> num_rows() > 0) {
				foreach ($temp_sl->result() as $row) :
					$st_id = $row -> s_id;
				endforeach;
			}
			//$query = $this -> sales_model -> get_item_quota_purchase_hstory($pdt_id, $bill_num,$week_num );
			if ($query -> num_rows() > 0) {

				foreach ($query->result() as $row) :
					$u = $row -> pdt_unit;
					$pdt_quantity = $row -> pdt_quantity;
					if ($u == 'Kg') {

						$newr = $pdt_quantity;
					} else if ($u == 'L') {

						$newr = $pdt_quantity;
					} else if ($u == 'Pieces') {

						$newr = $pdt_quantity;
					} else if ($u == 'Gram') {

						$newr = $pdt_quantity * 1000;
					} else if ($u == 'ml') {

						$newr = $pdt_quantity * 1000;
					}
					echo "<tr id='" . $row -> s_id . "'>";
					echo "<td>" . $row -> pdt_des . "</td>";
					echo "<td>" . number_format($row -> price_per_h, 2, '.', '') . "/" . $row -> price_per_unit_h . "</td>";
					echo "<td>" . number_format($newr, 2, '.', '') . "</td>";
					echo "<td>" . $row -> pdt_unit . "</td>";
					echo "<td class='subtotal'>" . number_format($row -> sub_total, 2, '.', '') . "</td>";
					echo "<td>
					<input type='hidden' value='" . $row -> pdt_id . "' id='pdt_id_del" . $row -> s_id . "'/>
					<input type='hidden' value='" . $newr . "' id='pdt_quantity_del" . $row -> s_id . "'/>
					<input type='hidden' value='" . $row -> pdt_unit . "' id='pdt_unit_del" . $row -> s_id . "'/>
					<input type='hidden' value='" . $is_quota_limited_flag . "' id='is_quota_limited_flag" . $row -> s_id . "'/>
					<input type='hidden' value='" . $st_id . "' id='st_id" . $row -> s_id . "'/>
					<button id='" . $row -> s_id . "'>Delete</button><button1 class='delete' id='" . $row -> s_id . "'></button>
					</td>";
					echo "<tr/>";

				endforeach;

			} else {
				echo "<div class='alert alert-error fade in'>Not found ! Please check if the product name you entered is correct !</div>";
			}

		}
	}

	function purchasedquantity() {
		$keyword = $this -> input -> post('term');
		$rc_num = $this -> input -> post('rc_num');
		$week_num = $this -> input -> post('week_num');
		$sdate = date('Y-m-d');
		//$edate = strtotime("-7 day", $sdate);

		$query = $this -> sales_model -> purchasedquantity($keyword, $rc_num, $week_num);
		$data['response'] = 'true';
		//Set response
		//$data['message'] = array(); //Create array
		if ($query -> num_rows() > 0) {

			foreach ($query->result() as $row) :

				echo number_format($row -> purchased_quantity, 2, '.', '');

			endforeach;

		} else {

			echo 0;

		}
	}

	function delete_db() {

		$id = $this -> input -> post('s_id');
		$st_id = $this -> input -> post('st_id');
		$pdt_id = $this -> input -> post('pdt_id');
		$q_p_h_id = $this -> input -> post('q_p_h_id');
		$given_quantity = $this -> input -> post('pdt_quantity');
		$given_unit = $this -> input -> post('pdt_unit');
		$is_quota_limited = $this -> input -> post('is_quota_limited');
		$query = $this -> sales_model -> getdb($id);
		//$newstock = null;
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) :
				$q = $row -> pdt_quantity;
				$u = $row -> pdt_unit;
				$pdt = $row -> pdt_id;
			endforeach;
		}
		$query2 = $this -> stock_model -> pdt_stock_id($pdt_id);
		if ($query2 -> num_rows() > 0) {
			foreach ($query2->result() as $row) :
				$stock = $row -> available_stock;
				$stock_unit = $row -> stock_unit;
			endforeach;
		}

		if ($stock_unit == $given_unit) {

			$newstock = $stock + $given_quantity;
		} elseif ($stock_unit == 'Tonne' && $given_unit == 'Kg') {

			$stockinkg = $stock * 1000;

			$newstock = ($stockinkg + $given_quantity) / 1000;

		} elseif ($stock_unit == 'Tonne' && $given_unit == 'Gram') {
			$stockingram = $stock * 1000000;

			$newstock = ($stockingram + $given_quantity) / 1000000;

		} else if ($stock_unit == 'Kg' && $given_unit == 'Gram') {
			$stockingram = $stock * 1000;

			$newstock = ($stockingram + $given_quantity) / 1000;

		} else if ($stock_unit == 'L' && $given_unit == 'ml') {
			$stockinmilli = $stock * 1000;

			$newstock = ($stockinmilli + $given_quantity) / 1000;

		}
		if ($is_quota_limited != '') {
		$this->db->limit(1);
		$query = $this->db->get('quota_mode');

		foreach ($query->result() as $row)
		{
		$mode= $row->quota_mode;
		}
		if($mode=='normal'){
		$this -> db -> delete('quota_purchase_history', array('q_p_h_id' => $q_p_h_id));
		}elseif($mode=='festival'){
		$this -> db -> delete('festival_quota_purchase_history', array('q_p_h_id' => $q_p_h_id));
		}
			
		}
		$this -> stock_model -> update_db($pdt_id, $newstock);
		$this -> db -> delete('sales', array('s_id' => $id));
		$this -> db -> delete('sales_temp', array('s_id' => $st_id));

	}

	function sales_report() {
			$this -> load -> view('sales/report_view');
		
	}
	function sales_report_single_item() {
			$this -> load -> view('sales/report_single_view');
		
	}
	
	function sales_report_get() {
		// $this->load->library('pagination');
		// $config['base_url'] = '/index.php/sales/sales_report_get/';
		// $config['total_rows'] = 200;
		// $config['per_page'] = 20;
		// $this->pagination->initialize($config);
		$this -> form_validation -> set_rules('sdate', 'Start Date', 'required');
		$this -> form_validation -> set_rules('edate', 'End Date', 'required|callback__check_valid_date|callback__comparedates[sdate]');

		if ($this -> form_validation -> run() == TRUE) {
			$data['query'] = $this -> sales_model -> salesreportdate();
			$this -> load -> view('sales/report_result_view', $data);
		} else {
			$this -> load -> view('sales/report_view');
		}
	}
function sales_report_get_item() {
		// $this->load->library('pagination');
		// $config['base_url'] = '/index.php/sales/sales_report_get/';
		// $config['total_rows'] = 200;
		// $config['per_page'] = 20;
		// $this->pagination->initialize($config);
		$this -> form_validation -> set_rules('sdate', 'Start Date', 'required');
		$this -> form_validation -> set_rules('pdt_id', 'Product Id', 'required');
		$this -> form_validation -> set_rules('edate', 'End Date', 'required|callback__check_valid_date|callback__comparedates[sdate]');

		if ($this -> form_validation -> run() == TRUE) {
			$data['query'] = $this -> sales_model -> salesreportdateitem();
			$this -> load -> view('sales/report_result_single_view', $data);
		} else {
			$this -> load -> view('sales/report_single_view');
		}
	}

	function bill_details() {

		// $this->load->library('pagination');
		// $config['base_url'] = '/index.php/sales/sales_report_get/';
		// $config['total_rows'] = 200;
		// $config['per_page'] = 20;
		// $this->pagination->initialize($config);
		$data['bill'] = $this -> input -> get('bill');
		$data['date'] = $this -> input -> get('date');
		$data['query'] = $this -> sales_model -> bill_details();

		$this -> load -> view('sales/bill_result_view', $data);
	}

	function bill_print($bill) {

		$data['query'] = $this -> sales_model -> bill_print($bill);
		$this -> load -> view('sales/bill_print_view', $data);
	}

	function GetCurrWeekController() {

		$query = $this -> week_model -> get_week_num();

		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$week_num = $row -> week_num;
			$week_end_ts = $row -> end_ts;
			$current_ts = date("Y-m-d H:i:s");

			if ((strtotime($current_ts)) > (strtotime($week_end_ts))) {

				$datex = new DateTime($week_end_ts);
				$datex = $datex -> format('U');
				$new_start_date = date("Y-m-d H:i:s", ((int)$datex + 1));
				//echo $new_start_date;
				$datex = new DateTime($new_start_date);
				$datex = $datex -> format('U');
				$new_end_date = date("Y-m-d H:i:s", ((int)$datex + 604799));
				//echo "<br>";
				//echo $new_end_date;
				$week_num = ($week_num + 1);
				$this -> week_model -> insert_week_num($week_num, $new_start_date, $new_end_date);

				$data = array('week_num' => $week_num);
				echo json_encode($data);

			} else {

				$data = array('week_num' => $week_num);
				echo json_encode($data);
			}

			// $data = array('week_num' => $row -> week_num);
			// echo json_encode($data);
		}
	}

	function checkout($bill_num) {
		$this -> sales_model -> delete_temp($bill_num);
		$this -> sales_model -> update_is_completed($bill_num);
		$this -> ci_alerts -> set('success', 'Transaction successful');
		redirect('sales/');

	}

	function billsearch() {
		$bill_num = $this -> input -> post('bill_num');
		if ($bill_num == '') {
			$this -> load -> view('sales/bill_search');
		} else {

			$data['query'] = $this -> sales_model -> bill_print_s();
			$this -> load -> view('sales/bill_print_s_view', $data);
		}
	}

	function incompletebill() {

		//$data['query'] = $this -> product_model -> pdt_single_id($id);
		$data['query'] = $this -> sales_model -> getincompletebill();

		$this -> load -> view('sales/incompleteresult', $data);
	}

	function sales_incomplete() {

		$bill = $this -> input -> get('bill');
		$date = $this -> input -> get('date');

		$query1 = $this -> sales_model -> bill_print($bill);
		if ($query1 -> num_rows() > 0) {
			foreach ($query1->result() as $value) :

				$rc_num = $value -> rc_num;

			endforeach;

		}
		$data['bill_num'] = $bill;
		$data['billdate'] = $date;
		//$data['bill'] = $this -> sales_model -> bill_print($bill);

		$data['customer'] = $this -> customer_model -> cus_single_num($rc_num);

		$query2 = $this -> sales_model -> sales_edit_in($bill);
		if ($query2 -> num_rows() > 0) {
			foreach ($query2->result() as $value) :

				$ql = $value -> is_quota_limited;

			endforeach;

			if ($ql == 'N') {

				$data['bill'] = $this -> sales_model -> sales_edit_in($bill);
				$data['q_p_h_id'] = 0;
			} elseif($ql == 'Y') {

				$data['bill'] = $this -> sales_model -> sales_edit_in_q($bill);
				$data['q_p_h_id'] = 1;
			}
		}

		$this -> load -> view('sales/sales_edit_view', $data);
	}
function salesreportonstock()
{
	
	$this -> form_validation -> set_rules('sdate', 'Start Date', 'required');
		//$this -> form_validation -> set_rules('pdt_id', 'Product Id', 'required');
		$this -> form_validation -> set_rules('edate', 'End Date', 'required|callback__check_valid_date|callback__comparedates[sdate]');

		if ($this -> form_validation -> run() == TRUE) {
			$data['query'] = $this -> sales_model -> salesreportonstock();
			$this -> load -> view('sales/report_result_onstock_view', $data);
		} else {
			$this -> load -> view('sales/report_onstock_view');
		}
}

function _check_valid_date($dob_val)
	{
		try
		{
			$dob_check = new DateTime($dob_val);
			$dob_check = $dob_check->format('Y-m-d');
			return TRUE;
		}
		catch(Exception $baddob)
		{
			$this->form_validation->set_message('_check_valid_date', 'The %s is invalid.');
			return FALSE;
		}
	}
	
	/**
	 * Compares batch end date with start date
	 * returns true if end date is greater than start date, false otherwise
	 */
	function _comparedates($stringdate1, $fielddate2)
	{
		$fielddate2 = $this->input->post($fielddate2);
		
		$enddate = strtotime($stringdate1);
		$startdate = strtotime($fielddate2);
		if ($enddate >= $startdate)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_comparedates', 'The %s should be greater than Start date.');
			return false;
		}
	}




}

/*
 function setItemsToCookies(){
 $pdt_id = $this -> input -> post('pdt_id');
 $pdt_des = $this -> input -> post('pdt_des');
 $total_quota = $this -> input -> post('total_quota');
 $purchased_quota = $this -> input -> post('purchased_quota');
 $remaining_quota = $this -> input -> post('remaining_quota');
 $price_per_unit_h = $this -> input -> post('price_per_unit_h');
 $price_per_h = $this -> input -> post('price_per_h');
 $pdt_quantity = $this -> input -> post('pdt_quantity');
 $pdt_unit = $this -> input -> post('pdt_unit');
 $sub_total = $this -> input -> post('sub_total');
 $bill_num = $this -> input -> post('bill_num');
 $rc_num = $this -> input -> post('rc_num');
 $week_num = $this -> input -> post('week_num');
 $new_stock = $this -> input -> post('new_stock');
 $is_quota_limited_flag = $this -> input -> post('is_quota_limited_flag');
 $cookies=array(
 'name'=>$pdt_id,
 );
 }
 */
