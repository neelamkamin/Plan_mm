<?php

$config = [

			'add_article_rules' =>[
											[
												'field' => 'FY',
												'label' => 'FY',
												'rules' => 'required'
											],

											[
												'field' => 'name_scheme',
												'label' => 'NAME SCHEME',
												'rules' => 'required',
											],

											[
												'field' => 'category',
												'label' => 'CATEGORY',
												'rules' => 'required',
											],

											[
												'field' => 'fund_cat',
												'label' => 'FUND CATEGORY',
												'rules' => 'required',
											],	

											[
												'field' => 'budget_est',
												'label' => 'BUDGET ESTIMATE',
												'rules' => 'required',
											]								

									],


				'edit_article_rules' =>[
											[
												'field' => 'title',
												'label' => 'Article Title',
												'rules' => 'required'
											],
											[
												'field' => 'body',
												'label' => 'Article Body',
												'rules' => 'required',
											],
											[
												'field' => 'cost',
												'label' => 'Article cost',
												'rules' => 'required',
											]

									],

			    'admin_login' =>  [

			    	 						[
			    	 							'field' => 'username',
												'label' => 'User Name',
												'rules' => 'required|min_length[2]',
			    	 						],
			    	 						[
			    	 							'field' => 'password',
												'label' => 'PassWord',
												'rules' => 'required'
			    	 						]


			    				],

       ];

?>