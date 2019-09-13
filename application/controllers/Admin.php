<?php 
class Admin extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$user_id = $_SESSION['user_id'];
			$admin_id = "Planing_and_Investment";
/*THIS 'Planing_and_Investment' IS THE 'id' ALREADY MADE IN DATABASE AS SUPER ADMIN
  SUPER ADMIN IS THE DEPT. OF PLANNING & INVESTMENT, GOVT. OF ARUNACHAL PRADESH
 */
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "plan_db";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			$sql = "SELECT * from users where id = '$user_id'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) 
				{
			 		while($row = $result->fetch_assoc())
			 		//print_r($user_id);	
			  		//print_r($row); exit;
			 			$current_id = $row['id'];
			 			if ($current_id == $admin_id)
					 			{
					 				$this->load->helper('form');
									$this->load->model('Schemes_model');

					 			}else {
					 				//echo "current_id and admin_id not Match";
					 				//die();
					 				return redirect('Dept_login');
					 				/* ELSE IT REDIRECT TO 'Dept_login' AND AS 'user_id' IS SET ANYWAY IT WILL AUTOMATICALLY CALL 'Dept' CONTROLLER 'index' FUNCTION
			    					 */
					 			}	
				   		{
						echo "";			         
				    	}

				} else {

			   // return redirect('Admin');
			   /* THIS return redirect('Admin'); IS ALREADY SET AT 'Login' CONTROLLER, NOT REQUIRED TO WRITE IT AGAIN HERE AS IT WILL THROW ERROR OF TOO MUCH REDIRECTION
			     */			    
				}					
			
		}

	public function index() //THIS IS LANDING PAGE AFTER LOGIN//
	{
			 
		 	$this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/index'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 6,
			   		'total_rows'=> $this->Schemes_model->count_all_dept(), //HERE 'count_all_articles()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 42//
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
			//echo "<pre>";
			//print_r($tol);
			//exit;			
	}

	public function dashboard()
		{
			if(! $this->session->userdata('user_id'))
				return redirect ('Dept_login');

			   $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/dashboard'),
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

			$articles = $this->Schemes_model->schemes_list($config['per_page'], $this->uri->segment(3));

			$this->load->view('admin/dashboard',['articles'=>$articles]);
		
		}

	public function show_column()
	{
			
		$this->load->view('admin/all_total');
	}

	public function show_category()
	{
		
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/show_category'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->count_category(), //HERE 'count_all_articles()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 42//
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

			$cat = $this->Schemes_model->sum_category($config['per_page'], $this->uri->segment(3));
			$this->load->view('admin/cat_list', compact("cat"));
			
	}

	public function show_schemes()
	{
		
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/show_schemes'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->count_scheme(), //HERE 'count_all_articles()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 42//
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

			$schemes = $this->Schemes_model->sum_scheme($config['per_page'], $this->uri->segment(3));
			$this->load->view('admin/scheme_list', compact("schemes"));
			
	}

	public function delete_scheme() /*FOR PLANING DEPT ONLY*/
	{
             /*we will make this function if require , note yet required */
	}
	public function edit_scheme()/*FOR PLANING DEPT ONLY*/
	{
			/*we will make this function if require , note yet required */
	}


}
?>

	