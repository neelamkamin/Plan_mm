
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Import_model extends CI_Model {

    public function importData($data) {

        $res = $this->db->insert_batch('schemes',$data);//HERE 'schemes' IS THE TABLE NAME//
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }

    }
 
   public function count_all_scheme()
    {
        $dept_id = $this->session->userdata('dept_id');
        $query = $this->db
                            ->select(['name_scheme','id'])
                            ->from('schemes')
                            ->get();
        return $query->num_rows();
    }

    public function all_schemes_list($limit, $offset)
    //THIS FUNCTION IS TO SHOW LIST OF ALL PROJECTS ON PUBLIC//
     {
        
        $query = $this->db
                            ->select()//HERE WE JUST ADDED 'reported_at' AS NEW PARAMETER TO SHOW DATE//
                            ->from('schemes')
                            ->limit ($limit, $offset) //FOR PAGINATION ONLY//
                            ->order_by('id','DESC')//THIS IS ACTIVE RECORD LIBRARY OF CODEIGNITER
                            ->get();            
        //print_r($query->result()); exit;
        return $query->result();

      }
}
?>

