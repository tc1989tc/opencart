<?php
class ControllerStoreShow extends Controller {
    public function index() {
		$storeId = 0;
		$this->load->model('store/show');
		if (isset($this->request->get['store_id'])) {			
			$storeId = $this->request->get['store_id'];
		}
		$storeInfo = $this->model_store_show->getStoreInfo($storeId);
		$data['store_name'] = $storeInfo['store_name'];
		$data['store_phone'] = $storeInfo['store_phone'];
		$data['store_address'] = $storeInfo['store_address'];
		$data['store_email'] = $storeInfo['store_email'];
		$data['store_introduce'] = $storeInfo['store_desc'];
		
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
