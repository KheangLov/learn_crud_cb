<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;
use Illuminate\Contracts\Session\Session as SessionSession;

class AdminEmployeesController extends \crocodicstudio\crudbooster\controllers\CBController {

		public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "first_name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "employees";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"First Name","name"=>"first_name"];
			$this->col[] = ["label"=>"Last Name","name"=>"last_name"];
			$this->col[] = ["label"=>"Name Khmer","name"=>"name_khmer"];
			$this->col[] = ["label"=>"Gender","name"=>"gender"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Date of birth","name"=>"dob"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Name Khmer','name'=>'name_khmer','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Gender','name'=>'gender','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'Male;Female'];
			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:employees','width'=>'col-sm-10','placeholder'=>'Please enter a valid email address'];
			$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'min:6|max:50','width'=>'col-sm-10','help'=>'Minimum 5 characters. Please leave empty if you did not change the password.'];
			$this->form[] = ['label'=>'Dob','name'=>'dob','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Start Date','name'=>'start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'End Date','name'=>'end_date','type'=>'date','validation'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Annual Leave','name'=>'annual_leave','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Card','name'=>'id_card','type'=>'upload','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Card Number','name'=>'card_number','type'=>'number','validation'=>'numeric','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Bank Account','name'=>'bank_account','type'=>'number','validation'=>'numeric','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Salary','name'=>'salary','type'=>'number','validation'=>'required|numeric','width'=>'col-sm-10','placeholder'=>'You can only enter the number only'];
			$this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'number','validation'=>'required|numeric','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Contact','name'=>'contact','type'=>'upload','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Contact Name','name'=>'contact_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Contact Relation','name'=>'contact_relation','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Contact Phone','name'=>'contact_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Contract','name'=>'contract','type'=>'upload','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Profile','name'=>'profile','type'=>'upload','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Hobby','name'=>'hobby','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Home Town','name'=>'home_town','type'=>'text','validation'=>'max:50','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Self Intro','name'=>'self_intro','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Goal','name'=>'goal','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Education','name'=>'education','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'Active;Inactive'];
			$this->form[] = ['label'=>'Supervisor','name'=>'supervisor_id','type'=>'select2','validation'=>'integer','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			$this->form[] = ['label'=>'Department','name'=>'department_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'departments,name'];
			$this->form[] = ['label'=>'Unit','name'=>'unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'units,name'];
			$this->form[] = ['label'=>'Position','name'=>'position_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'positions,name'];
			$this->form[] = ['label'=>'Group','name'=>'group_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'groups,name'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Name Khmer','name'=>'name_khmer','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Gender','name'=>'gender','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'Male;Female'];
			//$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:employees','width'=>'col-sm-10','placeholder'=>'Please enter a valid email address'];
			//$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'min:6|max:50','width'=>'col-sm-10','help'=>'Minimum 5 characters. Please leave empty if you did not change the password.'];
			//$this->form[] = ['label'=>'Dob','name'=>'dob','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Start Date','name'=>'start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'End Date','name'=>'end_date','type'=>'date','validation'=>'date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Annual Leave','name'=>'annual_leave','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Card','name'=>'id_card','type'=>'upload','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Card Number','name'=>'card_number','type'=>'number','validation'=>'numeric','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Bank Account','name'=>'bank_account','type'=>'number','validation'=>'numeric','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Salary','name'=>'salary','type'=>'number','validation'=>'required|numeric','width'=>'col-sm-10','placeholder'=>'You can only enter the number only'];
			//$this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'number','validation'=>'required|numeric','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Contact','name'=>'contact','type'=>'upload','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Contact Name','name'=>'contact_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Contact Relation','name'=>'contact_relation','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Contact Phone','name'=>'contact_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Contract','name'=>'contract','type'=>'upload','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Profile','name'=>'profile','type'=>'upload','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Hobby','name'=>'hobby','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Home Town','name'=>'home_town','type'=>'text','validation'=>'max:50','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Self Intro','name'=>'self_intro','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Goal','name'=>'goal','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Education','name'=>'education','type'=>'text','validation'=>'max:190','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'Active;Inactive'];
			//$this->form[] = ['label'=>'Supervisor','name'=>'supervisor_id','type'=>'select2','validation'=>'integer','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			//$this->form[] = ['label'=>'Department','name'=>'department_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'departments,name'];
			//$this->form[] = ['label'=>'Unit','name'=>'unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'units,name'];
			//$this->form[] = ['label'=>'Position','name'=>'position_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'positions,name'];
			//$this->form[] = ['label'=>'Group','name'=>'group_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'groups,name'];
			# OLD END FORM

			/* 
			| ---------------------------------------------------------------------- 
			| Sub Module
			| ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
			| 
			*/
			$this->sub_module = array();


			/* 
			| ---------------------------------------------------------------------- 
			| Add More Action Button / Menu
			| ----------------------------------------------------------------------     
			| @label       = Label of action 
			| @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
			| @icon        = Font awesome class icon. e.g : fa fa-bars
			| @color 	   = Default is primary. (primary, warning, succecss, info)     
			| @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
			| 
			*/
			$this->addaction = array();
			$this->addaction[] = ['label'=>'Change Password','url'=>CRUDBooster::mainpath('?password=[id]'),'icon'=>'fa fa-lock','color'=>'primary'];


			/* 
			| ---------------------------------------------------------------------- 
			| Add More Button Selected
			| ----------------------------------------------------------------------     
			| @label       = Label of action 
			| @icon 	   = Icon from fontawesome
			| @name 	   = Name of button 
			| Then about the action, you should code at actionButtonSelected method 
			| 
			*/
			$this->button_selected = array();

							
			/* 
			| ---------------------------------------------------------------------- 
			| Add alert message to this module at overheader
			| ----------------------------------------------------------------------     
			| @message = Text of message 
			| @type    = warning,success,danger,info        
			| 
			*/
			$this->alert        = array();
							

			
			/* 
			| ---------------------------------------------------------------------- 
			| Add more button to header button 
			| ----------------------------------------------------------------------     
			| @label = Name of button 
			| @url   = URL Target
			| @icon  = Icon from Awesome.
			| 
			*/
			$this->index_button = array();



			/* 
			| ---------------------------------------------------------------------- 
			| Customize Table Row Color
			| ----------------------------------------------------------------------     
			| @condition = If condition. You may use field alias. E.g : [id] == 1
			| @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
			| 
			*/
			$this->table_row_color = array();     	          

			
			/*
			| ---------------------------------------------------------------------- 
			| You may use this bellow array to add statistic at dashboard 
			| ---------------------------------------------------------------------- 
			| @label, @count, @icon, @color 
			|
			*/
			$this->index_statistic = array();



			/*
			| ---------------------------------------------------------------------- 
			| Add javascript at body 
			| ---------------------------------------------------------------------- 
			| javascript code in the variable 
			| $this->script_js = "function() { ... }";
			|			
			$('#change_password').on('click', function() {
				var password = $('#new_password').val();
				var id = $('#emp_id').val();
				var formData = new FormData();
				formData.append('password', password);
				$.ajax({
					type: 'PUT',
					url: `/admin/employees/password/\${id}`,
					data: formData,
					processData: false,
					contentType: false,
					cache: false,
					success: function(data) {
						console.log(data);
					}
				});
			});						
			*/
			$this->script_js = null;
			if (isset($_GET['password'])) {
				$this->script_js = "
					$(document).ready(function(e) {
						$('#csrf_token').val($('meta[name=\"csrf-token\"]').attr('content'));						
						$('#emp_password').modal('show');
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')
							}
						});
					});
				";
			}

