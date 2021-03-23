
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Import extends CI_Controller {  

    function __construct() {

     parent::__construct();
      if(! $this->session->userdata('dept_id'))
      return redirect('Login');

      $dept_id = $this->session->userdata('dept_id');
      //print_r($dept_id); exit;
      $admin_id = "Planing_and_Investment";
/*THIS 'Planing_and_Investment' IS THE 'id' ALREADY MADE IN DATABASE AS SUPER ADMIN
  SUPER ADMIN IS THE DEPT. OF PLANNING & INVESTMENT, GOVT. OF ARUNACHAL PRADESH
 */
      if ($dept_id == $admin_id)
            {
              $this->load->helper('form');
              $this->load->library('excel');
              $this->load->model('import_model');

            }else {
                      
              return redirect('Dept');
            } 
  }
      
  public function index(){
    
    $this->load->view('import/upload');
  }
  public function uploadData(){

  if ($this->input->post('submit')) {
            
            $path = 'uploads_mm/excel_mm/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            //$this->upload->initialize($config);
            $this->load->library('upload', $config);
                    
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if(empty($error)){
              if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                foreach ($allDataInSheet as $value) {
                  if($flag){
                    $flag =false;
                    continue;
                  }
                  $inserdata[$i]['dept_id']                = $value['B'];
                  $inserdata[$i]['FY']                     = $value['C'];
                  $inserdata[$i]['pre_budget_est']         = $value['D'];
                  $inserdata[$i]['pre_revised_est']        = $value['E'];
                  $inserdata[$i]['name_scheme']            = $value['F'];
                  $inserdata[$i]['category']               = $value['G'];
                  $inserdata[$i]['fund_cat']               = $value['H'];
                  $inserdata[$i]['budget_est']             = $value['I'];
                
                
                  $i++;
                }               
                $result = $this->import_model->importdata($inserdata);   
                if($result){

                  $this->session->set_flashdata('feedback',"Excel Records imported Succesfully.");
                  $this->session->set_flashdata('feedback_class','alert-success');
                  return redirect('Auth');

                }else{
                  echo "ERROR mm!";
                }             

          } catch (Exception $e) {
               die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' .$e->getMessage());
               $this->load->view('Import');
            }
          }else{
              echo "Failed to import - please import correct format excel file";
            $this->load->view('Import');
            }
            
            
    }
    
  }


    public function show_all()
    
    {

        $this->load->helper('form');
        $this->load->model('Import_model');
         $this->load->library('pagination');
               $config = [
                    'base_url'  => base_url('Import/show_all'),//BOZ HERE WE LOAD 'function index()' OF USER CONTROLLER//
                    'per_page'  => 10,
                    'total_rows'=> $this->Import_model->count_all_scheme(), //HERE 'count_all_schemes()' IS THE FUNCTION WE MADE IN 'schemesmodel.php' file at line no. 42//
                    'full_tag_open'  => "<ul class='pagination'>",//THIS LINE IS NOW WORKING
                    'full_tag_close' => "</ul>",
                    'first_tag_open' => '<li>',
                    'first_tag_close' => '</li>',
                    'last_tag_open' => '<li>',
                    'last_tag_close' => '</li>',
                    'next_tag_open'  => '<li>',
                    'next_tag_close' => '</li>',
                    'prev_tag_open'  => '<li>',
                    'prev_tag_close' => '</li>',
                    'num_tag_open'   => '<li>',
                    'num_tag_close' => '</li>',
                    'cur_tag_open'   => "<li class='active'><a>",
                    'cur_tag_close' => '</a></li>',
                    ];
               $this->pagination->initialize($config);

               $schemes = $this->Import_model->all_schemes_list($config['per_page'], $this->uri->segment(3));
        $this->load->helper('html'); //We have autoload it in autoload.php file of congig folder... 
        //...with syntex= $autoload['helper'] = array('html'); -- where I hav only entered 'html' in array parametres.//
        $this->load->view('import/dept_list',compact('schemes'));
        //HERE 'compact('schemes')' IS SAME AS ['schemes'=>$schemes];, JUST WE WRITE DIFFERENTLY//
    }
}
?>


