z<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('product_model');
		$this -> load -> model('quota_model');
		$this -> load -> model('stock_model');
		$this -> load -> model('sales_model');
		//$this->output->enable_profiler(TRUE);
		session_start();
		parent::__construct();
		if (!isset($_SESSION['username'])) {
			redirect('admin');
		}
	}

	function add() {

		//set validation rules
		$bpl_quota = $this -> input -> post('bpl_quota');
		$apl_quota = $this -> input -> post('apl_quota');
		$is_quota_limited = $this -> input -> post('is_quota_limited');
		$this -> form_validation -> set_rules('pdt_id', 'Product ID', 'required|xss_clean|is_unique[product.pdt_id]');
		$this -> form_validation -> set_rules('pdt_name', 'Product name', 'required|xss_clean|is_unique[product.pdt_name]');
		$this -> form_validation -> set_rules('pdt_description', 'Product description', 'required');
		$this -> form_validation -> set_rules('pdt_name_ml', 'Product name in Malayalam', 'required');
		$this -> form_validation -> set_rules('pdt_price', 'Product selling price', 'required|numeric');
		$this -> form_validation -> set_rules('ls_unit', 'Lowest Unit', '');
		$this -> form_validation -> set_rules('hs_unit', 'Highest Unit', 'required');
		$this -> form_validation -> set_rules('pdt_price_unit', 'Product selling price Unit', 'required');
		$this -> form_validation -> set_rules('quality', 'Quality', '');
		$this -> form_validation -> set_rules('is_quota_limited', 'is_quota_limited', 'trim');
		$this -> form_validation -> set_rules('pdt_price_purchase', 'Purchase price', 'required|numeric');
		$this -> form_validation -> set_rules('pdt_price_unit_purchase', 'Purchase price Unit', 'required');
		$this -> form_validation -> set_rules('apl_quota', 'quota', 'trim');
		$this -> form_validation -> set_rules('bpl_quota', 'quota', 'trm');
		if ($is_quota_limited == 'Y') {
			if($bpl_quota==''){
				$this -> form_validation -> set_rules('apl_quota', 'quota', 'trim|required');
			}elseif($apl_quota==''){
				$this -> form_validation -> set_rules('bpl_quota', 'quota', 'trm|required');
			}
			
			
		} else {
			$this -> form_validation -> set_rules('apl_quota', 'apl_quota', '');
			$this -> form_validation -> set_rules('bpl_quota', 'bpl_quota', '');
		}
		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid
			$this -> load -> view('product/add_view');
		} else {
			//if valid
			$pdt_id = $this -> input -> post('pdt_id');
			$pdt_name = $this -> input -> post('pdt_name');
			$pdt_name_ml = $this -> input -> post('pdt_name_ml');
			$pdt_description = $this -> input -> post('pdt_description');
			$pdt_price = $this -> input -> post('pdt_price');
			$quality = $this -> input -> post('quality');
			$pdt_price_unit = $this -> input -> post('pdt_price_unit');
			$hs_unit = $this -> input -> post('hs_unit');
			$ls_unit = $this -> input -> post('ls_unit');
			$is_quota_limited = $this -> input -> post('is_quota_limited');
			$this -> product_model -> add_new_pdt();
			$this -> stock_model -> add_new_stock_from_pdt();
			$this -> stock_model -> add_new_pdt();
			if ($is_quota_limited == 'Y') {
			
				$this -> quota_model -> add_new_quota();
			}
			$this -> ci_alerts -> set('success', 'Product added successfully');
			redirect('product/add');

		}
	}

	function update($pdt_id) {
		$pdt_id = rawurldecode($pdt_id);
		$data['query'] = $this -> product_model -> pdt_single($pdt_id);
		$this -> load -> view('product/update_view', $data);

	}

	function update_is_quota_limited() {
		$pdt_id = $this -> input -> post('key');
		$this -> product_model -> update_is_quota_limited($pdt_id);
        $this -> quota_model -> del_quota_from_pdt($pdt_id);
	}

	function update_is_quota_limited_y() {
		$key = $this -> input -> post('key');
		$pdt_id = rawurldecode($key);
		$this -> product_model -> update_is_quota_limited_y($pdt_id);

	}

	function update_from_quota($pdt_id) {
		$pdt_id = rawurldecode($pdt_id);
		$data['query'] = $this -> product_model -> pdt_single($pdt_id);
		$this -> load -> view('product/update_from_quota_view', $data);

	}

	function update_confirm() {

		//set validation rules
		$pdt_id = $this -> input -> post('pdt_id');
		$this -> form_validation -> set_rules('pdt_id', 'Product ID', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_idx', 'Product ID', 'required');
		$this -> form_validation -> set_rules('pdt_name', 'Product name', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_description', 'Product description', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_name_ml', 'Product name in Malayalam', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_price', 'Product price', 'required|numeric|xss_clean');
		$this -> form_validation -> set_rules('ls_unit', 'Lowest Unit', 'xss_clean');
		$this -> form_validation -> set_rules('hs_unit', 'Highest Unit', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_price_unit', 'Product price Unit', 'required|xss_clean');
		$this -> form_validation -> set_rules('quality', 'Quality', 'xss_clean');
		$this -> form_validation -> set_rules('pdt_price_purchase', 'Purchase price', 'required|numeric');
		$this -> form_validation -> set_rules('pdt_price_unit_purchase', 'Purchase price Unit', 'required');
		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid

			$data['query'] = $this -> product_model -> pdt_single($pdt_id);
			$this -> load -> view('product/update_error_view', $data);
		} else {
			//if valid

			$pdt_id = $this -> input -> post('pdt_id');
			$pdt_name = $this -> input -> post('pdt_name');
			$pdt_name_ml = $this -> input -> post('pdt_name_ml');
			$pdt_description = $this -> input -> post('pdt_description');
			$pdt_price = $this -> input -> post('pdt_price');
			$quality = $this -> input -> post('quality');
			$pdt_price_unit = $this -> input -> post('pdt_price_unit');
			$hs_unit = $this -> input -> post('hs_unit');
			$ls_unit = $this -> input -> post('ls_unit');
			//$is_quota_limited = $this -> input -> post('is_quota_limited');
			//if ($is_quota_limited != 'Y') {
			//	$this -> quota_model -> del_quota();
			//} else {
			//	$this -> quota_model -> add_new_quota();
			//}
			$this -> product_model -> update_pdt();
			$this -> stock_model -> update_pdt();
			$this -> ci_alerts -> set('success', 'Product updated successfully');
			redirect('product/update/' . $pdt_id);

		}
	}

	function update_confirm_from_quota() {

		//set validation rules
		$pdt_id = $this -> input -> post('pdt_id');
		$this -> form_validation -> set_rules('pdt_id', 'Product ID', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_idx', 'Product ID', 'required');
		$this -> form_validation -> set_rules('pdt_name', 'Product name', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_description', 'Product description', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_name_ml', 'Product name in Malayalam', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_price', 'Product price', 'required|numeric|xss_clean');
		$this -> form_validation -> set_rules('ls_unit', 'Lowest Unit', 'required|xss_clean');
		$this -> form_validation -> set_rules('hs_unit', 'Highest Unit', 'required|xss_clean');
		$this -> form_validation -> set_rules('pdt_price_unit', 'Product price Unit', 'required|xss_clean');
		$this -> form_validation -> set_rules('quality', 'Quality', 'required|xss_clean');
		//$this->form_validation->set_rules('pdt_description', 'Product Description', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			//if not valid

			$data['query'] = $this -> product_model -> pdt_single($pdt_id);
			$this -> load -> view('product/update_view', $data);
		} else {
			//if valid

			$pdt_id = $this -> input -> post('pdt_id');
			$pdt_name = $this -> input -> post('pdt_name');
			$pdt_name_ml = $this -> input -> post('pdt_name_ml');
			$pdt_description = $this -> input -> post('pdt_description');
			$pdt_price = $this -> input -> post('pdt_price');
			$quality = $this -> input -> post('quality');
			$pdt_price_unit = $this -> input -> post('pdt_price_unit');
			$hs_unit = $this -> input -> post('hs_unit');
			$ls_unit = $this -> input -> post('ls_unit');
			$is_quota_limited = $this -> input -> post('is_quota_limited');
			if ($is_quota_limited != 'Y') {
				$this -> quota_model -> del_quota();
			} else {
				if($bpl_quota==''){
				$this -> form_validation -> set_rules('apl_quota', 'APL quota', 'trim|required');
			    }elseif($apl_quota==''){
				$this -> form_validation -> set_rules('bpl_quota', 'BPL quota', 'trm|required');
			   }
			
				$this -> quota_model -> add_new_quota();
			}
			$this -> product_model -> update_pdt();
			$this -> ci_alerts -> set('success', 'Product updated successfully');
			redirect('quota/addgetid/' . $pdt_id);

		}
	}

	function search() {
		$this -> load -> view('product/search_view');
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

	function auto_pdt_per_unit_price() {
		$keyword = $this -> input -> post('term');
		$query = $this -> product_model -> auto_pdt_id($keyword);
		$data['response'] = 'true';
		//Set response
		//$data['message'] = array(); //Create array
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('pdt_price' => $row -> pdt_price, 'pdt_des' => $row -> pdt_description, 'pdt_unit' => $row -> pdt_price_unit);
			echo json_encode($data);
		} else {
			$data = array('pdt_price' => 'undifined', 'undifined');
			echo json_encode($data);
		}
	}

	function is_quota_limited() {
		$keyword = $this -> input -> post('term');
		$query = $this -> product_model -> is_quota_limited($keyword);
		$data['response'] = 'true';
		//Set response
		//$data['message'] = array(); //Create array
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('is_quota_limited' => $row -> is_quota_limited);
			echo json_encode($data);
		}
	}

	function pdt_details() {
		$keyword = $this -> input -> post('term');
		$query = $this -> product_model -> auto_pdt_id_de($keyword);
		$data['response'] = 'true';
		//Set response
		//$data['message'] = array(); //Create array
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			$data = array('pdt_price' => $row -> pdt_price, 'pdt_des' => $row -> pdt_description, 'pdt_unit' => $row -> pdt_price_unit, 'pdt_highest_unit' => $row -> hs_unit, 'pdt_quality' => $row -> quality, 'pdt_id' => $row -> pdt_id,'pdt_name' => $row -> pdt_name,);
			echo json_encode($data);
		} else {
			$data = array('new_product' => 'Y');
			echo json_encode($data);
		}
	}

	// function desauto()
	// {
	// $keyword = $this->input->post('term');
	// $data['response'] = 'false';
	// $query=$this->product_model->auto_pdt_des($keyword);
	// if($query->num_rows() > 0){
	// $data['response'] = 'true'; //Set response
	// $data['message'] = array(); //Create array
	// foreach($query->result() as $row){
	// $data['message'][] = array('label'=> $row->pdt_description, 'value'=> $row->pdt_description); //Add a row to array
	// }
	// }
	// echo json_encode($data);
	// }

	// function desauto2()
	// {
	// $keyword = $this->input->post('term');
	// $query=$this->product_model->auto_pdt_des($keyword);
	// $data['response'] = 'true'; //Set response
	// //$data['message'] = array(); //Create array
	// $row = $query->row();
	// $data= array('pdt_price'=>$row->pdt_price,'pdt_id'=>$row->pdt_id);
	// echo json_encode($data);
	// }
	function pdt_result() {
		$key = $this -> input -> get('key');
		$query = $this -> product_model -> search_pdt($key);
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
$price_per_unit=$row -> pdt_price_unit;
				if($price_per_unit=='Pieces')
				{
					$p_u='Piece';	
				}else{
					$p_u=$row -> pdt_price_unit;
				}
				echo "<tr >";
				echo "<td>" . $row -> pdt_id . "</td>";
				echo "<td>" . $row -> pdt_name . "</td>";
				echo "<td>" . $row -> pdt_date . "</td>";
				echo "<td>" . $row -> quality . "</td>";
				echo "<td>" . $row -> pdt_price . "/" . $p_u . "</td>";
				echo '<td><a class="btn btn-mini btn-primary" href="' . site_url() . '/product/update/' . $row -> pdt_id . '"><i class="icon-edit icon-white"></i> Update</a>';
				echo '<a class="btn btn-mini btn-danger" href="' . site_url() . '/product/delete/' . $row -> pdt_id . '" onclick="return confirm(\'You are about to delete this Product,\\n\\n   Do you want to continue ?\')"><i class="icon-trash icon-white"></i> Delete</a>';
				echo '</td>';
				echo "</tr>";

			endforeach;

			echo "</tbody>";
			echo "</table>";
		} else {
			echo "<div class='alert alert-error fade in'>Not found ! Please check if the product name you entered is correct !</div>";
		}
	}

	function pdt_result2() {
		$key = $this -> input -> get('key');
		$query = $this -> product_model -> search_pdtid($key);
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
$price_per_unit=$row -> pdt_price_unit;
				if($price_per_unit=='Pieces')
				{
					$p_u='Piece';	
				}else{
					$p_u=$row -> pdt_price_unit;
				}
				echo "<tr >";
				echo "<td>" . $row -> pdt_id . "</td>";
				echo "<td>" . $row -> pdt_name . "</td>";
				echo "<td>" . $row -> pdt_date . "</td>";
				echo "<td>" . $row -> quality . "</td>";
				echo "<td>" . $row -> pdt_price . "/" . $p_u . "</td>";
				echo '<td><a class="btn btn-mini btn-primary" href="' . site_url() . '/product/update/' . $row -> pdt_id . '"><i class="icon-edit icon-white"></i> Update</a>';
				echo '<a class="btn btn-mini btn-danger" href="' . site_url() . '/product/delete/' . $row -> pdt_id . '" onclick="return confirm(\'You are about to delete this Product,\\n\\n   Do you want to continue ?\')"><i class="icon-trash icon-white"></i> Delete</a>';
				echo '</td>';
				echo "</tr>";

			endforeach;

			echo "</tbody>";
			echo "</table>";
		} else {
			echo "<div class='alert alert-error fade in'>Not found ! Please check if the product name you entered is correct !</div>";
		}
	}

	function delete($id) {
		$id = rawurldecode($id);
		$this -> db -> delete('product', array('pdt_id' => $id));
		$this -> db -> delete('purchase_product', array('pdt_id' => $id));
		$this->stock_model->del_stock_from_pdt($id);
		$this->quota_model->del_quota_from_pdt($id);
		$this -> ci_alerts -> set('success', 'Product deleted successfully');
		redirect('product/search');
	}

}
