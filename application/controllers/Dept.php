<?php 
/*IF LOGIN WITH 'id 'OTHER THEN  ='Planing_and_Investment' OR Role = 'admin' THEN THIS CONTROLLER WILL BE CALL */
class Dept extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			if(! $this->session->userdata('dept_id'))
			return redirect('Login');
			$this->load->helper('form');
			$this->load->model('Schemes_model');
			$this->load->model('Approval_model');
		}

		public function index()
		{
/*This session data i.e 'id' was already set on 'Login Controller' at 'officer_login()'' function*/	
			$c_id = $this->session->userdata('id'); 
/*Here we are going to filter out user which has role as 'user' with 'Approval_model' get_role function*/
			$var = $this->Approval_model->GetUserRole();

			$active_id = $var->id;
			//print_r($c_id);
			//echo "<br>";
			//print_r($active_id); exit;
		if ($c_id !== $active_id)
			 return redirect('DeptAdmin');

			   $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Dept/index'),
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->num_rows(), //HERE 'num_rows()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 52//
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

			$schemes = $this->Schemes_model->schemes_list($config['per_page'], $this->uri->segment(3));
				
			  $this->load->view('dept/dept_dashboard',['schemes'=>$schemes]);
			  
		}
		
		public function add_scheme()
		{
			$var = $this->Approval_model->GetUserRole();

			$role = $var->role;
			//print_r($role); exit;
			if ($role !== 'user')
		  		return redirect('DeptAdmin'); 
/* If role='user' then below code will run 	*/	  		   
			$this->load->view('dept/add_scheme');

		}

		public function store_scheme()
		{

		$var = $this->Approval_model->GetUserRole();
		$role = $var->role;

		if ($role !== 'user')
		  	return redirect('DeptAdmin'); 
/* If role='user' then below code will run 	*/			
			$this->load->library('form_validation');
			if( $this->form_validation->run('add_scheme_rules')) //SEE form_validation.php FILE IN CONFIG FOLDER//
			{
				$post = $this->input->post();

				unset($post['submit']); //**TO REMOVE 'SUBMIT' WHICH COMES AS ARRAY, IF WE CHEECK BY SYSTEX "print_r($post); exit;" WE GET 'submit' AS AN ARRAY ALSO & DUE TO THIS WE R NOT ABLE TO POST DATA ON DATABASE**// 
				
				if( $this->Schemes_model->add_scheme($post) )

				{
					$this->session->set_flashdata('feedback',"Scheme Submitted Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "INSERTED SUCCESFULLY";
				}else
					 {
					
					$this->session->set_flashdata('feedback',"Failed to Submit, Plz Try Again !.");		
					 }
					return redirect('Dept');

			     }else
					{
						//$upload_error = $this->upload->display_errors();
					$this->load->view('dept/add_scheme', compact('upload_error','KAMIN'));
					} 
		}


	public function edit_scheme($scheme_id)
	{
		$var = $this->Approval_model->GetUserRole();

		$role = $var->role;
		//print_r($role); exit;
		if ($role !== 'user')
		  return redirect('DeptAdmin');	

			$user = $this->session->userdata('dept_id');

			$scheme = $this->Schemes_model->find_scheme($scheme_id);

			$c_id = $scheme->dept_id;
			//print_r($c_id); echo "<br>"; print_r($user); exit;
			if($user==$c_id)
				{
					$this->load->view('dept/edit_scheme',['scheme'=>$scheme]);

				} else{
					$this->session->set_flashdata('feedback',"You are not Authorized");
					$this->session->set_flashdata('feedback_class','alert-success');
					return redirect('Dept');
				}

	}

		public function update_scheme($scheme_id)//THIS "$scheme_id" IS TAKEN FORM "edit_scheme.php" file ON LINE 4// WE USE THIS "$scheme_id" PARAMETER ON LINE 105 BELOW IN THIS FILE ITSELF//
		{
			
			$this->load->library('form_validation');
			if( $this->form_validation->run('add_scheme_rules') )//SEE form_validation.php FILE IN CONFIG FOLDER//
			{
				$post = $this->input->post();

				unset($post['submit']); //**TO REMOVE 'SUBMIT' WHICH COMES AS ARRAY, IF WE CHEECK BY SYSTEX "print_r($post); exit;" WE GET 'submit' AS AN ARRAY ALSO & DUE TO THIS WE R NOT ABLE TO POST DATA ON DATABASE**// 
				//echo "<pre>";
				//print_r($post); exit;
				//$this->load->model('Schemes_model'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
				if( $this->Schemes_model->update_scheme($scheme_id,$post) )
				/* "$scheme_id" is taken from parameter on this function above */	
				{
					$this->session->set_flashdata('feedback',"Scheme Updated Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "INSERTED SUCCESFULLY";
				}else
					{	
					$this->session->set_flashdata('feedback',"Failed to Update, Plz report to Kamin about this.");
					//echo "FAILED";
					}
					return redirect('Dept');

				}else
					{
					$this->load->view('Dept/edit_scheme');
					}


		}

		public function delete_scheme()
		{
	   //print_r( $this->input->post() ); exit; //TO PRINT scheme_id, THAT WE RECEIVED AFTER CLICKING DELETE BUTTON//
		$arr_id = $this->input->Post('mm_id');//INSERTING scheme_id into variable '$scheme_id'//
			//$this->load->model('Schemes_model'); //WE MADE IT UNDER __CONSTRUCT FUNCTION//
				if( $this->Schemes_model->delete_scheme($arr_id) )

				{
					$this->session->set_flashdata('feedback',"Scheme Deleted Succesfully.");
					$this->session->set_flashdata('feedback_class','alert-success');
					//echo "SUCCESS";
				}
				else
				{
					$this->session->set_flashdata('feedback',"Failed to Delete, Plz report to Kamin about this.");
					//echo "FAILED";
				}
				return redirect('Dept');
		}

	public function all_approved()
/*FOR SHOWING DASHBOARD OF DEPTS USERS TO SEE ALL APPROVED SCHEMES*/
		{
			$this->load->model('Approval_model');
			$this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Dept/all_approved'),
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
				
			  $this->load->view('dept/all_approve',['schemes'=>$a_schemes]);
			
			
		}

}
?>

	
