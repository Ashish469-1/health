<?php
    $error = "";
    session_start();
    $id=$_SESSION['uid'];
   // $def=0.0;
    include("includes/connection.php");
    if(isset($_POST['license'])){
         $query = "INSERT INTO `driver` (`uid`,`driving_license`,`vehicle_no`,`lat`,`lng`) VALUES ( '".$id."' , '".$_POST['license']."' , '".$_POST['vehicleno']."','".mysqli_real_escape_string($conn, $_POST['latitude'])."','".mysqli_real_escape_string($conn, $_POST['longitude'])."')";
         if (!mysqli_query($conn, $query)) {
               $error = "<p>Could not Update Info, Try again later.</p>";
          } 
        else{
           $update_query = "UPDATE `users` 
                                SET infoUpdated = 1
                                    WHERE `id` = $id ";
            $result = mysqli_query($conn, $update_query);
            $error = "table Updated";
            header("Location: home.php");
        }
    }
?>
<!DOCTYPE html>
<head>
    <title>HealthCare | Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css"/>
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
    <style type="text/css">
        #map {
            /*margin-left:400px !important; */
            width: 100% !important;
            overflow: scroll !important;
            position: fixed !important;
            height: 100% !important;
            z-index: 100
        }
        body,html {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="reg-w3">
        <div class="w3layouts-main">
           <h3>Complete The Account Info to proceed further</h3>
           <div id="error">
            <?php if ($error!="") {
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            } ?>  
        </div>
        <p> Mark the hospital you work for</p>
    </div>
</div>
<?php if(!isset($_GET['hid'])){ ?>
<input id="pac-input" class="controls" type="text" placeholder="Search Box">
<div id="map"></div>
<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    var myLoc;
    var markers = [];
    var infowindow;
    function initAutocomplete() {
        navigator.geolocation.getCurrentPosition(showPosition);
    }

    function showPosition(position) {
        myLoc = { lat: position.coords.latitude, lng: position.coords.longitude };
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLoc,
            zoom: 15,
            mapTypeId: 'roadmap'
        });
        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
            location: myLoc,
            radius: 1500,
            types: ['hospital', 'Hospital']
        }, callback);

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                createMarker(place)

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        function callback(results, status, pagination) {
            console.log(results);
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
                if (pagination.hasNextPage) {
                    console.log(pagination.nextPage());
                }
            }
        }
        function createMarker(place) {
        // var placeLoc = place.geometry.location;
        var mark = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });
        google.maps.event.addListener(mark, 'click', function() {
            var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">' + place.name + '</h1>'+
            '<div id="bodyContent">'+
            '<a href="http://localhost/HealthCare/adv_info_driver.php?hid=' + place.place_id + '">'+
            'Click here to register you as driver of this hospital</a> '+
            '</p>'+
            '</div>'+
            '</div>';
            infowindow.setContent(contentString);
            infowindow.open(map, this);
        });
        markers.push(mark);
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDue5zxvxsCRkoBbBAvcAdDTns1IGJXXfE&libraries=places&callback=initAutocomplete" async defer></script>
<?php } else { ?>
<div class="reg-w3">
    <div class="w3layouts-main" style="margin: 1em auto !important">
        <div id="error">
            <?php if ($error!="") {
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            } ?>  
        </div>

            <form action="adv_info_driver.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['hid']?>">
            <input type="hidden" name="latitude" id="latitude" value="">
            <input type="hidden" name="longitude" id='longitude' value="">
            <input type="text" class="ggg" name="license" placeholder="LICENCE NO" required="">
            <input type="text" class="ggg" name="vehicleno" placeholder="VEHICLE NO" required="">
            <br>
            <div class="clearfix"></div>
            <input type="submit" value="Submit" name="register">
        </form>   
    </div>
</div>
<div id="mapHidden" style="display: none"></div>
<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    var myLoc;
    var markers = [];
    var infowindow;
    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('mapHidden'), {
            center: myLoc,
            zoom: 15,
            mapTypeId: 'roadmap'
        });
        var service = new google.maps.places.PlacesService(map);
        service.getDetails({
          placeId: document.getElementById('id').value
        }, function(place, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            console.log(place);
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
          }
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDue5zxvxsCRkoBbBAvcAdDTns1IGJXXfE&libraries=places&callback=initAutocomplete" async defer></script>
<?php } ?>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>