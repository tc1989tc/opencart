<?php
class ControllerAccountPersonstore extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/personstore', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		
		$customer_store_id = $this->customer->getCustomStoreId();
		
		$this->load->language('account/personstore');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$this->load->model('store/show');
		
		
		$data['hasStore'] = 0;
		$data['applyStoreLink'] = $this->url->link('account/personstore/applystore', '', 'SSL');
		if ($customer_store_id) {
			$data['hasStore'] = 1;
			
			$storeInfo = $this->model_store_show->getStoreInfo($customer_store_id);
			$data['store_name'] = $storeInfo['store_name'];
			$data['store_phone'] = $storeInfo['store_phone'];
			$data['store_address'] = $storeInfo['store_address'];
			$data['store_email'] = $storeInfo['store_email'];
			$data['store_introduce'] = $storeInfo['store_desc'];
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/wishlist')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_stock'] = $this->language->get('column_stock');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['addProductLink'] = $this->url->link('account/personstore/addproduct');
		$data['button_addProduct'] = $this->language->get('button_addProduct');
		
		$data['products'] = array();

		$products = $this->model_catalog_product->getAllProductIdsbyCustomStore($customer_store_id);
		if ($products) { 
			foreach ($products as $product_info) {
				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_wishlist_width'), $this->config->get('config_image_wishlist_height'));
					} else {
						$image = false;
					}

					if ($product_info['quantity'] <= 0) {
						$stock = $product_info['stock_status'];
					} elseif ($this->config->get('config_stock_display')) {
						$stock = $product_info['quantity'];
					} else {
						$stock = $this->language->get('text_instock');
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}

					$data['products'][] = array(
						'product_id' => $product_info['product_id'],
						'thumb'      => $image,
						'name'       => $product_info['name'],
						'model'      => $product_info['model'],
						'stock'      => $stock,
						'price'      => $price,
						'special'    => $special,
						'href'       => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
						'remove'     => $this->url->link('account/wishlist', 'remove=' . $product_info['product_id'])
					);
				}
			}
		}
		
		$data['continue'] = $this->url->link('account/account', '', 'SSL');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/personstore.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/personstore.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/personstore.tpl', $data));
		}
	}

	public function applystore() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/personstore', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		
		$this->load->language('account/personstore');
		$this->load->model('store/show');
		$customer_id = $this->customer->getId();
		$customer_store_id = $this->customer->getCustomStoreId();
		
		# Add store or update information
		if (isset($this->request->post['storeName']) && ($this->request->post['storeName']) && isset($this->request->post['storeDesc']) && ($this->request->post['storeDesc']) && isset($this->request->post['storeAddress']) && ($this->request->post['storeAddress']) && isset($this->request->post['storeEmail']) && ($this->request->post['storeEmail']) && isset($this->request->post['storeTelephone']) && ($this->request->post['storeTelephone'])) {			
			$storeInfo = array(
							'storeName' => $this->request->post['storeName'],
							'storeDesc' => $this->request->post['storeDesc'],
							'storeAddress' => $this->request->post['storeAddress'],
							'storeEmail' => $this->request->post['storeEmail'],
							'storeTelephone' => $this->request->post['storeTelephone']);
			if (!$customer_store_id) {
				$customer_store_id = $this->model_store_show->addStoreInfo($storeInfo, $customer_id);
			} else {
				$this->model_store_show->updateStoreInfo($storeInfo);
			}
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/wishlist')
		);

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['addStoreLink'] = $this->url->link('account/personstore/applystore', '', 'SSL');
		$data['store_name'] = $this->language->get('store_name');
		$data['store_name_place'] = $this->language->get('store_name_place');
		$data['store_description'] = $this->language->get('store_description');
		$data['store_description_place'] = $this->language->get('store_description_place');
		$data['store_address'] = $this->language->get('store_address');
		$data['store_address_place'] = $this->language->get('store_address_place');
		$data['store_email'] = $this->language->get('store_email');
		$data['store_email_place'] = $this->language->get('store_email_place');
		$data['store_telephone'] = $this->language->get('store_telephone');
		$data['store_telephone_place'] = $this->language->get('store_telephone_place');

		
		if ($customer_store_id) {
			# show exist store information
			$storeInfo = $this->model_store_show->getStoreInfo($customer_store_id);
			$data['store_name'] = $storeInfo['store_name'];
			$data['store_telephone'] = $storeInfo['store_phone'];
			$data['store_address'] = $storeInfo['store_address'];
			$data['store_email'] = $storeInfo['store_email'];
			$data['store_description'] = $storeInfo['store_desc'];
		}

		$data['button_continue'] = $this->language->get('button_continue');
		$data['continue'] = $this->url->link('account/account', '', 'SSL');
		$data['button_submit'] = $this->language->get('button_submit');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/applystore.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/applystore.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/applystore.tpl', $data));
		}
	}
}




