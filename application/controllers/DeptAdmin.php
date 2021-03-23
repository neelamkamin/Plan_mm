<?php 
/*IF LOGIN WITH 'id 'OTHER THEN  ='Planing_and_Investment' THEN THIS CONTROLLER WILL BE CALL */
class DeptAdmin extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
				if(! $this->session->userdata('dept_id'))
				  return redirect('Login');
		
			$this->load->helper('form');
			$this->load->model('Approval_model');
			//$id = $this->session->userdata('id');
			//$dept_id = $this->session->userdata('dept_id');
			//print_r($dept_id);
			//echo "<br>";
			//print_r($id); exit;
		}

		public function index()
		{
/*This session data i.e 'id' was already set on 'Login Controller' at 'officer_login()'' function*/	
			$c_id = $this->session->userdata('id'); 
/*Here we are going to filter out user which has role as 'user' with 'Approval_model' get_role function*/
			$var = $this->Approval_model->get_role();

			$active_id = $var->id;
			//print_r($c_id);
			//echo "<br>";
			//print_r($active_id); exit;
		if ($c_id !== $active_id)
			 return redirect('DeptAdmin/skip');
	
			   $this->load->library('pagination');
			   $config = [

			   		'base_url'	=> base_url('DeptAdmin/index'),			   		
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Approval_model->num_rows(), //HERE 'num_rows()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 52//
			   		'full_tag_open'	 => "<ul class='pagination'>",
			   		'full_tag_close' => "</ul>",
			   		'first_tag_open' => '<li>',
			   		'first_tag_close' => '</li>',
			   		'last_tag_open' => '<li>',
			   		'last_tag_close' => '</li>',
			   		'next_tag_open'	 => '<li>',
			   		'next_tag_close' => '</li>',
			   		'prev_tag_open'	 => '<li>',
			   		'prev_tag_close' => '</li>',
			   		'num_tag_open'	 => '<li>',
			   		'num_tag_close' => '</li>',
			   		'cur_tag_open'	 => "<li class='active'><a>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);

			$schemes = $this->Approval_model->schemes_list($config['per_page'], $this->uri->segment(3));
				
			  $this->load->view('apvl/apvl_dash',['schemes'=>$schemes]);
			
			
		}

		public function apvl_scheme($scheme_id)
		{
			$var = $this->Approval_model->get_role();

			$role = $var->role;
			//print_r($role); exit;
			if ($role !== 'admin')
			 return redirect('DeptAdmin/skip');


				$user = $this->session->userdata('dept_id');

				$scheme = $this->Approval_model->find_scheme($scheme_id);

				$c_id = $scheme->dept_id;
				//print_r($c_id); echo "<br>"; print_r($user); exit;
				   if($user==$c_id)
					{
						$this->load->view('apvl/apvl_scheme',['scheme'=>$scheme]);

					} else{
						$this->session->set_flashdata('feedback',"You are not Authorized, Even if you are admin but this is not your Dept Project");
							
						$this->session->set_flashdata('feedback_class','alert-success');
							
						return redirect('DeptAdmin');
					}

		}

		public function approve($approve_id)
		{
			$post = $this->input->post();

			unset($post['submit']); //**TO REMOVE 'SUBMIT' WHICH COMES AS ARRAY, IF WE CHEECK BY SYSTEX "print_r($post); exit;" WE GET 'submit' AS AN ARRAY ALSO & DUE TO THIS WE R NOT ABLE TO POST DATA ON DATABASE**// 
			//echo "<pre>";
			//print_r($post); exit;
			$this->load->model('Schemes_model'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
				if( $this->Schemes_model->update_scheme($approve_id,$post) )
					  /* "$approve_id" is taken from parameter on this function above */
				{
					$this->session->set_flashdata('feedback',"Project Approved Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
				}else
					{	
					$this->session->set_flashdata('feedback',"Failed to Approved");
					}
					return redirect('DeptAdmin/approved_schemes');

								
		}

		public function approved_schemes()
/*FOR SHOWING DASHBOARD OF DEPTS USERS TO SEE ALL APPROVED SCHEMES*/
		{
			$rr = $this->Approval_model->get_role();
/*We load "Approval_model->get_role()" to get the name,u_id and role of log-in user from DB to display it on view  */		
			$role = $rr->role;
			//print_r($role); exit;
			if ($role !== 'admin')
			return redirect('DeptAdmin/skip');
	
			   $this->load->library('pagination');
			   $config = [

			   		'base_url'	=> base_url('DeptAdmin/index'),			   		
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Approval_model->approved_rows(), //HERE 'num_rows()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 52//
			   		'full_tag_open'	 => "<ul class='pagination'>",
			   		'full_tag_close' => "</ul>",
			   		'first_tag_open' => '<li>',
			   		'first_tag_close' => '</li>',
			   		'last_tag_open' => '<li>',
			   		'last_tag_close' => '</li>',
			   		'next_tag_open'	 => '<li>',
			   		'next_tag_close' => '</li>',
			   		'prev_tag_open'	 => '<li>',
			   		'prev_tag_close' => '</li>',
			   		'num_tag_open'	 => '<li>',
			   		'num_tag_close' => '</li>',
			   		'cur_tag_open'	 => "<li class='active'><a>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);

			$a_schemes = $this->Approval_model->approved_list($config['per_page'], $this->uri->segment(3));
				
			  $this->load->view('apvl/already_apvl',['schemes'=>$a_schemes]);
			
			
		}

		public function skip()
		{
			$this->session->set_flashdata('feedback',"NOT AUTHORIZED-MM");
			$this->session->set_flashdata('feedback_class','alert-danger');
			//echo "NOT AUTHORIZED";
			return redirect('Dept');
		}
	
	
}
?>


	