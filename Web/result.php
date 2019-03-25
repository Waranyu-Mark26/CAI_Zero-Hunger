<!DOCTYPE html>
<html>
    <header>
        <title>Project : Zero Hunger</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="main.css">
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <script src="jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
        <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
        <script>
        var x = document.getElementById("demo");

        /*function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.html("Geolocation is not20 supported by this browser.");
            }
        }

        function showPosition(position) {


            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $replaced = str_replace(['true','http://127.0.0.1/'],['false',''],$actual_link);
            //var_dump($actual_link);
            if($_GET['load'])
             echo ("location.replace('"); echo ($replaced); echo ("&lat="); ?> + position.coords.latitudeecho('&lng=');+position.coords.longitude echo(');');

        }
        $(document).ready(function(){getLocation();})*/
        </script>
        <script>
            function proceed()
            {
                location.replace("amount.php?u=" + <?php echo "'"; echo $_GET['u']; echo "'";?>);
            }


        </script>
    </header>
    <body class="body">
        <h1>Project : Zero Hunger</h1>
        <h3 id="h3-re" >&nbspLogged in as <?php echo " " . $_GET['u']; ?></h3>
        <h2 align="center">Choose Your Location</h2>
        <container id="mapContainer-con">
            <div style="width: 990px; height: 540px" id="mapContainer"></div>
        </container>
        <script>
        // Initialize the platform object:
        var platform = new H.service.Platform({
            'app_id': 'ijd23W9uYkFxLdvP1T0w',
            'app_code': 'donsb39wZRwbqNwzwBirgw'
        });

        // Obtain the default map types from the platform object
        var maptypes = platform.createDefaultLayers();

        // Instantiate (and display) a map object:
        var map = new H.Map(
            document.getElementById('mapContainer'),
            maptypes.normal.map,
            {
                zoom: 18,
                center: { lng:103.772780 , lat:1.305638 }
            });

        </script>

        <div id="demo" align="center"></div>
        <br><br>
        <container id="btn-submit">
            <div>
            <button onclick="proceed()" class="btn btn-success">Next</button>
            </div>
        </container>
    </body>

</html>
