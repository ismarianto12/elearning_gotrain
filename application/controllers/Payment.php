<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
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


        if (isset($_GET['i']) && !empty($_GET['i'])) {
            $this->payment_model->checkLogin($_GET['i']);
        }

        if (!$this->session->userdata('payment_details') || !$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error_message', site_phrase('payment_not_configured_yet'));
            redirect(site_url(), 'refresh');
        }
    }

    function index()
    {
        $page_data['page_title'] = get_phrase('payment');
        $this->load->view('payment-global/index.php', $page_data);
    }


    function success_course_payment($payment_method = "")
    {
        //STARTED payment model and functions are dynamic here
        $response = false;
        $payer_user_id = $this->session->userdata('user_id');
        $enrol_user_id = $payer_user_id;
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_method])->row_array();
        $model_name = strtolower($payment_gateway['model_name']);
        if ($payment_gateway['is_addon'] == 1 && $model_name != null) {
            $this->load->model('addons/' . strtolower($payment_gateway['model_name']));
        }

        if ($model_name != null) {
            $payment_check_function = 'check_' . $payment_method . '_payment';
            $response = $this->$model_name->$payment_check_function($payment_method, 'course');
        }
        //ENDED payment model and functions are dynamic here
        if ($response === true) {
            //if course is a gift purchase
            if ($payment_details['gift_to_user_id'] > 0) {
                $enrol_user_id = $payment_details['gift_to_user_id'];
                $this->crud_model->enrol_student($enrol_user_id, $payer_user_id);
                $this->email_model->course_gift_notification($enrol_user_id, $payer_user_id, $payment_method, $payment_details['total_payable_amount']);
            } else {

                $this->crud_model->enrol_student($enrol_user_id);
                $this->email_model->course_purchase_notification($enrol_user_id, $payment_method, $payment_details['total_payable_amount']);
            }
            $this->crud_model->course_purchase($payer_user_id, $payment_method, $payment_details['total_payable_amount']);

            $this->session->unset_userdata('gift_to_user_id');
            $this->session->set_userdata('cart_items', array());
            $this->session->set_userdata('payment_details', '');
            $this->session->set_userdata('applied_coupon', '');

            $this->session->set_flashdata('flash_message', site_phrase('payment_successfully_done'));
            redirect('home/my_courses', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', site_phrase('an_error_occurred_during_payment'));
            redirect('home/shopping_cart', 'refresh');
        }
    }

    function success_instructor_payment($payment_method = "")
    {
        //STARTED payment model and functions are dynamic here
        $user_id = $this->session->userdata('user_id');
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_method])->row_array();
        $model_name = strtolower($payment_gateway['model_name']);
        if ($payment_gateway['is_addon'] == 1 && $model_name != null) {
            $this->load->model('addons/' . strtolower($payment_gateway['model_name']));
        }
        if ($model_name != null) {
            $payment_check_function = 'check_' . $payment_method . '_payment';
            $response = $this->$model_name->$payment_check_function($payment_method, 'instructor');
        } else {
            $response = true;
        }
        //ENDED payment model and functions are dynamic here

        if ($response) {
            $this->crud_model->update_payout_status($payment_details['items'][0]['payout_id'], $payment_method);
            $this->session->set_flashdata('flash_message', get_phrase('payout_updated_successfully'));
        } else {
            $this->session->set_flashdata('error_message', site_phrase('an_error_occurred_during_payment'));
        }

        redirect(site_url('admin/instructor_payout'), 'refresh');
    }
















    function create_stripe_payment($success_url = "", $cancel_url = "", $public_key = "", $secret_key = "")
    {
        $identifier = 'stripe';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();



        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];

        if ($test_mode == 1) {
            $public_key = $keys['public_key'];
            $secret_key = $keys['secret_key'];
        } else {
            $public_key = $keys['public_live_key'];
            $secret_key = $keys['secret_live_key'];
        }
        //ended common code of all payment gateway

        // Convert product price to cent
        $stripeAmount = round($payment_details['total_payable_amount'] * 100, 2);

        define('STRIPE_API_KEY', $secret_key);
        define('STRIPE_PUBLISHABLE_KEY', $public_key);
        define('STRIPE_SUCCESS_URL', $payment_details['success_url']);
        define('STRIPE_CANCEL_URL', $payment_details['cancel_url']);

        // Include Stripe PHP library
        require_once APPPATH . 'libraries/Stripe/init.php';

        // Set API key
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY);

        $response = array(
            'status' => 0,
            'error' => array(
                'message' => 'Invalid Request!'
            )
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = file_get_contents('php://input');
            $request = json_decode($input);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode($response);
            exit;
        }

        // ['name' => 'Course payment']

        if (!empty($request->checkoutSession)) {
            // Create new Checkout Session for the order
            try {
                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'product_data' => ['name' => $payment_details['payment_title']],
                            'unit_amount' => $stripeAmount,
                            'currency' => $payment_gateway['currency'],
                        ],
                        'quantity' => 1
                    ]],
                    'mode' => 'payment',
                    'success_url' => STRIPE_SUCCESS_URL . '/' . $identifier . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => STRIPE_CANCEL_URL,
                ]);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $session) {
                $response = array(
                    'status' => 1,
                    'message' => 'Checkout Session created successfully!',
                    'sessionId' => $session['id']
                );
            } else {
                $response = array(
                    'status' => 0,
                    'error' => array(
                        'message' => 'Checkout Session creation failed! ' . $api_error
                    )
                );
            }
        }

        // Return response
        echo json_encode($response);
    }


    /***
     * Hande-shake with SSL COMMERZ gateway and return payment url
     * in-case invalid response, send exception/warning
     */
    public function create_ssl_commerz_payment()
    {
        $identifier = 'sslcommerz';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();


        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        if ($test_mode == 1) {
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
        } else {
            $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php";
        }

        $post_data = array();
        $post_data['store_id'] = $payment_gateway["store_id"];
        $post_data['store_passwd'] = $payment_gateway["store_password"];
        $post_data['total_amount'] = round($payment_details['total_payable_amount'], 2);
        $post_data['currency'] = $payment_gateway['currency'];
        $post_data['tran_id'] = "SSLCZ_TXN_" . uniqid();
        $post_data['success_url'] = $payment_details['success_url'] . '/' . $payment_gateway['identifier'];
        $post_data['fail_url'] =  $payment_details['cancel_url'];
        $post_data['cancel_url'] =  $payment_details['cancel_url'];
        # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE


        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $this->session->userdata("name");
        $post_data['cus_email'] = $user_details["email"];
        $post_data['cus_add1'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "";
        $post_data['cus_phone'] = "";
        $post_data['cus_fax'] = "";

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        $ssl_commerz_response = "";
        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $ssl_commerz_response = json_decode($content, true);
        } else {
            curl_close($handle);
            $api_error = "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

        if (empty($api_error) && $ssl_commerz_response && $ssl_commerz_response["status"] !== "FAILED") {
            $response = array(
                'status' => 1,
                'message' => 'Checkout Session created successfully!',
                'content' => $ssl_commerz_response
            );
        } else {
            $response = array(
                'status' => 0,
                'error' => array(
                    'message' => 'Checkout Session creation failed! ' . $api_error,
                )
            );
        }

        // Return response
        echo json_encode($response);
    }

    public function create_payu_payment()
    {
        $identifier = 'payu';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();


        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        $user = $this->user_model->get_user($this->session->userdata("user_id"))->row();

        try {

            require_once APPPATH . 'libraries/openpayu_php/lib/openpayu.php';

            OpenPayU_Configuration::setOauthTokenCache(new OauthCacheFile(APPPATH . "libraries/openpayu_php/lib/Cache"));
            if ($test_mode == 1) {

                //set Production Environment
                OpenPayU_Configuration::setEnvironment('sandbox');
            } else {

                //set Sandbox Environment
                OpenPayU_Configuration::setEnvironment('secure');
            }

            //set POS ID and Second MD5 Key (from merchant admin panel)
            OpenPayU_Configuration::setMerchantPosId($keys["pos_id"]);
            OpenPayU_Configuration::setSignatureKey($keys["second_key"]);

            //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
            OpenPayU_Configuration::setOauthClientId($keys["pos_id"]);
            OpenPayU_Configuration::setOauthClientSecret($keys["client_secret"]);

            $order_data = [
                'notifyUrl' => $payment_details['success_url'] . '/' . $payment_gateway['identifier'],
                'continueUrl' => site_url("home/my_courses"),
                'customerIp' => $_SERVER['REMOTE_ADDR'],
                'merchantPosId' => $keys["pos_id"],
                'description' => 'RTV market',
                'currencyCode' => $payment_gateway["currency"],
                'totalAmount' => round($payment_details['total_payable_amount'], 2),
                'buyer' => [
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'firstName' => $user->first_name,
                    'lastName' => $user->last_name,
                    'language' => 'en',
                ],
                'products' => [
                    [
                        'name' => 'Wireless Mouse for Laptop',
                        'unitPrice' => '15000',
                        'quantity' => '1',
                    ],
                    [
                        'name' => 'HDMI cable',
                        'unitPrice' => '6000',
                        'quantity' => '1',
                    ],
                ],
            ];

            $response = OpenPayU_Order::create($order_data);
            $this->session->set_userdata("payu_order_id", $response->getResponse()->orderId);

            $response = ([
                "status" => 1,
                "message" => 'Checkout Session created successfully!',
                "GatewayPageURL" => $response->getResponse()->redirectUri
            ]);
        } catch (\Exception $exception) {

            $response = array(
                'status' => 0,
                'error' => array(
                    'message' => 'Checkout Session creation failed! ' . $exception->getMessage(),
                )
            );
        }

        // return response;
        echo json_encode($response);
    }

    public function create_xendit_payment()
    {
        $identifier = 'xendit';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();


        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];
        $user = $this->user_model->get_user($this->session->userdata("user_id"))->row();

        require_once APPPATH . 'libraries/xendit/vendor/autoload.php';


        try {
            \Xendit\Xendit::setApiKey($keys["api_key"]);
            $params = [
                'external_id' => 'AC_' . uniqid(),
                'payer_email' => $user->email, //'sample_email@xendit.co',
                'description' => 'Payment',
                'amount' => round($payment_details['total_payable_amount'] * 100, 2),
                //"currency" => $payment_gateway["currency"],
                "success_redirect_url" => $payment_details["success_url"] . '/' . $payment_gateway['identifier'],
                "failure_redirect_url" => $payment_details["cancel_url"],
            ];

            $createInvoice = \Xendit\Invoice::create($params);

            $id = $createInvoice['id'];
            $this->session->set_userdata("xendit_invoice_id", $id);

            $getInvoice = \Xendit\Invoice::retrieve($id);
            $response = array(
                "status" => 1,
                "message" => 'Checkout Session created successfully!',
                "GatewayPageURL" => $getInvoice["invoice_url"]
            );
        } catch (\Exception $exception) {

            $response = array(
                'status' => 0,
                'error' => array(
                    'message' => 'Checkout Session creation failed! ' . $exception->getMessage(),
                )
            );
        }

        // return response;
        echo json_encode($response);
    }

    public function create_doku_payment()
    {
        $identifier = 'doku';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();

        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];

        require_once APPPATH . 'libraries/doku_php/vendor/autoload.php';
        $dokuClient = new DOKU\Client;

        // Setup Config
        $dokuClient->setClientID($keys["client_id"]);
        $dokuClient->setSharedKey($keys["shared_key"]);

        if ($test_mode) {
            $dokuClient->isProduction(false); // Sandbox environment. For example project only.
        } else {
            $dokuClient->isProduction(true); // Sandbox environment. For example project only.
        }

        $user = $this->user_model->get_user($this->session->userdata("user_id"))->row();


        $order_data = array(
            'customerId' => 'ID-123456',
            'customerEmail' => $user->email,
            'customerName' => $this->session->userdata('name'),
            'phone' => $user->phone,
            'country' => 'ID', //'ID' in english
            'invoiceNumber' => "DK_" . uniqid(),
            'amount' => $payment_details["total_payable_amount"],
            'lineItems' => array(
                array("name" => $payment_details['payment_title'], 'price' => $payment_details["total_payable_amount"], "quantity" => count($payment_details["items"]))
            ),
            'urlFail' => $payment_details['cancel_url'],
            'urlSuccess' => $payment_details['success_url'] . "/" . $identifier,
            'language' => "EN",
            'backgroundColor' => '',
            'fontColor' => '',
            'buttonBackgroundColor' => '',
            'address' => '',
            'buttonFontColor' => ''
        );

        try {

            $obj_response = $dokuClient->generateCheckout($order_data);
            $response = array(
                "status" => 1,
                "message" => 'Checkout Session created successfully!',
                //"GatewayPageURL" => $obj_response["credit_card_payment_page"]["url"],
                "response" => $obj_response
            );
        } catch (\Exception $exception) {

            $response = array(
                'status' => 0,
                'error' => array(
                    'message' => 'Checkout Session creation failed! ' . $exception->getMessage(),
                )
            );
        }

        // return response;
        echo json_encode($response);
    }

    public function doku_ipn()
    {
        $identifier = 'doku';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();

        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        // Mapping the notification received from Jokul
        $notifyHeaders = getallheaders();
        $notifyBody = json_decode(file_get_contents('php://input'), true); // You can use to parse the value from the notification body
        $targetPath = $payment_details['success_url'] . "/" . $identifier; // Put this value with your payment notification path
        $secretKey = $keys['shared_key']; // // Put this value with your Secret Key

        $this->doku_log("Notif Header ", 'PHP-Library $notifyBody : ' . file_get_contents('php://input'), 'Notification');

        // Prepare Signature to verify the notification authenticity
        $signature = \DOKU\Common\Utils::generateSignature($notifyHeaders, $targetPath, file_get_contents('php://input'), $secretKey);

        // Verify the notification authenticity
        if ($signature == $notifyHeaders['Signature']) {
            http_response_code(200); // Return 200 Success to Jokul if the Signature is match

            $this->doku_log("Notif ", 'PHP-Library SIGNATURE MATCH 200', 'Notification');
            //TODO update transaction status on your end to 'SUCCESS'
        } else {
            http_response_code(401); // Return 401 Unauthorized to Jokul if the Signature is not match
            $this->doku_log("Notif ", 'PHP-Library SIGNATURE NOT MATCH 401', 'Notification');

            //TODO Do Not update transaction status on your end yetPHP-Library Notification digest
        }

        header('Content-type:application/json;charset=utf-8');
    }

    private function doku_log($class, $log_msg, $invoice_number = '')
    {
        $log_filename = "doku_log";
        $log_header = date(DATE_ATOM, time()) . ' ' . 'Notif ' . '---> ' . $invoice_number . " : ";
        if (!file_exists($log_filename)) {
            // create directory/folder uploads.
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
        // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
        file_put_contents($log_file_data, $log_header . $log_msg . "\n", FILE_APPEND);
    }


    function pay_by_cashfree()
    {
        $identifier = 'cashfree';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();

        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        if ($test_mode == 1) {
            $url = 'https://sandbox.cashfree.com/pg/orders';
        } else {
            $url = 'https://api.cashfree.com/pg/orders';
        }
        $_POST['customer_details']['customer_id'] = random(35);
        $_POST['order_amount'] = $payment_details['total_payable_amount'];
        $_POST['order_currency'] = $payment_gateway['currency'];
        $_POST['order_id'] = random(40);
        $_POST['order_meta']['return_url'] = $payment_details['success_url'] . '/cashfree?order_id=' . $_POST['order_id'];

        require_once(APPPATH . 'libraries/cachefree/vendor/autoload.php');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', "$url", [
            'body' => json_encode($_POST),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'x-api-version' => '2022-09-01',
                'x-client-id' => $keys['client_id'],
                'x-client-secret' => $keys['client_secret'],
            ],
        ]);

        $res = $response->getBody();


        echo '<html><body><script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
        
        <script>const cashfree = Cashfree({
            mode:"sandbox" //or production
        });
        let checkoutOptions = {
            paymentSessionId: "' . json_decode($res, true)['payment_session_id'] . '",
            redirectTarget: "_self" //optional (_self or _blank)
        }
        
        cashfree.checkout(checkoutOptions)
        </script></body><html>';
    }


    function create_maxicash_payment()
    {
        $identifier = 'maxicash';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        //$user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();

        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        $data1 = [
            "PayType" => "MaxiCash",
            "MerchantID" => $keys['merchant_id'],
            "MerchantPassword" => $keys['merchant_password'],
            "Amount" => (string)($payment_details['total_payable_amount'] * 100),
            "Currency" => $payment_gateway['currency'],
            "Telephone" => $_POST['telephone'],
            "Language" => "en",
            "Reference" => random(10), //(string)$payment_data->attribute_id,
            "accepturl" => $payment_details['success_url'] . '?status=success',
            "declineurl" => $payment_details['cancel_url'] . '?status=failed',
            "cancelurl" => $payment_details['cancel_url'] . '?status=failed',
            "notifyurl" => $payment_details['cancel_url'] . '?status=failed',
        ];
        $data = json_encode($data1);
        if ($test_mode) {
            $url = 'https://api-testbed.maxicashapp.com/payentry?data=' . $data;
        } else {
            $url = 'https://api.maxicashapp.com/payentry?data=' . $data;
        }

        redirect($url, 'refresh');
    }


    function aamarpay_payment_link()
    {

        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => 'aamarpay'])->row_array();
        $customer_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $user_id = $customer_details['id'];

        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway


        //Store payment info temporary in user temp column to re-login in this application
        $payment_info = array($user_id, $payment_details, $this->session->userdata('applied_coupon'), microtime(true));
        $payment_info = json_encode($payment_info);
        $payment_info = base64_encode($payment_info);
        $payment_info = str_replace("=", "", $payment_info);
        $this->db->where('id', $user_id)->update('users', ['temp' => $payment_info]);
        $payment_info = ellipsis($payment_info, 70);



        if ($test_mode == 1) {
            $payment_url = 'https://sandbox.aamarpay.com/index.php';
        } else {
            $payment_url = 'https://secure.aamarpay.com/index.php';
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $payment_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('store_id' => $keys['store_id'], 'signature_key' => $keys['signature_key'], 'cus_name' => $customer_details['first_name'] . ' ' . $customer_details['last_name'], 'cus_email' => $customer_details['email'], 'cus_phone' => $customer_details['phone'] ?? '017', 'amount' => $payment_details['total_payable_amount'], 'currency' => $payment_gateway['currency'], 'tran_id' => random(20) . $customer_details['id'], 'desc' => $payment_details['payment_title'], 'success_url' => $payment_details['success_url'] . '/aamarpay?i=' . $payment_info, 'fail_url' => $payment_details['cancel_url'], 'cancel_url' => $payment_details['cancel_url'], 'type' => 'json'),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $payment_url = json_decode($response)->payment_url;
        echo $payment_url;
    }

    function tazapay_payment_form()
    {
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => 'tazapay'])->row_array();
        $customer_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $user_id = $customer_details['id'];

        //start common code of all payment gateway
        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        if($test_mode == 1){
            $session_generate_url = 'https://service-sandbox.tazapay.com/v3/checkout';
        }else{
            $session_generate_url = 'https://service.tazapay.com/v3/checkout';
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $session_generate_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'customer_details' => [
                    'name' => $customer_details['first_name'].' '.$customer_details['last_name'],
                    'country' => strtoupper($_POST['country_code']),
                    'email' => $customer_details['email']
                ],
                'invoice_currency' => $payment_gateway['currency'],
                'amount' => $payment_details['total_payable_amount']*100,
                'success_url' => $payment_details['success_url'].'/tazapay',
                'cancel_url' => $payment_details['cancel_url'],
                'transaction_description' => $payment_details['payment_title']
            ]),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Basic ".base64_encode($keys['api_key'].':'.$keys['api_secret']),
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $this->session->set_flashdata('error_message', $err);
            redirect($payment_details['cancel_url'], 'refresh');
        } else {
            $responseArr = json_decode($response, true);
            if(is_array($responseArr) && $responseArr['status'] == 'success'){

                //this payment streaming valid for next 10 minutes
                $this->session->set_userdata('tazapay_id', $responseArr['data']['id'], 600);

                redirect($responseArr['data']['url'], 'refresh');
            }else{
                $this->session->set_flashdata('error_message', get_phrase('An error occurred'));
                redirect($payment_details['cancel_url'], 'refresh');
            }
        }

    }
}
