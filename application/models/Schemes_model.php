<?php
class Schemes_model extends CI_Model {

/*var $schemes refers to schemes only 
	Word scheme = scheme
Actually this code is reuse version of my earlier project AND I didn't change the variables name
*/ 
public function count_all_dept()
/*This Model function will load on landing page if user is admin */
	{
		//$dept_id = $this->session->userdata('dept_id');
		$query = $this->db
							->select(['name_scheme','id'])
							->from('schemes')
							->group_by('dept_id')
							->get();
		return $query->num_rows();
	}

	public function sum_column($limit, $offset)
/*This Model function will also load on landing page if user is admin */	
	{
		$this->db->select('dept_id, SUM(budget_est) AS AMOUNT, COUNT(name_scheme) AS TOTAL ', FALSE);
		$this->db->where('status', 1);
		$this->db->group_by('dept_id');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result_array();

	}

	public function num_rows() //THIS NEW FUNCTION IS MADE TO GET 'total_rows' FOR PAGINATION, SEE LINE 14 OF ADMIN.PHP FILE //
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
	//THIS FUNCTION IS TO SHOW LIST OF PROJECTS ON DASHBOARD//
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
		return $query->result();
					
	}

	public function all_schemes_list($limit, $offset)
	//THIS FUNCTION IS TO SHOW LIST OF ALL SCHEME FOR SUPER ADMIN//
	{
		
		$query = $this->db
							->select()
							->from('schemes')
							->where('status', 1)
							->limit ($limit, $offset) //FOR PAGINATION ONLY//
							->order_by('id','DESC')
							->get();			
		//print_r($query->result()); exit;
		return $query->result();
	}

	public function count_all_schemes()
	{
		$dept_id = $this->session->userdata('dept_id');
		$query = $this->db
							->select(['dept_id','id'])
							->from('schemes')
							->get();
		return $query->num_rows();
	}

	public function sum_category($limit, $offset)
	{
		$this->db->select('fund_cat, SUM(budget_est) AS AMOUNT', FALSE);
		$this->db->where('status', 1);
		$this->db->group_by('fund_cat');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result();

	}
	public function count_category()
	{
		$dept_id = $this->session->userdata('dept_id');
		$query = $this->db
							->select(['name_scheme','id'])
							->from('schemes')
							->group_by('fund_cat')
							->get();
		return $query->num_rows();
	}
