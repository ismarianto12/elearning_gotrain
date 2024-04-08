<script type="text/javascript">
  $(document).ready(function() {
    <?php if(isset($_GET['tab'])): ?>
      if ($('button[data-bs-target="#<?php echo htmlspecialchars($_GET['tab']); ?>"]').length) {
        const setIntervalCalBack = setInterval(function() {
          $('button[data-bs-target="#<?php echo htmlspecialchars($_GET['tab']); ?>"]').trigger('click');
          $('button[data-bs-target="#<?php echo htmlspecialchars($_GET['tab']); ?>"]').parent().parent().find('.nav-item .nav-link').removeClass('active');
          $('button[data-bs-target="#<?php echo htmlspecialchars($_GET['tab']); ?>"]').parent().parent().find('.nav-item .nav-link').removeClass('show');
          $('button[data-bs-target="#<?php echo htmlspecialchars($_GET['tab']); ?>"]').addClass('active show');

          $('#<?php echo htmlspecialchars($_GET['tab']); ?>').parent().find('.tab-pane').removeClass('show');
          $('#<?php echo htmlspecialchars($_GET['tab']); ?>').parent().find('.tab-pane').removeClass('active');
          $('#<?php echo htmlspecialchars($_GET['tab']); ?>').addClass('active show');

          if ($('#<?php echo htmlspecialchars($_GET['tab']); ?>').hasClass('active')) {
            clearInterval(setIntervalCalBack);
          }
        }, 1000);
      }
    <?php endif; ?>
  });
</script>


<!-- Google analytics -->
<?php if(!empty(get_settings('google_analytics_id'))): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_settings('google_analytics_id'); ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo get_settings('google_analytics_id'); ?>');
  </script>
<?php endif; ?>
<!-- Ended Google analytics -->

<!-- Meta pixel -->
<?php if(!empty(get_settings('meta_pixel_id'))): ?>
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo get_settings('meta_pixel_id'); ?>');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img loading="lazy" height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo get_settings('meta_pixel_id'); ?>&ev=PageView&noscript=1"/>
  </noscript>
<?php endif; ?>
<!-- Ended Meta pixel -->


<script type="text/javascript">
  function redirectTo(url, event){
    $(location).attr('href', url);
  }

  function actionTo(url, type = "get", event) {
    //Start prepare get url to post value
      var jsonFormate = '{}';
      if(type == 'post'){
        let pieces = url.split(/[\s?]+/);
        let lastString = pieces[pieces.length - 1];
        jsonFormate = '{"'+lastString.replace('=', '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","')+'"}';
      }
      jsonFormate = JSON.parse(jsonFormate);
    //End prepare get url to post value
    $.ajax({
      type: type,
      url: url,
      data: jsonFormate,
      success: function(response) {
        distributeServerResponse(response);
      }
    });

  }

  //Server response distribute
  function distributeServerResponse(response){
    try {
      JSON.parse(response);
      var isValidJson = true;
    } catch (error) {
      var isValidJson = false;
    }
    if (isValidJson) {
      response = JSON.parse(response);
      //For reload after submission
      if(typeof response.reload != "undefined" && response.reload != 0){
        location.reload();
      }

      //For redirect to another url
      if(typeof response.redirectTo != "undefined" && response.redirectTo != 0){
        $(location).attr('href', response.redirectTo);
      }

      //for show a element
      if(typeof response.show != "undefined" && response.show != 0 && $(response.show).length){
        $(response.show).css('display', 'inline-block');
      }
      //for hide a element
      if(typeof response.hide != "undefined" && response.hide != 0 && $(response.hide).length){
        $(response.hide).hide();
      }
      //for fade in a element
      if(typeof response.fadeIn != "undefined" && response.fadeIn != 0 && $(response.fadeIn).length){
        $(response.fadeIn).fadeIn();
      }
      //for fade out a element
      if(typeof response.fadeOut != "undefined" && response.fadeOut != 0 && $(response.fadeOut).length){
        $(response.fadeOut).fadeOut();
      }

      //For adding a class
      if(typeof response.addClass != "undefined" && response.addClass != 0 && $(response.addClass.elem).length){
        $(response.addClass.elem).addClass(response.addClass.content);
      }
      //For remove a class
      if(typeof response.removeClass != "undefined" && response.removeClass != 0 && $(response.removeClass.elem).length){
        $(response.removeClass.elem).removeClass(response.removeClass.content);
      }
      //For toggle a class
      if(typeof response.toggleClass != "undefined" && response.toggleClass != 0 && $(response.toggleClass.elem).length){
        $(response.toggleClass.elem).toggleClass(response.toggleClass.content);
      }

      //For showing error message
      if(typeof response.error != "undefined" && response.error != 0){
        toastr.error(response.error);
      }
      //For showing success message
      if(typeof response.success != "undefined" && response.success != 0){
        toastr.success(response.success);
      }

      //For replace texts in a specific element
      if(typeof response.text != "undefined" && response.text != 0 && $(response.text.elem).length){
        $(response.text.elem).text(response.text.content);
      }
      //For replace elements in a specific element
      if(typeof response.html != "undefined" && response.html != 0 && $(response.html.elem).length){
        $(response.html.elem).html(response.html.content);
      }
      //For replace elements in a specific element
      if(typeof response.load != "undefined" && response.load != 0 && $(response.load.elem).length){
        $(response.load.elem).html(response.load.content);
      }
      //For appending elements
      if(typeof response.append != "undefined" && response.append != 0 && $(response.append.elem).length){
        $(response.append.elem).append(response.append.content);
      }
      //Fo prepending elements
      if(typeof response.prepend != "undefined" && response.prepend != 0 && $(response.prepend.elem).length){
        $(response.prepend.elem).prepend(response.prepend.content);
      }
      //For appending elements after a element
      if(typeof response.after != "undefined" && response.after != 0 && $(response.after.elem).length){
        $(response.after.elem).after(response.after.content);
      }

      // Update the browser URL and add a new entry to the history
      if(typeof response.pushState != "undefined" && response.pushState != 0){
        history.pushState({}, response.pushState.title, response.pushState.url);
      }

      if(typeof response.script != "undefined" && response.script != 0){
        script
      }
    }
  }

</script>