			if (!empty(session()->get('success'))) {
				$this->script_js = "
					$(function(e) {
						swal({
							title: 'Success!',
							text: '" . session()->get('success') . "',
							icon: 'success',
							button: 'Done',
						});
						$('.sa-icon.sa-success').css('display', 'block');
					});
				";
			}


				/*
			| ---------------------------------------------------------------------- 
			| Include HTML Code before index table 
			| ---------------------------------------------------------------------- 
			| html code to display it before index table
			| $this->pre_index_html = "<p>test</p>";
			|
			*/
			$this->pre_index_html = null;
			if (isset($_GET['password'])) {
				$this->pre_index_html = '
					<div class="modal fade" id="emp_password" tabindex="-1" role="dialog" aria-labelledby="emp_password">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form method="POST" action="/admin/employees/password/' . $_GET['password'] . '">
									<input type="hidden" name="_token" id="csrf_token">
									<input type="hidden" name="_method" value="PUT">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Modal title</h4>
									</div>
									<div class="modal-body">
									<div class="form-group">
										<label for="new_password">New Password</label>
										<input type="password" class="form-control" name="password" id="new_password">
									</div>
									</div>
									<div class="modal-footer">
										<a href="' . CRUDBooster::mainpath() . '" class="btn btn-default">Close</a>
										<button type="submit" class="btn btn-primary" id="change_password">Save changes</button>
									</div>								
								</form>
							</div>
						</div>
					</div>
				';
			}
			// if (isset($_GET['password'])) {
			// 	$this->pre_index_html = '
			// 		<div class="modal fade" id="emp_password" tabindex="-1" role="dialog" aria-labelledby="emp_password">
			// 			<div class="modal-dialog" role="document">
			// 				<div class="modal-content">
			// 					<div class="modal-header">
			// 						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			// 						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			// 					</div>
			// 					<div class="modal-body">
			// 					<div class="form-group">
			// 						<label for="new_password">New Password</label>
			// 						<input type="password" class="form-control" name="password" id="new_password">
			// 						<input type="hidden" name="emp_id" id="emp_id" value="'  . $_GET['password'] .  '">
			// 					</div>
			// 					</div>
			// 					<div class="modal-footer">
			// 						<a href="' . CRUDBooster::mainpath() . '" class="btn btn-default">Close</a>
			// 						<button type="submit" class="btn btn-primary" id="change_password">Save changes</button>
			// 					</div>								
			// 				</div>
			// 			</div>
			// 		</div>
			// 	';
			// }
			
			
			
