<?php 
//THIS IS OUR DEFAULT CONTROLLER MADE THROUGH "routes.php" OF CONFIG FOLDER//
class Login extends CI_Controller {

	public function __construct()
   	{
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('loginmodel');
    }

	public function index()
	{
		if($this->session->userdata('dept_id'))
			return redirect('Auth');

		//$this->load->helper('form'); //WE LOAD THIS IN __construct //
		$this->load->view('pub/admin_login');
	}

	public function officer_login()
		{
		//$this->load->library('form_validation'); WE LOAD THIS IN __construct //
		$this->form_validation->set_rules('username','User Name','required|min_length[2]');
		$this->form_validation->set_rules('password','PassWord','required');

		if($this->form_validation->run()) //IF VALIDATION PASSES
			{						//SUCCESS
				$username = $this->input->post('username');
				$password = $this->input->post('password');
			
		            $user_row = $this->loginmodel->login_valid($username,$password);
		            //print_r($user_row); exit;
					if($user_row)
					{
						$login_id = $user_row->dept_id;
						$role = $user_row->role;
						$id = $user_row->id;
						$admin_id = "Planing_and_Investment";
						//print_r($u_id); exit;
/*Here we set both 'id' and 'u_id' in the session, we set 'u_id' in the session only to use in 'DeptAdmin' controller and 'Approval_Model, get_role()' function*/						
						$this->session->set_userdata('dept_id', $login_id);
						$this->session->set_userdata('id', $id);

						if ($role == 'admin') {

							if ($login_id == $admin_id) {

								return redirect('Auth');
							}else{
								
								return redirect('DeptAdmin');							
							}

						}else {
							return redirect('Dept');
						}

					}else{
							$this->session->set_flashdata('login_failed','Username or Password do not match');
							
								return redirect('login');
								//echo "PASSWORD DO NOT MATCH";
						}

							}else
								{
										$this->load->view('pub/admin_login');
										//echo validation_errors();
								}  
		
		}

	public function logout()
	{
		$this->session->unset_userdata('dept_id');
		return redirect('Login');
	}
    	/*
    HERE BELOW WE CODE FOR CHANGE PASSWORD
    	*/
	
	public function updatePwd()
	{
		$this->load->view('Change_Pass');
		$this->form_validation->set_rules('pass','Current Password','required|max_length[20]');
		$this->form_validation->set_rules('newpass','New Password','required|max_length[20]');
		$this->form_validation->set_rules('confpassword','Confirm Password','required|max_length[20]');
		if($this->form_validation->run()){
			$curr_password = $this->input->post('pass');
			$new_password = $this->input->post('newpass');
			$conf_password = $this->input->post('confpassword');

			$dept_id = $this->session->userdata('dept_id'); //TAKING dept_id FROM SESSION//

			//$this->load->model('loginmodel'); //WE LOAD THIS IN __construct ABOVE //
			$passwd = $this->loginmodel->getCurrPassword($dept_id);
			//print_r($passwd);
			//exit();
			if($passwd->pass == $curr_password){
				if($new_password == $conf_password){
					if($this->loginmodel->updatePassword($new_password, $dept_id))
					{
						
						echo "PASSWORD UPDATED SUCCESFULLY";
					}
					else{
						echo "Failed to Update Password, Plz consult N. Kamin";
						//return redirect ('Welcome');
						}
						
							}
							else{
								echo "NEW Pass Word & Confirm Pass Word not Matching";
					
								}					
			}
				echo "PLEASE ENTER CORRECT PASSWORD";
				
		}
		else{
	
		}
	}

	public function user_detail()
	{
		/*
		//THIS KEY 'usr' WILL BE PASSED TO VIEW FILE "user_bai.php"// 
			$kkk["usr"] = $this->loginmodel->get_user(); 
			$this->load->view('admin/user_bai', $kkk);
		*/
		
		$kkk = $this->loginmodel->get_user();
		$this->load->view('admin/user_bai',['usr'=>$kkk]);
		/*THIS KEY 'usr' WILL BE PASSED TO VIEW FILE "user_bai.php"  
		*/
	}

}




