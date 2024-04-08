<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . "libraries/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class Payment_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }


    function configure_course_payment()
    {
        $items = array();
        $total_payable_amount = 0;

        //item detail
        foreach ($this->session->userdata('cart_items') as $key => $cart_item) :
            $course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
            $item_details['id'] = $cart_item;
            $item_details['title'] = $course_details['title'];
            $item_details['thumbnail'] = $this->crud_model->get_course_thumbnail_url($course_details['id']);
            $item_details['creator_id'] = $course_details['creator'];
            $item_details['discount_flag'] = $course_details['discount_flag'];
            $item_details['discounted_price'] = $course_details['discounted_price'];
            $item_details['price'] = $course_details['price'];

            $item_details['actual_price'] = ($course_details['discount_flag'] == 1) ? $course_details['discounted_price'] : $course_details['price'];
            $item_details['sub_items'] = array();

            $items[$key] = $item_details;
            $total_payable_amount += $item_details['actual_price'];
        endforeach;
        //ended item detail

        //if applied coupon
        $coupon_code = $this->session->userdata('applied_coupon');
        if ($coupon_code) {
            $total_payable_amount = $this->crud_model->get_discounted_price_after_applying_coupon($coupon_code);
        }

        //included tax
        $total_payable_amount = round($total_payable_amount + ($total_payable_amount / 100) * get_settings('course_selling_tax'), 2);

        //common structure for all payment gateways and all type of payment
        $data['total_payable_amount'] = $total_payable_amount;
        $data['items'] = $items;
        $data['is_instructor_payout_user_id'] = false;
        $data['payment_title'] = get_phrase('pay_for_purchasing_course');
        $data['success_url'] = site_url('payment/success_course_payment');
        $data['cancel_url'] = site_url('payment');
        $data['back_url'] = site_url('home/shopping_cart');

        // Course gift
        $data['gift_to_user_id'] = $this->session->userdata('gift_to_user_id');

        $this->session->set_userdata('payment_details', $data);
    }

    function configure_instructor_payment($is_instructor_payout_user_id = false)
    {
        $payout_request = $this->db->where('user_id', $is_instructor_payout_user_id)->where('status', 0)->get('payout')->row_array();
        $amount = $payout_request['amount'];
        $items = array();
        $total_payable_amount = 0;
        $instructor_details = $this->user_model->get_all_user($is_instructor_payout_user_id)->row_array();

        //item detail
        $item_details['payout_id'] = $payout_request['id'];
        $item_details['title'] = get_phrase('pay_to') . ' ' . $instructor_details['first_name'] . ' ' . $instructor_details['last_name'];
        $item_details['thumbnail'] = '';
        $item_details['creator_id'] = '';
        $item_details['discount_flag'] = 0;
        $item_details['discounted_price'] = $amount;
        $item_details['price'] = $amount;
        $item_details['actual_price'] = $amount;
        $item_details['sub_items'] = array();
        $items[0] = $item_details;
        //ended item details

        //common structure for all payment gateways and all type of payment
        $data['total_payable_amount'] = $amount;
        $data['items'] = $items;
        $data['is_instructor_payout_user_id'] = $is_instructor_payout_user_id;
        $data['payment_title'] = get_phrase('pay_for_instructor_payout');
        $data['success_url'] = site_url('payment/success_instructor_payment');
        $data['cancel_url'] = site_url('payment');
        $data['back_url'] = site_url('admin/instructor_payout');

        $this->session->set_userdata('payment_details', $data);
    }



























    public function check_paypal_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway


        $paymentID = $_GET['payment_id'];
        $paymentToken = $_GET['payment_token'];
        $payerID = $_GET['payer_id'];
        if ($test_mode == 1) {
            $paypalURL       = 'https://api.sandbox.paypal.com/v1/';
            $paypalClientID = $keys['sandbox_client_id'];
            $paypalSecret = $keys['sandbox_secret_key'];
        } else {
            $paypalURL       = 'https://api.paypal.com/v1/';
            $paypalClientID = $keys['production_client_id'];
            $paypalSecret = $keys['production_secret_key'];
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paypalURL . 'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID . ":" . $paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);

        if (empty($response)) {
            return false;
        } else {
            $jsonData = json_decode($response);
            $curl = curl_init($paypalURL . 'payments/payment/' . $paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            // Transaction data
            $result = json_decode($response);

            // CHECK IF THE PAYMENT STATE IS APPROVED OR NOT
            if ($result && $result->state == 'approved') {
                return true;
            } else {
                return false;
            }
        }
    }

    public function check_stripe_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();

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
            $public_key = $keys['public_key'];
            $secret_key = $keys['secret_key'];
        } else {
            $public_key = $keys['public_live_key'];
            $secret_key = $keys['secret_live_key'];
        }
        define('STRIPE_PUBLISHABLE_KEY', $public_key);
        define('STRIPE_API_KEY', $secret_key);


        // Check whether stripe checkout session is not empty
        $session_id = $_GET['session_id'];
        if ($session_id != "") {
            //$session_id = $_GET['session_id'];

            // Include Stripe PHP library
            require_once APPPATH . 'libraries/Stripe/init.php';

            // Set API key
            \Stripe\Stripe::setApiKey(STRIPE_API_KEY);

            // Fetch the Checkout Session to display the JSON result on the success page
            try {
                $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $checkout_session) {
                // Retrieve the details of a PaymentIntent
                try {
                    $intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    $api_error = $e->getMessage();
                }

                // // Retrieves the details of customer
                // try {
                //     // Create the PaymentIntent
                //     $customer = \Stripe\Customer::retrieve($checkout_session->customer);
                // } catch (\Stripe\Exception\ApiErrorException $e) {
                //     $api_error = $e->getMessage();
                // }

                //if(empty($api_error) && $intent){
                if ($intent) {
                    // Check whether the charge is successful
                    if ($intent->status == 'succeeded') {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    $status_msg = get_phrase("Unable_to_fetch_the_transaction_details") . ' ' . $api_error;
                }
            } else {
                $status_msg = get_phrase("Transaction_has_been_failed") . ' ' . $api_error;
            }
        } else {
            $status_msg = get_phrase("Invalid_Request");
        }
        return false;
    }


    public function check_razorpay_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway




        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.razorpay.com/v1/payments/' . $_GET['razorpay_payment_id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($keys['key_id'] . ':' . $keys['secret_key'])
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);

        $total_payable_amount = $payment_details['total_payable_amount'] * 100;

        if ($response->status == 'authorized' && $total_payable_amount == $response->amount) {
            return true;
        }
    }

    public function razorpayPrepareData($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

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
            $key_id = $keys['key_id'];
            $secret_key = $keys['secret_key'];
        } else {
            $key_id = $keys['key_id'];
            $secret_key = $keys['secret_key'];
        }



        $api = new Api($key_id, $secret_key);
        $_SESSION['payable_amount'] = $payment_details['total_payable_amount'];

        $razorpayOrder = $api->order->create(array(
            'receipt'         => rand(),
            'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
            'currency'        => $payment_gateway['currency'],
            'payment_capture' => 1 // auto capture
        ));
        $amount = $razorpayOrder['amount'];
        $razorpayOrderId = $razorpayOrder['id'];
        $_SESSION['razorpay_order_id'] = $razorpayOrderId;

        $data = array(
            "key" => $key_id,
            "amount" => $amount,
            "name" => get_settings('system_title'),
            "description" => get_settings('about_us'),
            "image" => base_url('uploads/system/' . get_settings('favicon')),
            "prefill" => array(
                "name"  => $user_details['first_name'] . ' ' . $user_details['last_name'],
                "email"  => $user_details['email'],
            ),
            "notes"  => array(
                "merchant_order_id" => rand(),
            ),
            "theme"  => array(
                "color"  => json_decode($payment_gateway['keys'], true)['theme_color']
            ),
            "order_id" => $razorpayOrderId,
        );
        return $data;
    }

    /**** Custom Payment Gateways ****/
    public function check_skrill_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        /** this will be verified based on the what we'll receive as a response from skrill(has security issues) **/

        $status = $_GET["status"];
        if ($status == '-2') {
            return false;
        } else if ($status == '2') {
            return false;
        } else if ($status == '0') {
            return false;
        } else if ($status == '-1') {
            return false;
        }

        return true;
    }

    public function skrill_ipn()
    {
        /***UN-COMPLETE***/
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => "skrill"])->row_array();

        //if instructor payout, no need to verify or do anything
        if ($_GET['is_instructor_payout_user_id'] <= 0) {

            $keys = json_decode($payment_gateway['keys'], true);
            $concat_fields = $_GET['merchant_id'] .
                $_GET['transaction_id'] .
                strtoupper(md5($keys['skrill_secret_word'])) .
                $_GET['mb_amount'] .
                $_GET['mb_currency'] .
                $_GET['status'];
        }
    }

    public function check_payu_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        $order_id = $this->session->userdata("payu_order_id");
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

            $response = OpenPayU_Order::retrieve($order_id);
            if ($response->getStatus() === "SUCCESS" && $response->getResponse()->orders[0]->totalAmount) {

                $this->session->unset_userdata('payu_order_id');
                return true;
            }
        } catch (\Exception $exception) {

            //
        }

        return false;
    }

    public function check_sslcommerz_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }

        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        $val_id = urlencode($_POST['val_id']);
        $store_id = urlencode($keys["store_id"]);
        $store_passwd = urlencode($keys["store_password"]);
        if ($test_mode == 1) {

            $validation_url = "https://sandbox.sslcommerz.com";
        } else {

            $validation_url = "https://securepay.sslcommerz.com";
        }

        $validation_url .= "/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json";
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $validation_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($code == 200 && !(curl_errno($handle))) {

            $result = json_decode($result, true);
            if ($result['status'] == 'VALID' && $payment_details['total_payable_amount'] == $result["amount"]) {

                return true;
            }
        }

        return false;
    }

    public function check_pagseguro_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway
    }

    public function check_xendit_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        $id = $this->session->userdata("xendit_invoice_id");
        require_once APPPATH . 'libraries/xendit/vendor/autoload.php';

        try {
            \Xendit\Xendit::setApiKey($keys["api_key"]);
            $getInvoice = \Xendit\Invoice::retrieve($id);

            if ($getInvoice["status"] === "PAID" && $getInvoice["amount"] == ($payment_details['total_payable_amount'] * 100)) {

                $this->session->unset_userdata('xendit_invoice_id');
                return true;
            }
        } catch (\Exception $exception) {

            //
        }

        return false;
    }

    public function check_doku_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway
        return true;
    }

    function checkLogin($payment_info = "")
    {
        if ($this->session->userdata('user_id') > 0) {
            return $this->session->userdata('payment_details');
        } else {
            $cart_items = array();
            // Checking login credential for admin
            $payment_info = str_replace('...', '', $payment_info);
            $query = $this->db->like('temp', $payment_info)->get('users');
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $payment_info = base64_decode($row->temp);
                $payment_info = json_decode($payment_info, true);
                $user_id = $payment_info[0];
                $payment_details = $payment_info[1];

                if (($payment_info[3] + 600) < microtime(true) || $user_id != $row->id) {
                    return false;
                }


                $this->session->set_userdata('custom_session_limit', (time() + 604800));
                $this->session->set_userdata('user_id', $row->id);
                $this->session->set_userdata('role_id', $row->role_id);
                $this->session->set_userdata('role', get_user_role('user_role', $row->id));
                $this->session->set_userdata('name', $row->first_name . ' ' . $row->last_name);
                $this->session->set_userdata('is_instructor', $row->is_instructor);
                $this->session->set_userdata('user_login', '1');

                if ($payment_details['is_instructor_payout_user_id'] == false) {
                    foreach ($payment_details['items'] as $item) {
                        if (isset($item['id']) && $item['id'] > 0) {
                            $cart_items[] = $item['id'];
                        }
                    }
                }
                $this->session->set_userdata('cart_items', $cart_items);
                $this->session->set_userdata('applied_coupon', $payment_info[2]);
                $this->session->set_userdata('payment_details', $payment_details);
                $this->session->set_userdata('total_price_of_checking_out', $payment_details['total_payable_amount']);

                return $payment_details;
            }
        }
    }


    function check_bkash_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway


        $paymentID = $_GET['paymentID'];
        $request_body = array(
            'paymentID' => $paymentID
        );

        if ($test_mode) {
            $url = curl_init('https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/execute');
        } else {
            $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute');
        }

        $request_body_json = json_encode($request_body);

        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $request_body_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        $obj = json_decode($resultdata);

        if ($obj->statusCode == '0000') {
            return true;
        } else {
            return false;
        }
    }

    function check_cashfree_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

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
        $order_id = $_GET['order_id'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url . '/' . $order_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array(
            'accept: application/json',
            'x-api-version: 2022-09-01',
            'x-client-id:' . $keys['client_id'],
            'x-client-secret:' . $keys['client_secret']
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        $response = json_decode($result);

        if ($response && $response->order_status == 'PAID') {
            return true;
        } else {
            return false;
        }
    }


    function check_maxicash_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        $payment_details = $this->session->userdata('payment_details');

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
            $url = 'https://api-testbed.maxicashapp.com/PayEntry';
        } else {
            $url = 'https://api.maxicashapp.com/PayEntry';
        }


        //https://developer.maxicashapp.com/?q=Request+came+with+empty+payload
        // // Replace the placeholder values with your actual values
        // $totalAmount = "100.00";
        // $maxicashTelephoneNo = "1234567890";
        // $merchantID = "your_merchant_id";
        // $merchantPassword = "your_merchant_password";
        // $referenceOfTransaction = "your_transaction_reference";
        // $successURL = "http://example.com/success";
        // $cancelURL = "http://example.com/cancel";
        // $failureURL = "http://example.com/failure";
        // $notifyURL = "http://example.com/notify";

        // // Construct the data array
        // $data = array(
        //     "PayType" => "MaxiCash",
        //     "Amount" => $totalAmount,
        //     "Currency" => "maxiDollar",
        //     "Telephone" => $maxicashTelephoneNo,
        //     "MerchantID" => $merchantID,
        //     "MerchantPassword" => $merchantPassword,
        //     "Language" => "fr",
        //     "Reference" => $referenceOfTransaction,
        //     "Accepturl" => $successURL,
        //     "Cancelurl" => $cancelURL,
        //     "Declineurl" => $failureURL,
        //     "NotifyURL" => $notifyURL
        // );

        // // Encode the data array to JSON
        // $jsonData = json_encode($data);

        // // Create cURL resource
        // $ch = curl_init();

        // // Set cURL options
        // curl_setopt($ch, CURLOPT_URL, "$url");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "data=" . urlencode($jsonData));

        // // Execute cURL session and get the response
        // $response = curl_exec($ch);

        // // Close cURL session
        // curl_close($ch);

        // // Print the response
        // if(json_decode($response, true)['ResponseStatus'] == "success"){
        //     return true;
        // }else{
        //     return false;
        // }



        if ($_GET['status'] == 'success') {
            return true;
        } else {
            return false;
        }
    }


    function check_aamarpay_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway


        if (is_array($_POST) && $_POST['pay_status'] == "Successful") {
            $merTxnId = $_POST['mer_txnid'];
            $store_id = $keys['store_id'];  // You have to use your Store ID / MerchantID here
            $signature_key = $keys['signature_key']; // Your have to use your signature key here ,it will be provided by aamarPay

            if ($test_mode == 1) {
                $url = "https://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$merTxnId&store_id=$store_id&signature_key=$signature_key&type=json"; //sandbox
            } else {
                $url = "https://secure.aamarpay.com/api/v1/trxcheck/request.php?request_id=$merTxnId&store_id=$store_id&signature_key=$signature_key&type=json"; //live url
            }

            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);

            curl_setopt($curl_handle, CURLOPT_VERBOSE, true);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
            $buffer = curl_exec($curl_handle);
            curl_close($curl_handle);
            $arr = json_decode($buffer, true);


            if (is_array($arr) && $arr['pay_status'] == "Successful") {
                return true;
                // echo 3333;
            } else {
                return false;
                // echo 2222;
            }
        } else {
            return false;
        }
    }

    function check_flutterwave_payment($identifier = "")
    {
        //start common code of all payment gateway
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();
        $payment_details = $this->session->userdata('payment_details');

        if ($payment_details['is_instructor_payout_user_id'] > 0) {
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        } else {
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];
        //ended common code of all payment gateway

        if(isset($_GET['transaction_id'])){
            $transaction_id = $_GET['transaction_id'];
        }else{
            $transaction_id = '';
        }
        $secret_key = $keys['secret_key'];

        $url = "https://api.flutterwave.com/v3/transactions/$transaction_id/verify";

        $headers = array(
            "Authorization: Bearer $secret_key"
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($http_status == 200) {
            if(isset(json_decode($response)->status) && json_decode($response)->status == 'success'){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    function check_tazapay_payment(){

        $id = $this->session->userdata('tazapay_id');

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
            $session_generate_url = 'https://service-sandbox.tazapay.com/v3/checkout/'.$id;
        }else{
            $session_generate_url = 'https://service.tazapay.com/v3/checkout/'.$id;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => $session_generate_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Basic ".base64_encode($keys['api_key'].':'.$keys['api_secret'])
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            $responseArr = json_decode($response, true);
            if(is_array($responseArr) && $responseArr['status'] == 'success'){
                if($responseArr['data']['amount'] == $responseArr['data']['amount_paid']){
                    $this->session->unset_userdata('tazapay_id');
                    return true;
                }else{
                    return false;
                }
            }else{
                $this->session->set_flashdata('error_message', get_phrase('An error occurred'));
                redirect($payment_details['cancel_url'], 'refresh');
            }
        }
    }


    
}