			/*
			| ---------------------------------------------------------------------- 
			| Include HTML Code after index table 
			| ---------------------------------------------------------------------- 
			| html code to display it after index table
			| $this->post_index_html = "<p>test</p>";
			|
			*/
			$this->post_index_html = null;
			
			
			
			/*
			| ---------------------------------------------------------------------- 
			| Include Javascript File 
			| ---------------------------------------------------------------------- 
			| URL of your javascript each array 
			| $this->load_js[] = asset("myfile.js");
			|
			*/
			$this->load_js = array();
			// $this->load_js[] = asset("js/sweetalert.js");
			
			
			
			/*
			| ---------------------------------------------------------------------- 
			| Add css style at body 
			| ---------------------------------------------------------------------- 
			| css code in the variable 
			| $this->style_css = ".style{....}";
			|
			*/
			$this->style_css = NULL;
			
			
			
			/*
			| ---------------------------------------------------------------------- 
			| Include css File 
			| ---------------------------------------------------------------------- 
			| URL of your css each array 
			| $this->load_css[] = asset("myfile.css");
			|
			*/
			$this->load_css = array();
			
			
		}


		/*
		| ---------------------------------------------------------------------- 
		| Hook for button selected
		| ---------------------------------------------------------------------- 
		| @id_selected = the id selected
		| @button_name = the name of button
		|
		*/
		public function actionButtonSelected($id_selected,$button_name) {
			//Your code here
						
		}


		/*
		| ---------------------------------------------------------------------- 
		| Hook for manipulate query of index result 
		| ---------------------------------------------------------------------- 
		| @query = current sql query 
		|
		*/
		public function hook_query_index(&$query) {
				//Your code here
						
		}

		/*
		| ---------------------------------------------------------------------- 
		| Hook for manipulate row of index table html 
		| ---------------------------------------------------------------------- 
		|
		*/    
		public function hook_row_index($column_index,&$column_value) {	        
			//Your code here
		}

		/*
		| ---------------------------------------------------------------------- 
		| Hook for manipulate data input before add data is execute
		| ---------------------------------------------------------------------- 
		| @arr
		|
		*/
		public function hook_before_add(&$postdata) {        
			//Your code here
			if (strtolower($postdata['status']) == 'active')
				$postdata['status'] = 1;
			else
				$postdata['status'] = 0;

			if (empty($postdata['id_card']))
				$postdata['id_card'] = $postdata['card_number'];
			unset($postdata['card_number']);
		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command after add public static function called 
		| ---------------------------------------------------------------------- 
		| @id = last insert id
		| 
		*/
		public function hook_after_add($id) {        
			//Your code here
		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for manipulate data input before update data is execute
		| ---------------------------------------------------------------------- 
		| @postdata = input post data 
		| @id       = current id 
		| 
		*/
		public function hook_before_edit(&$postdata,$id) {        
				//Your code here

		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command after edit public static function called
		| ----------------------------------------------------------------------     
		| @id       = current id 
		| 
		*/
		public function hook_after_edit($id) {
				//Your code here 

		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command before delete public static function called
		| ----------------------------------------------------------------------     
		| @id       = current id 
		| 
		*/
		public function hook_before_delete($id) {
				//Your code here

		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command after delete public static function called
		| ----------------------------------------------------------------------     
		| @id       = current id 
		| 
		*/
		public function hook_after_delete($id) {
				//Your code here

		}



		//By the way, you can still create your own method in here... :) 
		// public function getIndex() {
		// 	if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
   
		// 	//Create your own query 
		// 	$data = [];
		// 	$data['page_title'] = 'Employee';
		// 	$data['result'] = DB::table('employees')->orderby('id', 'desc')->paginate(10);
		// 	$this->cbView('custom_emp', $data);
		// }
}