<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Model {

// 	public function getTbl_where($where,$order_by,$table)
// 	{
// 		$this->db->where($where);
// 		$this->db->order_by($order_by,'asc');
// 		return $this->db->get($table)->result_array();
// 	}


	public function EventCountdown($where,$order_by,$table)
	{
		$this->db->where($where);
		$this->db->order_by($order_by,'asc');
		$this->db->limit(20,0); 
		return $this->db->get($table)->result_array();
	}

	public function getData($where,$table){
		$this->db->where($where);
		return $this->db->get($table)->row();
	}

	public function select_table_where($where,$table)
	{
		$this->db->where($where);
		return $this->db->get($table)->result_array();
	}

	public function select_table_whereIn($where,$table)
	{
		$this->db->where_in($where);
		return $this->db->get($table)->result_array();
	}

	public function select_table($table)
	{
		return $this->db->get($table);
	}

	public function select_tableOrderBy($table,$name,$order)
	{
		$this->db->order_by($name,$order);
		return $this->db->get($table)->result();;

	}

	public function select_table_OrderBy($order_by,$table)
	{
		$this->db->select('*');
	    $this->db->from($table);
		$this->db->order_by($order_by['a'],$order_by['b']);
		return $this->db->get()->result_array(); 

	}

	public function select_table_OrderByApi($order_by,$table){
		$this->db->select('
			usr_fname,
			usr_mname,
			usr_lname,
			birth_date,
			usr_gender,
			usr_contact,
			usr_municipality,
			usr_occupation,
			usr_institution,
			usr_email,
			usr_sector,
			usr_sector_other,
			qrcode,
		');
	    $this->db->from($table);
		$this->db->order_by($order_by['a'],$order_by['b']);
		$this->db->limit(20,0);   
		return $this->db->get()->result_array(); 
	}


	public function select_table_whereOrderBy($where,$order_by,$table)
	{
		$this->db->where($where);
		$this->db->order_by($order_by['a'],$order_by['b']);
		return $this->db->get($table)->result();

	}

	// public function getWhereInData($where,$table){
	// 	$this->db->where_in($where);
	// 	return $this->db->get($table)->row();
	// }

	public function getTbl($table,$order_by,$order_asc_desc)
	{
		$this->db->order_by($order_by,$order_asc_desc);
		return $this->db->get($table)->result_array();
	}
	public function getTbl_where($where,$order_by,$table)
	{
		$this->db->where($where);
		$this->db->order_by($order_by,'desc');
		return $this->db->get($table)->result_array();
	}

	public function getTbl_where_($where,$order_by,$asc,$table)
	{
		$this->db->where($where);
		$this->db->order_by($order_by,$asc);
		return $this->db->get($table)->result_array();
	}

	public function insert($table,$data)
	{
		$this->db->insert($table,$data);

	}

	public function update_table($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function delete_table_where($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function ssp_all_posts_limit($limit,$start,$table)
	{
		$this->db->limit($limit,$start);
		return $this->db->get($table)->result();
	}

	public function ssp_post_search_limit($limit,$start,$like,$table)
	{
		$this->db->limit($limit,$start);
		$this->db->or_like($like);
		return $this->db->get($table)->result();
	}

	public function ssp_all_posts_where($where,$table)
	{
		$this->db->where($where);
		return $this->db->get($table)->result();
	}

	public function ssp_all_posts_where_limit($limit,$start,$where,$table)
	{
		$this->db->limit($limit,$start);
		$this->db->where($where);
		return $this->db->get($table)->result();
	}

	public function ssp_all_posts_like($table,$like)
	{
		$this->db->like($like,'both');
		return $this->db->get($table)->result();
	}

	public function ssp_all_posts_like_count($table,$like)
	{
		$this->db->like($like,'both');
		return $this->db->get($table)->num_rows();
	}

	public function ssp_all_posts_where_like($table,$where,$like)
	{
		$this->db->where($where);
		$this->db->like($like,'both');
		return $this->db->get($table)->result();
	}

	public function ssp_all_posts_join_orlike($table_1,$table_2,$join,$like)
	{
		$this->db->select('*');
	    $this->db->from($table_1);
	    $this->db->join($table_2,$join);
	    // $this->db->or_like($like);
	    $this->db->like($like);
	   return $this->db->get()->result();
	}

	public function ssp_all_posts_join($table_1,$table_2,$join)
	{
		$this->db->select('*');
	    $this->db->from($table_1);
	    $this->db->join($table_2,$join);
	   return $this->db->get()->result();
	}
	
	public function ssp_all_posts_join_where($table_1,$table_2,$join,$where)
	{
		$this->db->select('*');
	    $this->db->from($table_1);
	    $this->db->join($table_2,$join);
	    $this->db->where($where);
	   return $this->db->get()->row();
	}

	public function verify($where,$table)
	{
		$this->db->where($where);
		return $this->db->get($table)->num_rows();
	}


	public function if_logged_in()
	{
		if($this->session->user_id)
		{
			redirect(base_url('Home'));
		}
	}

	public function if_not_logged_in()
	{
		if(!$this->session->admin_id)
		{
			redirect(base_url('Admin'));
		}
	}


	public function three_join_where($select,$where,$join2,$join3,$limit,$start,$tbl,$tbl2,$tbl3){
		$this->db->select($select);
	    $this->db->from($tbl);
	    $this->db->join($tbl2,$join2,'left');
	    $this->db->join($tbl3,$join3,'left');
	    $this->db->where($where);
	    $retun_array['rows'] = $this->db->count_all_results('', false);;
    	$this->db->limit($limit,$start); 
        $retun_array['data'] =  $this->db->get()->result_array();
        return $retun_array;
	}


	public function three_join_where_like($select,$where,$join2,$join3,$limit,$start,$like,$tbl,$tbl2,$tbl3){
		$this->db->select($select);
	    $this->db->from($tbl);
	    $this->db->join($tbl2,$join2,'left');
	    $this->db->join($tbl3,$join3,'left');
	    $this->db->where($where);
	    $this->db->or_like($like);
	    $retun_array['rows'] = $this->db->count_all_results('', false);;
    	$this->db->limit($limit,$start); 
        $retun_array['data'] =  $this->db->get()->result_array();
        return $retun_array;
	}

	public function Sample(){
		$this->db->select('
			date_start
		');
	    $this->db->from('tbl_activities'); 
	    // $this->db->where($array);
	    $this->db->group_by('date_start');
	    $this->db->order_by('po_wo_num','asc');
	    return $this->db->get()->result_array();
	}
}