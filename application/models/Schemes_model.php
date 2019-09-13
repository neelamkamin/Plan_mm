<?php
class Schemes_model extends CI_Model {

/*var $articles refers to schemes only 
	Word article = scheme
Actually this code is reuse version of my earlier project AND I didn't change the variables name
*/

	public function schemes_list($limit, $offset)
	//THIS FUNCTION IS TO SHOW LIST OF PROJECTS ON DASHBOARD//
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
		                    ->select()
							->from('schemes')
							->where('user_id', $user_id)
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
							->limit ($limit, $offset) //FOR PAGINATION ONLY//
							->order_by('id','DESC')
							->get();			
		//print_r($query->result()); exit;
		return $query->result();
	}

	public function count_all_schemes()
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['user_id','id'])
							->from('schemes')
							->get();
		return $query->num_rows();
	}

	public function count_all_dept()
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['name_scheme','id'])
							->from('schemes')
							->group_by('user_id')
							->get();
		return $query->num_rows();
	}


	public function sum_column($limit, $offset)
	{
		$this->db->select('user_id, SUM(budget_est) AS AMOUNT, COUNT(name_scheme) AS TOTAL ', FALSE);
		$this->db->group_by('user_id');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result_array();

	}

	public function sum_category($limit, $offset)
	{
		$this->db->select('fund_cat, SUM(budget_est) AS AMOUNT', FALSE);
		$this->db->group_by('fund_cat');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result();

	}
	public function count_category()
	{
		$user_id = $this->session->userdata('user_id');
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
		//$this->db->select("user_id, SUM(budget_est) as AMOUNT");
		$this->db->group_by('category');
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result();

	}
	public function count_scheme()
	{
		$user_id = $this->session->userdata('user_id');
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

	public function find_scheme($article_id)
	{
		$q = $this->db
			     //->select(['id','name_scheme','body','status','remark','budget_est','exp','category'])
				->select()
				->where('id',$article_id)
				->get('schemes');

		return $q->row(); //HERE WE RETURN 'ROW'TO FETCH ONLY ONE AFFECTED ROW, IF WE RETURN 'RESULT' THEN ARRAY WILL START WITH ZERO (0) INDEX// 
	}

	public function update_scheme($article_id, Array $article)
	{
		return $this->db
				->where('id',$article_id)
				->update('schemes',$article);
	}

	public function delete_scheme($arr_id)
	{
		return $this->db->delete('schemes',['id'=>$arr_id]); //HERE 1ST PARAMETER IS TABLE NAME, i.e->schemes & 2ND PARAMETER IS ID OF THE REPORT-ARTICLE TO BE DELETED//
	}

	

	public function num_rows() //THIS NEW FUNCTION IS MADE TO GET 'total_rows' FOR PAGINATION, SEE LINE 14 OF ADMIN.PHP FILE //
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db
							->select(['name_scheme','id'])
							->from('schemes')
							->where('user_id', $user_id)
							->get();
		return $query->num_rows();
	}

	public function search( $query, $limit, $offset )//HERE WE RECEIVED PARAMETER "$query" FROM 'public function search()' OF 'user.php' FILE AT LINE 39//
	{
		$q = $this->db->from('schemes')
					->like('user_id',$query)//HERE WE PASSED "$query" WHICH WE RECEIVED ABOVE AS PARAMETER//
					->limit ( $limit, $offset)
					->order_by('id','DESC')
					->get();
		return $q->result();
	}

	public function count_search_results($query)
	{
		$qr = $this->db->from('schemes')
						->like('user_id',$query)
						->get();
		return $qr->num_rows();
	}

	public function dept_pagination( $user_id, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/dept_result($user_id)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "single_dept.php"//
	{
	
		$this->db->select('user_id,category, SUM(budget_est) AS AMOUNT, COUNT(name_scheme) AS TOTAL ', FALSE);
		//$this->db->select("user_id, SUM(budget_est) as AMOUNT");
		$this->db->group_by('category');
		$this->db->where( ['user_id' => $user_id] );
		$this->db->limit ($limit, $offset);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('schemes');
		return $query->result();
	}

	public function find_dept ( $user_id )//TO FIND 'user_id' VIA ANCHOR tag/link only//
	{
	
		$query = $this->db
							->select(['name_scheme','id','user_id'])
							->from('schemes')
							->group_by('category')
							->where( ['user_id' => $user_id] )
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
					->like('category',$category)//HERE WE PASSED "$user_id" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            ->where( ['category' => $category] )
					->limit ( $limit, $offset)
					->order_by('id','DESC')
					->get();
		return $q->result();
	}

	public function find_fund ( $fund )//TO FIND 'category' VIA ANCHOR tag/link only//
	{
		$q = $this->db
					->from('schemes')
					->where( ['fund_cat' => $fund] )
					->get();
		return $q->num_rows();

	}
	public function fund_pagination( $fund, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/category_result($category)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "cat_list.php"//
	{
		$q = $this->db->from('schemes')
					->like('fund_cat',$fund)//HERE WE PASSED "$user_id" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            ->where( ['fund_cat' => $fund] )
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
		$category =  $this->uri->segment(3); /*HERE WE GET USER_ID AND CATEGORY FROM URL */
        $user_id =  $this->uri->segment(4);
        //print_r($user_id);
        //print_r($category); die();		
		$query = $this->db
							->select(['name_scheme','id','user_id'])
							->from('schemes')
							->where( [
										'category' => $category,
										'user_id' => $user_id
									] )
							->get();
		return $query->num_rows();

	}
	public function dept_category_pagination( $category,$user_id, $limit, $offset )
//TO DISPLAY DATA WITH PAGINATION OF CONTROLLER "User/category_result($category)" VIA ANCHOR TAG/LINK ONLY AT VIEW FILE:-  "cat_list.php"//
	{
		$q = $this->db->from('schemes')
					->like('category',$category)//HERE WE PASSED "$category" WHICH WE RECEIVED ABOVE AS PARAMETER//
		            ->where( [
								'category' => $category,
								'user_id' => $user_id
							] )
					->limit ( $limit, $offset)
					->order_by('id','DESC')
					->get();
		return $q->result();
	}
	 
    
}

?>