//FOR SCHEMES LIST GROUPING//
	public function sum_scheme($limit, $offset)
	{
		$this->db->select('category, SUM(budget_est) AS AMOUNT', FALSE);
		//$this->db->select("dept_id, SUM(budget_est) as AMOUNT");
		$this->db->where('status', 1);
		$this->db->group_by('category');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result();

	}
	public function count_scheme()
	{
		$dept_id = $this->session->userdata('dept_id');
		$query = $this->db
							->select(['name_scheme','id'])
							->from('schemes')
							->group_by('category')
							->get();
		return $query->num_rows();
	}


	public function add_scheme($array)
	{
		return $this->db->insert('schemes',$array);
	}

	public function find_scheme($scheme_id)
	{
		$q = $this->db
			     //->select(['id','name_scheme','body','status','remark','budget_est','exp','category'])
				->select()
				->where('id',$scheme_id)
				->get('schemes');

		return $q->row(); //HERE WE RETURN 'ROW'TO FETCH ONLY ONE AFFECTED ROW, IF WE RETURN 'RESULT' THEN ARRAY WILL START WITH ZERO (0) INDEX// 
	}

	public function update_scheme($scheme_id, Array $scheme)
	{
		return $this->db
				->where('id',$scheme_id)
				->update('schemes',$scheme);
	}

	public function delete_scheme($arr_id)
	{
		return $this->db->delete('schemes',['id'=>$arr_id]); //HERE 1ST PARAMETER IS TABLE NAME, i.e->schemes & 2ND PARAMETER IS ID OF THE REPORT-scheme TO BE DELETED//
	}

	public function search( $query, $limit, $offset )//HERE WE RECEIVED PARAMETER "$query" FROM 'public function search()' OF 'user.php' FILE AT LINE 39//
	{
		$q = $this->db->from('schemes')
					->like('name_scheme',$query)//HERE WE PASSED "$query" WHICH WE RECEIVED ABOVE AS PARAMETER//
					->where('status', 1)
					->limit ( $limit, $offset)
					->order_by('id','DESC')
					->get();
		return $q->result();
	}

	public function count_search_results($query)
	{
		$qr = $this->db->from('schemes')
						->like('name_scheme',$query)
						->where('status', 1)
						->get();
		return $qr->num_rows();
	}

	public function dept_pagination( $dept_id, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/dept_result($dept_id)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "single_dept.php"//
	{
	
		$this->db->select('dept_id,category, SUM(budget_est) AS AMOUNT, COUNT(name_scheme) AS TOTAL ', FALSE);
		//$this->db->select("dept_id, SUM(budget_est) as AMOUNT");
		$this->db->group_by('category');

		$this->db->where( [
							'status' => 1, 
							'dept_id' => $dept_id
						 ] );

		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result();
	}

	public function find_dept ( $dept_id )//TO FIND 'dept_id' VIA ANCHOR tag/link only//
	{
	
		$query = $this->db
							->select(['name_scheme','id','dept_id'])
							->from('schemes')
							->group_by('category')
							->where( ['dept_id' => $dept_id] )
							->get();
		return $query->num_rows();

	}

	public function find_category ( $category )//TO FIND 'category' VIA ANCHOR tag/link only//
	{
		$q = $this->db
					->from('schemes')
					->where( ['category' => $category] )
					->get();
		return $q->num_rows();

	}
	public function category_pagination( $category, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/category_result($category)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "cat_list.php"//
	{
		$q = $this->db->from('schemes')
					->like('category',$category)//HERE WE PASSED "$dept_id" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            ->where( ['category' => $category, 'status' => 1] )
					->limit ( $limit, $offset)
					->order_by('id','DESC')
					->get();
		return $q->result();
	}

	public function find_fund ( $fund )//TO FIND 'category' VIA ANCHOR tag/link only//
	{
		$q = $this->db
					->from('schemes')
					->where( ['fund_cat' => $fund, 'status' => 1] )
					->get();
		return $q->num_rows();

	}
	public function fund_pagination( $fund, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/category_result($category)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "cat_list.php"//
	{
		$q = $this->db->from('schemes')
					->like('fund_cat',$fund)//HERE WE PASSED "$dept_id" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            ->where( ['fund_cat' => $fund, 'status' => 1] )
					->limit ( $limit, $offset)
					->order_by('id','DESC')
					->get();
		return $q->result();
	}

	public function find ( $id )
	{
		$q = $this->db->from('schemes')
					->where( ['id' => $id] )
					->get();
		if($q->num_rows())
			return $q->row();
		return false;

	}
	
	public function find_dept_category ()
	{
		$category =  $this->uri->segment(3); /*HERE WE GET dept_id AND CATEGORY FROM URL */
        $dept_id =  $this->uri->segment(4);
        //print_r($dept_id);
        //print_r($category); die();		
		$query = $this->db
							->select(['name_scheme','id','dept_id'])
							->from('schemes')
							->where( [
										'status'  => 1,
										'category' => $category,
										'dept_id' => $dept_id
									] )
							->get();
		return $query->num_rows();

	}
	public function dept_category_pagination( $category,$dept_id, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/category_result($category)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "cat_list.php"//
	{
		$q = $this->db->from('schemes')
					->like('category',$category)//HERE WE PASSED "$category" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            ->where( [
								'status'  => 1,
								'category' => $category,
								'dept_id' => $dept_id
							] )
					->limit ( $limit, $offset)
					->order_by('id','DESC')
					->get();
		return $q->result();
	}
	 
    
}

?>
