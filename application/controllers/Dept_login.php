<?php 

/* THIS 'Dept_login' CONTROLLER WILL BE CALLED IF LOGIN AS USER 'id' OTHER THAN 'Planing_and_Investment' */
class Dept_login extends CI_Controller {

	public function __construct()
   		 {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Loginmodel');
    	}

		public function index()
			{
				if($this->session->userdata('user_id'))
					return redirect('Dept');
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
					
		             	$login_id = $this->loginmodel->login_valid($username,$password);
						if($login_id)
						{
							//$this->load->library('session'); **ADDED IN CONFIG FOLDER AT AUTOLOAD LIBRARY AS 
							//AS PER THIS e.g > $autoload['libraries'] = array('database','session'); ALONG WITH DATABASE//

							$this->session->set_userdata('user_id',$login_id);
								return redirect('Dept');

						}else{
							$this->session->set_flashdata('login_failed','Username or Password do not match');
							
								return redirect('login');
								//echo "PASSWORD DO NOT MATCH";
						}

							}else
								{
										$this->load->view('dept/dept_login');
										//echo validation_errors();
								}  
		
		}

		public function logout()
		{
			$this->session->unset_userdata('user_id');
			return redirect('Login');
		}


}
?>




