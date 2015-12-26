<?php
class ModelStoreShow extends Model {
	public function getStoreInfo($storeId) {
		$storeInfo = $this->db->query(" SELECT * FROM ".DB_PREFIX."customer_store WHERE customer_store_id= '".(int)$storeId . "'");

		return $storeInfo->row;
	}
	
	public function addStoreInfo($storeIn, $customerId) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_store SET store_name = '" . $this->db->escape($storeIn['storeName']) . "', store_desc = '" . $this->db->escape($storeIn['storeDesc']) . "', store_phone = '" . $this->db->escape($storeIn['storeTelephone']) . "', store_email = '" . $this->db->escape($storeIn['storeEmail']) . "', store_address = '" . $this->db->escape($storeIn['storeAddress']) . "'");
		$customer_store_id = $this->db->getLastId();
		# Update customer info
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET customer_store_id = '" . (int)$customer_store_id . "' WHERE customer_id = '" . (int)$customerId ."'");
		return $customer_store_id;
	}
	
	public function updateStoreInfo($storeIn) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer_store SET store_name = '" . $this->db->escape($storeIn['storeName']) . "', store_desc = '" . $this->db->escape($storeIn['storeDesc']) . \
			"', store_phone = '" . $this->db->escape($storeIn['storeTelephone']) . "', store_email = '" . $this->db->escape($storeIn['storeEmail']) . "', store_address = '" . $this->db->escape($storeIn['storeAddress']) . "'");
			
	}

}