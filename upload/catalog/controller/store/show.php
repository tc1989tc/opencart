<?php
class ControllerStoreShow extends Controller {
    public function index() {
		$storeId = 0;
		$this->load->model('store/show');
		$this->load->model('catalog/product');
		if (isset($this->request->get['store_id'])) {			
			$storeId = $this->request->get['store_id'];
		}
		$storeInfo = $this->model_store_show->getStoreInfo($storeId);
		$data['store_name'] = $storeInfo['store_name'];
		$data['store_phone'] = $storeInfo['store_phone'];
		$data['store_address'] = $storeInfo['store_address'];
		$data['store_email'] = $storeInfo['store_email'];
		$data['store_introduce'] = $storeInfo['store_desc'];
		
		$data['customerProduces'] = array();
		$data['customerhasProduces'] = false;
		$productIds = $this->model_catalog_product->getAllProductIdsbyCustomStore($storeId);
		if ($productIds) {
			foreach ($productIds as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}
					$data['customerProduces'][] = array(
																				'image' => $image,
																				'name' => $product_info['name'],
																				'product_link' => $this->url->link('product/product', 'product_id=' . $product_info['product_id']);
					$data['customerhasProduces'] = true;
				}
			}
		}
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');		
		$data['content_top'] = $this->load->controller('common/content_top');		
		$data['content_bottom'] = $this->load->controller('common/content_bottom');		
    $data['footer'] = $this->load->controller('common/footer');		
    $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/store/show.tpl')) {			
		$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/store/show.tpl', $data));		
	} else {			
		$this->response->setOutput($this->load->view('default/template/store/show.tpl', $data));	
	}
    }
}
