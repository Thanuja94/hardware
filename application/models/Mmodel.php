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

    public function get_invoice_details($id)
    {
        $result = $this->db->query(
            "SELECT
                ih.invoice_number, 
                ih.invoice_date, 
                il.item_code, 
                il.unit_price, 
                im.unit_type, 
                im.item_name, 
                sku.sku_code, 
                sku.sku_name, 
                il.discount,
                il.qty,
                il.total_price
            FROM
                invoice_header AS ih
                INNER JOIN
                invoice_lines AS il
                ON 
                    ih.id = il.invoice_id
                INNER JOIN
                item_master AS im
                ON 
                    il.item_code = im.item_code
                INNER JOIN
                item_sku AS sku
                ON 
                    im.item_sku_id = sku.id
                WHERE ih.id=$id"
        );
        return $result;
    }

    public function get_item_list()
    {
        $result = $this->db
            ->query("SELECT DISTINCT
                        item_master.item_code, 
                        item_master.item_name
                    FROM
                        inventory
                        INNER JOIN
                        item_master
                        ON 
                            inventory.item_id = item_master.id");

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
                                        im.re_order_level,   
                                        sku.sku_code,
                                        sku.sku_name,
                                        inv.qty,
                                        inv.purchased_price,
                                        inv.selling_price,
                                        inv.date_purchased 
                                    FROM
                                        inventory AS inv
                                        INNER JOIN item_master AS im ON inv.item_id = im.id
                                        INNER JOIN item_sku AS sku ON inv.item_sku_id = sku.id 
                                        AND im.item_sku_id = sku.id ";

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

    public function get_item_details_for_transaction($item_code)
    {

        return $this->db->query("
                    SELECT
                        im.item_code, 
                        im.item_name, 
                        im.unit_type, 
                        sku.sku_code, 
                        sku.sku_name, 
                        i.selling_price
                    FROM
                        item_master AS im
                        INNER JOIN
                        item_sku AS sku
                        ON 
                            im.item_sku_id = sku.id
                        INNER JOIN
                        inventory AS i
                        ON 
                            im.id = i.item_id AND
                            sku.id = i.item_sku_id
                    WHERE im.item_code='$item_code'
        ");
    }

    public function generate_invoice_number()
    {
        $invoice_number = "";

        $this->db->select("id");
        $this->db->from("invoice_header");
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

    public function save_transaction($header, $line_records)
    {

        if ($this->db->insert('invoice_header', $header)) {
            $invoice_id = $this->db->insert_id();

            foreach ($line_records as $lines) {
                $lines['invoice_id'] = $invoice_id;
                $this->db->insert('invoice_lines', $lines);
            }
            return $invoice_id;
        }
        return false;
    }

    public function get_sku_list($param)
    {

        return $this->db->query("select * from item_sku where sku_code like '%$param%' OR sku_name like '%$param%'");
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
        item_sku.sku_name, 
        invoice_header.customer_name, 
        invoice_header.invoice_date, 
        invoice_lines.unit_price, 
        invoice_lines.qty, 
        item_master.unit_type, 
        invoice_lines.total_price, 
        invoice_lines.discount
    FROM
        invoice_header
        INNER JOIN
        invoice_lines
        ON 
            invoice_header.id = invoice_lines.invoice_id
        INNER JOIN
        item_master
        ON 
            invoice_lines.item_code = item_master.item_code
        INNER JOIN
        item_sku
        ON 
            item_master.item_sku_id = item_sku.id AND
            item_master.item_sku_id = item_sku.id";

        if (isset($param_data['from']) && $from != '')
            $query .= " AND invoice_header.invoice_date >= '$from'";
        if (isset($param_data['to']) && $to != '')
            $query .= " AND invoice_header.invoice_date <= '$to'";
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
                        i.re_order_level, 
                        sku.sku_code, 
                        sku.sku_name, 
                        s.supplier_code, 
                        s.supplier_name, 
                        i.`status`
                    FROM
                        item_master AS i
                        INNER JOIN
                        item_sku AS sku
                        ON 
                            i.item_sku_id = sku.id
                        INNER JOIN
                        suppliers AS s
                        ON 
                            i.supplier_id = s.id
                    WHERE i.item_code LIKE '%$item_code%'        
                            ");
    }

    public function get_item_sales_history(){
        return $this->db->query("
                                    SELECT
                                        im.id, 
                                        im.item_code, 
                                        im.item_name, 
                                        SUM(il.qty) AS qty, 
                                        SUM(il.total_price) AS total_price, 
                                        im.unit_type,
                                        il.unit_price,
                                        sku.sku_code, 
                                        sku.sku_name
                                    FROM
                                        item_master AS im
                                        INNER JOIN
                                        item_sku AS sku
                                        ON 
                                            im.item_sku_id = sku.id
                                        INNER JOIN
                                        invoice_lines AS il
                                        ON 
                                            il.item_code = im.item_code
                                        GROUP BY
                                        im.id, 
                                        im.item_code, 
                                        im.item_name, 
                                        il.unit_price, 
                                        im.unit_type, 
                                        sku.sku_code, 
                                        sku.sku_name
        ");
    }

    public function get_inventory_report(){

        return $this->db->query(
            "SELECT
                im.id, 
                im.item_code, 
                im.item_name, 
                im.unit_type, 
                sku.sku_code, 
                sku.sku_name, 
                SUM(i.qty) as qty, 
                i.selling_price, 
                im.re_order_level
            FROM
                item_master AS im
                INNER JOIN
                item_sku AS sku
                ON 
                    im.item_sku_id = sku.id
                INNER JOIN
                inventory AS i
                ON 
                    im.id = i.item_id AND
                    sku.id = i.item_sku_id
            GROUP BY
                im.id, 
                im.item_code, 
                im.item_name, 
                im.unit_type, 
                sku.sku_code, 
                sku.sku_name, 
                i.selling_price, 
                im.re_order_level"
        );
    }

    public function get_items_for_chart(){

        $item_names = [];
        $item_sales = [];

        $res = $this->db->query(
                            "SELECT 
                                im.item_code,
                                im.item_name,
                                SUM( il.qty ) AS qty 
                            FROM
                                item_master AS im
                                INNER JOIN invoice_lines AS il ON im.item_code = il.item_code 
                            GROUP BY
                                im.item_code,
                                im.item_name 
                            ORDER BY
                                SUM( il.qty ) DESC 
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
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice_header AS ih WHERE MONTH ( ih.invoice_date )= 1 ) AS m1,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice_header AS ih WHERE MONTH ( ih.invoice_date )= 2 ) AS m2,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice_header AS ih WHERE MONTH ( ih.invoice_date )= 3 ) AS m3,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice_header AS ih WHERE MONTH ( ih.invoice_date )= 4 ) AS m4,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice_header AS ih WHERE MONTH ( ih.invoice_date )= 5 ) AS m5,
            ( SELECT IFNULL( SUM( ih.net_total ), 0 ) FROM invoice_header AS ih WHERE MONTH ( ih.invoice_date )= 6 ) AS m6 
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
        SELECT IFNULL( SUM( ih.net_total ), 0 ) as sales FROM invoice_header AS ih WHERE MONTH ( ih.invoice_date )= 5
        ");

        $data['total_sales'] = $res->row()->sales;

        $res = $this->db->query("
            SELECT COUNT(*) as total_items FROM item_master WHERE MONTH(last_modified_at) =5 and status=1
        ");

        $data['total_items'] = $res->row()->total_items;

        $res = $this->db->query("
            SELECT COUNT(*) as invoices FROM invoice_header WHERE MONTH(last_modified_at) =5 
        ");

        $data['total_invoices'] = $res->row()->invoices;

        return $data;
    }

}
