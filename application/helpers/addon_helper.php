<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter
*
* An open source application development framework for PHP 5.1.6 or newer
*
* @package		CodeIgniter
* @author		ExpressionEngine Dev Team
* @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
* @license		http://codeigniter.com/user_guide/license.html
* @link		http://codeigniter.com
* @since		Version 1.0
* @filesource
*/

/* CHECK THE ADDON STATUS */
if (! function_exists('addon_status')) {
    function addon_status($unique_identifier = '') {
        $CI	=&	get_instance();
        $CI->load->database();
        $result = $CI->db->get_where('addons', array('unique_identifier' => $unique_identifier));
        if ($result->num_rows() > 0) {
            $result = $result->row_array();
            return $result['status'];
        }else{
            return 0;
        }
    }
}

/* CHECK IF THE STUDENT IS ELIGIBLE FOR DOWNLOADING THE CERTIFICATE */
if (! function_exists('certificate_eligibility')) {
    function certificate_eligibility($course_id = "", $user_id = "") {
        $CI	=&	get_instance();
        $CI->load->database();

        if ($user_id == "") {
            $user_id = $CI->session->userdata('user_id');
        }
        $result = $CI->db->get_where('certificates', array('course_id' => $course_id, 'student_id' => $user_id));
        if ($result->num_rows() > 0) {
            return 1;
        }else{
            return 0;
        }
    }
}

/* GET THE SHAREABLE LINK OF CERTIFICATE */
if (! function_exists('generate_certificate')) {
    function generate_certificate($course_id = "", $user_id = "") {
        $CI	=&	get_instance();
        $CI->load->database();

        if ($user_id == "") {
            $user_id = $CI->session->userdata('user_id');
        }
        $result = $CI->db->get_where('certificates', array('course_id' => $course_id, 'student_id' => $user_id))->row_array();
        return $result['shareable_url'];
    }
}

/* COUNT OFFLINE PAYMENT PENDING USER */
if (! function_exists('get_pending_offline_payment')) {
    function get_pending_offline_payment() {
        $CI =&  get_instance();
        $CI->load->database();

        $count_pending_payment = count($CI->db->get_where('offline_payment', array('status' => 0))->result_array());
        return $count_pending_payment;
    }
}


use Aws\S3\S3Client;
if (! function_exists('get_video_url')) {
    function get_video_url($url, $course_id){
        $CI =&  get_instance();
        $CI->load->database();
        $course = $CI->db->where('id', $course_id)->get('course')->row_array();

        $file = explode('wasabi-',$url);
        $name = slugify($course['title']).'/wasabi-'.$file[2];
        
        if($url){
            require_once APPPATH . 'libraries/s3-vendor/autoloader.php';
            $s3 = new S3Client([
                'endpoint' => 'http://s3.wasabisys.com',
                'region' => get_settings('wasabi_region'),
                'version' => 'latest',
                'credentials' => array(
                'key' => get_settings('wasabi_key'),
                'secret' =>get_settings('wasabi_secret_key'),
                )
            ]);
                
            $cmd = $s3->getCommand('GetObject', [
                'Bucket' => get_settings('wasabi_bucketname'),
                'Key' => $name,
                'ACL' => 'public-read',
            ]);
            $currentMinute = date('i')+10000;
            $request = $s3->createPresignedRequest($cmd, $currentMinute.' minutes');
            $presignedUrl = (string)$request->getUri();
            return $presignedUrl;
        }else{
            return 0;
        }
    }
}



// ------------------------------------------------------------------------
/* End of file addon_helper.php */
/* Location: ./system/helpers/common.php */
