<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));

        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        $this->user_model->check_session_data();       
    }

    function index($page_suffix = ""){
        if($page_suffix == 'home-1' || $page_suffix == 'home-2' || $page_suffix == 'home-3' || $page_suffix == 'home-4' || $page_suffix == 'home-5' || $page_suffix == 'home-6'){

            $page_suffix = str_replace('-', '_', $page_suffix);

            $this->db->where('key', 'home_page');
            $this->db->update('frontend_settings', ['value' => $page_suffix]);
            redirect(site_url('home'), 'refresh');
        }

        $this->db->where('page_url', $page_suffix);
        $custom_page = $this->db->get('custom_page')->row_array();


        $page_data['page_url'] = $custom_page['page_url'];
        $page_data['page_content'] = $custom_page['page_content'];
        $page_data['page_title'] = $custom_page['page_title'];
        $page_data['page_name'] = 'custom_page_viewer';
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

}