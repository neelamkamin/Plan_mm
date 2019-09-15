<?php 
class Admin  extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			if(! $this->session->userdata('user_id'))
			return redirect('Login');

			$user_id = $this->session->userdata('user_id');
			//print_r($user_id); exit;
			$admin_id = "Planing_and_Investment";
/*THIS 'Planing_and_Investment' IS THE 'id' ALREADY MADE IN DATABASE AS SUPER ADMIN
  SUPER ADMIN IS THE DEPT. OF PLANNING & INVESTMENT, GOVT. OF ARUNACHAL PRADESH
 */
			if ($user_id == $admin_id)
				{
					$this->load->helper('form');
					$this->load->model('Schemes_model');

				}else {
					 				
					return redirect('Dept');
				}					
			
		}
	
	public function index()
	{
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url('Admin/index'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->count_all_schemes(), 
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

			   $schemes = $this->Schemes_model->all_schemes_list($config['per_page'], $this->uri->segment(3));
		//$this->load->helper('html'); //We have autoload it in autoload.php file of congig folder... 
		//...with syntex= $autoload['helper'] = array('html'); -- where I hav only entered 'html' in array parametres.//
		$this->load->view('pub/project_list',compact('schemes'));
		//HERE 'compact('schemes')' IS SAME AS ['schemes'=>$schemes];, JUST WE WRITE DIFFERENTLY//
	}

	public function search()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('query','Query','required');
		if ( ! $this->form_validation->run())
			return $this->index();
		$query = $this->input->post('query');
		//print_r($query);
		return redirect("Admin/search_results/$query"); 
		
	}

	public function search_results( $query )
	{
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("Admin/search_results/$query"),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->count_search_results($query), //HERE 'count_search_results($query)' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 86//
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
			   		'cur_tag_open'	 => "<li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);
			   $src_result = $this->Schemes_model->search($query, $config['per_page'], $this->uri->segment(4));

			   $this->load->view('pub/search_results',compact('src_result'));
	}

	public function scheme( $id )//HERE "$id" PARAMETER IS RECEIVED FROM "public function find ( $id )" FUNCTION OF "Schemes_model.php" FILE OF MODELS FOLDER//
	{
		//$this->load->helper('form');
		//$this->load->model('Schemes_model');
		$art_id = $this->Schemes_model->find( $id ); //HE WIL PASS THIS "$art_id" OBJECT INTO "scheme_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/scheme_detail', compact('art_id'));
	}

	public function dept_result( $user_id )
	{

		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("User/dept_result/$user_id"),
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->find_dept($user_id), //HERE 'find_dept($user_id)' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file //
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
			   		'cur_tag_open'	 => "<li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);


		$dept_id = $this->Schemes_model->dept_pagination( $user_id, $config['per_page'], $this->uri->segment(4) ); //HE WIL PASS THIS "$art_id" OBJECT INTO "scheme_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/dept_detail', compact('dept_id'));

	}

	public function category_result( $category )
	{
			
		//$this->load->helper('form');
		//$this->load->model('Schemes_model');
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("User/category_result/$category"),
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->find_category($category), //HERE 'find_dept($user_id)' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file //
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
			   		'cur_tag_open'	 => "<li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);


		$cat_id = $this->Schemes_model->category_pagination( $category, $config['per_page'], $this->uri->segment(4) ); //HE WIL PASS THIS "$art_id" OBJECT INTO "scheme_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/category_detail', compact('cat_id'));

	}

	public function fund_result( $fund )
	{
			
		//$this->load->helper('form');
		//$this->load->model('Schemes_model');
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("User/fund_result/$fund"),
			   		'per_page'	=> 5,
			   		'total_rows'=> $this->Schemes_model->find_fund($fund), //HERE 'find_dept($user_id)' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file //
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
			   		'cur_tag_open'	 => "<li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);


		$fund_cat = $this->Schemes_model->fund_pagination( $fund, $config['per_page'], $this->uri->segment(4) ); //HE WIL PASS THIS "$art_id" OBJECT INTO "scheme_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/fund_detail', compact('fund_cat'));

	}

	public function extra()
		{
			
			$this->load->view('pub/extra');
		}
    
    /* FOR CATEGORY OF SINGLE DEPARTMENT */
    public function dept_category()
	{
		$category =  $this->uri->segment(3);
        $user_id =  $this->uri->segment(4);	
		//$this->load->helper('form');
		//$this->load->model('Schemes_model');
		 $this->load->library('pagination');
			   $config = [
			   		'base_url'	=> base_url("User/dept_result/$category/$user_id"),
			   		'per_page'	=> 8,
			   		'total_rows'=> $this->Schemes_model->find_dept_category(), 
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
			   		'cur_tag_open'	 => "<li class='active'>",
			   		'cur_tag_close' => '</a></li>',
			  		];
			   $this->pagination->initialize($config);


		$dept_cat = $this->Schemes_model->dept_category_pagination( $category, $user_id, $config['per_page'], $this->uri->segment(4) ); //HE WIL PASS THIS "$art_id" OBJECT INTO "scheme_detail.php" FILE OF VIEWS FOLDER//
		$this->load->view('pub/dept_cat_detail', compact('dept_cat'));

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
			   		'total_rows'=> $this->Schemes_model->count_category(), //HERE 'count_all_schemes()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 42//
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
			   		'total_rows'=> $this->Schemes_model->count_scheme(), //HERE 'count_all_schemes()' IS THE FUNCTION WE MADE IN 'Schemes_model.php' file at line no. 42//
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