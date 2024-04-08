<?php
require APPPATH . '/libraries/TokenHandler.php';
//include Rest Controller library
require APPPATH . 'libraries/REST_Controller.php';

class Api_files extends REST_Controller {

    protected $token;
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));
        
        $this->load->database();
        $this->load->library('session');
        // creating object of TokenHandler class at first
        $this->tokenHandler = new TokenHandler();

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

    }


    function file_content_get(){

        $auth_token = $_GET['auth_token'];
        $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
        if ($logged_in_user_details['user_id'] > 0) {

            $user_id = $logged_in_user_details['user_id'];

            //For video lesson
            if(isset($_GET['course_id']) && isset($_GET['lesson_id']) && $user_id > 0){
                $course_id = $this->input->get('course_id');
                $lesson_id = $this->input->get('lesson_id');
                $multi_instructors = explode(',', $this->crud_model->get_course_by_id($course_id)->row('user_id'));
                $lesson = $this->crud_model->get_lessons('lesson', $lesson_id)->row_array();
                $get_lesson_type = get_lesson_type($lesson_id);

                if(enroll_status($course_id, $user_id) == 'valid' || in_array($user_id, $multi_instructors)){


                    //Assign video url
                    if($get_lesson_type == 'video_file' || $get_lesson_type == 'amazon_video_url' || $get_lesson_type == 'academy_cloud' || $get_lesson_type == 'html5_video_url'){
                        $fileUrl = $lesson['video_url'];
                    }elseif($get_lesson_type == 'doc_file'){
                        $fileUrl = 'uploads/lesson_files/'.$lesson['attachment'];
                        echo $this->get_html_from_docx_file($fileUrl);
                        return;
                    }else{
                        $fileUrl = 'uploads/lesson_files/'.$lesson['attachment'];
                    }


                    $fileUrl = str_replace(base_url(), '', $fileUrl);
                    $basename = basename($fileUrl);
                    if (strpos($fileUrl, 'http') !== false) {
                        $header_data = get_headers($fileUrl, 1);
                        if(array_key_exists('Content-Type', $header_data)){$content_type = $header_data['Content-Type'];}
                        if(array_key_exists('Content-type', $header_data)){$content_type = $header_data['Content-type'];}
                        if(array_key_exists('content-type', $header_data)){$content_type = $header_data['content-type'];}


                        //$this->get_remote_file_size($fileUrl);
                        if(array_key_exists('Content-Length', $header_data)){$file_size = $header_data['Content-Length'];}
                        if(array_key_exists('Content-length', $header_data)){$file_size = $header_data['Content-length'];}
                        if(array_key_exists('content-length', $header_data)){$file_size = $header_data['content-length'];}
                    }else{
                        $content_type = mime_content_type($fileUrl);
                        $file_size = filesize($fileUrl);
                    }

                    if($get_lesson_type == 'image_file' || $get_lesson_type == 'pdf_file' || $get_lesson_type == 'text_file'){
                        //for not streaming file as like: img, pdf, txt and more.
                        header('Content-Type: '.$content_type);
                        header('Content-Length: ' . $file_size);
                        header('Content-Disposition: inline; filename='.basename($fileUrl));
                        readfile($fileUrl);
                        exit;
                    }elseif($get_lesson_type == 'video_file' || $get_lesson_type == 'amazon_video_url' || $get_lesson_type == 'academy_cloud' || $get_lesson_type == 'html5_video_url'){
                        // echo $file_size;
                        //1310720
                        // //28296966814 = 28 GB
                        //150000
                        //157205
                        // die;
                        
                        // if (strpos($fileUrl, 'http') !== false) {
                        //     //Without chunking load a remote server's video
                        //     header('Accept-Ranges: bytes');
                        //     header('Content-Type: '.$content_type);
                        //     header('Content-Length: '.$file_size);
                        //     header('Content-Range: bytes 0-'.($file_size-1).'/'.$file_size);
                        //     readfile($fileUrl);

                        //     exit;
                        // }else{






                            // //With chunking load a own hosted video
                            // $range = isset($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : 'bytes=0-'.($file_size-1);
                            // $start = 0;
                            // $end = $file_size - 1;
                            // $chunkSize = 131072;// | 8192; // Adjust the chunk size as per your requirements
                            // header('Accept-Ranges: bytes');
                            // header('Content-Type: '.$content_type);
                            // header('Content-Disposition: inline; filename="' . $basename . '"');
                            // if ($range) {
                            //     header('HTTP/1.1 206 Partial Content');
                            //     header('Content-Length: ' . $file_size);
                            //     header('Content-Range: bytes ' . $start . '-' . $end . '/' . $file_size);
                            // } else {
                            //     header('Content-Length: ' . $file_size);
                            // }

                            // $handle = fopen($fileUrl, 'rb');
                            // fseek($handle, $start);

                            // while (!feof($handle) && ($pos = ftell($handle)) <= $end) {
                            //     if ($pos + $chunkSize > $end) {
                            //         $chunkSize = $end - $pos + 1;
                            //     }
                            //     echo fread($handle, $chunkSize);
                            //     flush();
                            // }

                            // fclose($handle);

                            // exit;


                            //With Range requests load a own hosted video
                            $chunkSize = floor($file_size/14000);
                            if($chunkSize < 100000) $chunkSize = 100000;
                            if($chunkSize > 2500000) $chunkSize = 2500000;
                            $start = 0;
                            $end = $file_size - 1;
                            //$range = isset($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : 'bytes=0-'.($file_size-1);
                            $range = isset($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : 'bytes=0-'.$chunkSize;
                
                            header('Accept-Ranges: bytes');
                            header('Content-Type: '.$content_type);
                            header('Content-Disposition: inline; filename="' . $basename . '"');
                            if ($range) {
                                header('HTTP/1.1 206 Partial Content');
                                $range = explode('=', $range);
                                $start = intval($range[1]);
                                $end = $start + $chunkSize - 1;
                                if ($end > $file_size - 1) {
                                    $end = $file_size - 1;
                                }
                                header('Content-Range: bytes ' . $start . '-' . $end . '/' . $file_size);
                            } else {
                                header('Content-Length: ' . $file_size);
                            }

                            $handle = fopen($fileUrl, 'rb');
                            fseek($handle, $start);

                            while (!feof($handle) && ($pos = ftell($handle)) <= $end) {
                                if ($pos + $chunkSize > $end) {
                                    $chunkSize = $end - $pos + 1;
                                }
                                echo fread($handle, $chunkSize);
                                flush();
                            }

                            fclose($handle);

                            exit;







                            // //PLAY 1ST FIRST PART OF A FULL VIDEO file
                            // $start = 0;
                            // $end = $file_size; // Play the first 50% of the video

                            // $chunkSize = 8192; // Adjust the chunk size as needed

                            // // header('Accept-Ranges: bytes');
                            // // header('Content-Type: video/mp4');
                            // // header('Content-Length: ' . ($end - $start + 1));
                            // //header('Content-Range: bytes ' . $start . '-' . $end . '/' . $file_size);

                            // header('Content-Type: '.$content_type);
                            // header('Content-Disposition: inline; filename="' . $basename . '"');
                            // header('Content-Length: ' . $file_size);

                            // //$handle = fopen($fileUrl, 'rb');
                            // $handle = fopen('uploads/lesson_files/videos/52a474424c9bba054f8541c44f250f91.mp4', 'rb');

                            // fseek($handle, $start);

                            // while (!feof($handle) && ($pos = ftell($handle)) <= $end) {
                            //     if ($pos + $chunkSize > $end) {
                            //         $chunkSize = $end - $pos + 1;
                            //     }
                            //     echo fread($handle, $chunkSize);
                            //     flush();
                            // }

                            // fclose($handle);




                        //}
                    }

                }
            }
        }
        
    }

    function offline_video_for_mobile_app_get($lesson_id = "", $auth_token = ""){
        $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

        if ($logged_in_user_details['user_id'] > 0) {

            $this->load->helper('download');
            $lesson_video = $this->db->where('id', $lesson_id)->get('lesson');
            $video_url = $lesson_video->row('video_url');

            if(enroll_status($lesson_video->row('course_id'), $logged_in_user_details['user_id']) == 'valid' && $video_url != ''){
                $video_url = str_replace(base_url(),"",$video_url);
                $data = file_get_contents($video_url);
                $name = slugify($lesson_video->row('title')).'.'.pathinfo($video_url, PATHINFO_EXTENSION);
                force_download($name, $data);
            }
        }
    }

    function get_remote_file_size($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        $data = curl_exec($ch);
        $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        return $fileSize;
    }

    function get_html_from_docx_file($docxFilePath = ""){
        if($docxFilePath == ""){
            return $docxFilePath;
        }

        require_once APPPATH . '/libraries/phpword-master/vendor/autoload.php';
        // Load the .docx file
        $phpWord = PhpOffice\PhpWord\IOFactory::load($docxFilePath, 'Word2007');

        // Save the content as HTML
        $tempFile = tempnam(sys_get_temp_dir(), 'phpword-');
        $objWriter = PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save($tempFile);

        // Read the HTML content
        $htmlContent = file_get_contents($tempFile).'
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
            }

            h1, h2, h3 {
                margin-bottom: 1rem;
            }

            p {
                margin: 1rem 0;
            }

            ul, ol {
                margin: 1rem 0;
                padding-left: 2rem;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid #ccc;
                padding: 0.5rem;
            }

            img {
                max-width: 100%;
                height: auto;
            }
        </style>';

        // Clean up the temporary HTML file
        unlink($tempFile);

        return $htmlContent;
    }

    public function token_data_get($auth_token)
  {
    //$received_Token = $this->input->request_headers('Authorization');
    if (isset($auth_token)) {
      try
      {

        $jwtData = $this->tokenHandler->DecodeToken($auth_token);
        return json_encode($jwtData);
      }
      catch (Exception $e)
      {
        echo 'catch';
        http_response_code('401');
        echo json_encode(array( "status" => false, "message" => $e->getMessage()));
        exit;
      }
    }else{
      echo json_encode(array( "status" => false, "message" => "Invalid Token"));
    }
  }

}
