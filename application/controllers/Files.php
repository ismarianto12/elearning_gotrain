<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Files extends CI_Controller
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


        //Check custom session data
        $this->user_model->check_session_data();

        if (!$this->session->userdata('user_id')) {
            redirect(site_url('login'), 'refresh');
        }
    }

    function index()
    {
        // check this request from iframe, canvas, api or direct from browser url
        if (isset($_SERVER['HTTP_REFERER'])) {
        } else {
            return false;
        }


        $user_id = $this->session->userdata('user_id');

        //For video lesson
        if (isset($_GET['course_id']) && isset($_GET['lesson_id']) && $user_id > 0) {
            $course_id = $this->input->get('course_id');
            $lesson_id = $this->input->get('lesson_id');
            $multi_instructors = explode(',', $this->crud_model->get_course_by_id($course_id)->row('user_id'));
            $lesson = $this->crud_model->get_lessons('lesson', $lesson_id)->row_array();
            $get_lesson_type = get_lesson_type($lesson_id);

            if (enroll_status($course_id) == 'valid' || $this->session->userdata('admin_login') == '1' || in_array($user_id, $multi_instructors)) {


                //Assign video url
                if ($get_lesson_type == 'video_file' || $get_lesson_type == 'amazon_video_url' || $get_lesson_type == 'academy_cloud' || $get_lesson_type == 'html5_video_url') {
                    $fileUrl = $lesson['video_url'];
                } elseif ($get_lesson_type == 'audio_file') {
                    $fileUrl = $lesson['audio_url'];
                } elseif ($get_lesson_type == 'doc_file') {
                    $fileUrl = 'uploads/lesson_files/' . $lesson['attachment'];
                    echo $this->get_html_from_docx_file($fileUrl);
                    return;
                } else {
                    $fileUrl = 'uploads/lesson_files/' . $lesson['attachment'];
                }

                if (str_contains(base_url(), 'https:') && str_contains($fileUrl, 'http:')) {
                    $fileUrl = str_replace('http:', 'https:', $fileUrl);
                }elseif(str_contains(base_url(), 'http:') && str_contains($fileUrl, 'https:')){
                    $fileUrl = str_replace('https:', 'http:', $fileUrl);
                }

                $fileUrl = str_replace(base_url(), '', $fileUrl);
                $basename = basename($fileUrl);
                if (strpos($fileUrl, 'http') !== false) {
                    $header_data = get_headers($fileUrl, 1);
                    if (array_key_exists('Content-Type', $header_data)) {
                        $content_type = $header_data['Content-Type'];
                    }
                    if (array_key_exists('Content-type', $header_data)) {
                        $content_type = $header_data['Content-type'];
                    }
                    if (array_key_exists('content-type', $header_data)) {
                        $content_type = $header_data['content-type'];
                    }


                    //$this->get_remote_file_size($fileUrl);
                    if (array_key_exists('Content-Length', $header_data)) {
                        $file_size = $header_data['Content-Length'];
                    }
                    if (array_key_exists('Content-length', $header_data)) {
                        $file_size = $header_data['Content-length'];
                    }
                    if (array_key_exists('content-length', $header_data)) {
                        $file_size = $header_data['content-length'];
                    }
                } else {
                    $content_type = mime_content_type($fileUrl);
                    $file_size = filesize($fileUrl);
                }

                if ($get_lesson_type == 'image_file' || $get_lesson_type == 'pdf_file' || $get_lesson_type == 'text_file') {
                    //for not streaming file as like: img, pdf, txt and more.
                    header('Content-Type: ' . $content_type);
                    header('Content-Length: ' . $file_size);
                    header('Content-Disposition: inline; filename=' . basename($fileUrl));
                    readfile($fileUrl);
                    exit;
                } elseif ($get_lesson_type == 'video_file' || $get_lesson_type == 'amazon_video_url' || $get_lesson_type == 'academy_cloud' || $get_lesson_type == 'html5_video_url' || $get_lesson_type == 'audio_file') {
                    
                    if($file_size < 3000000){
                        $chunkSize = $file_size;
                    }else{
                        $chunkSize = 3000000;
                    }

                    $start = 0;
                    $end = $file_size - 1;

                    $range = isset($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : 'bytes=0-' . $chunkSize;

                    header('Accept-Ranges: bytes');
                    header('Content-Type: ' . $content_type);
                    header('Content-Disposition: inline; filename="' . $basename . '"');

                    if ($range) {
                        header('HTTP/1.1 206 Partial Content');
                        $range = explode('=', $range);
                        $start = intval($range[1]);
                        $end = min($start + $chunkSize - 1, $file_size - 1);
                        header('Content-Range: bytes ' . $start . '-' . $end . '/' . $file_size);
                    } else {
                        header('Content-Length: ' . $file_size);
                    }

                    // Set cache-control headers
                    header('Cache-Control: public, max-age=0');
                    header('Pragma: public');

                    // Remove unnecessary headers
                    header_remove('Expires');

                    $handle = fopen($fileUrl, 'rb');
                    fseek($handle, $start);


                    while (!feof($handle) && ($pos = ftell($handle)) <= $end) {
                        if ($pos + $chunkSize > $end) {
                            $chunkSize = $end - $pos + 1;
                        }
                        echo fread($handle, $chunkSize);
                        ob_flush();
                        flush();
                    }
                    

                    fclose($handle);
                    exit;

                }
            }
        }
    }

    function get_remote_file_size($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        $data = curl_exec($ch);
        $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        return $fileSize;
    }

    function get_html_from_docx_file($docxFilePath = "")
    {
        if ($docxFilePath == "") {
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
        $htmlContent = file_get_contents($tempFile) . '
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
}
