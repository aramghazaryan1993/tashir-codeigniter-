 <?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Import Model
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_model extends CI_Model {

    private $_batchImport;

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('tmp_payments', $data);
    }

    public function ReadFiles($path,$import_xls_file,$userID) {
        try {
              header('Content-Type: text/html; charset=utf-8');
            $this->db->trans_start();
               
            /*$this->db->query(" truncate table tmp_payments;");   
                $a="LOAD DATA LOCAL INFILE '".$path.$import_xls_file."' INTO TABLE tmp_payments
                        CHARACTER SET 'utf8'
                        FIELDS TERMINATED BY ';'
                        LINES TERMINATED BY '\r\n'
                        IGNORE 1 LINES
                        (emptyColumn,productName, supplierName, projectName, description,price,quantity);";
                        
                //throw new Exception($a, 0);   
                 
                $this->db->query($a);*/

                $query=$this->db->query("call pr_read_payments('$import_xls_file',$userID);");
                $result=$query->row()->result;   

                if ($result==1)
                {
                    copy($path.$import_xls_file, ROOT_UPLOAD_IMPORT_PATH."Readed/".$import_xls_file);
                    //$this->db->query("truncate table tmp_payments;");
                }

                unlink($path.$import_xls_file);
                $query->next_result(); 
                $query->free_result(); 
                $this->db->trans_complete();
                return $result;
            
            }
            catch (Exception $e) 
            {
                if(file_exists ( $path.$import_xls_file )){
                    unlink($path.$import_xls_file);    
                }
                $this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  ReadFiles()");');
                echo $e->getMessage().'  ReadFiles()';
            }
       
    }

    public function GetUnReadedPayments() 
    {
        try
        {
           $sql = "select Tp.productName,TP.supplierName,TP.projectName,TP.description, TP.price, TP.quantity,
                case when ifnull(PD.id,0)=0 then 1 else 0 end as missingProduct,
                case when ifnull(PJ.id,0)=0 then 1 else 0 end as missingProject,
                case when ifnull(SP.id,0)=0 then 1 else 0 end as missingSupplier
                from tmp_payments TP 
                   left join tbl_products PD on PD.name=TP.productName
                   left join tbl_projects PJ on PJ.name=TP.projectName
                   left join tbl_suppliers SP on SP.name=TP.supplierName
                where ifnull(PD.id,0)=0 or ifnull(PJ.id,0)=0 or ifnull(SP.id,0)=0 or price=0 or quantity=0;";
           //return $sql;
           $result = $this->db->query($sql);

           if (!$result)
           {
                $error = $this->db->error(); 
                throw new Exception($error['message']);
           }

           return $result;
        }

        catch (Exception $e) 
        {
            $this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  GetUnReadedPayments()";');
            echo $e->getMessage().'  GetUnReadedPayments()';
        }

     }

     public function DeleteTmpTable()
     {
        $this->db->query(" truncate table tmp_payments;");   
     }


}
