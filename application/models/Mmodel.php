<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function query($query)
    {
        return $this->db->query($query);
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return ($this->db->affected_rows() >= 0);
    }

    public function get_all($table)
    {
        $result = $this->db
            ->select("*")
            ->from($table)
            ->get();

        return $result;
    }

    public function get_all_by_id($table, $id)
    {
        $result = $this->db
            ->select("*")
            ->from($table)
            ->where('id', $id)
            ->get();

        return $result;
    }

    public function get_where_count($table, $where)
    {

        $res = $this->db
            ->select('*')
            ->from($table)
            ->where($where)
            ->get();

        return $res->num_rows();
    }

    public function get_all_where($table, $where)
    {
        $result = $this->db
            ->select("*")
            ->from($table)
            ->where($where)
            ->get();

        return $result;
    }

    public function get_customer_by_id($table, $id)
    {
        $result = $this->db
            ->select("*")
            ->from($table)
            ->where('cus_id', $id)
            ->get();

        return $result;
    }

    public function get_invoice_details($id)
    {
        $result = $this->db->query(
            "SELECT
                ih.invoice_id, 
                ih.invoice_date, 
                il.item_code, 
                il.unit_price, 
                im.unit_type, 
                im.item_name, 
                im.item_group, 
                il.discount,
                il.item_qty,
                il.total_price
            FROM
                customer 
                INNER JOIN 
                invoice AS ih
                ON
                customer.cus_id = ih.cus_id
                INNER JOIN
                invoice_details AS il
                ON 
                    ih.id = il.invoice_id
                INNER JOIN
                item_master AS im
                ON 
                    il.item_code = im.item_code
                
                WHERE ih.id=$id"
        );
        return $result;
    }

    public function get_item_groups()
    {
        $result = $this->db
            ->query("SELECT DISTINCT item_group from item_master ");

        return $result;
    }
    
    public function get_item_list()
    {
        $result = $this->db
            ->query("SELECT DISTINCT
                        item_master.item_code, 
                        item_master.item_name
                    FROM
                    stock_details
                        INNER JOIN
                        item_master
                        ON 
                        stock_details.item_id = item_master.id");

        return $result;
    }

    public function get_customer_details()
    {
        $result = $this->db
            ->select("*")
            ->from('item_master')
            ->get();

        return $result;
    }

    public function get_inventory($param_data)
    {

        $from = $param_data["from"];
        $to = $param_data["to"];
        $type = $param_data["search_by"];
        $param = $param_data["param"];
        $param2 = $param_data["param2"];

        $query = "
                                    SELECT
                                        im.item_code,
                                        im.item_name,
                                        im.unit_type,   
                                        im.item_group,   
                                        sto.qty,
                                        sto.purchased_price,
                                        sto.selling_price,
                                        sto.purchase_date,
                                        sto.stock_id,
                                        sto.remaining_qty
                                    FROM
                                    stock_details AS sto
                                        INNER JOIN item_master AS im ON sto.item_id = im.id ";

        if (($param_data['from'] !=''))
            $query .= " AND inv.date_purchased >= '$from'";
        if (($param_data['to'] !=''))
            $query .= " AND inv.date_purchased <= '$to'";
        if (isset($type) && $type == 'price')
            $query .= " AND inv.selling_price LIKE '%$param2%'";
        if (isset($type) && $type == 'item')
            $query .= " AND im.item_code LIKE '%$param%'";

        $result = $this->db->query($query);

        return $result;
    }

    public function get_item_details_for_transaction($item_code,$stock_id)
    {

        return $this->db->query("
                    SELECT
                        im.item_code, 
                        im.item_name, 
                        im.unit_type, 
                        im.item_group,
                        i.stock_id,
                        i.selling_price
                    FROM
                        item_master AS im
                        
                        INNER JOIN
                        stock_details AS i
                        ON 
                            im.id = i.item_id 
                            
                    WHERE im.item_code='$item_code' and i.stock_id = '$stock_id'
        ");
    }

    public function get_item_details_for_new_order($item_code)
    {

        return $this->db->query("
                    SELECT
                        im.item_code, 
                        im.item_name, 
                        im.item_group
                        
                    FROM
                        item_master AS im
                                               
                    WHERE im.item_code='$item_code'
        ");
    }
    public function get_stock_remaining($item_code, $stock_id)
    {

        return $this->db->query("
            SELECT  
                sd.remaining_qty
            FROM 
                stock_details as sd
            INNER JOIN 
                item_master as i
            ON 
                i.id = sd.item_id
            WHERE 
                sd.stock_id = '$stock_id'
            AND i.item_code = '$item_code'
        ");
    }

    public function get_item_details_for_new_grn($item_code,$stock_id)
    {

        return $this->db->query("
                SELECT 
                    s.stock_id,
                    i.item_code,
                    i.item_name,
                    i.item_group
                    
                FROM
                    item_master as i
                INNER JOIN
                stock_details as s
                ON
                    i.id = s.item_id
                WHERE
                i.item_code = '$item_code' AND
                s.stock_id = '$stock_id'
        ");
    }
    public function get_item_details_for_new_sup_inv($item_code,$stock_id)
    {

        return $this->db->query("
                SELECT 
                    s.stock_id,
                    i.item_code,
                    i.item_name,
                    i.item_group,
                    s.purchased_price

                FROM
                    item_master as i
                INNER JOIN
                stock_details as s
                ON
                    i.id = s.item_id
                WHERE
                i.item_code = '$item_code' AND
                s.stock_id = '$stock_id'
        ");
    }


    public function get_order_list()
    {

        return $this->db->query("
        SELECT 
            ordr.id,
		    ordr.order_id, 
		    date(ordr.order_date) AS order_date, 
		    apr.supplier_id,
            apr.`status`
        FROM 
		    `hardware`.`order` AS ordr
        INNER JOIN 
		    approve AS apr 
        ON
	        ordr.order_id = apr.order_id
        ");
    }

    public function get_order_list_for_del_note()
    {

        return $this->db->query("
        Select 
            approve.order_id 
        FROM 
            approve 
        Where 
            order_id 
        NOT IN
                 (SELECT 
                        approve.order_id 
                    FROM 
                        approve 
                    INNER JOIN  
                        delivery_note 
                    ON
                        approve.order_id = delivery_note.order_id
                    WHERE
                        `status` =1) 
        And 
            `status` =1

        ");
    }

    public function update_order_status($status,$order_id)
    {

        return $this->db->query("
        UPDATE `hardware`.`approve` SET `status` = '$status' WHERE `order_id` = '$order_id'
        ");
    }

    public function generate_invoice_number()
    {
        $invoice_number = "";

        $this->db->select("id");
        $this->db->from("invoice");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $invoice_number = "INV0000" . $rowcount;
        else if ($rowcount < 100) $invoice_number = "INV000" . $rowcount;
        else if ($rowcount < 1000) $invoice_number = "INV00" . $rowcount;
        else if ($rowcount < 10000) $invoice_number = "INV0" . $rowcount;
        else $invoice_number = "INV" . $invoice_number;


        return $invoice_number;
    }


    public function generate_supplier_number()
    {
        $supplier_number = "";

        $this->db->select("id");
        $this->db->from("suppliers");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $supplier_number = "SUPP0000" . $rowcount;
        else if ($rowcount < 100) $supplier_number = "SUPP000" . $rowcount;
        else if ($rowcount < 1000) $supplier_number = "SUPP00" . $rowcount;
        else if ($rowcount < 10000) $supplier_number = "SUPP0" . $rowcount;
        else $supplier_number = "SUPP" . $supplier_number;


        return $supplier_number;
    }

    public function generate_order_number()
    {
        $order_number = "";

        $this->db->select("id");
        $this->db->from("order");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $order_number = "ORD0000" . $rowcount;
        else if ($rowcount < 100) $order_number = "ORD000" . $rowcount;
        else if ($rowcount < 1000) $order_number = "ORD00" . $rowcount;
        else if ($rowcount < 10000) $order_number = "ORD0" . $rowcount;
        else $order_number = "ORD" . $order_number;


        return $order_number;
    }

    public function generate_grn_number()
    {
        $grn_number = "";

        $this->db->select("id");
        $this->db->from("grn");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $grn_number = "GRN0000" . $rowcount;
        else if ($rowcount < 100) $grn_number = "GRN000" . $rowcount;
        else if ($rowcount < 1000) $grn_number = "GRN00" . $rowcount;
        else if ($rowcount < 10000) $grn_number = "GRN0" . $rowcount;
        else $grn_number = "GRN" . $grn_number;


        return $grn_number;
    }
    public function generate_sup_inv_id()
    {
        $sup_inv_id = "";

        $this->db->select("id");
        $this->db->from("sup_invoice");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $sup_inv_id = "SINV0000" . $rowcount;
        else if ($rowcount < 100) $sup_inv_id = "SINV000" . $rowcount;
        else if ($rowcount < 1000) $sup_inv_id = "SINV00" . $rowcount;
        else if ($rowcount < 10000) $sup_inv_id = "SINV0" . $rowcount;
        else $sup_inv_id = "SINV" . $sup_inv_id;


        return $sup_inv_id;
    }

    public function generate_item_number()
    {
        $invoice_number = "";

        $this->db->select("id");
        $this->db->from("item_master");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $invoice_number = "ITM0000" . $rowcount;
        else if ($rowcount < 100) $invoice_number = "ITM000" . $rowcount;
        else if ($rowcount < 1000) $invoice_number = "ITM00" . $rowcount;
        else if ($rowcount < 10000) $invoice_number = "ITM0" . $rowcount;
        else $invoice_number = "ITM" . $invoice_number;

        return $invoice_number;
    }

    public function generate_stock_number()
    {
        $stock_number = "";

        $this->db->select("id");
        $this->db->from("stock");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $stock_number = "STO0000" . $rowcount;
        else if ($rowcount < 100) $stock_number = "STO000" . $rowcount;
        else if ($rowcount < 1000) $stock_number = "STO00" . $rowcount;
        else if ($rowcount < 10000) $stock_number = "STO0" . $rowcount;
        else $stock_number = "STO" . $stock_number;

        return $stock_number;
    }
    public function generate_delivery_note_number()
    {
        $DN_number = "";

        $this->db->select("id");
        $this->db->from("delivery_note");
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $result = $this->db->get();
        if ($result->num_rows() == 0)
            $rowcount = 0;
        else {
            $rowcount = $result->row()->id;
        }
        $rowcount++;
        if ($rowcount < 10) $DN_number = "DN0000" . $rowcount;
        else if ($rowcount < 100) $DN_number = "DN000" . $rowcount;
        else if ($rowcount < 1000) $DN_number = "DN00" . $rowcount;
        else if ($rowcount < 10000) $DN_number = "DN0" . $rowcount;
        else $DN_number = "DN" . $DN_number;

        return $DN_number;
    }

    public function save_transaction($header, $line_records,$customer)
    {

        if($this->db->insert('customer', $customer)){
            $customer_id = $this->db->insert_id();
            $header['cus_id'] = $customer_id;

            if ($this->db->insert('invoice', $header)) {
                $invoice_id = $this->db->insert_id();
    
                foreach ($line_records as $lines) {
                    $lines['invoice_id'] = $invoice_id;
                    
                    
                    $stocks['stock_id'] = $lines['stock_id'];
                    $stocks['invoice_id'] = $header['invoice_id'];
                    
                    $qty = $lines["item_qty"];
                    $stock_id  = $lines['stock_id'];
                    $item_id  = $lines['item_code'];

                    $query = "UPDATE stock_details
                    SET remaining_qty = remaining_qty - $qty
                    WHERE stock_id = '$stock_id' and item_id = (SELECT id from item_master where item_code = '$item_id')";
                    // var_dump($query);
                    $this->db->query($query);

                    unset($lines['stock_id']);
                    $this->db->insert('invoice_details', $lines);
                    $this->db->insert('invoice_stock_details', $stocks);
                }
                return $invoice_id;
                
                
            }   
        }
       
       
        return false;
        
    }
    public function save_order($order, $line_records,$approve)
    {

        if($this->db->insert('order', $order)){
            $order_id = $this->db->insert_id();
            $order_no= $order['order_id'];

            $this->db->insert('approve', $approve);
    
                foreach ($line_records as $lines) {
                    $lines['order_id'] = $order_no;
                    $this->db->insert('order_details', $lines);
                }

                return $order_id;
                
                
             
        }
       
       
        return false;
        
    }
    public function save_grn($grn, $line_records)
    {

        if($this->db->insert('grn', $grn)){
            $id = $this->db->insert_id();
            $grn_id= $grn['grn_id'];

            
    
                foreach ($line_records as $lines) {
                    $lines['grn_id'] = $grn_id;
                    $this->db->insert('grn_details', $lines);
                }

                return $id;
                
                
             
        }
       
       
        return false;
        
    }
    public function save_sup_invoice($sup_inv, $line_records)
    {

        if($this->db->insert('sup_invoice', $sup_inv)){
            $id = $this->db->insert_id();
            $sup_inv_id= $sup_inv['sup_inv_id'];

            
    
                foreach ($line_records as $lines) {
                    $lines['sup_inv_id'] = $sup_inv_id;
                    $this->db->insert('sup_invoice_details', $lines);
                }

                return $id;
                
                
             
        }
       
       
        return false;
        
    }

    public function get_sku_list($param)
    {

        return $this->db->query("select * from item_sku where sku_code like '%$param%' OR sku_name like '%$param%'");
    }

    public function get_stock_list_by_item($item_code)
    {

        return $this->db->query("select distinct
        stock_id 
        FROM 
        stock_details AS itstock 
        INNER JOIN 
        item_master AS im 
        ON 
        itstock.item_id = im.id
        
        WHERE im.item_code = '$item_code'")->result();
    }

    public function get_item_list_by_stock($stock_id)
    {

        return $this->db->query("SELECT 
        i.item_code,
        i.item_name,
        i.item_group
        
        FROM
        item_master as i
        INNER JOIN
        stock_details as s
        ON
        i.id = s.item_id
        WHERE
        s.stock_id = '$stock_id'")->result();
    }

    public function get_salesHistory_table($param_data)
    {

        $from = $param_data["from"];
        $to = $param_data["to"];
        //$type = $param_data["search_by"];
        // $type = $param_data["item_code"];
        $param = $param_data["item_code"];

        $query = "SELECT
        item_master.item_code, 
        item_master.item_name, 
        item_master.item_group, 
        customer.customer_name,
        invoice.invoice_date, 
        invoice_details.unit_price, 
        invoice_details.item_qty, 
        item_master.unit_type, 
        invoice_details.total_price, 
        invoice_details.discount
    FROM
    customer 
    INNER JOIN
        invoice
        ON customer.cus_id = invoice.cus_id
        INNER JOIN
        invoice_details
        ON 
            invoice.id = invoice_details.invoice_id
        INNER JOIN
        item_master
        ON 
        invoice_details.item_code = item_master.item_code
        ";

        if (isset($param_data['from']) && $from != '')
            $query .= " AND invoice.invoice_date >= '$from'";
        if (isset($param_data['to']) && $to != '')
            $query .= " AND invoice.invoice_date <= '$to'";
        if (isset($param_data["item_code"]))
            $query .= " AND item_master.item_code = '$param' ";

        // die($query);


        $result = $this->db->query($query);
        // var_dump($result->result());
        return $result;
    }

    public function get_item_codes()
    {
        $query = "SELECT
        item_master.item_code
    FROM
        item_master";

        $result = $this->db->query($query);
        // var_dump($result->result());
        return $result;
    }

    public function get_items($item_code=''){

        return $this->db
            ->query("SELECT
                        i.item_code, 
                        i.item_name, 
                        i.unit_type, 
                        i.item_group,
                        s.supplier_id, 
                        s.supplier_name, 
                        i.`status`
                    FROM
                        item_master AS i
                        INNER JOIN
                        suppliers AS s
                        ON 
                            i.supplier_id = s.id
                    WHERE i.item_code LIKE '%$item_code%'        
                            ");
    }

    public function get_item_sales_history($from = '', $to =''){

        if($from && $to){
            return $this->db->query("
            SELECT
                im.id, 
                im.item_code, 
                im.item_name, 
                SUM(il.item_qty) AS qty, 
                SUM(il.total_price) AS total_price, 
                im.unit_type,
                il.unit_price,
                im.item_group
            
             FROM
                 item_master AS im
            INNER JOIN
                 invoice_details AS il
            ON 
                il.item_code = im.item_code
            INNER JOIN 
                invoice AS i
            ON
                i.id = il.invoice_id

            WHERE i.invoice_date between '$from' and '$to'    
            GROUP BY
                im.id, 
                im.item_code, 
                im.item_name, 
                il.unit_price, 
                im.unit_type,
                im.item_group 
            
                                        
        ");

        }
        return $this->db->query("
            SELECT
                im.id, 
                im.item_code, 
                im.item_name, 
                SUM(il.item_qty) AS qty, 
                SUM(il.total_price) AS total_price, 
                im.unit_type,
                il.unit_price,
                im.item_group
            
             FROM
                 item_master AS im
            INNER JOIN
                 invoice_details AS il
            ON 
                il.item_code = im.item_code
            INNER JOIN 
                invoice AS i
            ON
                i.id = il.invoice_id

              
            GROUP BY
                im.id, 
                im.item_code, 
                im.item_name, 
                il.unit_price, 
                im.unit_type,
                im.item_group 
            
                                        
        ");
        
    }

    public function get_inventory_report($from = '', $to =''){

        if($from && $to){
            return $this->db->query(
                "SELECT
                im.id, 
                im.item_code, 
                im.item_name, 
                im.unit_type, 
                im.item_group,
                SUM(sd.qty) as qty, 
                sd.selling_price 
                
            FROM
                item_master AS im
                
                INNER JOIN
                stock_details AS sd
                ON 
                    im.id = sd.item_id 
                                INNER JOIN 
                                        stock as s
                                        ON 
                                        sd.stock_id = s.stock_id
                                        WHERE s.purchase_date between '$from' and '$to' 
            GROUP BY
                im.id, 
                im.item_code, 
                im.item_name, 
                im.unit_type, 
                im.item_group,
                sd.selling_price 
                
                    "
            );
        }

        return $this->db->query(
            "SELECT
            im.id, 
            im.item_code, 
            im.item_name, 
            im.unit_type, 
            im.item_group,
            SUM(sd.qty) as qty, 
            sd.selling_price 
            
        FROM
            item_master AS im
            
            INNER JOIN
            stock_details AS sd
            ON 
                im.id = sd.item_id 
                            INNER JOIN 
                                    stock as s
                                    ON 
                                    sd.stock_id = s.stock_id
                                    
        GROUP BY
            im.id, 
            im.item_code, 
            im.item_name, 
            im.unit_type, 
            im.item_group,
            sd.selling_price 
            
                "
        );
    }
    public function get_purchased_order_report($from = '', $to =''){


        if($from && $to){
            return $this->db->query(
                "
                SELECT 
                    sid.item_code,
                    im.item_name,
                    im.item_group,
                    im.unit_type,
                    sid.unit_price,
                    sid.item_qty,
                    si.supplier_id,
                    sid.total_price
                
                FROM
                     sup_invoice_details as sid
                INNER JOIN 
                    item_master as im
                ON
                    sid.item_code = im.item_code
                INNER JOIN 
                    sup_invoice as si
                 ON
                    sid.sup_inv_id = si.sup_inv_id
                WHERE si.invoice_date between '$from' and '$to'
                "
            );
        }
        return $this->db->query(
            "
            SELECT 
                sid.item_code,
                im.item_name,
                im.item_group,
                im.unit_type,
                sid.unit_price,
                sid.item_qty,
                si.supplier_id,
                sid.total_price
            
            FROM
                 sup_invoice_details as sid
            INNER JOIN 
                item_master as im
            ON
                sid.item_code = im.item_code
            INNER JOIN 
                sup_invoice as si
             ON
                sid.sup_inv_id = si.sup_inv_id
                "
        );
    }

    public function get_items_for_chart(){

        $item_names = [];
        $item_sales = [];

        $res = $this->db->query(
                            "SELECT 
                                im.item_code,
                                im.item_name,
                                SUM( il.item_qty ) AS qty 
                            FROM
                                item_master AS im
                                INNER JOIN invoice_details AS il ON im.item_code = il.item_code 
                            GROUP BY
                                im.item_code,
                                im.item_name 
                            ORDER BY
                                SUM( il.item_qty ) DESC 
                                LIMIT 7");

        foreach ($res->result() as $items){
            $item_names[] = $items->item_code;
            $item_sales[] = $items->qty;
        }

        return array("names" => $item_names, "values" => $item_sales);

    }

    public function get_sales_history_for_chart(){

       $res= $this->db->query("
        SELECT
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice AS ih WHERE MONTH ( ih.invoice_date )= 1 ) AS m1,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice AS ih WHERE MONTH ( ih.invoice_date )= 2 ) AS m2,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice AS ih WHERE MONTH ( ih.invoice_date )= 3 ) AS m3,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice AS ih WHERE MONTH ( ih.invoice_date )= 4 ) AS m4,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice AS ih WHERE MONTH ( ih.invoice_date )= 5 ) AS m5,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice AS ih WHERE MONTH ( ih.invoice_date )= 6 ) AS m6 
        FROM
        DUAL
        ");

        $data[] = $res->row()->m1;
        $data[] = $res->row()->m2;
        $data[] = $res->row()->m3;
        $data[] = $res->row()->m4;
        $data[] = $res->row()->m5;
        $data[] = $res->row()->m6;

        return $data;
    }

    public function get_data_for_dashboard(){

        $res = $this->db->query("
        SELECT IFNULL( SUM( ih.net_total ), 0 ) as sales FROM invoice AS ih WHERE MONTH ( ih.invoice_date )= 5
        ");

        $data['total_sales'] = $res->row()->sales;

        $res = $this->db->query("
            SELECT COUNT(*) as total_items FROM item_master WHERE MONTH(last_modified_at) =5 and status=1
        ");

        $data['total_items'] = $res->row()->total_items;

        $res = $this->db->query("
            SELECT COUNT(*) as invoices FROM invoice WHERE MONTH(last_modified_at) =5 
        ");

        $data['total_invoices'] = $res->row()->invoices;

        return $data;
    }

}