<?php
class ModelStoreShow extends Model {
	public function getStoreInfo($storeId) {
		$storeInfo = $this->db->query(" SELECT * FROM ".DB_PREFIX."customer_store WHERE customer_store_id=".(int)$storeId);

		return $storeInfo->row;
	}

}