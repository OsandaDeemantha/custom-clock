<html>
<title>Custom Animated Clock</title>

<head>
    <style>
        body {
            background-color: #2A2A2A;
        }

        .container {
            margin: 50px;
            position: relative;
        }

        .outCircle2 {
            width: 250px;
            height: 250px;
            left: 0px;
            position: absolute;
            top: 0px;
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
        }

        .clocktext {
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: xx-large;
            font-weight: 800;
            transform: translate(-50%, -50%);
            font-family: "Comic Sans MS", cursive, sans-serif;
            color: white;
        }

        .outCircle {
            width: 200px;
            height: 200px;
            left: 25px;
            position: absolute;
            top: 25px;
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
        }

        .rotate {
            width: 100%;
            height: 100%;
        }

        .counterrotate {
            width: 50px;
            height: 50px;
        }

        .inner {
            width: 50px;
            height: 50px;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            border-radius: 100px;
            position: absolute;
            left: 0px;
            top: 0px;
            display: block;
        }

        .content {
            position: relative;
            display: block;
        }

        .sun2 {
            border-radius: 50%;
            position: absolute;
            overflow: hidden;
            left: 0px;
            top: 0px;
        }

        .shadow {
            border-radius: 50%;
            position: absolute;
            left: 0px;
            top: 0px;
        }
    </style>
</head>

<body>

    <?php
    // date_default_timezone_set('Asia/Colombo'); //better to set timezone before getting server time
    // echo date_default_timezone_get();
    // echo "<br>";
    // echo date('m/d/Y h:i:s a', time());
    // echo "<br>";
    // echo date('D M d Y H:i:s O'); //correct format to add to the javascript
    ?>
    <div class="container">
        <div class="outCircle2">
            <img src="img/ring.png" alt="Ring" style="width:100%;">
            <div class="clocktext" id="clocktext"></div>
        </div>

        <div class="outCircle" id="outCircle">
            <div class="rotate">
                <div class="counterrotate" id="counterrotate">
                    <div class="content" id="half1">
                        <div class="sun2" id="sun1">
                            <img src="img/moon.png" alt="Sun" style="width:100%;">
                            <div class="shadow" id="shadow1">
                                <img src="img/sun.png" alt="Moon" style="width:100%;">
                            </div>
                        </div>
                    </div>
                    <div class="content" id="half2">
                        <div class="sun2" id="sun2">
                            <img src="img/sun.png" alt="Sun" style="width:100%;">
                            <div class="shadow" id="shadow2">
                                <img src="img/moon.png" alt="Moon" style="width:100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function show() {

            var enableSeconds = true;

            var virtualOrigin = Date.parse("2020-08-14T00:00:04"),
                realOrigin = Date.parse("2020-08-14T00:00:00"),
                factor = 4;

            actualDate = new Date();
            var Digital = new Date(virtualOrigin + (actualDate - realOrigin) * factor); //calculate virtual time
            var hours = Digital.getHours()
            var minutes = Digital.getMinutes()
            var seconds = Digital.getSeconds()

            var timestamp = (hours * 3600) + (minutes * 60) + seconds;
            var allseconds = 86400;
            var degree = (timestamp / allseconds) * 360;
            degree = (Math.round((degree + Number.EPSILON - 135) * 100) / 100);
            var antiDegree = 360 - degree;
            var length = (((degree + 135) / 360) * 100) - 50;
            var length2 = length - 50;

            if (hours <= 9)
                hours = "0" + hours
            if (minutes <= 9)
                minutes = "0" + minutes
            if (seconds <= 9)
                seconds = "0" + seconds

            if (enableSeconds) {
                document.getElementById("clocktext").innerHTML = hours + ":" + minutes + ":" + seconds;
            } else {
                document.getElementById("clocktext").innerHTML = hours + ":" + minutes;
            }
            if (length > 0) {
                document.getElementById("half1").style.display = "none";
                document.getElementById("half2").style.display = "block";
            } else {
                document.getElementById("half1").style.display = "block";
                document.getElementById("half2").style.display = "none";
            }

            document.getElementById('counterrotate').style.webkitTransform = "rotate(" + antiDegree + "deg)";
            document.getElementById('counterrotate').style.msTransform = "rotate(" + antiDegree + "deg)";
            document.getElementById('counterrotate').style.transform = "rotate(" + antiDegree + "deg)";

            document.getElementById('outCircle').style.webkitTransform = "rotate(" + degree + "deg)";
            document.getElementById('outCircle').style.msTransform = "rotate(" + degree + "deg)";
            document.getElementById('outCircle').style.transform = "rotate(" + degree + "deg)";

            document.getElementById('shadow1').style.webkitTransform = "translateX(" + length + "px)";
            document.getElementById('shadow1').style.msTransform = "translateX(" + length + "px)";
            document.getElementById('shadow1').style.transform = "translateX(" + length + "px)";

            document.getElementById('shadow2').style.webkitTransform = "translateX(" + length2 + "px)";
            document.getElementById('shadow2').style.msTransform = "translateX(" + length2 + "px)";
            document.getElementById('shadow2').style.transform = "translateX(" + length2 + "px)";

            setTimeout("show()", 1000 / factor)
        }
        show()
    </script>

</body>

</html>