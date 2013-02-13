<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Stock extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('product_model');
		$this -> load -> model('stock_model');
		session_start();
		parent::__construct();
		if (!isset($_SESSION['username'])) {
			redirect('admin');
		}
	}

	function addgetid($pdt_id) {
		$id = rawurldecode($pdt_id);
		$data['query'] = $this -> product_model -> pdt_single_id($id);
		$data['query1'] = $this -> stock_model -> pdt_stock_id($id);
		$data['bill_num'] = $this -> stock_model -> pdt_stock_id_from_stk_load($id);
		$this -> load -> view('stock/add_view', $data);

	}

	function addgetname($pdt_name) {
		$name = rawurldecode($pdt_name);
		$data['query'] = $this -> product_model -> pdt_single_name($name);
		$data['query1'] = $this -> stock_model -> pdt_stock_name($name);
		$data['bill_num'] = $this -> stock_model -> pdt_stock_id_from_stk_load($id);
		$this -> load -> view('stock/add_view', $data);

	}

	function cleargetid($pdt_id) {
		$id = rawurldecode($pdt_id);
		$data['query'] = $this -> stock_model -> pdt_stock_id($id);
		$this -> load -> view('stock/clear_view', $data);

	}
	function cleargetid_u($pdt_id) {
		$id = rawurldecode($pdt_id);
		$data['query'] = $this -> stock_model -> pdt_stock_id($id);
		$this -> load -> view('stock/clear_u_view', $data);
	}

	function cleargetname($pdt_id) {
		$id = rawurldecode($pdt_id);
		$data['query'] = $this -> stock_model -> pdt_stock_name($id);
		$this -> load -> view('stock/clear_view', $data);

	}

	function add_confirm() {

		$this -> form_validation -> set_rules('new_value', 'New stock value', 'required|xss_clean');

		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$pdt_id = $this -> input -> post('pdt_id');
			$data['query'] = $this -> product_model -> pdt_single_name($pdt_id);
			$data['query1'] = $this -> stock_model -> pdt_stock_id($id);
			$this -> load -> view('stock/add_view', $data);
		} else {

			$pdt_id = $this -> input -> post('pdt_id');
			$this -> stock_model -> add_new_stock();
			$this -> ci_alerts -> set('success', 'Stock updated successfully');
			redirect('stock/addgetid/' . $pdt_id);

		}

	}

	function update_confirm() {

		$this -> form_validation -> set_rules('new_value', 'New stock value', 'required|xss_clean');

		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$pdt_id = $this -> input -> post('pdt_id');
			$data['query'] = $this -> product_model -> pdt_single_name($pdt_id);
			$data['query1'] = $this -> stock_model -> pdt_stock_id($pdt_id);
			$this -> load -> view('stock/add_view', $data);
		} else {

			$pdt_id = $this -> input -> post('pdt_id');
			$this -> stock_model -> update_stock();
			$this -> ci_alerts -> set('success', 'Stock updated successfully');
			redirect('stock/addgetid/' . $pdt_id);

		}

	}

	function clear() {
		$data['title'] = 'Clear Stock';
		$this -> load -> view('stock/search_clear_view', $data);
	}

	function clear_confirm($pdt_id) {

		$this -> stock_model -> clear_stock($pdt_id);
		$this -> ci_alerts -> set('success', 'Stock cleared successfully');
		redirect('stock/cleargetid_u/'.$pdt_id);
	}

	function add() {
		$data['bill_num'] = $this -> stock_model -> pdt_stock_id_from_stk_load();
		$data['title'] = 'Add Stock';
		$this -> load -> view('stock/add_view', $data);
	}

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
				$data['message'][] = array('label' => $row -> pdt_name, 'value' => $row -> pdt_name);
				//Add a row to array
			}
		}
		echo json_encode($data);
	}

	function auto_id() {
		$keyword = $this -> input -> post('term');
		$data['response'] = 'false';
		$query = $this -> product_model -> auto_pdt_id($keyword);
		if ($query -> num_rows() > 0) {
			$data['response'] = 'true';
			//Set response
			$data['message'] = array();
			//Create array
			foreach ($query->result() as $row) {
				$data['message'][] = array('label' => $row -> pdt_id, 'value' => $row -> pdt_id);
				//Add a row to array
			}
		}
		echo json_encode($data);
	}

	function delete($id) {
		$this -> db -> delete('product', array('pdt_idx' => $id));
		$this -> ci_alerts -> set('success', 'Product deleted successfully');
		redirect('product/search');
	}

	function stock_details() {
		$keyword = $this -> input -> post('term');
		$query = $this -> stock_model -> pdt_stock_id($keyword);
		$data['response'] = 'true';
		//Set response
		//$data['message'] = array(); //Create array
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('pdt_stock' => number_format($row -> available_stock, 2, '.', ''), 'stock_unit' => $row -> stock_unit);
			echo json_encode($data);
		} else {
			$data = array('pdt_stock' => 0, 'stock_unit' => 0);
			echo json_encode($data);

		}

	}

	function add_db() {
		$bill_num= $this->input->post('bill_num');
		$pdt_id = $this->input->post('pdt_id');
        $flag=$this->input->post('new_pdt');
		if($flag=='Y'){
			
			$this -> product_model -> add_new_pdt_from_stock();
			$this -> stock_model -> add_new_pdt_from_stock();
		}
		$this -> stock_model -> modify_stock();
		$this -> stock_model -> stock_audit();
		
		$query = $this -> stock_model -> get_item($pdt_id, $bill_num);
		if ($query -> num_rows() > 0) {

				foreach ($query->result() as $row) :
					echo "<tr id='". $row -> spa_id ."'>";
					echo "<td>" . $row -> pdt_id . "</td>";
					echo "<td>" . $row -> current_unit_price . "/" . $row -> pdt_price_unit . "</td>";
					echo "<td>" . number_format($row -> stock_load_qty,2,'.','') ."/" . $row ->stock_load_unit .  "</td>";
					//echo "<td>" . number_format($row -> stock_after_load,2,'.','') ."/" . $row ->stock_load_unit .  "</td>";
					echo "<td>" . number_format($row -> sub_total,2,'.','') ."</td>";
					echo "<td><input type='hidden' value='" . $row -> pdt_id . "' id='pdt_id_del" . $row -> spa_id . "'/>
					<input type='hidden' value='" . $row -> stock_load_qty . "' id='stk_added" . $row -> spa_id . "'/>
					<input type='hidden' value='" . $row -> stock_after_load . "' id='stk_after_add" . $row -> spa_id . "'/>
					<input type='hidden' id='forhiding' value='chumma'/>
					<button  id='" . $row -> spa_id . "'>Delete</button><button1 class='delete' id='" . $row -> spa_id . "'></button></td>";
					echo "<tr>";
					endforeach;
			} 
	}
