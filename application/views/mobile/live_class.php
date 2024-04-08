<!DOCTYPE html>

<head>
    <title><?php echo get_phrase('live_class'); ?> : <?php echo $course_details['title']; ?></title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.3.5/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.3.5/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link name="favicon" type="image/x-icon" href="<?php echo base_url() . 'uploads/system/favicon.png' ?>" rel="shortcut icon" />
</head>

<body>
    <style>
    body {
        padding-top: 50px;
    }

    .course_info {
        color: #999999;
        font-size: 11px;
        padding-bottom: 10px;
    }

    .btn-finish {
        background-color: #656565;
        border-color: #222222;
        color: #cacaca;
    }

    .btn-finish:hover,
    .btn-finish:focus,
    .btn-finish:active,
    .btn-finish.active,
    .open .dropdown-toggle.btn-finish {
        color: #cacaca;
    }

    .course_user_info {
        color: #989898;
        font-size: 12px;
        margin-right: 20px;
    }

    @media only screen and (max-width: 815px) {
        #nav-tool {
            display: none;
        }
    }
    </style>



    <!-- import ZoomMtg dependencies -->
    <!--<script src="https://source.zoom.us/1.9.1/lib/vendor/react.min.js"></script>-->
    <!--<script src="https://source.zoom.us/1.9.1/lib/vendor/react-dom.min.js"></script>-->
    <!--<script src="https://source.zoom.us/1.9.1/lib/vendor/redux.min.js"></script>-->
    <!--<script src="https://source.zoom.us/1.9.1/lib/vendor/redux-thunk.min.js"></script>-->
    <!--<script src="https://source.zoom.us/1.9.1/lib/vendor/lodash.min.js"></script>-->

    <!-- import ZoomMtg -->
    <!--<script src="https://source.zoom.us/zoom-meeting-1.9.1.min.js"></script>-->
    
    <script src="https://source.zoom.us/2.3.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.3.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.3.5/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.3.5/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.9/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/2.3.5/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.3.5.min.js"></script>

    <script>

    $(window).on("orientationchange",function(){
        console.log("Orientation changed");
    });
    function stop_zoom() {
        var r = confirm("<?php echo get_phrase('do_you_want_to_leave_the_live_video_class'); ?> ? <?php echo get_phrase('you_can_join_them_later_if_the_video_class_remains_ive'); ?>");
        if (r == true) {
            ZoomMtg.leaveMeeting();
        }

    }

    $(document).ready(function() {
        start_zoom();
    });

    function start_zoom() {

        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();

        var API_KEY = "<?php echo get_settings('zoom_api_key'); ?>";
        var API_SECRET = "<?php echo get_settings('zoom_secret_key'); ?>";
        var USER_NAME = "<?php echo $logged_user_details['first_name'] . " " . $logged_user_details['last_name']; ?>";
        var MEETING_NUMBER = "<?php echo $live_class_details['zoom_meeting_id']; ?>";
        var PASSWORD = "<?php echo $live_class_details['zoom_meeting_password']; ?>";

        testTool = window.testTool;


        var meetConfig = {
            apiKey: API_KEY,
            apiSecret: API_SECRET,
            meetingNumber: MEETING_NUMBER,
            userName: USER_NAME,
            passWord: PASSWORD,
            leaveUrl: "<?php echo site_url('home/live_class_mobile_web_view/' . slugify($course_details['id']) . '/' . $logged_user_details['id']); ?>/true",
            role: 0
        };


        var signature = ZoomMtg.generateSignature({
            meetingNumber: meetConfig.meetingNumber,
            apiKey: meetConfig.apiKey,
            apiSecret: meetConfig.apiSecret,
            role: meetConfig.role,
            success: function(res) {
                console.log(res.result);
            }
        });

        ZoomMtg.init({
            leaveUrl: "<?php echo site_url('home/live_class_mobile_web_view/' . slugify($course_details['id']) . '/' . $logged_user_details['id']); ?>/true",
            meetingInfo: [ 'topic', 'host'],
            isSupportAV: true,
            success: function() {
                ZoomMtg.join({
                    meetingNumber: meetConfig.meetingNumber,
                    userName: meetConfig.userName,
                    signature: signature,
                    apiKey: meetConfig.apiKey,
                    passWord: meetConfig.passWord,
                    success: function(res) {
                        console.log('join meeting success');
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            error: function(res) {
                console.log(res);
            }
        });
    }
    </script>
</body>

</html>
