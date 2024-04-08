<?php
    //start common code of all payment gateway
    $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_gateway['identifier']])->row_array();

    if($payment_details['is_instructor_payout_user_id'] > 0){
        $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
        $keys = json_decode($instructor_details['payment_keys'], true);
        $keys = $keys[$payment_gateway['identifier']];
    }else{
        $keys = json_decode($payment_gateway['keys'], true);
    }
    $test_mode = $payment_gateway['enabled_test_mode'];
    //ended common code of all payment gateway

    if($test_mode == 1){
        $username = $keys['username'];
        $password = $keys['password'];
        $app_key = $keys['app_key'];
        $app_secret = $keys['app_secret'];
    } else {
        $username = $keys['username'];
        $password = $keys['password'];
        $app_key = $keys['app_key'];
        $app_secret = $keys['app_secret'];
    }
?>

<script src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
<!-- Buy button --> <!-- Initially disabled -->
<button class="gateway <?php echo $payment_gateway['identifier']; ?>-gateway payment-button float-end" id="bKash_button" disabled="disabled" style="background-color: #d93668;"><?php echo get_phrase("pay_with_bkash"); ?></button>

<script>
    let paymentID;

    let username = "<?php echo $username; ?>"; // New line
    let password = "<?php echo $password; ?>"; // New line
    let app_key = "<?php echo $app_key; ?>"; // New line
    let app_secret = "<?php echo $app_secret; ?>"; // New line

    <?php if($test_mode): ?>
        let grantTokenUrl = 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/token/grant'; // New line
        let createCheckoutUrl = 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/create'; // Replaced API
        let executeCheckoutUrl = 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/execute'; // Replaced API
    <?php else: ?>
        let grantTokenUrl = 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant'; // New line
        let createCheckoutUrl = 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create'; // Replaced API
        let executeCheckoutUrl = 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute'; // Replaced API
    <?php endif; ?>

    $(document).ready(function () {
        getAuthToken(); // Replaced function
    });

    // New function
    function getAuthToken() {
        let body = {
        "app_key": app_key,
        "app_secret": app_secret
        };

        $.ajax({
        url: grantTokenUrl,
        headers: {
            "username": username,
            "password": password,
            "Content-Type": "application/json"
        },
        type: 'POST',
        data: JSON.stringify(body),
        success: function (result) {
            
            let headers = {
            "Content-Type": "application/json",
            "Authorization": result.id_token, // Contains access token
            "X-APP-Key": app_key
            };

            let request = {
                "amount": "<?php echo $payment_details['total_payable_amount']; ?>",
                "intent": "sale",
                "currency": "<?php echo $payment_gateway['currency']; ?>", // New line
                "merchantInvoiceNumber": "<?php echo rand(100000, 999999); ?>" // New line
            };

            initBkash(headers, request);
        },
        error: function (error) {
            console.log(error);
        }
        });
    }

    function initBkash(headers, request) {
        bKash.init({
        paymentMode: 'checkout',
        paymentRequest: request, // Updated line

        createRequest: function (request) {
            $.ajax({
            url: createCheckoutUrl,
            headers: headers, // New line
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(request),
            success: function (data) {
                
                if (data && data.paymentID != null) {
                paymentID = data.paymentID;
                bKash.create().onSuccess(data);
                } 
                else {
                bKash.create().onError(); // Run clean up code
                alert(data.errorMessage + " Tag should be 2 digit, Length should be 2 digit, Value should be number of character mention in Length, ex. MI041234 , supported tags are MI, MW, RF");
                }

            },
            error: function () {
                bKash.create().onError(); // Run clean up code
                alert(data.errorMessage);
            }
            });
        },
        executeRequestOnAuthorization: function () {
            $.ajax({
            url: executeCheckoutUrl + '/' + paymentID, // Updated line
            headers: headers, // New line
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {

                if (data && data.paymentID != null) {
                    // On success, perform your desired action
                    alert('[SUCCESS] data : ' + JSON.stringify(data));
                    window.location.href = "<?php echo $payment_details['success_url']; ?>/bkash";

                } else {
                    alert('[ERROR] data : ' + JSON.stringify(data));
                    bKash.execute().onError();//run clean up code
                }

            },
            error: function () {
                alert('An alert has occurred during execute');
                bKash.execute().onError(); // Run clean up code
            }
            });
        },
        onClose: function () {
            alert('User has clicked the close button');
        }
        });

        $('#bKash_button').removeAttr('disabled');

    }
</script>