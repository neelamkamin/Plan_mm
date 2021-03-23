<?php
class Loginmodel extends CI_Model {

	public function login_valid($username,$password)
	{

		
		$q = $this->db
					->where(['u_name'=>$username,'pass'=>$password])
					->get('users');
 //$q = select * from users where 'u_name'= $username and 'pass' = $password (CORE PHP SYNTEX)
		if ($q->num_rows() > 0) {
			//$ss =	$q->row(); print_r($ss); exit();
				return $q->row();
				//return $q->row()->id;
				//return TRUE;
		}else {
			return FALSE;
		}
	}
//BELOW CODE IS FOR PASSWORD CHANGE//

	public function getCurrPassword($dept_id)
	{
		$query = $this->db
						->where(['id'=>$dept_id])
							->get('users');

		if($query->num_rows() > 0){
			return $query->row();
		}
	}

	public function updatePassword($new_password, $dept_id)
	{
		$data = array( 'pass' => $new_password );

		return $this->db
						->where('id', $dept_id)
							->update('users', $data);
	}


	public function get_user()
	//THIS FUNCTION IS TO SHOW DETAILS OF ALL USERS//
	{
		
		$query = $this->db							
						->get("users");
		return $query;
		
		/*
		$this->db->from("users");

		$query = $this->db
						->get();
		return $query;
		*/
					
					
	}

}

