<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/mlogin');
        $this->load->model('mloging');
        $this->load->model('mmodel');
        $this->load->model('user/muser');

        if (is_login() == '') {
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $login_info = array(
                'last_url' => $actual_link);
            $this->session->set_userdata($login_info);
            redirect(base_url());
        }
    }

    public function index()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "Dashboard";
        $object['title'] = "Dashboard";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');
        $main_data["sales_data"] = ($this->mmodel->get_data_for_dashboard());

        $this->load->view('dashboard',$main_data);
        $this->load->view('footer');
        $data["item_sales"] = ($this->mmodel->get_items_for_chart());
        $data["total_sales"] = ($this->mmodel->get_sales_history_for_chart());
        $this->load->view('js/dashboardjs',$data);
    }

    public function inventory()
    {
        $param_data["from"] = $this->input->get_post('from');
        $param_data["to"] = $this->input->get_post('to');
        $param_data["search_by"] = $this->input->get_post('search_by');
        $param_data["param"] = $this->input->get_post('param');
        $param_data["param2"] = $this->input->get_post('param2');

        $object['controller'] = $this;
        $object['active_tab'] = "Inventory";
        $object['active_main_tab'] = "Inventory";
        $object['title'] = "Inventory";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $data['items'] = $this->mmodel->get_item_list();
        $data['inventory'] = $this->mmodel->get_inventory($param_data);

        $this->load->view('inventory', $data);
        $this->load->view('footer');
        $this->load->view('js/inventoryjs');
    }
    
    public function item_list()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "item_list";
        $object['active_main_tab'] = "item_list";
        $object['title'] = "item_list";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $data['items'] = $this->mmodel->get_all('item_master');
        $data['selected'] = $this->input->get('item_code');
        $data['item_list'] = $this->mmodel->get_items($this->input->get('item_code'));

        $this->load->view('item_list',$data);
        $this->load->view('footer');
        $this->load->view('js/item_listjs');
    }
    
    public function add_items_inventory($msg = "", $alert_type = "alert-success", $stock_id = "")
	{
		$object['controller'] = $this;
		$object['active_tab'] = "item_update";
		$object['title'] = "ItemUpdate";
		$this->load->view('header', $object);
		$this->load->view('top_header');
		$this->load->view('side_menu');

if($this->input->get('stock_id')){
			$stock_id = $this->input->get('stock_id');
		}
		//$data["skus"] = $this->mmodel->get_all('item_sku_1');
		$data["items"] = $this->mmodel->get_all('item_master');
		$data["itemgroups"] = $this->mmodel->get_item_groups();
		$data["stock_id"] = $stock_id;

		$data["msg"] = $msg;
		$data["alert_type"] = $alert_type;
		
		if(!$stock_id){
			$data["msg"] = "No stock select to add items";
			$data["alert_type"] = "alert-danger";
		}

		$this->load->view('updateinventory', $data);
		$this->load->view('footer');
		$this->load->view('js/updateinventoryjs');
	}
    // public function add_items_inventory($msg = "", $alert_type = "alert-success", $stock = "")
    // {
    //     $object['controller'] = $this;
    //     $object['active_tab'] = "item_update";
    //     $object['title'] = "ItemUpdate";
    //     $this->load->view('header', $object);
    //     $this->load->view('top_header');
    //     $this->load->view('side_menu');

    //     //$data["skus"] = $this->mmodel->get_all('item_sku_1');
    //     $data["items"] = $this->mmodel->get_all('item_master');
    //     $data["itemgroups"] = $this->mmodel->get_item_groups();
        
    //     $data["msg"] = $msg;
    //     $data["alert_type"] = $alert_type;

    //     $this->load->view('updateinventory', $data);
    //     $this->load->view('footer');
    //     $this->load->view('js/updateinventoryjs');
    // }

    public function save_item_inventory()
    {
        $data['item_id'] = $this->input->get_post('item_code');
        $data['stock_id'] = $this->input->get_post('stock_id');
        // $data['item_sku_id'] = $this->input->get_post('sku_code');
        $data['qty'] = $this->input->get_post('qty');
        $data['purchased_price'] = $this->input->get_post('price');
        $data['profit_type'] = $this->input->get_post('profit_type');
        $data['profit_margin'] = $this->input->get_post('profit_margin');
        $data['selling_price'] = $this->input->get_post('selling_price');
        $data['purchase_date'] = $this->input->get_post('date');
        $data['last_modified_at'] = date('Y-m-d H:i:s');
        $data['last_modified_by'] = $this->session->userdata('name');
        $data['remaining_qty'] = $this->input->get_post('qty');
        $stock_id = $this->input->get_post('stock_id');

        $res = $this->mmodel->insert('stock_details', $data);
        if ($res) {
            $this->add_items_inventory('Items Added Successfully', 'alert-success', $stock_id);
        } else {
            $this->add_items_inventory('Items failed to Insert', 'alert-danger',$stock_id);
        }

    }

    public function add_sku($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "add_sku";
        $object['active_main_tab'] = "add_sku";
        $object['title'] = "Inventory";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('create_SKU', $data);
        $this->load->view('footer');
    }

    public function save_sku()
    {
        $data["sku_code"] = $this->input->get_post('sku_code');
        $data["sku_name"] = $this->input->get_post('sku_name');
        $data["status"] = $this->input->get_post('status');
        $data['last_modified_at'] = date('Y-m-d H:i:s');
        $data['last_modified_by'] = $this->session->userdata('name');

        if ($this->mmodel->get_where_count('item_sku', array('sku_code' => $data["sku_code"])) > 0) {
            $this->add_sku('SKU Code Already exists', 'alert-danger');
        } else {
            if ($this->mmodel->insert('item_sku', $data)) {
                $this->add_sku('SKU Added Successfully');
            } else {
                $this->add_sku('SKU failed to Insert', 'alert-danger');
            }
        }
    }

    public function view_sku()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "view_sku";
        $object['title'] = "Inventory";

        $search_param = $this->input->get_post('search_param');

        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');
        $data['sku_list'] = $this->mmodel->get_sku_list($search_param);
        $this->load->view('view_SKU', $data);
        $this->load->view('footer');
    }

    public function create_invoice()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "Invoice";
        $object['title'] = "Invoice";

        $trans_id = $this->input->get("id");

        // $data["customer_details"] = $this->mmodel->get_customer_by_id("customer", $trans_id);
        // $data["invoice_header_details"] = $this->mmodel->get_all_by_id("invoice", $trans_id);
        // $data["invoice_details"] = $this->mmodel->get_invoice_details($trans_id);


        $invoice_header_details = $this->mmodel->get_all_by_id("invoice", $trans_id);
        $data["customer_details"] = $this->mmodel->get_customer_by_id("customer", $invoice_header_details->row()->cus_id);
        $data["invoice_header_details"] = $invoice_header_details;
        $data["invoice_details"] = $this->mmodel->get_invoice_details($trans_id);

        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');
        $this->load->view('usercash_invoice', $data);
        $this->load->view('footer');
    }
    public function item_create($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "item_create";
        $object['title'] = "Item Create";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        //$data["skus"] = $this->mmodel->get_all('item_sku_1');
        $data["unit_types"] = $this->mmodel->get_all('unit_types');
        $data["suppliers"] = $this->mmodel->get_all('suppliers');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('item_create',$data);
        $this->load->view('footer');
        $this->load->view('js/item_createjs');
    }

    public function save_item($msg = "", $alert_type = "alert-success"){

        $data['item_name'] = $this->input->get_post('name');
       // $data['item_sku_id'] = $this->input->get_post('sku');
        $data['item_group'] = $this->input->get_post('group');
        $data['supplier_id'] = $this->input->get_post('supplier');
        $data['unit_type'] = $this->input->get_post('unit_type');
        // $data['re_order_level'] = $this->input->get_post('re_order_level');
        $data['status'] = $this->input->get_post('status');
        $data['item_code'] = $this->mmodel->generate_item_number();
        $data['last_modified_at'] = date('Y-m-d H:i:s');
        $data['last_modified_by'] = $this->session->userdata('name');

        if ($this->mmodel->insert('item_master', $data)) {
            $this->item_create('Item Added Successfully');
        } else {
            $this->item_create('Item failed to Insert', 'alert-danger');
        }
    }

    public function save_stock($msg = "", $alert_type = "alert-success"){

        $data['purchase_date'] = $this->input->get_post('purchased_date');
        $data['stock_id'] = $this->mmodel->generate_stock_number();
       

        if ($this->mmodel->insert('stock', $data)) {
            $this->add_stock('Stock Added Successfully');
        } else {
            $this->add_stock('Failed to Insert Stock', 'alert-danger');
        }
    }
    public function save_suppliers($msg = "", $alert_type = "alert-success"){

        $data['supplier_name'] = $this->input->get_post('supplier_name');
        $data['address_line_1'] = $this->input->get_post('adderss1');
        $data['address_line_2'] = $this->input->get_post('adderss2');
        $data['address_line_3'] = $this->input->get_post('adderss3');
        $data['sup_tel_no'] = $this->input->get_post('contact_number');
        $data['supplier_email'] = $this->input->get_post('email');
        $data['supplier_id'] = $this->mmodel->generate_supplier_number();
        // $data['last_modified_at'] = date('Y-m-d H:i:s');
        // $data['last_modified_by'] = $this->session->userdata('name');

        if ($this->mmodel->insert('suppliers', $data)) {
            $this->suppliers('Supplier Added Successfully');
        } else {
            $this->suppliers('Failed to Insert Supplier', 'alert-danger');
        }
    }
    public function save_delivery_note($msg = "", $alert_type = "alert-success"){

        $data['DN_id'] = $this->input->get_post('DN_id');
        $data['supplier_id'] = $this->input->get_post('supplier_id');
        $data['order_id'] = $this->input->get_post('order_id');
        $data['item_qty'] = $this->input->get_post('item_qty');
        $data['issue_date'] = $this->input->get_post('issue_date');
        $data['delivery_date'] = $this->input->get_post('delivery_date');
        // $data['supplier_id'] = $this->mmodel->generate_supplier_number();
        // $data['last_modified_at'] = date('Y-m-d H:i:s');
        // $data['last_modified_by'] = $this->session->userdata('name');

        if ($this->mmodel->insert('delivery_note', $data)) {
            $this->delivery_note('Delivery Note Added Successfully');
        } else {
            $this->delivery_note('Failed to Insert Delivery Note', 'alert-danger');
        }
    }
    public function invoicelist()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "InvoiceList";
        $object['title'] = "Invoice List";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');
        $this->load->view('invoicelist');
        $this->load->view('footer');
        $this->load->view('js/invoicelistjs');
    }

    public function invoiceModal()
    {
        $object['controller'] = $this;
        //$object['active_tab'] = "InvoiceList";
        $object['title'] = "Invoice Modal";
        $this->load->view('header', $object);
        //$this->load->view('top_header');
        //$this->load->view('side_menu');
        $this->load->view('myModal');
        $this->load->view('footer');
        $this->load->view('js/invoicelistjs');
    }

    public function itemsaleshistory()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "Itemsaleshistory";
        $object['title'] = "Item Sales History";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $param_data["from"] = $this->input->get('from');
        $param_data["to"] = $this->input->get('to');
        $param_data["item_code"] = $this->input->get('item_code');
        $param_data["param"] = $this->input->get('param');

        $data["sales_history_table"] = $this->mmodel->get_salesHistory_table($param_data);
        $data["item_codes"] = $this->mmodel->get_item_codes();
        $this->load->view('itemsaleshistory', $data);
        $this->load->view('footer');
        $this->load->view('js/itemsaleshistoryjs');
    }

    public function salestransaction()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "Salestransaction";
        $object['title'] = "Sales Transaction";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        // $param_data["item_code"] = $this->input->get('item_code');
       

        $data["inv_number"] = $this->mmodel->generate_invoice_number();
        $data["items"] = $this->mmodel->get_item_list();
        // $data["stocks"] = $this->mmodel->get_all('stock');
        // $data["stocks"] = $this->mmodel->get_stock_list_by_item($this->input->get('item_code'));
        
        

        $data["inv_date"] = date('Y-m-d');

        $this->load->view('salestransaction', $data);
        $this->load->view('footer');
        $this->load->view('js/salestransactionsjs');
    }

    public function get_stocks_for_item(){
        $data = $this->mmodel->get_stock_list_by_item($this->input->get('item_code'));

        echo json_encode($data);

    }

    public function get_items_for_stocks(){
        $data = $this->mmodel->get_item_list_by_stock($this->input->get('stock_id'));

        echo json_encode($data);

    }

    public function update_order_status_approve(){
        $order_id =  $this->input->get('order_id');
        
        $this->mmodel->update_order_status('1',$order_id);
        $this->order_list();

        

    }
    public function update_order_status_reject(){
        $order_id =  $this->input->get('order_id');
        $this->mmodel->update_order_status('2',$order_id);
        $this->order_list();

        

    }

    public function salesreport()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "salesreport";
        $object['active_main_tab'] = "salesreport";
        $object['title'] = "Sales Report";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $data["sales_data"] = $this->mmodel->get_item_sales_history($from,$to);
        $this->load->view('salesreport',$data);
        $this->load->view('footer');
        $this->load->view('js/salesreportjs');
    }

    public function inventoryreport()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "inventoryreport";
        $object['title'] = "Inventory Report";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $data["inventory_data"] = $this->mmodel->get_inventory_report($from,$to);
        $this->load->view('inventoryreport',$data);
        $this->load->view('footer');
        $this->load->view('js/inventoryreportjs');
    }


    public function save_transaction()
    {
        $header['invoice_id'] = $this->input->post('invoice_number');
        $header['invoice_date'] = $this->input->post('inv_date');
        $header['gross_total'] = $this->input->post('gross_total');
        $header['qty_total'] = $this->input->post('total_qty');
        $header['tot_discount'] = $this->input->post('total_discount');
        $header['net_total'] = $this->input->post('net_total');
        $header['net_total'] = $this->input->post('net_total');
        $header['net_total'] = $this->input->post('net_total');
        $header['last_modified_at'] = date('Y-m-d H:i:s');
        $header['last_modified_by'] = $this->session->userdata('name');

        $customer['customer_name'] = $this->input->post('customer_name');
        $customer['address_line_1'] = $this->input->post('address_line_1');
        $customer['address_line_2'] = $this->input->post('address_line_2');
        $customer['address_line_3'] = $this->input->post('address_line_3');
        $customer['cus_tel'] = $this->input->post('cus_tel');

        // $stocks_rec['stock_id'] = $this->input->post('stock_id');

        $item_list = json_decode($this->input->post('item_list'));

        $line_records = [];

        foreach ($item_list as $item) {
            $line['item_code'] = $item[0];
            $line['unit_price'] = $item[1];
            $line['discount'] = $item[2];
            $line['item_qty'] = $item[3];
            $line['total_price'] = $item[4];
            $line['stock_id'] = $item[5];
            $line_records[] = $line;
        }

        $data['status'] = 0;

        $trans_id = $this->mmodel->save_transaction($header, $line_records,$customer);

        if ($trans_id) {
            $data['status'] = 1;
            $data['trans_id'] = $trans_id;
        }

        echo json_encode($data);
    }

    public function save_order()
    {
        $order['order_id'] = $this->input->post('order_id');
        $order['order_date'] = $this->input->post('order_date');

        
        $approve['supplier_id'] = $this->input->post('supplier_id');
        $approve['order_id'] = $this->input->post('order_id');

        $item_list = json_decode($this->input->post('item_list'));

        $line_records = [];

        foreach ($item_list as $item) {
            $line['item_code'] = $item[0];
            $line['item_qty'] = $item[1];
            // $line['discount'] = $item[2];
            // $line['item_qty'] = $item[3];
            // $line['total_price'] = $item[4];
            $line_records[] = $line;
        }

        $data['status'] = 0;

        $trans_id = $this->mmodel->save_order($order, $line_records,$approve);

        if ($trans_id) {
            $data['status'] = 1;
            $data['trans_id'] = $trans_id;
        }

        echo json_encode($data);
    }

    public function save_grn()
    {
        $grn['grn_id'] = $this->input->post('grn_id');
        $grn['delivered_date'] = $this->input->post('delivered_date');
 
        $grn['supplier_id'] = $this->input->post('supplier_id');
        $grn['comments'] = $this->input->post('comments');
        $grn['received_by'] = $this->input->post('received_by');

        $item_list = json_decode($this->input->post('item_list'));

        $line_records = [];

        foreach ($item_list as $item) {
            
            $line['item_code'] = $item[0];
            $line['delivered_qty'] = $item[1];
            $line['stock_id'] = $item[2];
            // $line['discount'] = $item[2];
            // $line['item_qty'] = $item[3];
            // $line['total_price'] = $item[4];
            $line_records[] = $line;
        }

        $data['status'] = 0;

        $trans_id = $this->mmodel->save_grn($grn, $line_records);

        if ($trans_id) {
            $data['status'] = 1;
            $data['trans_id'] = $trans_id;
        }

        echo json_encode($data);
    }
    public function save_sup_invoice()
    {
        $sup_inv['sup_inv_id'] = $this->input->post('sup_inv_id');
        $sup_inv['invoice_date'] = $this->input->post('inv_date');
 
        $sup_inv['supplier_id'] = $this->input->post('supplier_id');
        $sup_inv['gross_total'] = $this->input->post('gross_total');
        $sup_inv['net_total'] = $this->input->post('net_total');
        $sup_inv['discount'] = $this->input->post('discount');

        $item_list = json_decode($this->input->post('item_list'));

        $line_records = [];

        foreach ($item_list as $item) {
            
            $line['item_code'] = $item[0];
            $line['stock_id'] = $item[1];
            $line['unit_price'] = $item[2];
            $line['item_qty'] = $item[3];
            $line['total_price'] = $item[4];
            // $line['discount'] = $item[2];
            
            
            $line_records[] = $line;
        }

        $data['status'] = 0;

        $trans_id = $this->mmodel->save_sup_invoice($sup_inv, $line_records);

        if ($trans_id) {
            $data['status'] = 1;
            $data['trans_id'] = $trans_id;
        }

        echo json_encode($data);
    }

    public function get_item_details()
    {
        $item_code = $this->input->get('item_code');
        $stock_id = $this->input->get('stock_id');

        $item_details = $this->mmodel->get_item_details_for_transaction($item_code,$stock_id);

        echo json_encode($item_details->row());

    }

    public function get_item_details_for_order()
    {
        $item_code = $this->input->get('item_code');

        $item_details = $this->mmodel->get_item_details_for_new_order($item_code);

        echo json_encode($item_details->row());

    }

    public function get_item_details_for_grn()
    {
        $item_code = $this->input->get('item_code');
        $stock_id = $this->input->get('stock_id');

        $item_details = $this->mmodel->get_item_details_for_new_grn($item_code,$stock_id);

        echo json_encode($item_details->row());

    }
    public function get_item_details_for_sup_inv()
    {
        $item_code = $this->input->get('item_code');
        $stock_id = $this->input->get('stock_id');

        $item_details = $this->mmodel->get_item_details_for_new_sup_inv($item_code,$stock_id);

        echo json_encode($item_details->row());

    }

    public function suppliers($msg = "", $alert_type = "alert-success"){
        $object['controller'] = $this;
        $object['active_tab'] = "suppliers";
        $object['title'] = "Suppliers";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $param_data["from"] = $this->input->get('from');
        $param_data["to"] = $this->input->get('to');
        $param_data["item_code"] = $this->input->get('item_code');
        $param_data["param"] = $this->input->get('param');

        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $data["sales_history_table"] = $this->mmodel->get_salesHistory_table($param_data);
        // $data["item_codes"] = $this->mmodel->get_item_codes();
        $data['suppliers'] = $this->mmodel->get_all('suppliers');
        $this->load->view('supplier_list', $data);
        $this->load->view('footer');
        // $this->load->view('js/itemsaleshistoryjs');
    }

    public function view_GRN($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "GRN";
        $object['title'] = "GRN";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        
        $data["grns"] = $this->mmodel->get_all('grn');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('view_GRN',$data);
        $this->load->view('footer');
       
    }

    public function delivery_note($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "delivetynote";
        $object['title'] = "Delivery Note";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

       // $data["skus"] = $this->mmodel->get_all('item_sku');
        //$data["unit_types"] = $this->mmodel->get_all('unit_types');
        $data["suppliers"] = $this->mmodel->get_all('suppliers');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $data["DN_id"] = $this->mmodel->generate_delivery_note_number();
        $data["order_list"] = $this->mmodel->get_order_list_for_del_note();
        $data["deliveries"] = $this->mmodel->get_all('delivery_note');
        

        $this->load->view('delivery_note_list',$data);
        $this->load->view('footer');
       // $this->load->view('js/item_createjs');
    }

    public function supplier_invoice($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "supplier_invoice";
        $object['title'] = "Supplier Invoice";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        //$data["skus"] = $this->mmodel->get_all('item_sku');
        //$data["unit_types"] = $this->mmodel->get_all('unit_types');
        $data["suppliers"] = $this->mmodel->get_all('suppliers');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $data["invoices"] = $this->mmodel->get_all('sup_invoice');

        $this->load->view('supplier_invoice',$data);
        $this->load->view('footer');
       // $this->load->view('js/item_createjs');
    }

    public function add_new_sup_invoice($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "supplier_invoice";
        $object['title'] = "Supplier Invoice";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        //$data["skus"] = $this->mmodel->get_all('item_sku');
        $data["stocks"] = $this->mmodel->get_all('stock');
        $data["suppliers"] = $this->mmodel->get_all('suppliers');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;
        $data["sup_inv_id"] = $this->mmodel->generate_sup_inv_id();
    


        $this->load->view('add_new_sup_invoice',$data);
        $this->load->view('footer');
       $this->load->view('js/add_new_sup_invoicejs');
    }

    public function order_list($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "order_list";
        $object['title'] = "Order";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        
        
        $data["orders"] = $this->mmodel->get_order_list();
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('order_list',$data);
        $this->load->view('footer');
       
    }

    public function add_new_order($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "add_new_order";
        $object['title'] = "New Order";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $data["items"] = $this->mmodel->get_all('item_master');
        //$data["unit_types"] = $this->mmodel->get_all('unit_types');
        $data["suppliers"] = $this->mmodel->get_all('suppliers');
        $data["order_id"] = $this->mmodel->generate_order_number();
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('add_new_order',$data);
        $this->load->view('footer');
        $this->load->view('js/new_orderjs');
    }


    public function purchase_order_report()
    {
        $object['controller'] = $this;
        $object['active_tab'] = "purchase_order_report";
        $object['title'] = "Kethmi Holding Hardware Stores";
        $this->load->view('report_header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $data["purchased_data"] = $this->mmodel->get_purchased_order_report($from, $to);
        $this->load->view('purchase_order_report',$data);
        $this->load->view('footer');
        $this->load->view('js/purchaseorderreportjs');
    }

    public function add_new_grn($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "add_new_grn";
        $object['title'] = "New GRN";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

       // $data["skus"] = $this->mmodel->get_all('item_sku');
        // $data["unit_types"] = $this->mmodel->get_all('unit_types');
        $data["suppliers"] = $this->mmodel->get_all('suppliers');
        $data["stocks"] = $this->mmodel->get_all('stock');
        $data["grn_id"] = $this->mmodel->generate_grn_number();
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('add_new_GRN',$data);
        $this->load->view('footer');
        $this->load->view('js/add_new_GRNjs');
    }


    // edit supplier need to remove

    public function edit_supplier($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "edit_supplier";
        $object['title'] = "edit_supplier";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        //$data["skus"] = $this->mmodel->get_all('item_sku');
        $data["unit_types"] = $this->mmodel->get_all('unit_types');
        $data["suppliers"] = $this->mmodel->get_all('suppliers');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('supplier_edit',$data);
        $this->load->view('footer');
       // $this->load->view('js/item_createjs');
    }

    public function add_stock($msg = "", $alert_type = "alert-success")
    {
        $object['controller'] = $this;
        $object['active_tab'] = "add_stock";
        $object['active_main_tab'] = "Inventory";
        $object['title'] = "CreateStock";
        $this->load->view('header', $object);
        $this->load->view('top_header');
        $this->load->view('side_menu');

        //$data["skus"] = $this->mmodel->get_all('item_sku');
        $data["stocks"] = $this->mmodel->get_all('stock');
        $data["msg"] = $msg;
        $data["alert_type"] = $alert_type;

        $this->load->view('stock_list', $data);
        $this->load->view('footer');
        $this->load->view('js/updateinventoryjs');
    }

}
