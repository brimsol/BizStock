<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Quota extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('product_model');
		$this -> load -> model('quota_model');
		session_start();
		parent::__construct();
		if (!isset($_SESSION['username'])) {
			redirect('admin');
		}

	}

	function addgetid($pdt_id) {
		$id = rawurldecode($pdt_id);
		$data['query1'] = $this -> quota_model -> pdt_quota_id($id);
		$data['query'] = $this -> product_model -> pdt_single_id($id);
		$this -> load -> view('quota/add_view', $data);

	}

	function addgetname($pdt_name) {
		$name = rawurldecode($pdt_name);
		$data['query1'] = $this -> quota_model -> pdt_quota_name($name);
		$data['query'] = $this -> product_model -> pdt_single_name($name);
		$this -> load -> view('quota/add_view', $data);

	}

	function cleargetid($pdt_id) {

		$data['query'] = $this -> product_model -> pdt_single_id($pdt_id);
		$this -> load -> view('stock/clear_view', $data);

	}

	function cleargetname($pdt_id) {

		$data['query'] = $this -> product_model -> pdt_single_name($pdt_id);
		$this -> load -> view('stock/clear_view', $data);

	}

	function add_confirm() {

		$this -> form_validation -> set_rules('allowed_quota', 'Allowed quota', 'trim|xss_clean');

		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$pdt_id = $this -> input -> post('pdt_id');
			$data['query'] = $this -> product_model -> pdt_single_name($pdt_id);
			$this -> load -> view('stock/add_view', $data);
		} else {

			$pdt_id = $this -> input -> post('pdt_id');
			$is_quota_limited = $this -> input -> post('is_quota_limited');
			$q_id = $this -> input -> post('q_id');
			//if(is_quota_limited!='E'){

			$this -> quota_model -> add_new_quota();
			$this -> ci_alerts -> set('success', 'Quota updated successfully');
			redirect('quota/addgetid/' . $pdt_id);
			//}else{
			//$this -> quota_model -> delete_quota();
			//$this -> ci_alerts -> set('success', 'Quota updated successfully');
			//redirect('quota/addgetid/' . $pdt_id);
			//}
		}
	}

	function add_confirm_qm() {

		$this -> form_validation -> set_rules('allowed_quota', 'Allowed quota', 'trim|xss_clean');

		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$pdt_id = $this -> input -> post('pdt_id');
			$data['query'] = $this -> product_model -> pdt_single_name($pdt_id);
			$this -> load -> view('stock/add_view', $data);
		} else {

			$pdt_id = $this -> input -> post('pdt_id');
			$is_quota_limited = $this -> input -> post('is_quota_limited');
			$q_id = $this -> input -> post('q_id');
			//if(is_quota_limited!='E'){
			if ($is_quota_limited == 'E') {
				$this -> quota_model -> add_new_quota_from_qm();
				$this -> ci_alerts -> set('success', 'Quota updated successfully');
				redirect('quota/addgetid/' . $pdt_id);
			} else {
				$this -> ci_alerts -> set('success', 'Quota updated successfully');
				redirect('quota/addgetid/' . $pdt_id);
			}
		}
	}

	function update_confirm() {

		$this -> form_validation -> set_rules('allowed_quota', 'Allowed quota', 'trim|xss_clean');

		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$pdt_id = $this -> input -> post('pdt_id');
			$data['query'] = $this -> product_model -> pdt_single_name($pdt_id);
			$this -> load -> view('stock/add_view', $data);
		} else {
			$pdt_id = $this -> input -> post('pdt_id');
			$is_quota_limited = $this -> input -> post('is_quota_limited');
			//
			if ($is_quota_limited == 'E') {
				$this -> quota_model -> update_quota();
				$this -> ci_alerts -> set('success', 'Quota updated successfully');
				redirect('quota/addgetid/' . $pdt_id);
			} else {
				$this -> quota_model -> delete_quota();
				$this -> ci_alerts -> set('success', 'Quota updated successfully');
				redirect('quota/addgetid/' . $pdt_id);
			}
		}
	}

	function clear() {
		$data['title'] = 'Clear Stock';
		$this -> load -> view('stock/search_clear_view', $data);
	}

	function clear_confirm($pdt_id) {

		$this -> product_model -> pdt_clear_stock($pdt_id);

		redirect('stock/cleargetid/' . $pdt_id);
	}

	function add() {
		$data['title'] = 'Add Stock';
		$this -> load -> view('quota/search_view', $data);
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

	function quota_details() {
		$keyword = $this -> input -> post('term');
		$rc_type = $this -> input -> post('rc_type');
		if ($rc_type == 'APL') {
			$query = $this -> quota_model -> pdt_quota_id($keyword);
			$data['response'] = 'true';
			//Set response
			//$data['message'] = array(); //Create array
			if ($query -> num_rows() > 0) {
				$row = $query -> row();
				$data = array('pdt_quota' => $row -> apl_quota);
				echo json_encode($data);
			} else {
				$data = array('pdt_quota' => 'Unlimited');
				echo json_encode($data);

			}
		} else {

			$query = $this -> quota_model -> pdt_quota_id($keyword);
			$data['response'] = 'true';
			//Set response
			//$data['message'] = array(); //Create array
			if ($query -> num_rows() > 0) {
				$row = $query -> row();
				$data = array('pdt_quota' => $row -> bpl_quota);
				echo json_encode($data);
			} else {
				$data = array('pdt_quota' => 'Unlimited');
				echo json_encode($data);
			}

		}
	}

}
