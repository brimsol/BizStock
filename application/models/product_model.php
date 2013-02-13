<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product_model extends MY_Model {
	function __construct() {
		parent::__construct('default');
	}

	function addNewProduct($product_data) {
		$is_quota_limited = $this -> input -> post('is_quota_limited');

		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}

		if ($mode == 'normal') {
			if ($is_quota_limited == '') {
				$normal_quota_flag = 'N';
				$product_data['is_quota_limited'] = $normal_quota_flag;
			} else {
				$normal_quota_flag = 'Y';
				$product_data['is_quota_limited'] = $normal_quota_flag;
			}
		} elseif ($mode == 'festival') {
			if ($is_quota_limited == '') {
				$normal_quota_flag = 'N';
				$product_data['is_quota_limited'] = $normal_quota_flag;
			} else {
				$normal_quota_flag = 'N';
				$festival_quota_flag = 'Y';

				$product_data['is_quota_limited'] = $normal_quota_flag;
				$product_data['is_festival_quota_limited'] = $festival_quota_flag;
			}
		}
		unset($product_data['pdt_purchase_price']);
		unset($product_data['pdt_purchase_price_unit']);
		unset($product_data['apl_quota']);
		unset($product_data['bpl_quota']);
		
		$this -> db -> insert('product', $product_data);
	}

	function addProductPurchaseDetails($product_data) {
		$is_quota_limited = $this -> input -> post('is_quota_limited');

		if ($is_quota_limited == '') {
			$normal_quota_flag = 'N';
			$product_data['is_quota_limited'] = $normal_quota_flag;	
		} else {
			$normal_quota_flag = 'Y';
			$product_data['is_quota_limited'] = $normal_quota_flag;
		}
		unset($product_data['pdt_sell_price']);
		unset($product_data['pdt_sell_price_unit']);
		unset($product_data['apl_quota']);
		unset($product_data['bpl_quota']);
		
		$this -> db -> insert('purchase_product', $product_data);
	}

	function addNewPdtViaStockPage() {
		$pdt_id = $this -> input -> post('pdt_id');
		$pdt_name = $this -> input -> post('pdt_name');
		$pdt_name_ml = $this -> input -> post('pdt_name_ml');
		$pdt_description = $this -> input -> post('pdt_des');
		$quality = $this -> input -> post('pdt_quality');
		$pdt_sell_price = $this -> input -> post('pdt_sell_price');
		$pdt_sell_price_unit = $this -> input -> post('pdt_sell_price_unit');
		$pdt_h_unit = $this -> input -> post('pdt_h_unit');
		$ls_unit = 'Gram';
		$is_quota_limited = $this -> input -> post('is_quota_limited');
		if ($is_quota_limited == '') {
			$data = array('pdt_id' => $pdt_id, 'pdt_name' => $pdt_name, 'pdt_name_ml' => $pdt_name_ml, 
			              'pdt_description' => $pdt_description, 'quality' => $quality,   
			              'pdt_sell_price' => $pdt_sell_price, 'pdt_sell_price_unit' => $pdt_sell_price_unit, 
			              'hs_unit' => $pdt_h_unit, 'ls_unit' => $ls_unit, 'is_quota_limited' => 'N');
		} else {
			$data = array('pdt_id' => $pdt_id, 'pdt_name' => $pdt_name, 'pdt_name_ml' => $pdt_name_ml, 
			              'pdt_description' => $pdt_description, 'quality' => $quality, 
			              'pdt_sell_price' => $pdt_sell_price, 'pdt_sell_price_unit' => $pdt_sell_price_unit, 
			              'hs_unit' => $hs_unit, 'ls_unit' => $ls_unit, 'is_quota_limited' => 'Y');
		}
		$this -> db -> insert('product', $data);
	}

	function addPdtPurchaseDetViaStockPage() {
		$pdt_id = $this -> input -> post('pdt_id');
		$pdt_name = $this -> input -> post('pdt_name');
		$pdt_name_ml = $this -> input -> post('pdt_name_ml');
		$pdt_description = $this -> input -> post('pdt_des');
		$quality = $this -> input -> post('pdt_quality');
		$pdt_purchase_price = $this -> input -> post('pdt_purchase_price');
		$pdt_purchase_price_unit = $this -> input -> post('pdt_purchase_price_unit');
		$pdt_h_unit = $this -> input -> post('pdt_h_unit');
		$is_quota_limited = $this -> input -> post('is_quota_limited');
		if ($is_quota_limited == '') {
			$data = array('pdt_id' => $pdt_id, 'pdt_name' => $pdt_name, 'pdt_name_ml' => $pdt_name_ml, 
			              'pdt_description' => $pdt_description, 'quality' => $quality, 
			              'pdt_purchase_price' => $pdt_purchase_price, 'pdt_purchase_price_unit' => $pdt_purchase_price_unit, 
			              'hs_unit' => $pdt_h_unit, 'ls_unit' => $pdt_h_unit, 'is_quota_limited' => 'N');
		} else {
			$data = array('pdt_id' => $pdt_id, 'pdt_name' => $pdt_name, 'pdt_name_ml' => $pdt_name_ml, 
			              'pdt_description' => $pdt_description, 'quality' => $quality, 
			              'pdt_purchase_price' => $pdt_purchase_price, 'pdt_price_unit' => $pdt_purchase_price_unit, 
			              'hs_unit' => $hs_unit, 'ls_unit' => $ls_unit, 'is_quota_limited' => 'Y');
		}
		$this -> db -> insert('purchase_product', $data);
	}

	function autoCompleteProductID($keyword) {
		$this -> db -> select('pdt_id, pdt_sell_price, pdt_sell_price_unit, pdt_description');
		$this -> db -> like('pdt_id', $keyword, 'after');
		return $this -> db -> get('product');
	}

	function fetchProductDetailsWithID($pdt_id) {
		$this -> db -> like('pdt_id', $pdt_id, 'both');
		return $this -> db -> get('product');
	}

	function fetchProductDetailsWithName($pdt_name) {
		 $this->db->like('pdt_name', $pdt_name, 'both');
         return $this->db->get('product');
    }

	function auto_pdt($keyword){
         $this -> db -> select('pdt_name');
		 $this -> db -> like('pdt_name', $keyword, 'after');
         return $this -> db -> get('product');
    }
	
	function getProductDetails($pdt_id) {
		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$select_query = "SELECT p.pdt_id, p.pdt_name, p.pdt_name_ml, p.pdt_description, p.quality, p.pdt_sell_price, 
									p.pdt_sell_price_unit, p.hs_unit, p.ls_unit, p.pdt_date, p.is_quota_limited, p.pdt_idx, 
			                        pp.pdt_purchase_price AS PURCHASEPRICE, pp.pdt_purchase_price_unit AS PURCHASEPRICEUNIT
                             FROM product p JOIN purchase_product pp 
                             ON p.pdt_id = pp.pdt_id 
                             WHERE p.pdt_id='$pdt_id'";
			return $this -> db -> query($select_query);
		} elseif ($mode == 'festival') {
			$select_query = "SELECT p.pdt_id, p.pdt_name, p.pdt_name_ml, p.pdt_description, p.quality, p.pdt_sell_price, 
									p.pdt_sell_price_unit, p.hs_unit, p.ls_unit, p.pdt_date, 
									p.is_festival_quota_limited AS is_quota_limited, p.pdt_idx,
									pp.pdt_price AS PURCHASEPRICE, pp.pdt_price_unit AS PURCHASEPRICEUNIT
      						 FROM product p JOIN purchase_product pp 
      						 ON p.pdt_id = pp.pdt_id WHERE p.pdt_id='$pdt_id'";
			return $this -> db -> query($select_query);
		}
	}

	function updateProduct($product_data) {
		unset($product_data['pdt_purchase_price']);
		unset($product_data['pdt_purchase_price_unit']);
		
		$pdt_id = $this -> input -> post('pdt_id');
		
		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> update('product', $product_data);
	}

	function updateProductPurchase($product_data) {
		unset($product_data['pdt_sell_price']);
		unset($product_data['pdt_sell_price_unit']);
		
		$pdt_id = $this -> input -> post('pdt_id');

		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> update('purchase_product', $product_data);
	}

	function autoCompleteProductName($keyword) {
		$this -> db -> select('pdt_name');
		$this -> db -> like('pdt_name', $keyword, 'after');
		return $this -> db -> get('product');
	}

	function auto_pdt_des($keyword) {
		$this -> db -> select('pdt_description,pdt_price');
		$this -> db -> like('pdt_description', $keyword, 'after');
		return $this -> db -> get('product');

	}

	function is_quota_limited($keyword) {

		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$this -> db -> select('is_quota_limited');
			$this -> db -> where('pdt_id', $keyword);
			return $this -> db -> get('product');
		} elseif ($mode == 'festival') {
			$this -> db -> select('is_festival_quota_limited AS is_quota_limited');
			$this -> db -> where('pdt_id', $keyword);
			return $this -> db -> get('product');
		}
	}

	function auto_pdt_id_de($keyword) {

		$this -> db -> where('pdt_id', $keyword);
		return $this -> db -> get('product');

	}

	function search_pdt($q) {

		$this -> db -> like('pdt_name', $q, 'both');
		return $this -> db -> get('product');

	}


	function pdt_single_id($id) {

		$this -> db -> where('pdt_id', $id);
		return $this -> db -> get('product');

	}

	function pdt_single_name($id) {

		$this -> db -> where('pdt_name', $id);
		return $this -> db -> get('product');

	}

	function add_new_quota() {
		$pdt_idx = $this -> input -> post('pdt_idx');
		$pdt_id = $this -> input -> post('pdt_id');
		$card_type = $this -> input -> post('card_type');
		$allowed_quota = $this -> input -> post('allowed_quota');
		if ($card_type == 'APL') {
			if ($allowed_quota != '') {
				$data = array('apl_quota' => $allowed_quota);
			} else {
				$data = array('apl_quota' => NULL);

			}

		} else {

			if ($allowed_quota != '') {
				$data = array('bpl_quota' => $allowed_quota);
			} else {
				$data = array('bpl_quota' => NULL);

			}
		}
		$this -> db -> where('pdt_idx', $pdt_idx);
		$this -> db -> update('product', $data);
	}

	function pdt_clear_stock($pdt_id) {

		$data = array('available_stock' => NULL, 'stock_unit' => NULL);
		$this -> db -> where('pdt_id', $pdt_id);
		$this -> db -> update('product', $data);
	}

	function update_is_quota_limited($pdt_id) {
		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$data = array('is_quota_limited' => 'N');
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> update('product', $data);
			$this -> db -> delete('normal_quota', array('q_id' => $id));
		} elseif ($mode == 'festival') {
			$data = array('is_festival_quota_limited' => 'N');
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> update('product', $data);
		}

	}

	function update_is_quota_limited_y() {
		$key = $this -> input -> post('key');
		$pdt_id = rawurldecode($key);
		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$data = array('is_quota_limited' => 'Y');
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> update('product', $data);
		} elseif ($mode == 'festival') {
			$data = array('is_festival_quota_limited' => 'Y');
			$this -> db -> where('pdt_id', $pdt_id);
			$this -> db -> update('product', $data);
		}

	}

}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */
