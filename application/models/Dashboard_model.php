<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard_model extends CI_Model {





	public function insert($table,$data)

	{

		$this->db->insert($table,$data);

	}

	public function verify($where,$table)

	{

		$this->db->where($where);

		return $this->db->get($table)->num_rows();

	}

	public function getData($where,$table){

		$this->db->where($where);

		return $this->db->get($table)->row();

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

	public function select_table($table)

	{

		return $this->db->get($table);

	}



	// public function getTbl($table){

	// 	return $this->db->get($table)->result_array();

	// }



	public function getTbl($table,$order_by,$order_asc_desc)

	{

		$this->db->order_by($order_by,$order_asc_desc);

		return $this->db->get($table)->result_array();

	}



	public function select_table_join($col, $table, $join, $joinTable, $where){

		$query = $this->db->select($col)

			->from($table)

			->join($joinTable, $join, 'LEFT')

			->where($where)

			->get();

		return $query->result_array();

	}

	

	public function EmployeeRecordsAttendanceReport($where){

		$this->db->select('

			a.date,

			a.time,

			b.usr_fname,

			b.usr_mname,

			b.usr_lname,

			b.usr_email,

			b.birth_date,

			b.usr_gender,

			b.usr_contact,

			b.usr_occupation,

			b.usr_institution,

			b.usr_municipality,

			b.date_created,

			b.usr_sector,

			b.usr_sector_other,

		');

		$this->db->from('attendance a');

	    $this->db->join('usr_table b','b.qrcode = a.qrcode');

	    $this->db->where($where);

	    $this->db->order_by('a.id','asc');

	    return $this->db->get()->result_array();

	}



	public function EmployeeRecordsAttendance($where){

		$this->db->select('

			a.date,

			a.time,

			b.usr_fname,

			b.usr_mname,

			b.usr_lname

		');

		$this->db->from('attendance a');

	    $this->db->join('usr_table b','b.qrcode = a.qrcode');

	    $this->db->where($where);

	    $this->db->order_by('a.time','desc');

	    return $this->db->get()->result_array();

	}

	

	public function SearchEmployee($array){

		$this->db->select('

			a.date,

			a.time,

			b.usr_fname,

			b.usr_mname,

			b.usr_lname

		');

		$this->db->from('attendance a');

	    $this->db->join('usr_table b','b.qrcode = a.qrcode');

	    $this->db->where('a.event_id', $array['event_id']);



	    if ($array['date'] != '') {

	    	$this->db->where('a.date', $array['date']);

	    }



	    if ($array['qrcode'] != '') {

	    	$this->db->where('a.qrcode', $array['qrcode']);

	    }



	    $this->db->order_by('a.date','desc');

	    return $this->db->get()->result_array();

	}



	public function select_table_where($where, $table){

		$this->db->where($where);

		return $this->db->get($table)->result_array();

	}



	public function select_table_OrderBy($order_by,$table)

	{

		$this->db->select('*');

	    $this->db->from($table);

		$this->db->order_by($order_by['a'],$order_by['b']);

		return $this->db->get()->result_array(); 



	}



	public function select_table_whereOrderBy($where,$order_by,$table)

	{

		$this->db->where($where);

		$this->db->order_by($order_by['a'],$order_by['b']);

		return $this->db->get($table)->result();



	}



	public function select_table_whereOrderByApi($where,$order_by,$table)

	{

		$this->db->select('

			empNumber as empNumber,

			date,

			time

		');

		$this->db->where($where);

		$this->db->order_by($order_by['a'],$order_by['b']);

		return $this->db->get($table)->result();



	}

	

	public function updateTime($data,$table,$id){

		$this->db->where('id',$id);

		$this->db->update($table,$data);

	}

}

