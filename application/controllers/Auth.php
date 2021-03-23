<?php 
class Auth extends CI_Controller {
/*THIS IS AUTHORIZATION CONTROLLER ACT AS MIDDLE_WARE 
THIS CONTROLLER IS MADE TO ENSURE THAT SESSION 'dept_id' IS SET
IN CI WITHOUT CACHE MEMORY 'dept_id' IS NOT SET IN FIRST ATTEMPT EVEN IF USERNAME & P/W ARE CORRECT
WE ALREADY TESTED IN BY DELETING ALL HISTORY 
*/

	public function __construct()
	{
			parent::__construct();
			if(! $this->session->userdata('dept_id'))
				return redirect('Login');
			$dept_id = $this->session->userdata('dept_id'); //print_r($dept_id); exit;

			$admin_id = "Planing_and_Investment";
/*THIS 'Planing_and_Investment' IS THE 'id' ALREADY MADE IN DATABASE AS SUPER ADMIN
  SUPER ADMIN IS THE DEPT. OF PLANNING & INVESTMENT, GOVT. OF ARUNACHAL PRADESH
 */
			if ($dept_id == $admin_id)
				{
					$this->load->model('Schemes_model');

				}else {
					 				
					return redirect('Dept');
				}	
				
	}

	public function index() //THIS IS LANDING PAGE AFTER LOGIN FOR SUPER ADMIN SHOWING ALL DEPTS LIST THAT HAVE SUBMITTED SCHEMES//
	{
						 
		 	$this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/index'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 6,
			   		'total_rows'=> $this->Schemes_model->count_all_dept(), //HERE 'count_all_dept()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 42//
			   		'full_tag_open'	 => "<ul class='pagination'>",//THIS LINE IS NOW WORKING
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

			$tol = $this->Schemes_model->sum_column($config['per_page'], $this->uri->segment(3));
			$this->load->view('admin/single_dept', compact("tol"));
						
	}



}
?>

	
