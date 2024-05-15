<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Alyusr Academy</title>

    <link rel="icon" type="image/png" href="images/favicon.png">

    <link href="{{ asset('landing/css/soonx.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('landing/css/media.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>


<body class="dark">

    <!-- Snow-->

    <canvas class="snow-canvas"></canvas>

    <!-- started id wrap  -->

    <div id="wrap">

        <!--starts logo div -->

        <div class="logo">
            <div class="container"> <a href="#."><img class="logo" style="height:40%;" src="{{ asset('landing/logo.svg') }} "
                        alt="ALYUSR logo" /></a> </div>
            <div class="clear"></div>
        </div>

        <!--ended logo div -->

        <div class="clear"></div>

        <!-- starts counter -->

        <div class="counter lightcounter">
            <div class="container">
                <ul class="countdown_2">
                    <li>
                        <span class="days">00</span>
                        <p class="days_ref">days</p>
                    </li>
                    <li>
                        <span class="hours">00</span>
                        <p class="hours_ref">hours</p>
                    </li>
                    <li>
                        <span class="minutes">00</span>
                        <p class="minutes_ref">min</p>
                    </li>
                    <li>
                        <span class="seconds last">00</span>
                        <p class="seconds_ref">seconds</p>
                    </li>
                </ul>
                <div class="lightnotify mid">
                    <h1>...منصة اليسر للدورات التدريبية  - انتظرونا قريبا </h1>

                </div>
                <div class="clear"></div>
                {{-- <div class="lightsocial">
                    <ul>
                        <li><a href="#." class="fa fb"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#." class="fa tw"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#." class="fa in"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#." class="fa gp"><i class="fa fa-google"></i></a></li>
                    </ul>
                </div> --}}
            </div>
            <div class="clear"></div>
        </div>

        <!-- end counter -->
        <div class="clear"></div>

        <!-- start footer -->

        <div class="lightfooter">
            <div class="container">
                <p>Copyrights © 2024 ALYUSR - All Rights Reserved.</p>
            </div>
            <div class="clear"></div>
        </div>

        <!--end footer -->

    </div>

    <!-- ended id wrap  -->

    <!-- JS File -->

    <script type="text/javascript" src="{{ asset('landing/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('landing/js/snow-plugin.js') }}"></script>

    <script>
        $(".snow-canvas").snow();
    </script>


    <script type="text/javascript" src="{{ asset('landing/js/jquery.downCount.js') }}"></script>
    <script type="text/javascript" src="{{ asset('landing/js/functions.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.countdown_2').downCount({
                date: '06/16/2024 12:00:00',
                offset: +1
            });
        });
    </script>
</body>

</html>
