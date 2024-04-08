<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @author   : Creativeitem
 *  date    : 7 October, 2018
 *  Academy
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

class Data_center extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));
        
        $this->load->database();
        $this->load->library('session');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if(strpos(base_url(), 'demo.creativeitem.com')){
            $this->session->set_flashdata('error_message', "This feature is not available in the demo platform.");
            redirect(site_url('admin/data_center'), 'refresh');
        }


        ini_set('memory_limit', '5000M');
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
    }


    function demo_importer()
    {

        //check file validity and version
        if(empty($_FILES["data_file"]["name"])){
            $this->session->set_flashdata('error_message', get_phrase('please_select_your_zip_file'));
            redirect(site_url('admin/data_center'), 'refresh');
        }

        if (!is_dir('backups'))
            mkdir('backups', 0777, true);

        $upload_path = 'uploads.zip';
        $backup_path = 'backups/uploads_v'.get_settings('version').'_'.date('d-M-Y-H-i-s');
        $uploaded_folder_name = explode('.zip' ,$_FILES["data_file"]["name"])[0];

        //check file validity and version
        if(!strpos($_FILES["data_file"]["name"], get_settings('version'))){
            $this->session->set_flashdata('error_message', get_phrase('version_mismatching').'!');
            redirect(site_url('admin/data_center'), 'refresh');
        }


        if (class_exists('ZipArchive')) {
            //move existing uploads folder to backup folder
            rename('uploads', $backup_path);
            //Backup current database before run uploaded demo sql
            $this->backup_sql($backup_path);

            //upload new zip file in root path
            move_uploaded_file($_FILES["data_file"]["tmp_name"], $upload_path);

            // Unzip uploaded file and remove zip file.
            $zip = new ZipArchive;
            $res = $zip->open($upload_path);
            //Extract to root path
            $zip->extractTo('./');
            $zip->close();
            unlink($upload_path);




            //rename the uploaded folder from uploads_v5.10.1 to uploads
            rename($uploaded_folder_name, 'uploads');

            //if the uploaded folder structure is uploads_v5.10.1_06-Dec-2022-13-28-04 > uploads_v5.10.1
            $files_and_folders = glob(BASEPATH.'../*', GLOB_MARK);
            foreach ($files_and_folders as $files_and_folder) {
                $files_and_folder_arr = explode('/', $files_and_folder);

                //remove a extra / end of folder name
                $folder_name = str_replace("\selector", '', end($files_and_folder_arr).'selector');

                //remove extra space from this type of folder name (uploads_v5.10.1 (7).zip)
                $ext_file_name = preg_replace('/\s+/', '', explode(' (', $uploaded_folder_name)[0]);

                //check 
                if(strpos($folder_name, $uploaded_folder_name) > 0 || strpos($folder_name, $ext_file_name) !== false){

                    //rename from uploads_v5.10.1_06-Dec-2022-13-28-04 to uploads
                    rename($folder_name, 'uploads');
                }
            }

        }else{
            $this->session->set_flashdata('error_message', get_phrase('your_server_is_unable_to_extract_the_zip_file').'. '.get_phrase('please_enable_the_zip_extension_on_your_server').', '.get_phrase('then_try_again'));
            redirect(site_url('admin/data_center'), 'refresh');
        }

        //Run uploaded sql file [drop table added sql file]
        $this->run_demo_sql('./uploads/demo.sql');

        //Delete uploaded sql file after run that
        unlink('uploads/demo.sql');

        $this->session->set_flashdata('imported_message', get_phrase('created_a_backup_file_of_your_old_data'));
        $this->session->set_flashdata('flash_message', get_phrase('demo_imported_successfully'));
        redirect(site_url('admin/data_center'), 'refresh');
    }

    public function exportDatabase() {
        

    }

    function backup_sql($backup_path){
        // Access the specific configuration values
        $database = $this->db->database;
        $host     = $this->db->hostname;
        $username = $this->db->username;
        $password = $this->db->password;

        // Connect to the database
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

        // Retrieve the list of tables
        $tablesQuery = $pdo->query("SHOW TABLES");
        $tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);

        // Generate the SQL script for structure and data
        $sqlScript = '';

        foreach ($tables as $table) {
            // Drop table if exists
            $sqlScript .= "DROP TABLE IF EXISTS `$table`;\n";

            // Create table again
            $createTableQuery = $pdo->query("SHOW CREATE TABLE `$table`");
            $createTableStatement = $createTableQuery->fetch();
            $createTableSQL = $createTableStatement['Create Table'];
            $sqlScript .= "$createTableSQL;\n";

            // Export data
            $dataQuery = $pdo->query("SELECT * FROM `$table`");
            $rows = $dataQuery->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($rows)) {
                $insertSQL = "INSERT INTO `$table` (";
                $columns = array_keys($rows[0]);
                $insertSQL .= "`" . implode("`, `", $columns) . "`) VALUES ";

                foreach ($rows as $row) {
                    $values = array_map(function ($value) use ($pdo) {
                        if ($value === null) {
                            return 'NULL';
                        }
                        return $pdo->quote($value);
                    }, $row);

                    $insertSQL .= "(" . implode(", ", $values) . "), ";
                }

                $insertSQL = rtrim($insertSQL, ", ") . ";\n";
                $sqlScript .= $insertSQL;
            }
        }

        // Specify the directory to save the SQL script
        $filename = 'demo.sql';
        $file = $backup_path . '/' . $filename;

        // Save the SQL script to file
        file_put_contents($file, $sqlScript);       
    }

    function run_demo_sql($file_path) {
        $this->load->database();

        // Set line to collect lines that wrap
        $templine = '';
        // Read in entire file
        $lines = file($file_path);
        // Loop through each line
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current templine we are creating
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query so can process this templine
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                $this->db->query($templine);
                // Reset temp variable to empty
                $templine = '';
            }
        }
    }

    function extract_zip_file($path, $extractTo, $delete_zip_file = false){
        //extract the created zip file and delete zip file without demo.sql file
        $zip = new ZipArchive;
        $res = $zip->open($path);
        //Extract to root path
        $zip->extractTo($extractTo);
        $zip->close();

        if($delete_zip_file == true){
            unlink($path);
        }
    }

    function download_zip_file($folder_name){

        $this->load->library('zip');
        $this->zip->read_dir('backups/'.$folder_name, false);

        // Download the file to your desktop. Name it "my_backup.zip"
        $this->zip->download('uploads_v'.get_settings('version').'.zip');


        $this->session->set_flashdata('flash_message', get_phrase('downloaded_successfully'));
        redirect(site_url('admin/data_center'), 'refresh');
    }

    public function delete_dir($dirName = ""){
        if($dirName == ""){
            redirect(site_url('admin/data_center'), 'refresh');
        }
        
        $this->deleteDir('backups/'.$dirName);

        $this->session->set_flashdata('flash_message', get_phrase('backup_files_deleted_successfully'));
        redirect(site_url('admin/data_center'), 'refresh');
    }

    public static function deleteDir($dirPath) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if(file_exists($file.'.htaccess')){
                unlink($file.'.htaccess');
            }
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    function create_backup_file(){
        $dirPath = 'uploads';
        $backup_path = 'backups/uploads_v'.get_settings('version').'_'.date('d-M-Y-H-i-s');

        $this->copyAllFilesAndFolders($dirPath, $backup_path);

        $this->backup_sql($backup_path);

        $this->session->set_flashdata('flash_message', get_phrase('your_backup_file_has_been_stored_successfully'));
        redirect(site_url('admin/data_center'), 'refresh');
    }

    public static function copyAllFilesAndFolders($dirPath, $backup_path){
        
        if (!is_dir('backups'))
            mkdir('backups', 0777, true);
        if (!is_dir($backup_path))
            mkdir($backup_path, 0777, true);

        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            $new_path = str_replace('uploads/', '', $file);

            if (is_dir($file)) {
                if (!is_dir($backup_path.'/'.$new_path))
                    mkdir($backup_path.'/'.$new_path, 0777, true);

                if(file_exists($file.'.htaccess')){
                    copy($file.'.htaccess', $backup_path.'/'.$new_path.'.htaccess');
                }

                self::copyAllFilesAndFolders($file, $backup_path);
            } else {
                copy($file, $backup_path.'/'.$new_path);
            }
        }
    }


    function language_import(){
        $this->load->dbforge();

        foreach($_FILES['language_files']['name'] as $key => $language){
            $language_name = strtolower(preg_replace('/\s+/', '_', explode('.', $_FILES['language_files']['name'][$key])[0]));
            //Create language column if not exist
            if (!$this->db->field_exists($language_name, 'language')) {
                $fields = array(
                    $language_name => array(
                        'type' => 'LONGTEXT',
                        'default' => null,
                        'null' => TRUE,
                        'collation' => 'utf8_unicode_ci'
                    )
                );
                $this->dbforge->add_column('language', $fields);
            }

            $language_content_arr = json_decode(file_get_contents($_FILES['language_files']['tmp_name'][$key]), true);
            if(is_array($language_content_arr)){
                //Upload the json file
                move_uploaded_file($_FILES['language_files']['tmp_name'][$key], 'application/language/'.$language_name.'.json');
            }else{
                $this->session->set_flashdata('error_message', get_phrase('JSON_validation_failed').'!');
                redirect(site_url('admin/data_center'), 'refresh');
            }

            foreach($language_content_arr as $phrase_key => $phrase){
                $phrase_key = strtolower(preg_replace('/\s+/', '_', $phrase_key));
                $query = $this->db->get_where('language', ['phrase' => $phrase_key]);

                if($query->num_rows() > 0){
                    $this->db->where('phrase', $phrase_key);
                    $this->db->update('language', [$language_name => $phrase]);
                }else{
                    $this->db->insert('language', ['phrase' => $phrase_key, $language_name => $phrase]);
                }

            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('language_file_imported_successfully'));
        redirect(site_url('admin/data_center'), 'refresh');
    }
    



}
