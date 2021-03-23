<?php
class Approval_model extends CI_Model {

	public function get_role()
/*This Model method is for fetching data of user with role as 'admin' from DB, Any log-in user's data which has a role other than 'admin' will not fetched/load */	
	{
		$role= 'admin';
		//$dept_id = $this->session->userdata('dept_id');
		$id = $this->session->userdata('id');
		//print_r($id); exit;
		$query = $this->db
							->select()
							->where([
								 //'dept_id'   =>$dept_id, /*Data on dept_id field is not unique in DB */
									  'id' => $id,
									  'role' => $role /*Only to fetch data where role='admin' */
									])
					        ->get('users');
	 //$result = $this->db->last_query();
		$result = $query->row();
		//print_r($result); exit;
		return $result;		 

	}

	public function find_scheme($scheme_id)
/*THIS FUNCTION IS RELATED TO CONTROLLER "DeptAdmin" = public function apvl_scheme($scheme_id) */
	{
		$q = $this->db
			     //->select(['id','name_scheme','body','status','remark','budget_est','exp','category'])
				->select()
				->where('id',$scheme_id)
				->get('schemes');

		return $q->row(); //HERE WE RETURN 'ROW'TO FETCH ONLY ONE AFFECTED ROW, IF WE RETURN 'RESULT' THEN ARRAY WILL START WITH ZERO (0) INDEX// 
	}

	public function num_rows() //THIS NEW FUNCTION IS MADE TO GET 'total_rows' Un-Approved Scheme FOR PAGINATION, SEE LINE 14 OF ADMIN.PHP FILE //
	{
		$dept_id = $this->session->userdata('dept_id');
		//print_r($dept_id); exit;
		$query = $this->db
							->select()
							->from('schemes')
							//->where('dept_id', $dept_id)
							->where(['dept_id'=>$dept_id, 'status'=> 0])
							->get();
		return $query->num_rows();
	}

	public function schemes_list($limit, $offset)
	//THIS FUNCTION IS TO SHOW LIST OF PROJECTS FOR APPROVAL WHERE STATUS => 0, ON DASHBOARD//
	{
		$dept_id = $this->session->userdata('dept_id');
		$query = $this->db
		                    ->select()
							->from('schemes')
							//->where('dept_id', $dept_id)
							->where(['dept_id'=>$dept_id, 'status'=> 0])
							->limit ($limit, $offset) //FOR PAGINATION ONLY//
							->order_by('id','DESC')
							->get();
		//print_r($query->result()); exit;
		//return $query->result_array();
		return $query->result();
					
	}

	public function update_scheme($approve_id, Array $scheme)
	{
		return $this->db
				->where('id',$approve_id)
				->update('schemes',$scheme);
	}

	public function approved_rows() //THIS NEW FUNCTION IS MADE TO GET 'total_rows' OF APPROVED SCHEME FOR PAGINATION, SEE LINE 14 OF ADMIN.PHP FILE //
	{
		$dept_id = $this->session->userdata('dept_id');
		//print_r($dept_id); exit;
		$query = $this->db
							->select()
							->from('schemes')
							//->where('dept_id', $dept_id)
							->where(['dept_id'=>$dept_id, 'status'=> 1])
							->get();
		return $query->num_rows();
	}

	public function approved_list($limit, $offset)
	//THIS FUNCTION IS TO SHOW LIST OF APPROVED PROJECTS WHERE STATUS=>1, ON DASHBOARD//
	{
		$dept_id = $this->session->userdata('dept_id');
		$query = $this->db
		                    ->select()
							->from('schemes')
							//->where('dept_id', $dept_id)
							->where(['dept_id'=>$dept_id, 'status'=> 1])
							->limit ($limit, $offset) //FOR PAGINATION ONLY//
							->order_by('id','DESC')
							->get();
		//print_r($query->result()); exit;
		return $query->result();
	}

	public function GetUserRole()
/*This Model method is for fetching data of log-in user with role as 'user' from DB, Any log-in user's data which has a role other than 'user' will not fetched/load, This method will be use in 'Dept' Controller*/	
	{
		$id = $this->session->userdata('id');
		//print_r($id); exit;
		$query = $this->db
							->select()
							->where([
									  'id' => $id,
									  'role' => 'user' /*Only to fetch data where role='user' */
									])
					        ->get('users');
	 //$result = $this->db->last_query();
		$result = $query->row();
		//print_r($result); exit;
		return $result;		 

	}


}
?>