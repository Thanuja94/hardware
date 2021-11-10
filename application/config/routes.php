<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['inventory'] = 'dashboard/inventory';
$route['item_create'] = 'dashboard/item_create';
$route['item_list'] = 'dashboard/item_list';
$route['salesreport'] = 'dashboard/salesreport';
$route['inventoryreport'] = 'dashboard/inventoryreport';
$route['itemupdate'] = 'dashboard/add_items_inventory';
$route['load_invoice_list'] = 'dashboard/invoicelist';
$route['load_invoiceModal_list'] = 'dashboard/myModal';
$route['itemsaleshistory'] = 'dashboard/itemsaleshistory';
$route['save_item'] = 'dashboard/save_item';
$route['load_salestransaction'] = 'dashboard/salestransaction';
$route['save_transaction'] = 'dashboard/save_transaction';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['invoice'] = 'dashboard/create_invoice';
$route['sales_history'] = 'dashboard/SalesHistory';
$route['add_sku'] = 'dashboard/add_sku';
$route['save_sku'] = 'dashboard/save_sku';
$route['view_sku'] = 'dashboard/view_sku';
$route['save_item_inventory'] = 'dashboard/save_item_inventory';
$route['suppliers'] = 'dashboard/suppliers';
$route['save_suppliers'] = 'dashboard/save_suppliers';
$route['save_stock'] = 'dashboard/save_stock';
$route['GRN'] = 'dashboard/view_GRN';
$route['delivery_note'] = 'dashboard/delivery_note';
$route['supplier_invoice'] = 'dashboard/supplier_invoice';
$route['add_new_sup_invoice'] = 'dashboard/add_new_sup_invoice';
$route['order_list'] = 'dashboard/order_list';
$route['add_new_order'] = 'dashboard/add_new_order';
$route['purchase_order_report'] = 'dashboard/purchase_order_report';
$route['add_new_grn'] = 'dashboard/add_new_grn';
$route['add_stock'] = 'dashboard/add_stock';
$route['get_stocks_for_item'] = 'dashboard/get_stocks_for_item';
$route['save_order'] = 'dashboard/save_order';
$route['update_order_status_approve'] = 'dashboard/update_order_status_approve';
$route['update_order_status_reject'] = 'dashboard/update_order_status_reject';
$route['get_items_for_stocks'] = 'dashboard/get_items_for_stocks';


// need to remove
$route['edit_supplier'] = 'dashboard/edit_supplier';

//ajax routes
$route['get_item_details'] = 'dashboard/get_item_details';
$route['get_item_details_for_order'] = 'dashboard/get_item_details_for_order';
$route['get_item_details_for_grn'] = 'dashboard/get_item_details_for_grn';