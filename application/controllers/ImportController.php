<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Import Controller
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */

class ImportController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->userID=$this->session->userdata('user_id');
        date_default_timezone_set('Asia/Yerevan');
        $this->load->model('Import_model', 'import');
    }

    public function save() {
        $this->import->DeleteTmpTable();
            
        $this->load->library('excel');
         try {
                $path = ROOT_UPLOAD_IMPORT_PATH;

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv|jpg|png';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                
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
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('Պրոդուկտ', 'Մատակարար', 'Պրոյեկտ', 'Նկարագրություն', 'Գին','Քանակ',
                'Ամսաթիվ');
            $makeArray = array('Պրոդուկտ' => 'Պրոդուկտ', 'Մատակարար' => 'Մատակարար', 
                'Պրոյեկտ' => 'Պրոյեկտ', 'Նկարագրություն' => 'Նկարագրություն', 'Գին' => 'Գին', 
                'Քանակ' => 'Քանակ','Ամսաթիվ'=>'Ամսաթիվ');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);
           
            //if (empty($data)) {
                $flag = 1;
            //}
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $productName = $SheetDataKey['Պրոդուկտ'];
                    $supplierName = $SheetDataKey['Մատակարար'];
                    $projectName = $SheetDataKey['Պրոյեկտ'];
                    $description = $SheetDataKey['Նկարագրություն'];
                    $price = $SheetDataKey['Գին'];
                    $quantity = $SheetDataKey['Քանակ'];
                    $registration_date = $SheetDataKey['Ամսաթիվ'];
                    $productName = filter_var(trim($allDataInSheet[$i][$productName]), FILTER_SANITIZE_STRING);
                    $supplierName = filter_var(trim($allDataInSheet[$i][$supplierName]), FILTER_SANITIZE_STRING);
                    $projectName = trim($allDataInSheet[$i][$projectName]);
                    $description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
                    $price = filter_var(trim($allDataInSheet[$i][$price]), FILTER_SANITIZE_STRING);
                    $quantity = filter_var(trim($allDataInSheet[$i][$quantity]), FILTER_SANITIZE_STRING);


                    $date =  trim($allDataInSheet[$i][$registration_date]);
                    $d = explode("-",$date); 
                    $registration_date = date('Y-m-d', strtotime($d[2]."-".$d[0]."-".$d[1]));
                    $fetchData[] = array('productName' => $productName, 'supplierName' => $supplierName, 'projectName' => 
                        $projectName, 'description' => $description, 'price' => $price, 'quantity' => $quantity, 
                        'registration_date'=>$registration_date);
                }              
                $this->import->setBatchImport($fetchData);
                $this->import->importData();
            } else {
                echo "Please import correct file";
            }
        
        //$this->load->view('import/display', $data);

                $result = $this->import->ReadFiles($path,$import_xls_file,$this->userID);
                echo $result;

        }
        catch(Exception $e)
            {
                if(file_exists ( $path.$import_xls_file )){
                    unlink($path.$import_xls_file);    
                }
                
            }
    }

    public function GetUnReadedPayments()
    {
        $query = $this->import->GetUnReadedPayments();
        $data['un_readed_payments'] = $query;  
        $this->load->view('UnReadedPayments',$data);
    }

}
