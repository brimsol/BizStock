<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Customer extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('customer_model');
		session_start();
		parent::__construct();
		if (!isset($_SESSION['username'])) {
			//redirect('admin');
		}
	}

	/** Search customer before rendering the billing screen **/
	function autoCompleteCustomerID() {
		$keyword = $this -> input -> post('term');
		$data['response'] = 'false';
		$query = $this -> customer_model -> auto_pdt($keyword);
		if ($query -> num_rows() > 0) {
			$data['response'] = 'true';
			$data['message'] = array();
			foreach ($query->result() as $row) {
				$data['message'][] = array('label' => $row -> rc_num, 'value' => $row -> rc_num);
			}
		}
		echo json_encode($data);
	}
	
	
	
	
	

	function add() {

		//set validation rules
		$this -> form_validation -> set_rules('rc_num', 'Card number', 'required|numeric|xss_clean|is_unique[customer.rc_num]');
		$this -> form_validation -> set_rules('rc_owner', 'Owner Name', 'required|xss_clean');
		$this -> form_validation -> set_rules('address', 'Address', 'required');
		$this -> form_validation -> set_rules('card_type', 'Card Type', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$this -> load -> view('customer/add_view');
		} else {
			//if valid
			$rc_num = $this -> input -> post('rc_num');
			$rc_owner = $this -> input -> post('rc_owner');
			$card_type = $this -> input -> post('card_type');
			$address = $this -> input -> post('address');

			$this -> customer_model -> add_new_cus($rc_num, $rc_owner, $card_type, $address);
			$this -> ci_alerts -> set('success', 'Customer added successfully');
			redirect('customer/add');

		}
	}

	function add_from_sales() {

		//set validation rules
		$this -> form_validation -> set_rules('rc_num', 'Card number', 'required|numeric|xss_clean|is_unique[customer.rc_num]');
		$this -> form_validation -> set_rules('rc_owner', 'Owner Name', 'required|xss_clean');
		$this -> form_validation -> set_rules('address', 'Address', 'required');
		$this -> form_validation -> set_rules('card_type', 'Card Type', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$this -> load -> view('customer/add_view');
		} else {
			//if valid
			$rc_num = $this -> input -> post('rc_num');
			$rc_owner = $this -> input -> post('rc_owner');
			$card_type = $this -> input -> post('card_type');
			$address = $this -> input -> post('address');

			$this -> customer_model -> add_new_cus($rc_num, $rc_owner, $card_type, $address);
			$this -> ci_alerts -> set('success', 'Customer added successfully');
			redirect('sales/checkcard/' . $rc_num);

		}
	}

	function update($pdt_id) {

		$data['query'] = $this -> customer_model -> cus_single($pdt_id);
		$this -> load -> view('customer/update_view', $data);

	}

	function update_confirm() {

		//set validation rules
		$this -> form_validation -> set_rules('rc_num', 'Card number', 'required|numeric|xss_clean');
		$this -> form_validation -> set_rules('rc_owner', 'Owner Name', 'required|xss_clean');
		$this -> form_validation -> set_rules('address', 'Address', 'required');
		$this -> form_validation -> set_rules('card_type', 'Card Type', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$this -> load -> view('customer/update_error_view');
		} else {
			//if valid
			$rc_num = $this -> input -> post('rc_num');
			$rc_owner = $this -> input -> post('rc_owner');
			$card_type = $this -> input -> post('card_type');
			$address = $this -> input -> post('address');
			$card_id = $this -> input -> post('card_id');
			$this -> customer_model -> update_cus($card_id, $rc_num, $rc_owner, $card_type, $address);
			$this -> ci_alerts -> set('success', 'Customer Updated successfully');
			redirect('customer/update/' . $card_id);

		}
	}

	function search() {
		$this -> load -> view('customer/search_view');
	}

	function cus_result() {
		$key = $this -> input -> get('key');
		$query = $this -> customer_model -> cus_single_num($key);
		if ($query -> num_rows() > 0) {
			echo "<legend>Search Result</legend>";

			echo "<table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
			echo " <th>Card Number</th>";
			echo "<th>Owner Name</th>";
			echo "<th>Action</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			foreach ($query->result() as $row) :

				echo "<tr >";
				echo "<td>" . $row -> rc_num . "</td>";
				echo "<td>" . $row -> rc_owner . "</td>";
				echo '<td><a class="btn btn-mini btn-primary" href="' . site_url() . '/customer/update/' . $row -> card_id . '"><i class="icon-edit icon-white"></i> Update</a>';
				echo '<a class="btn btn-mini btn-danger" href="' . site_url() . '/customer/delete/' . $row -> card_id . '" onclick="return confirm(\'You are about to delete this customer,\\n\\n   Do you want to continue ?\')"><i class="icon-trash icon-white"></i> Delete</a>';
				echo '</td>';
				echo "</tr>";

			endforeach;
			echo "</tbody>";
			echo "</table>";
		} else {
			echo '<div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4 class="alert-heading">Card error !</h4>
            <p>Sorry, This card is not registered. Do you want to register now?</p>
            <p>
              <a class="btn btn-danger" href="' . site_url("customer/add?rc_num=$key") . '">Register Now</a> <a class="btn" href="' . site_url("customer/search/") . '">No Thanks</a>
            </p>
          </div>';
		}
	}

	function delete($id) {
		$this -> db -> delete('customer', array('card_id' => $id));
		$this -> ci_alerts -> set('success', 'Customer deleted successfully');
		redirect('customer/search');
	}

}
