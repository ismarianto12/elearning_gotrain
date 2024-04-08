<span class="aamarpay-error-message text-danger d-none"></span>
<button onclick="pay_by_aamarpay();" class="gateway <?php echo $payment_gateway['identifier']; ?>-gateway payment-button float-end" id="aamarpay_button" style="background-color: #f9ac4d;"><?php echo get_phrase("pay_by_aamarpay"); ?></button>
<script>
    function pay_by_aamarpay(){
        $.ajax({
            url: "<?php echo site_url('payment/aamarpay_payment_link'); ?>",
            success: function(response) {
                if(validURL(response)){
                    window.location.href = response;
                }else{
                    $('.aamarpay-error-message').html(response);
                    $('.aamarpay-error-message').removeClass('d-none');
                }
            }
        });
    }
    function validURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
            '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        return !!pattern.test(str);
    }
</script>