<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Customer_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function carddetails($rc_num) {
		$this -> db -> where('rc_num', $rc_num);
		return $this -> db -> get('customer');
	}

	function add_new_cus($rc_num, $rc_owner, $card_type, $address) {
		$data = array('rc_num' => $rc_num, 'rc_owner' => $rc_owner, 'card_type' => $card_type, 'address' => $address);
		$this -> db -> insert('customer', $data);
	}

	function update_cus($card_id, $rc_num, $rc_owner, $card_type, $address) {
		$data = array('rc_num' => $rc_num, 'rc_owner' => $rc_owner, 'card_type' => $card_type, 'address' => $address, );
		$this -> db -> where('card_id', $card_id);
		$this -> db -> update('customer', $data);
	}

	function auto_pdt($keyword) {
		$this -> db -> select('rc_num');
		$this -> db -> like('rc_num', $keyword, 'after');
		return $this -> db -> get('customer');

	}

	function auto_rc($keyword) {
		$this -> db -> select('rc_num');
		$this -> db -> like('rc_num', $keyword, 'after');
		return $this -> db -> get('customer');

	}

	function search_pdt($q) {

		$this -> db -> like('pdt_name', $q, 'both');
		return $this -> db -> get('product');

	}

	function cus_single($id) {

		$this -> db -> where('card_id', $id);
		return $this -> db -> get('customer');

	}

	function cus_single_num($id) {

		$this -> db -> where('rc_num', $id);
		return $this -> db -> get('customer');

	}

}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */
