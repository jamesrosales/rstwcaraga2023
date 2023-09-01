<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function ApprovalStats(){
		$query = $this->db->query('
			SELECT SUM(CASE WHEN approval_status = 1 THEN 1 ELSE 0 END) AS Approved, 
				SUM(CASE WHEN approval_status = 0 THEN 1 ELSE 0 END) AS Pending 
				FROM usr_table
  		');
	   	return $query->row();
	}
	
	public function GenderStats(){
// 		$query = $this->db->query('SELECT 
// 		  case when gender='Male' then count(gender) end AS Male,
// 		  case when gender='Female' then count(gender) end AS Female
// 		FROM
// 		  usr_table 
// 		  where approval_status = 1
  // ');
		$query = $this->db->query('
			SELECT usr_gender, COUNT(usr_id) AS count
			FROM usr_table
			where approval_status = 1
			GROUP BY usr_gender;
  		');
	   	return $query->result_array();
	}

	public function AgeBracket(){
		// $query = $this->db->query('
		// 	SELECT *
		// 	FROM usr_table
		// 	GROUP BY usr_gender;
  		// ');
	   	// return $query->result_array();
	   	$this->db->select('
			birth_date
		');
		$this->db->from('usr_table');
	    // $this->db->join('usr_table b','b.qrcode = a.qrcode');
	    $this->db->where('approval_status', 1);
	    // $this->db->order_by('a.time','desc');
	    return $this->db->get()->result_array();
	}

	public function ClusterGraph(){

			$this->db->select('
				COUNT(usr_id) as total,
				usr_cluster,
			');
	    $this->db->from('usr_table');  
	    $this->db->where('approval_status', 1);
	     $this->db->group_by('usr_cluster');
	    $query = $this->db->get()->result_array(); 
	   	return $query;
	}

	public function EventStats(){
      $query = $this->db->query('
        	SELECT t.event_id, t.event_name, t.maximum, count(p.event_id) AS num_participants
					from tbl_events t left join usr_table p
					on find_in_set(t.event_id, p.event_approved_id) 
					and p.approval_status = 1
					group by t.event_id
					order by t.event_name desc
      ');	
      return $query->result_array();
	}

	public function EventPeningStats(){
      $query = $this->db->query('
        	SELECT t.event_id, t.event_name, t.maximum, count(p.event_id) AS num_participants
					from tbl_events t left join usr_table p
					on find_in_set(t.event_id, p.event_id) 
					-- and p.approval_status = 0
					group by t.event_id
					order by t.event_name desc
      ');	
      return $query->result_array();
	}

	public function RoleStats(){

			$this->db->select('
				COUNT(b.usr_role) as total,
				a.role_name,
			  
			');
	    $this->db->from('tbl_roles a');  
	    $this->db->join('usr_table b','b.usr_role = a.role_id', 'left');
	    $this->db->where('b.approval_status', 1);
	     $this->db->group_by('a.role_id');
	    $query = $this->db->get()->result_array(); 
	   	return $query;
	}

	public function EventParticipants($event_id, $status){
		$this->db->select('
			a.usr_fname,
			a.usr_lname,
			a.usr_mname,
			a.usr_suffix,
			a.usr_cluster,
			a.usr_gender,
			a.event_id,
			a.event_approved_id,
			b.role_name,
		');
	  
	  $this->db->from('usr_table a');  
	  $this->db->join('tbl_roles b','b.role_id = a.usr_role', 'left');
	  $this->db->where('FIND_IN_SET('.$event_id.', a.event_approved_id) !=', 0);
		$this->db->where('a.approval_status', $status);
		$this->db->order_by("a.usr_lname", "asc");
	  $query = $this->db->get()->result_array(); 
	  return $query;
	}

	public function EventParticipantsPending($event_id, $status){
		$this->db->select('
			a.usr_fname,
			a.usr_lname,
			a.usr_mname,
			a.usr_suffix,
			a.usr_cluster,
			a.usr_gender,
			b.role_name,
		');
	  
	  $this->db->from('usr_table a');  
	  $this->db->join('tbl_roles b','b.role_id = a.usr_role', 'left');
	  $this->db->where('FIND_IN_SET('.$event_id.', a.event_id) !=', 0);
		// $this->db->where('a.approval_status', $status);
	  $query = $this->db->get()->result_array(); 
	  return $query;
	}

	public function ApprovedParticipants(){

	    $query = $this->db->query('SELECT 
	    	a.usr_id,
	    	a.usr_lname,
	    	a.usr_fname,
	    	a.usr_mname, 
	    	a.usr_suffix,
	    	a.usr_email,
	    	a.birth_date,
	    	a.usr_gender,
	    	a.usr_contact,
	    	a.usr_occupation,
	    	a.usr_institution,
	    	a.usr_municipality,
	    	a.usr_sector,
	    	a.usr_cluster,
	    	a.number_of_email,
	    	c.role_name,
	    	-- a.usr_contact,
	    	-- a.usr_contact,
	        GROUP_CONCAT(DISTINCT(b.event_name) ORDER BY b.event_date SEPARATOR "<br><br>") as event_name,  
	        GROUP_CONCAT(DISTINCT(d.event_name) ORDER BY d.event_date SEPARATOR "<br><br>") as event_approved_name 
	        from usr_table as a
	        LEFT JOIN tbl_events as b ON FIND_IN_SET(b.event_id,a.event_id) 
	        LEFT JOIN tbl_events as d ON FIND_IN_SET(d.event_id,a.event_approved_id) 
	        LEFT JOIN tbl_roles as c ON c.role_id = a.usr_role
	        -- LEFT JOIN tbl_users as d ON d.user_id = a.user_id 
	        where a.approval_status = 1
	        GROUP BY a.usr_id 
	        order by a.usr_id desc');
        return $query->result_array();
	}

	// same function with approved participants but remove the request event concat
	public function OnsiteParticipants(){
	    $query = $this->db->query('SELECT 
	    	a.usr_id,
	    	a.usr_lname,
	    	a.usr_fname,
	    	a.usr_mname, 
	    	a.usr_suffix,
	    	a.usr_email,
	    	a.birth_date,
	    	a.usr_gender,
	    	a.usr_contact,
	    	a.usr_occupation,
	    	a.usr_institution,
	    	a.usr_municipality,
	    	a.usr_sector,
	    	a.usr_cluster,
	    	a.idcard_status,
	    	a.number_of_email,
	    	c.role_name,
	        GROUP_CONCAT(DISTINCT(b.event_name) ORDER BY b.event_date SEPARATOR "<br><br>") as event_approved_name  
	        from usr_table as a
	        LEFT JOIN tbl_events as b ON FIND_IN_SET(b.event_id,a.event_approved_id) 
	        LEFT JOIN tbl_roles as c ON c.role_id = a.usr_role
	        where a.approval_status = 1
	        GROUP BY a.usr_id 
	        order by a.usr_lname asc');
        return $query->result_array();
	}

	public function ApprovedParticipantsPrintID($array){
				$this->db->select('
					a.usr_id,
		    	a.usr_lname,
		    	a.usr_fname,
		    	a.usr_mname, 
		    	a.usr_suffix,
		    	a.usr_email,
		    	a.birth_date,
		    	a.usr_gender,
		    	a.usr_contact,
		    	a.usr_occupation,
		    	a.usr_institution,
		    	a.usr_municipality,
		    	a.usr_sector,
		    	a.usr_cluster,
		    	a.qrcode,
		    	b.role_name
				');
			  
			  $this->db->from('usr_table a');  
			  $this->db->join('tbl_roles b','b.role_id = a.usr_role', 'left');
				$this->db->where('a.approval_status', 1);
				$this->db->where('a.usr_cluster', $array['cluster']);
			  $query = $this->db->get()->result_array(); 
			  return $query;
	}

	public function IDPrintingSoloData($array){
				$this->db->select('
					a.usr_id,
		    	a.usr_lname,
		    	a.usr_fname,
		    	a.usr_mname, 
		    	a.usr_suffix,
		    	a.usr_email,
		    	a.birth_date,
		    	a.usr_gender,
		    	a.usr_contact,
		    	a.usr_occupation,
		    	a.usr_institution,
		    	a.usr_municipality,
		    	a.usr_sector,
		    	a.usr_cluster,
		    	a.qrcode,
		    	b.role_name
				');
			  
			  $this->db->from('usr_table a');  
			  $this->db->join('tbl_roles b','b.role_id = a.usr_role', 'left');
				$this->db->where('a.usr_id', $array['usr_id']);
			  $query = $this->db->get()->result_array(); 
			  return $query;
	}
	
	public function PendingParticipants(){

	    $query = $this->db->query('SELECT 
	    	a.usr_id,
	    	a.usr_lname,
	    	a.usr_fname,
	    	a.usr_mname, 
	    	a.usr_suffix,
	    	a.usr_email,
	    	a.birth_date,
	    	a.usr_gender,
	    	a.usr_contact,
	    	a.usr_occupation,
	    	a.usr_institution,
	    	a.usr_municipality,
	    	a.usr_sector,
	    	a.usr_cluster,
	    	a.move_to_pending_status,
	    	c.role_name,
	        GROUP_CONCAT(b.event_name ORDER BY b.event_date SEPARATOR "<br>") as event_name   
	        from usr_table as a
	        LEFT JOIN tbl_events as b ON FIND_IN_SET(b.event_id,a.event_id) 
	        LEFT JOIN tbl_roles as c ON c.role_id = a.usr_role 
	        where a.approval_status = 0
	        GROUP BY a.usr_id 
	        order by a.usr_id desc');
        return $query->result_array();
	}

	public function PendingParticipantsCount(){

	    $query = $this->db->query('SELECT 
	    	a.usr_id,
	    	a.usr_lname,
	    	a.usr_fname,
	    	a.usr_mname, 
	    	a.usr_suffix,
	    	a.usr_email,
	    	a.birth_date,
	    	a.usr_contact,
	        GROUP_CONCAT(b.event_name SEPARATOR "<br>") as event_name  
	        from usr_table as a
	        LEFT JOIN tbl_events as b ON FIND_IN_SET(b.event_id,a.event_id) 
	        -- LEFT JOIN tbl_users as d ON d.user_id = a.user_id 
	        where a.approval_status = 0
	        GROUP BY a.usr_id 
	        order by a.usr_id desc');
        return $query->num_rows();
	}

	public function userInfoWithEvents($usr_id){

	    $query = $this->db->query('SELECT 
	    	a.usr_id,
	    	a.usr_lname,
	    	a.usr_fname,
	    	a.usr_mname, 
	    	a.usr_suffix,
	    	a.usr_email,
	    	a.birth_date,
	    	a.usr_contact,
				a.usr_gender,
				a.number_of_email,
	        GROUP_CONCAT(b.event_name  ORDER BY b.event_date ASC SEPARATOR "<br>") as event_name  
	        from usr_table as a
	        LEFT JOIN tbl_events as b ON FIND_IN_SET(b.event_id,a.event_approved_id) 
	        -- LEFT JOIN tbl_users as d ON d.user_id = a.user_id 
	        where a.usr_id = '.$usr_id.'  
	        GROUP BY a.usr_id 
	        order by a.usr_id desc');
        return $query->row();
	}

	public function getProfile($usr_id){
      $this->db->select('
		   	a.usr_id,
	    	a.usr_lname,
	    	a.usr_fname,
	    	a.usr_mname, 
	    	a.usr_suffix,
	    	a.usr_email,
	    	a.birth_date,
	    	a.usr_gender,
	    	a.usr_contact,
	    	a.usr_occupation,
	    	a.usr_institution,
	    	a.usr_municipality,
	    	a.usr_sector,
	    	a.usr_cluster,
	    	b.role_name,
	    	a.event_id,
	    	a.event_approved_id,
	    	a.approval_status
		');
	    $this->db->from('usr_table a');  
	    $this->db->join('tbl_roles b','b.role_id = a.usr_role', 'left');
	    // $this->db->join('report_pr c','c.ppmp_id = a.ppmp_id', 'left');
	    // $this->db->join('report_po_wo d','d.po_wo_id = a.po_wo_id', 'left');

			$this->db->where('usr_id', $usr_id);

	    $query = $this->db->get()->row(); 
	   	return $query;
      // return $query->result_array();
	}

	public function eventListUser($data){
			$this->db->select('*');
	    $this->db->from('tbl_events');  
			$this->db->where_in('event_id', $data);
			$this->db->order_by('event_name','desc');
	    $query = $this->db->get()->result(); 
	   	return $query;
	}

	public function EventParticipantsChecklist($event_id){
		$this->db->select('
			a.usr_id,
			a.usr_fname,
			a.usr_lname,
			a.usr_mname,
			a.usr_suffix,
			a.usr_cluster,
			a.usr_gender,
			a.event_id,
			a.event_approved_id,
			b.role_name,
		');
	  
	  $this->db->from('usr_table a');  
	  $this->db->join('tbl_roles b','b.role_id = a.usr_role', 'left');
	  $this->db->where('FIND_IN_SET('.$event_id.', a.event_id) !=', 0);
	  $this->db->or_where('FIND_IN_SET('.$event_id.', a.event_approved_id) !=', 0);
		// $this->db->where('a.approval_status', $status);
		$this->db->order_by('a.usr_lname','asc');
	  $query = $this->db->get()->result_array(); 
	  return $query;
	}

	public function EventCountBySession($event_id){
      // $query = $this->db->query('
      //   	SELECT count(DISTINCT(b.event_approved_id)) AS num_participants
			// 		from tbl_events a left join usr_table b
			// 		on find_in_set(a.event_id, b.event_approved_id) 
			// 		and a.event_id = '.$event_id.'
      // ');	
      // return $query->row();
		$this->db->select('
			a.usr_id,
		');
	  
	  $this->db->from('usr_table a');  
	  $this->db->join('tbl_roles b','b.role_id = a.usr_role', 'left');
	  $this->db->where('FIND_IN_SET('.$event_id.', a.event_approved_id) !=', 0);
	  $this->db->or_where('FIND_IN_SET('.$event_id.', a.event_approved_id) !=', 0);
		// $this->db->where('a.approval_status', $status);
		
		$this->db->order_by('a.usr_lname','asc');
	  $query = $this->db->get()->num_rows(); 
	  return $query;
	}
}

