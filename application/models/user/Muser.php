<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

date_default_timezone_set("Asia/Colombo");

class Muser extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_sys_user_list()
    {
        $this->db->select('sys_user.user_id,sys_user.username,sys_user_group.user_group,sys_user.name,sys_user.email,sys_user.status_id');
        $this->db->from('sys_user');
        $this->db->join('sys_user_group', 'sys_user_group.user_group_id = sys_user.user_group_id');
        return $this->db->get();

    }

    public function get_user_details($user_id)
    {
        $this->db->select('sys_user.*,sys_user_group.*,0 AS restaurant_details,0 AS hotel_details,0 AS pendings');
        $this->db->from('sys_user');
        $this->db->join('sys_user_group', 'sys_user_group.user_group_id = sys_user.user_group_id');
        $this->db->where('sys_user.user_id', $user_id);
        $results = $this->db->get()->result();
        foreach ($results as $data) {
            $this->db->select('business_partners.*,0 AS image_path');
            $this->db->from('business_partners');
            $this->db->where('business_partners.sys_user_id', $user_id);
            $this->db->where('business_partners.business_type_id', BUSINESS_RESTAURANT);
            $this->db->where("(status_id = " . ACTIVE . " OR status_id = " . DEACTIVE . ")", null, false);
            $data->restaurant_details = $this->db->get()->result();
            foreach ($data->restaurant_details as $details) {
                $details->image_path = array();
                $this->db->select('*');
                $this->db->from('media_links');
                $this->db->where('media_links.business_id', $details->business_id);
                $this->db->where('media_links.media_category_id', IMG_LOGO);
                $details->image_path = $this->db->get()->result();
            }

            $this->db->select('business_partners.*,0 AS image_path');
            $this->db->from('business_partners');
            $this->db->where('business_partners.sys_user_id', $user_id);
            $this->db->where('business_partners.business_type_id', BUSINESS_HOTEL);
            $this->db->where("(status_id = " . ACTIVE . " OR status_id = " . DEACTIVE . ")", null, false);
            $data->hotel_details = $this->db->get()->result();
            foreach ($data->restaurant_details as $details) {
                $this->db->select('*');
                $this->db->from('media_links');
                $this->db->where('media_links.business_id', $details->business_id);
                $this->db->where('media_links.media_category_id', IMG_LOGO);
                $details->image_path = $this->db->get()->result();
            }

            $this->db->select('business_partners.*,business_types.*,0 AS image_path');
            $this->db->from('business_partners');
            $this->db->where('business_partners.sys_user_id', $user_id);
            $this->db->join('business_types', 'business_partners.business_type_id = business_types.business_type_id');
            $this->db->where('business_partners.status_id', PENDING);
            $data->pendings = $this->db->get()->result();
            foreach ($data->restaurant_details as $details) {
                $this->db->select('*');
                $this->db->from('media_links');
                $this->db->where('media_links.business_id', $details->business_id);
                $this->db->where('media_links.media_category_id', IMG_LOGO);
                $details->image_path = $this->db->get()->result();
            }

        }
        return $results;
    }
    public function get_sys_user_user_group()
    {
        $this->db->select('*');
        $this->db->from('sys_user_group');
        return $this->db->get();
    }
    public function check_valide_username($username_input_text)
    {
        $this->db->select('username');
        $this->db->from('sys_user');
        $this->db->where('username', $username_input_text);

        if ($this->db->get()->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }

    }
    public function addnew_sys_user($post_data)
    {
        if ($this->db->insert('sys_user', $post_data)) {
            return true;
        } else {
            return false;
        }

    }
    public function get_edit_user($edit_user_id)
    {
        $this->db->select('*');
        $this->db->from('sys_user');
        $this->db->where('user_id', $edit_user_id);
        $query = $this->db->get();
        return $query;
    }

    public function update_sys_user($post_data, $edit_user_id)
    {
        $post_data['password'] = md5($post_data['password']);
        $this->db->where('user_id', $edit_user_id);
        $this->db->update('sys_user', $post_data);
        return $this->db->last_query();

        return true;
    }

    public function get_all_order($table, $order)
    {
        $this->db->order_by($order);
        return $this->db->get($table);

    }
    public function get_where($column, $table, $common, $id)
    {
        $this->db->select($column);
        $this->db->from($table);
        $this->db->where($common, $id);
        return $this->db->get();
    }
    public function get_all($table)
    {
        return $this->db->get($table);
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function get_where_2($column, $table, $common, $id, $common_2, $id_2)
    {
        $this->db->select($column);
        $this->db->from($table);
        $this->db->where($common, $id);
        $this->db->where($common_2, $id_2);
        return $this->db->get();
    }
    public function delete_where($table, $column, $value)
    {
        $this->db->where($column, $value);
        $this->db->delete($table);
    }
    public function update($column, $id, $table, $data)
    {
        $this->db->where($column, $id);
        $this->db->update($table, $data);
    }
    public function add_new_group($post_data)
    {
        $this->db->insert('sys_user_group', $post_data);
        $insert_id = $this->db->insert_id();
        $this->db->set('sys_user_group_id', $insert_id);
        $this->db->where('user_group_id', $insert_id);
        $this->db->update('sys_user_group');

    }

    public function get_user_list()
    {
        $this->db->select('*,0 AS user_details');
        $this->db->from('sys_user');
        $this->db->where('user_group_id', HOTEL_ADMIN);
        $query = $this->db->get()->result();
        foreach ($query as $user) {
            $user->user_details = $this->get_user_summery($user->user_id)[0];
        }
        return $query;
    }

	public function query($query)
	{
		return $this->db->query($query);
	}
}
