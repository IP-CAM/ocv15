<?php
class ControllerSaleOrderVolusion extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('sale/order_volusion');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order_volusion');

		$this->getList();
	}

	public function insert() {
		$this->language->load('sale/order_volusion');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order_volusion');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_order_volusion->addOrder($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_order_status_id'])) {
				$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
			}

			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('sale/order_volusion');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order_volusion');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_sale_order_volusion->saveOrder($this->request->get['order_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_order_status_id'])) {
				$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
			}

			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('sale/order_volusion/update', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('sale/order_volusion');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order_volusion');

		if (isset($this->request->post['selected']) && ($this->validateDelete())) {
			foreach ($this->request->post['selected'] as $order_id) {
				$this->model_sale_order_volusion->deleteOrder($order_id);
				$this->openbay->deleteOrder($order_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_order_status_id'])) {
				$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
			}

			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = $this->request->get['filter_order_id'];
		} else {
			$filter_order_id = null;
		}

		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}

		if (isset($this->request->get['filter_order_status_id'])) {
			$filter_order_status_id = $this->request->get['filter_order_status_id'];
		} else {
			$filter_order_status_id = null;
		}

		if (isset($this->request->get['filter_total'])) {
			$filter_total = $this->request->get['filter_total'];
		} else {
			$filter_total = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$filter_date_modified = $this->request->get['filter_date_modified'];
		} else {
			$filter_date_modified = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'o.order_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['invoice'] = $this->url->link('sale/order_volusion/invoice', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['insert'] = $this->url->link('sale/order_volusion/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('sale/order_volusion/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['orders'] = array();

		$data = array(
			'filter_order_id'        => $filter_order_id,
			'filter_customer'	     => $filter_customer,
			'filter_order_status_id' => $filter_order_status_id,
			'filter_total'           => $filter_total,
			'filter_date_added'      => $filter_date_added,
			'filter_date_modified'   => $filter_date_modified,
			'sort'                   => $sort,
			'order'                  => $order,
			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                  => $this->config->get('config_admin_limit')
		);

		$order_total = $this->model_sale_order_volusion->getTotalOrders($data);

		$results = $this->model_sale_order_volusion->getOrders($data);

		foreach ($results as $result) {
			$this->data['orders'][] = array(
				'order_id'      => $result['order_id'],
				'customer'      => $result['customer'],
				'status'        => $result['status'],
				'total'         => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'selected'      => isset($this->request->post['selected']) && in_array($result['order_id'], $this->request->post['selected']),
				'href'			=> $this->url->link('sale/order_volusion/update', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_missing'] = $this->language->get('text_missing');

		$this->data['column_order_id'] = $this->language->get('column_order_id');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_date_modified'] = $this->language->get('column_date_modified');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_invoice'] = $this->language->get('button_invoice');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_order'] = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . '&sort=o.order_id' . $url, 'SSL');
		$this->data['sort_customer'] = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$this->data['sort_total'] = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
		$this->data['sort_date_added'] = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . '&sort=o.date_added' . $url, 'SSL');
		$this->data['sort_date_modified'] = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $order_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_order_id'] = $filter_order_id;
		$this->data['filter_customer'] = $filter_customer;
		$this->data['filter_order_status_id'] = $filter_order_status_id;
		$this->data['filter_total'] = $filter_total;
		$this->data['filter_date_added'] = $filter_date_added;
		$this->data['filter_date_modified'] = $filter_date_modified;

		$this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'sale/order_volusion_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		/*order_volusion_list*/ 
		$this->response->setOutput($this->render());
	}

	public function getForm() {
		$this->load->model('sale/customer');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['act_complete_order'] = $this->url->link('sale/order_volusion/complete_order', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['act_jump'] = $this->url->link('sale/order_volusion/update', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['act_list'] = $this->url->link('sale/order_volusion', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['act_customer'] = $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . $url, 'SSL');

		/* This is to add necessary columns to order, customer tables */
		$this->model_sale_order_volusion->addColumns();
		$this->model_sale_order_volusion->addPaymentTable();
		/* This is to add necessary columns to order, customer tables */

		if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$order_info = $this->model_sale_order_volusion->getOrder($this->request->get['order_id']);
		}

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['order_id'])) {
			$this->data['order_id'] = $this->request->get['order_id'];
		} else {
			$this->data['order_id'] = 0;
		}

		if (isset($this->request->post['store_id'])) {
			$this->data['store_id'] = $this->request->post['store_id'];
		} elseif (!empty($order_info)) {
			$this->data['store_id'] = $order_info['store_id'];
		} else {
			$this->data['store_id'] = '';
		}

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['store_url'] = HTTPS_CATALOG;
		} else {
			$this->data['store_url'] = HTTP_CATALOG;
		}

		if (isset($this->request->post['customer'])) {
			$this->data['customer'] = $this->request->post['customer'];
		} elseif (!empty($order_info)) {
			$this->data['customer'] = $order_info['customer'];
		} else {
			$this->data['customer'] = '';
		}

		if (isset($this->request->post['customer_id'])) {
			$this->data['customer_id'] = $this->request->post['customer_id'];
		} elseif (!empty($order_info)) {
			$this->data['customer_id'] = $order_info['customer_id'];
		} else {
			$this->data['customer_id'] = '';
		}

		if (isset($this->request->post['customer_group_id'])) {
			$this->data['customer_group_id'] = $this->request->post['customer_group_id'];
		} elseif (!empty($order_info)) {
			$this->data['customer_group_id'] = $order_info['customer_group_id'];
		} else {
			$this->data['customer_group_id'] = '';
		}

		$this->load->model('sale/customer_group');

		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($order_info)) {
			$this->data['firstname'] = $order_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($order_info)) {
			$this->data['lastname'] = $order_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (!empty($order_info)) {
			$this->data['email'] = $order_info['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$this->data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($order_info)) {
			$this->data['telephone'] = $order_info['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$this->data['fax'] = $this->request->post['fax'];
		} elseif (!empty($order_info)) {
			$this->data['fax'] = $order_info['fax'];
		} else {
			$this->data['fax'] = '';
		}

		if (isset($this->request->post['affiliate_id'])) {
			$this->data['affiliate_id'] = $this->request->post['affiliate_id'];
		} elseif (!empty($order_info)) {
			$this->data['affiliate_id'] = $order_info['affiliate_id'];
		} else {
			$this->data['affiliate_id'] = '';
		}

		if (isset($this->request->post['affiliate'])) {
			$this->data['affiliate'] = $this->request->post['affiliate'];
		} elseif (!empty($order_info)) {
			$this->data['affiliate'] = ($order_info['affiliate_id'] ? $order_info['affiliate_firstname'] . ' ' . $order_info['affiliate_lastname'] : '');
		} else {
			$this->data['affiliate'] = '';
		}

		if (isset($this->request->post['order_status_id'])) {
			$this->data['order_status_id'] = $this->request->post['order_status_id'];
		} elseif (!empty($order_info)) {
			$this->data['order_status_id'] = $order_info['order_status_id'];
		} else {
			$this->data['order_status_id'] = '';
		}

		$this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['comment'])) {
			$this->data['comment'] = $this->request->post['comment'];
		} elseif (!empty($order_info)) {
			$this->data['comment'] = $order_info['comment'];
		} else {
			$this->data['comment'] = '';
		}

		$this->load->model('sale/customer');

		if (isset($this->request->post['customer_id'])) {
			$this->data['addresses'] = $this->model_sale_customer->getAddresses($this->request->post['customer_id']);
		} elseif (!empty($order_info)) {
			$this->data['addresses'] = $this->model_sale_customer->getAddresses($order_info['customer_id']);
		} else {
			$this->data['addresses'] = array();
		}

		if (isset($this->request->post['payment_firstname'])) {
			$this->data['payment_firstname'] = $this->request->post['payment_firstname'];
		} elseif (!empty($order_info)) {
			$this->data['payment_firstname'] = $order_info['payment_firstname'];
		} else {
			$this->data['payment_firstname'] = '';
		}

		if (isset($this->request->post['payment_lastname'])) {
			$this->data['payment_lastname'] = $this->request->post['payment_lastname'];
		} elseif (!empty($order_info)) {
			$this->data['payment_lastname'] = $order_info['payment_lastname'];
		} else {
			$this->data['payment_lastname'] = '';
		}

		if (isset($this->request->post['payment_company'])) {
			$this->data['payment_company'] = $this->request->post['payment_company'];
		} elseif (!empty($order_info)) {
			$this->data['payment_company'] = $order_info['payment_company'];
		} else {
			$this->data['payment_company'] = '';
		}

		if (isset($this->request->post['payment_company_id'])) {
			$this->data['payment_company_id'] = $this->request->post['payment_company_id'];
		} elseif (!empty($order_info)) {
			$this->data['payment_company_id'] = $order_info['payment_company_id'];
		} else {
			$this->data['payment_company_id'] = '';
		}

		if (isset($this->request->post['payment_tax_id'])) {
			$this->data['payment_tax_id'] = $this->request->post['payment_tax_id'];
		} elseif (!empty($order_info)) {
			$this->data['payment_tax_id'] = $order_info['payment_tax_id'];
		} else {
			$this->data['payment_tax_id'] = '';
		}

		if (isset($this->request->post['payment_address_1'])) {
			$this->data['payment_address_1'] = $this->request->post['payment_address_1'];
		} elseif (!empty($order_info)) {
			$this->data['payment_address_1'] = $order_info['payment_address_1'];
		} else {
			$this->data['payment_address_1'] = '';
		}

		if (isset($this->request->post['payment_address_2'])) {
			$this->data['payment_address_2'] = $this->request->post['payment_address_2'];
		} elseif (!empty($order_info)) {
			$this->data['payment_address_2'] = $order_info['payment_address_2'];
		} else {
			$this->data['payment_address_2'] = '';
		}

		if (isset($this->request->post['payment_city'])) {
			$this->data['payment_city'] = $this->request->post['payment_city'];
		} elseif (!empty($order_info)) {
			$this->data['payment_city'] = $order_info['payment_city'];
		} else {
			$this->data['payment_city'] = '';
		}

		if (isset($this->request->post['payment_postcode'])) {
			$this->data['payment_postcode'] = $this->request->post['payment_postcode'];
		} elseif (!empty($order_info)) {
			$this->data['payment_postcode'] = $order_info['payment_postcode'];
		} else {
			$this->data['payment_postcode'] = '';
		}

		if (isset($this->request->post['payment_country_id'])) {
			$this->data['payment_country_id'] = $this->request->post['payment_country_id'];
		} elseif (!empty($order_info)) {
			$this->data['payment_country_id'] = $order_info['payment_country_id'];
		} else {
			$this->data['payment_country_id'] = '';
		}

		if (isset($this->request->post['payment_country'])) {
			$this->data['payment_country'] = $this->request->post['payment_country'];
		} elseif (!empty($order_info)) {
			$this->data['payment_country'] = $order_info['payment_country'];
		} else {
			$this->data['payment_country'] = '';
		}

		if (isset($this->request->post['payment_zone_id'])) {
			$this->data['payment_zone_id'] = $this->request->post['payment_zone_id'];
		} elseif (!empty($order_info)) {
			$this->data['payment_zone_id'] = $order_info['payment_zone_id'];
		} else {
			$this->data['payment_zone_id'] = '';
		}

		if (isset($this->request->post['payment_zone'])) {
			$this->data['payment_zone'] = $this->request->post['payment_zone'];
		} elseif (!empty($order_info)) {
			$this->data['payment_zone'] = $order_info['payment_zone'];
		} else {
			$this->data['payment_zone'] = '';
		}

		if (isset($this->request->post['payment_method'])) {
			$this->data['payment_method'] = $this->request->post['payment_method'];
		} elseif (!empty($order_info)) {
			$this->data['payment_method'] = $order_info['payment_method'];
		} else {
			$this->data['payment_method'] = '';
		}

		if (isset($this->request->post['payment_code'])) {
			$this->data['payment_code'] = $this->request->post['payment_code'];
		} elseif (!empty($order_info)) {
			$this->data['payment_code'] = $order_info['payment_code'];
		} else {
			$this->data['payment_code'] = '';
		}

		if (isset($this->request->post['shipping_firstname'])) {
			$this->data['shipping_firstname'] = $this->request->post['shipping_firstname'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_firstname'] = $order_info['shipping_firstname'];
		} else {
			$this->data['shipping_firstname'] = '';
		}

		if (isset($this->request->post['shipping_lastname'])) {
			$this->data['shipping_lastname'] = $this->request->post['shipping_lastname'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_lastname'] = $order_info['shipping_lastname'];
		} else {
			$this->data['shipping_lastname'] = '';
		}

		if (isset($this->request->post['shipping_company'])) {
			$this->data['shipping_company'] = $this->request->post['shipping_company'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_company'] = $order_info['shipping_company'];
		} else {
			$this->data['shipping_company'] = '';
		}

		if (isset($this->request->post['shipping_address_1'])) {
			$this->data['shipping_address_1'] = $this->request->post['shipping_address_1'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_address_1'] = $order_info['shipping_address_1'];
		} else {
			$this->data['shipping_address_1'] = '';
		}

		if (isset($this->request->post['shipping_address_2'])) {
			$this->data['shipping_address_2'] = $this->request->post['shipping_address_2'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_address_2'] = $order_info['shipping_address_2'];
		} else {
			$this->data['shipping_address_2'] = '';
		}

		if (isset($this->request->post['shipping_city'])) {
			$this->data['shipping_city'] = $this->request->post['shipping_city'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_city'] = $order_info['shipping_city'];
		} else {
			$this->data['shipping_city'] = '';
		}

		if (isset($this->request->post['shipping_postcode'])) {
			$this->data['shipping_postcode'] = $this->request->post['shipping_postcode'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_postcode'] = $order_info['shipping_postcode'];
		} else {
			$this->data['shipping_postcode'] = '';
		}

		if (isset($this->request->post['shipping_country_id'])) {
			$this->data['shipping_country_id'] = $this->request->post['shipping_country_id'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_country_id'] = $order_info['shipping_country_id'];
		} else {
			$this->data['shipping_country_id'] = '';
		}

		if (isset($this->request->post['shipping_country'])) {
			$this->data['shipping_country'] = $this->request->post['shipping_country'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_country'] = $order_info['shipping_country'];
		} else {
			$this->data['shipping_country'] = '';
		}

		if (isset($this->request->post['shipping_zone_id'])) {
			$this->data['shipping_zone_id'] = $this->request->post['shipping_zone_id'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_zone_id'] = $order_info['shipping_zone_id'];
		} else {
			$this->data['shipping_zone_id'] = '';
		}

		if (isset($this->request->post['shipping_zone'])) {
			$this->data['shipping_zone'] = $this->request->post['shipping_zone'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_zone'] = $order_info['shipping_zone'];
		} else {
			$this->data['shipping_zone'] = '';
		}

		$this->load->model('localisation/country');

		$this->data['countries'] = $this->model_localisation_country->getCountries();

		if (isset($this->request->post['shipping_method'])) {
			$this->data['shipping_method'] = $this->request->post['shipping_method'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_method'] = $order_info['shipping_method'];
		} else {
			$this->data['shipping_method'] = '';
		}

		if (isset($this->request->post['shipping_code'])) {
			$this->data['shipping_code'] = $this->request->post['shipping_code'];
		} elseif (!empty($order_info)) {
			$this->data['shipping_code'] = $order_info['shipping_code'];
		} else {
			$this->data['shipping_code'] = '';
		}

		if (isset($this->request->post['order_product'])) {
			$order_products = $this->request->post['order_product'];
		} elseif (isset($this->request->get['order_id'])) {
			$order_products = $this->model_sale_order_volusion->getOrderProducts($this->request->get['order_id']);
		} else {
			$order_products = array();
		}

		$this->load->model('catalog/product');

		$this->document->addScript('view/javascript/jquery/ajaxupload.js');

		$this->data['order_products'] = array();

		foreach ($order_products as $order_product) {
			if (isset($order_product['order_option'])) {
				$order_option = $order_product['order_option'];
			} elseif (isset($this->request->get['order_id'])) {
				$order_option = $this->model_sale_order_volusion->getOrderOptions($this->request->get['order_id'], $order_product['order_product_id']);
			} else {
				$order_option = array();
			}

			if (isset($order_product['order_download'])) {
				$order_download = $order_product['order_download'];
			} elseif (isset($this->request->get['order_id'])) {
				$order_download = $this->model_sale_order_volusion->getOrderDownloads($this->request->get['order_id'], $order_product['order_product_id']);
			} else {
				$order_download = array();
			}

			$this->data['order_products'][] = array(
				'order_product_id' => $order_product['order_product_id'],
				'product_id'       => $order_product['product_id'],
				'name'             => $order_product['name'],
				'model'            => $order_product['model'],
				'option'           => $order_option,
				'download'         => $order_download,
				'quantity'         => $order_product['quantity'],
				'price'            => $order_product['price'],
				'total'            => $order_product['total'],
				'tax'              => $order_product['tax'],
				'reward'           => $order_product['reward']
			);
		}

		if (isset($this->request->post['order_voucher'])) {
			$this->data['order_vouchers'] = $this->request->post['order_voucher'];
		} elseif (isset($this->request->get['order_id'])) {
			$this->data['order_vouchers'] = $this->model_sale_order_volusion->getOrderVouchers($this->request->get['order_id']);
		} else {
			$this->data['order_vouchers'] = array();
		}

		$this->load->model('sale/voucher_theme');

		$this->data['voucher_themes'] = $this->model_sale_voucher_theme->getVoucherThemes();

		if (isset($this->request->post['order_total'])) {
			$this->data['order_totals'] = $this->request->post['order_total'];
		} elseif (isset($this->request->get['order_id'])) {
			$this->data['order_totals'] = $this->model_sale_order_volusion->getOrderTotals($this->request->get['order_id']);
		} else {
			$this->data['order_totals'] = array();
		}

		if (!empty($order_info)) {
			$this->data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);
		} else {
			$this->data['total'] = '';
		}

		if (!empty($order_info)) {
			$this->data['date_added'] = date('m/d/Y h:iA', strtotime($order_info['date_added']));
		} else {
			$this->data['date_added'] = '';
		}

		if (!empty($order_info)) {
			$this->data['date_modified'] = date('m/d/Y h:iA', strtotime($order_info['date_modified']));
		} else {
			$this->data['date_modified'] = '';
		}

		if (!empty($order_info)) {
			$this->data['ip'] = $order_info['ip'];
		} else {
			$this->data['ip'] = '';
		}

		if (!empty($order_info)) {
			$this->data['user_agent'] = $order_info['user_agent'];
		} else {
			$this->data['user_agent'] = '';
		}

		if (isset($this->request->post['date_shipped'])) {
			$this->data['date_shipped'] = $this->request->post['date_shipped'];
		} elseif (!empty($order_info)) {
			$this->data['date_shipped'] = $order_info['date_shipped'];
		} else {
			$this->data['date_shipped'] = '';
		}

		if (isset($this->request->post['internal_comment'])) {
			$this->data['internal_comment'] = $this->request->post['internal_comment'];
		} elseif (!empty($order_info)) {
			$this->data['internal_comment'] = $order_info['internal_comment'];
		} else {
			$this->data['internal_comment'] = '';
		}

		if (isset($this->request->post['gift_comment'])) {
			$this->data['gift_comment'] = $this->request->post['gift_comment'];
		} elseif (!empty($order_info)) {
			$this->data['gift_comment'] = $order_info['gift_comment'];
		} else {
			$this->data['gift_comment'] = '';
		}

		if (isset($this->request->post['customer_comment'])) {
			$this->data['customer_comment'] = $this->request->post['customer_comment'];
		} elseif (!empty($order_info)) {
			$this->data['customer_comment'] = $order_info['customer_comment'];
		} else {
			$this->data['customer_comment'] = '';
		}
		

		$this->template = 'sale/order_volusion_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->data['accordion_payments'] = $this->getOrderPaymentsHtml($this->request->get['order_id']); /*Accordion payments-tab*/
		$this->data['savedCcHtml'] = $this->savedCcHtml($this->request->get['order_id']);
		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'sale/order_volusion')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email']))) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['payment_firstname']) < 1) || (utf8_strlen($this->request->post['payment_firstname']) > 32)) {
			$this->error['payment_firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen($this->request->post['payment_lastname']) < 1) || (utf8_strlen($this->request->post['payment_lastname']) > 32)) {
			$this->error['payment_lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['payment_address_1']) < 3) || (utf8_strlen($this->request->post['payment_address_1']) > 128)) {
			$this->error['payment_address_1'] = $this->language->get('error_address_1');
		}

		if ((utf8_strlen($this->request->post['payment_city']) < 3) || (utf8_strlen($this->request->post['payment_city']) > 128)) {
			$this->error['payment_city'] = $this->language->get('error_city');
		}

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->post['payment_country_id']);

		if ($country_info) {
			if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['payment_postcode']) < 2) || (utf8_strlen($this->request->post['payment_postcode']) > 10)) {
				$this->error['payment_postcode'] = $this->language->get('error_postcode');
			}

			// VAT Validation
			$this->load->helper('vat');

			if ($this->config->get('config_vat') && $this->request->post['payment_tax_id'] && (vat_validation($country_info['iso_code_2'], $this->request->post['payment_tax_id']) == 'invalid')) {
				$this->error['payment_tax_id'] = $this->language->get('error_vat');
			}
		}

		if ($this->request->post['payment_country_id'] == '') {
			$this->error['payment_country'] = $this->language->get('error_country');
		}

		if (!isset($this->request->post['payment_zone_id']) || $this->request->post['payment_zone_id'] == '') {
			$this->error['payment_zone'] = $this->language->get('error_zone');
		}

		if (!isset($this->request->post['payment_method']) || $this->request->post['payment_method'] == '') {
			$this->error['payment_method'] = $this->language->get('error_payment');
		}

		// Check if any products require shipping
		$shipping = false;

		if (isset($this->request->post['order_product'])) {
			$this->load->model('catalog/product');

			foreach ($this->request->post['order_product'] as $order_product) {
				$product_info = $this->model_catalog_product->getProduct($order_product['product_id']);

				if ($product_info && $product_info['shipping']) {
					$shipping = true;
				}
			}
		}

		if ($shipping) {
			if ((utf8_strlen($this->request->post['shipping_firstname']) < 1) || (utf8_strlen($this->request->post['shipping_firstname']) > 32)) {
				$this->error['shipping_firstname'] = $this->language->get('error_firstname');
			}

			if ((utf8_strlen($this->request->post['shipping_lastname']) < 1) || (utf8_strlen($this->request->post['shipping_lastname']) > 32)) {
				$this->error['shipping_lastname'] = $this->language->get('error_lastname');
			}

			if ((utf8_strlen($this->request->post['shipping_address_1']) < 3) || (utf8_strlen($this->request->post['shipping_address_1']) > 128)) {
				$this->error['shipping_address_1'] = $this->language->get('error_address_1');
			}

			if ((utf8_strlen($this->request->post['shipping_city']) < 3) || (utf8_strlen($this->request->post['shipping_city']) > 128)) {
				$this->error['shipping_city'] = $this->language->get('error_city');
			}

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['shipping_country_id']);

			if ($country_info && $country_info['postcode_required'] && (utf8_strlen($this->request->post['shipping_postcode']) < 2) || (utf8_strlen($this->request->post['shipping_postcode']) > 10)) {
				$this->error['shipping_postcode'] = $this->language->get('error_postcode');
			}

			if ($this->request->post['shipping_country_id'] == '') {
				$this->error['shipping_country'] = $this->language->get('error_country');
			}

			if (!isset($this->request->post['shipping_zone_id']) || $this->request->post['shipping_zone_id'] == '') {
				$this->error['shipping_zone'] = $this->language->get('error_zone');
			}

			if (!$this->request->post['shipping_method']) {
				$this->error['shipping_method'] = $this->language->get('error_shipping');
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'sale/order_volusion')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->setOutput(json_encode($json));
	}

	private function getTotals() {
		$this->session->data['catalog_model'] = 1;
		$this->load->model('setting/extension');
		$return_data = array();
		$total_data = array();			
		$total = 0;
		$taxes = $this->cart->getTaxes();
		$sort_order = array(); 
		$results = $this->model_setting_extension->getExtensions('total'); //no need
		if (isset($this->session->data['optional_fees'])) {
			$s = 900;
			foreach ($this->session->data['optional_fees'] as $optional_fee) {
				$results[] = array(
					'extension_id'	=> $s,
					'type'			=> 'total',
					'code'			=> $optional_fee['code']
				);
				$s++;
			}
		}
		foreach ($results as $key => $value) {
			$found = false;
			if (isset($this->session->data['optional_fees'])) {
				foreach ($this->session->data['optional_fees'] as $optional_fee) {
					if ($value['code'] == $optional_fee['code']) {
						$sort_order[$key] = $optional_fee['sort_order'];
						$found = true;
					}
				}
			}
			if (!$found) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}
		}
		array_multisort($sort_order, SORT_ASC, $results);
		
		foreach ($results as $result) {
			$found = false;
			if (isset($this->session->data['optional_fees'])) {
				foreach ($this->session->data['optional_fees'] as $optional_fee) {
					if ($result['code'] == $optional_fee['code']) {
						$sub_total = $this->cart->getSubTotal();
						if ($optional_fee['type'] == "p-amt" || $optional_fee['type'] == "p-per") {
							if ($optional_fee['type'] == "p-amt") {
								$amount = $optional_fee['value'];
							} elseif ($optional_fee['type'] == "p-per") {
								$amount = ($sub_total * $optional_fee['value']) / 100;
							}
							if ($optional_fee['taxed'] && $optional_fee['tax_class_id'] && ($optional_fee['type'] == 'p-amt' || $optional_fee['type'] == 'p-per')) {
								if (version_compare(VERSION, '1.5.1.2', '>')) {
									$tax_rates = $this->tax->getRates($amount, $optional_fee['tax_class_id']);
									foreach ($tax_rates as $tax_rate) {
										if (!isset($taxes[$tax_rate['tax_rate_id']])) {
											$taxes[$tax_rate['tax_rate_id']] = $tax_rate['amount'];
										} else {
											$taxes[$tax_rate['tax_rate_id']] += $tax_rate['amount'];
										}
									}
								} else {
									if (!isset($taxes[$optional_fee['tax_class_id']])) {
										$taxes[$optional_fee['tax_class_id']] = $amount / 100 * $this->tax->getRate($optional_fee['tax_class_id']);
									} else {
										$taxes[$optional_fee['tax_class_id']] += $amount / 100 * $this->tax->getRate($optional_fee['tax_class_id']);
									}
								}
							}
						} else {
							$amount = 0;
							if ($optional_fee['type'] == "m-amt") {
								$discount_min = min($optional_fee['value'], $sub_total);
							}
							foreach ($this->cart->getProducts() as $product) {
								$discount = 0;
								if ($optional_fee['type'] == "m-amt") {
									$discount = $discount_min * ($product['total'] / $sub_total);
								} elseif ($optional_fee['type'] == "m-per") {
									$discount = ($product['total'] * $optional_fee['value']) / 100;
								}
								if ($product['tax_class_id'] && $optional_fee['pre_tax'] == 1) {
									$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);
									foreach ($tax_rates as $tax_rate) {
										if ($tax_rate['type'] == 'P') {
											$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
										}
									}
								}
								$amount -= $discount;
							}
							if ($optional_fee['shipping'] && isset($this->session->data['shipping_method'])) {
								$discount = 0;
								foreach ($this->session->data['shipping_methods'] as $shipping_method) {
									foreach ($shipping_method['quote'] as $quote) {
										if ($quote['code'] == $this->session->data['shipping_method']['code']) {
											if ($optional_fee['type'] == "m-amt") {
												if ($quote['cost'] >= $optional_fee['value']) {
													$discount = $optional_fee['value'];
												} else {
													$discount = $quote['cost'];
												}
											} elseif ($optional_fee['type'] == "m-per") {
												$discount = ($quote['cost'] * $optional_fee['value']) / 100;
											}
											if ($this->session->data['shipping_method']['tax_class_id'] && $optional_fee['pre_tax'] == 1) {
												foreach ($tax_rates as $tax_rate) {
													if (version_compare(VERSION, '1.5.1.2', '>')) {
														$tax_rates = $this->tax->getRates($quote['cost'] - ($quote['cost'] - $discount), $this->session->data['shipping_method']['tax_class_id']);
														foreach ($tax_rates as $tax_rate) {
															if (!isset($taxes[$tax_rate['tax_rate_id']])) {
																$taxes[$tax_rate['tax_rate_id']] = $tax_rate['amount'];
															} else {
																$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
															}
														}
													} else {
														if (!isset($taxes[$this->session->data['shipping_method']['tax_class_id']])) {
															$taxes[$this->session->data['shipping_method']['tax_class_id']] = $discount / 100 * $this->tax->getRate($this->session->data['shipping_method']['tax_class_id']);
														} else {
															$taxes[$this->session->data['shipping_method']['tax_class_id']] -= $discount / 100 * $this->tax->getRate($this->session->data['shipping_method']['tax_class_id']);
														}
													}
												}
											}
										}
									}
								}
								$amount -= $discount;
							}
						}
						$total += $amount;
						$text = $this->currency->format($amount);
						$total_data[] = array(
							'code'			=> $optional_fee['code'],
							'title'			=> $optional_fee['title'],
							'text'			=> $text,
							'value'			=> $amount,
							'sort_order'	=> $optional_fee['sort_order']
						);
						$found = true;
					}
				}
			}
			if (!$found) {
				if ($this->config->get($result['code'] . '_status')) {
					if (version_compare(VERSION, '1.5.2', '<') && $result['code'] != "tax") {
						$this->language->load('oentrytotal/' . $result['code']);
					} elseif (version_compare(VERSION, '1.5.1.3.1', '>')) {
						$this->language->load('oentrytotal/' . $result['code']);
					}
					$this->load->model('total/' . $result['code']);
					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}
			$sort_order = array(); 
			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}
			array_multisort($sort_order, SORT_ASC, $total_data);			
		}
		
		
		unset($this->session->data['catalog_model']);
		$return_data = array(
			'total_data'	=> $total_data,
			'total'			=> $total,
			'taxes'			=> $taxes
		);
		return $return_data;
	}

	private function savedCcHtml($order_id) {
		$cards = $this->model_sale_order_volusion->getSavedCards($order_id, 'credit_card');
		
		$payment_types = array(
			'credit_card' => 'Credit Card',
			'paypal'	=> 'Paypal',
			'check'		=> 'Check',
			'cash'		=> 'Cash',
			'wire'		=> 'Wire Transfer',
			'bank'		=> 'Bank Deposit',
			'other'		=> 'Other'
		);
		$card_types = array('3'=>'Amex', '4'=>'Visa', '5' =>'MasterCard', '6'=>'Discover');
		
		$res_html = "<option value=''>Select</option>";
		foreach($cards as $card) {
			$value = base64_decode($card['cc_number']);
			$value.= ",".$card['cc_type'].",".$card['cc_name'].",".str_replace("-",",",$card['cc_exp_month_year']).",".base64_decode($card['cc_cvv']);
			$res_html .= "<option value='{$value}'>{$card_types[$card['cc_type']]} {$card['pay_details']}</option>";
		}
		
		return $res_html;
	}

	private function getOrderPaymentsHtml($order_id) {
		$payment_records = $this->model_sale_order_volusion->getOrderPayments($order_id);
		$payment_records_html = "";
		
		$payment_types = array(
			'credit_card' => 'Credit Card',
			'paypal'	=> 'Paypal',
			'check'		=> 'Check',
			'cash'		=> 'Cash',
			'wire'		=> 'Wire Transfer',
			'bank'		=> 'Bank Deposit',
			'other'		=> 'Other'
		);
		$card_types = array('3'=>'Amex', '4'=>'Visa', '5' =>'MasterCard', '6'=>'Discover');
		
		//$totals = $this->getTotals();
		$balance_due = 0;//$totals['total'];
		
		foreach($payment_records as $payment) {
			$payment_records_html .= "<tr>
				<td>".date('n/j/Y g:i A', strtotime($payment['created']))."</td>";
			
			switch($payment['payment_method']) {
				case 'credit_card': case 'paypal': case 'wire': case 'bank': case 'check': case 'cash':
					$payment_records_html .= "<td>".$payment_types[$payment['payment_method']]." | ".($payment['pay_option']=='received' ? "<span style='color:#333;'>Received</span>":($payment['pay_option']=='deposited' ? "<span style='color:#33D;'>Deposited</span>":"<span style='color:#D33;'>Refunded</span>"))."</td>";
					break;
				case 'other': 
					$payment_records_html .= "<td>".$payment['other_payment_type_name']." | ".($payment['pay_option']=='received' ? "<span style='color:#333;'>Received</span>":($payment['pay_option']=='deposited' ? "<span style='color:#33D;'>Deposited</span>":"<span style='color:#D33;'>Refunded</span>"))."</td>";
					break;
				default:
					$payment_records_html .= "<td>".$payment_types[$payment['payment_method']]."</td>";
					break;
			}
			
			$payment_records_html .= "<td>".($payment['chk_not_balance'] == 0 ? "Yes":"No")."</td>";
			
			switch($payment['payment_method']) {
				case 'paypal':
					$payment_records_html .= "<td>{$payment['payer_paypal_email']}</td>";
					break;
				case 'credit_card':
					$card_type = $card_types[$payment['cc_type']];
					$payment_records_html .= "<td>{$card_type} {$payment['pay_details']}</td>";
					break;
				case 'check': 
					$payment_records_html .= "<td>".base64_decode($payment['check_deposit_account'])."</td>";
					break;
				case 'cash': 
					$payment_records_html .= "<td>".base64_decode($payment['cash_deposit_account'])."</td>";
					break;
				case 'bank': 
					$payment_records_html .= "<td>".base64_decode($payment['bank_deposit_account'])."</td>";
					break;
				case 'wire': case 'other': default:
					$payment_records_html .= "<td>".$payment['pay_details']."</td>";
					break;
			}
			
			$payment_records_html .= "<td>".$this->currency->format($payment['pay_amount'])."</td>";
			
			if($payment['chk_not_balance'] == 0) {
				if($payment['pay_option'] == 'refunded') { // Refunded Money
					$balance_due += $payment['pay_amount'];
				}
				else {
					$balance_due -= $payment['pay_amount'];
				}
				
				$payment_records_html .= "<td>".$this->currency->format($balance_due)."</td>";
			} else {
				$payment_records_html .= "<td>".$this->currency->format($balance_due)."</td>";
			}
			
			$payment_records_html .= "
				<td align='center'><a href='javascript:void(0);' data-role={$payment['order_payment_id']} class='remove_payment_record'>&nbsp;</a></td>
			</tr>";
			
			switch($payment['payment_method']) {
				case 'paypal':
					$payment_records_html .= "<tr class='note'>
						<td colspan='7'>
						    <div>
								<label>AuthCode:</label><span class='value'>{$payment['payer_paypal_email']}</span>
								<label>TransID:</label><span class='value'>{$payment['trans_id']}</span>
								<label>Note:</label><span class='value'>{$payment['note']}</span>
						    </div>
						</td>
					</tr>";
					break;
				case 'credit_card':
					$card_type = $card_types[$payment['cc_type']];
					$payment_records_html .= "<tr class='note'>
						<td colspan='7'>
						    <div>
								<label>Card #:</label><span class='value'>{$payment['pay_details']}</span>
								<label>Card Type:</label><span class='value'>{$card_type}</span>
								<label>Note:</label><span class='value'>{$payment['note']}</span>
						    </div>
						</td>
					</tr>";
					break;
				case 'check':
					if($payment['check_received_date']) {
						$l_date = "Received Date";
						$v_date = date('m/d/Y', strtotime($payment['check_received_date']));
					}
					elseif($payment['check_deposit_date']) {
						$l_date = "Deposited Date";
						$v_date = date('m/d/Y', strtotime($payment['check_deposit_date']));
					}
					else {
						$l_date = "Refunded Date";
						$v_date = date('m/d/Y', strtotime($payment['check_refund_date']));
					}
							
					$payment_records_html .= "<tr class='note'>
						<td colspan='7'>
						    <div>
								<label>Check #:</label><span class='value'>{$payment['pay_details']}</span>
								<label>{$l_date}:</label><span class='value'>{$v_date}</span>
								<label>Note:</label><span class='value'>{$payment['note']}</span>
						    </div>
						</td>
					</tr>";
					break;
				case 'cash': 
					if($payment['cash_received_date']) {
						$l_date = "Received Date";
						$v_date = date('m/d/Y', strtotime($payment['cash_received_date']));
					}
					elseif($payment['cash_deposit_date']) {
						$l_date = "Deposited Date";
						$v_date = date('m/d/Y', strtotime($payment['cash_deposit_date']));
					}
					else {
						$l_date = "Refunded Date";
						$v_date = date('m/d/Y', strtotime($payment['cash_refund_date']));
					}
							
					$payment_records_html .= "<tr class='note'>
						<td colspan='7'>
						    <div>
								<label>{$l_date}:</label><span class='value'>{$v_date}</span>
								<label>Note:</label><span class='value'>{$payment['note']}</span>
						    </div>
						</td>
					</tr>";
					break;
				case 'other': default:
					$payment_records_html .= "<tr class='note'>
						<td colspan='7'>
						    <div>
								<label>Note:</label><span class='value'>{$payment['note']}</span>
						    </div>
						</td>
					</tr>";
					break;
				case 'wire':
					$payment_records_html .= "<tr class='note'>
						<td colspan='7'>
						    <div>
								<label>Transfer Date:</label><span class='value'>".date('m/d/Y', strtotime($payment['wire_transfer_date']))."</span>
								<label>Note:</label><span class='value'>{$payment['note']}</span>
						    </div>
						</td>
					</tr>";
					break;
				case 'bank':
					$payment_records_html .= "<tr class='note'>
						<td colspan='7'>
						    <div>
								<label>Deposited Date:</label><span class='value'>".date('m/d/Y', strtotime($payment['bank_deposit_date']))."</span>
								<label>Note:</label><span class='value'>{$payment['note']}</span>
						    </div>
						</td>
					</tr>";
					break;
			}
		}
		
		return $payment_records_html;
	}
	public function complete_order() {
		$this->load->model('sale/order_volusion');

		$order_id = $this->request->get['order_id'];
		$email = $this->request->get['email'];

		$date_shipped = date('Y-m-d H:i:s');
		$this->model_sale_order_volusion->completeOrder($order_id, $date_shipped);
		
		$this->session->data['success'] = $this->language->get('text_success');
		
		$this->redirect($this->url->link('sale/order_volusion/update', 'token=' . $this->session->data['token'] . '&order_id=' . $order_id . $url, 'SSL'));
	}
	public function addOrderPayment(){	
		$post = $this->request->post;
		$this->load->model('sale/order_volusion');
		$saved_card = $this->model_sale_order_volusion->addOrderPayment($post);
		$payment_log = array('orderHtml'=>"", 'savedCcHtml'=>"",);
		$payment_log['orderHtml'] = $this->getOrderPaymentsHtml($post['order_id']);	
		
		if (isset($post['pay_cc_save'])) $payment_log['savedCcHtml'] = $this->savedCcHtml($post['order_id']);
		

		$this->response->setOutPut(json_encode($payment_log));
	}

	public function delOrderPayment(){
		$order_payment_id = $this->request->post['order_payment_id'];
		$this->load->model('sale/order_volusion');
		$this->model_sale_order_volusion->delOrderPayment($order_payment_id);
		$this->response->setOutPut('success');
	}
}
?>