function bill_print($bill) {

		$data['query'] = $this -> stock_model -> bill_print($bill);
		$this -> load -> view('stock/bill_print_view', $data);
	}
function report() {

		$this -> load -> view('stock/report_view');
	}
function pdt_details() {
		$keyword = $this -> input -> post('term');
		$query = $this -> stock_model -> auto_pdt_id_de($keyword);
		$data['response'] = 'true';
		//Set response
		//$data['message'] = array(); //Create array
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('pdt_price' => $row -> pdt_price,'pdt_price_selling' => $row -> SELLINGPRICE, 'pdt_des' => $row -> pdt_description, 'pdt_unit' => $row -> pdt_price_unit,'pdt_unit_selling' => $row -> SELLINGUNIT, 'pdt_highest_unit' => $row -> hs_unit, 'pdt_quality' => $row -> quality, 'pdt_id' => $row -> pdt_id,'pdt_name' => $row -> pdt_name,);
			echo json_encode($data);
		} else {
			//$data = array('new_product' => 'Y');
			echo json_encode($data);
		}
	}
function stock_report_get() {
		// $this->load->library('pagination');
		// $config['base_url'] = '/index.php/sales/sales_report_get/';
		// $config['total_rows'] = 200;
		// $config['per_page'] = 20;
		// $this->pagination->initialize($config);
		$this -> form_validation -> set_rules('sdate', 'Start Date', 'required');
		$this -> form_validation -> set_rules('edate', 'End Date', 'required|callback__check_valid_date|callback__comparedates[sdate]');

		if ($this -> form_validation -> run() == TRUE) {
			$data['query'] = $this -> stock_model -> stockreportdate();
			$this -> load -> view('stock/report_result_view', $data);
		}
		else{
			$this -> load -> view('stock/report_view');
		}
		//$data['query'] = $this -> stock_model -> stockreportdate();
		//$this -> load -> view('stock/report_result_view', $data);
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
	function bill_details() {

		// $this->load->library('pagination');
		// $config['base_url'] = '/index.php/sales/sales_report_get/';
		// $config['total_rows'] = 200;
		// $config['per_page'] = 20;
		// $this->pagination->initialize($config);
		$data['bill'] = $this -> input -> get('bill');
		$data['date'] = $this -> input -> get('date');
		$data['query'] = $this -> stock_model -> bill_details();

		$this -> load -> view('stock/bill_result_view', $data);
	}
	function delete_db() {

		//$id = $this -> input -> post('s_id');
		$spa_id = $this -> input -> post('spa_id');
		$pdt_id = $this -> input -> post('pdt_id');
		$stock_added= $this -> input -> post('current_stock');
		$this -> stock_model -> update_db_del($pdt_id,$stock_added);
		$this -> db -> delete('stock_load_audit', array('spa_id' => $spa_id));
		

	}
	 function billsearch() {
		$bill_num=$this ->input->post('bill_num');
		if($bill_num==''){
			$this->load->view('stock/bill_search');
		}else{
			
			$data['query']=$this->stock_model->bill_print_s();
			$this->load->view('stock/bill_print_s_view',$data);
		}
	}
function search()
    {
        $data['title']='Search Stock';	
        $this->load->view('stock/search_view',$data);
    }
	function search_get_id()
    {
    	$id=$this ->input->post('id');
      $data['stock']=$this->stock_model->pdt_stock_id($id);
	  $this->load->view('stock/search_r_view',$data);
    }
	function search_get_name()
    {
      $name=$this ->input->post('name');
	  $data['stock']=$this->stock_model->pdt_stock_name($name);
	  $this->load->view('stock/search_r_view',$data);
    }
	
	function reportall(){

		        $this->load->library('pagination');
				$config['base_url'] = base_url('index.php/stock/reportall');
				$config['total_rows'] = $this->db->count_all('stock');
				$config['per_page'] = 10;
				$config['num_links'] = 20;
				$this->pagination->initialize($config);
			    $data['query']=$this->stock_model->reportall($config['per_page'],$this->uri->segment(3,0));
			   $data["links"] = $this->pagination->create_links();
			$this->load->view('stock/stock_all_report',$data);
			
	}
function loaded($bill_num) {
		
		$this -> stock_model -> update_is_completed($bill_num);
		$this -> ci_alerts -> set('success', 'Stock added successfully');
		redirect('stock/add');
  }
function incompletebill(){
		
		   //$data['query'] = $this -> product_model -> pdt_single_id($id);
		   $data['query'] = $this -> stock_model -> getincompletebill();
		   $this->load->view('stock/incompleteresult',$data);
	}
 function stock_incomplete(){
  	
	$bill=$this->input->get('bill');
	$date=$this->input->get('date');
	$data['bill']=$this->input->get('bill');
	$data['date']=$this->input->get('date');
	$data['stock'] = $this -> stock_model -> bill_print($bill);

    $this -> load -> view('stock/stock_edit_view', $data);
  }
}