<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6wWy83m1Mj-WVV446QA0c6yVB4AseJNQ"></script>


<title>Map</title>

</head>
<body>

<div id="map-canvas"> </div>

<br>
    <button type="submit" id="mailtobutton" class="btn btn-primary">Email Us</button>

    <style>
            html { height: 50%}
            body { height: 50%; margin: 100; padding: 100}
            #map-canvas { height: 100% }
    </style>



    <script>
    $(document).ready(function() {
        $('#mailtobutton').click(function(event) {
            window.location = "mailto:wint_zoo@gmail.com";
        });

        function initialize() {
        var myLatlng = new google.maps.LatLng(10.789120, 106.695340);
        var mapOptions = {
            center: myLatlng,
            zoom: 15
        };

        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

        var infowindow = new google.maps.InfoWindow({
            content: '<div id="content"><a href="http://localhost/doanhk2/">WINT ZOO</a> <br/> 24 Phan Liem, Da Kao Ward, District 1, Ho Chi Minh City, Vietnam</div>',
            position: myLatlng
        });

        infowindow.open(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    });

    
    </script>


</body>

</html>