<?php
    session_start();
    require_once "functions.php";
    include 'include/user.php';
    $user = new User();
    include "db_connect.php";

    if ($conn->connect_errno) {
      echo $conn->connect_error;
      exit;
    }
    else
    {
      // get setting
      $sql="SELECT * FROM settings";
      $result = $conn->query($sql); 
    
      $total=$result->num_rows; 
      $settings=$result->fetch_object();
    
      // get city
      $sql = "SELECT
      trips.trip_dest
      FROM
      trips
      GROUP BY
      trips.trip_dest
      ORDER BY
      trips.trip_dest ASC  
      ";
      $citiesQuery = mysqli_query($conn,$sql);
    
      // get activities
      $sql = "SELECT
      trips.trip_activity
      FROM
      trips
      GROUP BY
      trips.trip_activity
      ORDER BY
      trips.trip_activity ASC  
      ";
      $activitiesQuery = mysqli_query($conn,$sql);
    }

    if($_GET['type'] && $_GET['type']!="") {
      $sql = "SELECT
      trips.trip_id,
      trips.trip_type_id,
      trips.trip_name,
      trips.trip_sum,
      trips.trip_dest,
      trips.trip_cover,
      trip_price.price_unit1,
	    trips.trip_status
      FROM
      trips
      RIGHT JOIN trip_price ON trips.trip_id = trip_price.trip_id WHERE trips.trip_status = '1' AND trip_type_id='".$_GET['type']."'";
      $searchQuery = mysqli_query($conn,$sql);
    }

    if($_GET['city'] && $_GET['city']!="") {
      if($_GET['activity'] && $_GET['activity']=="") {
        $sql = "SELECT
        trips.trip_id,
        trips.trip_type_id,
        trips.trip_name,
        trips.trip_sum,
        trips.trip_dest,
        trips.trip_cover,
        trip_price.price_unit1,
	      trips.trip_status
        FROM
        trips
        RIGHT JOIN trip_price ON trips.trip_id = trip_price.trip_id WHERE trips.trip_status = '1' AND trip_dest='".$_GET['city']."'";
      } else {
        $sql = "SELECT
        trips.trip_id,
        trips.trip_type_id,
        trips.trip_name,
        trips.trip_sum,
        trips.trip_dest,
        trips.trip_cover,
        trip_price.price_unit1,
	      trips.trip_status
        FROM
        trips
        RIGHT JOIN trip_price ON trips.trip_id = trip_price.trip_id WHERE trips.trip_status = '1' AND trip_dest='".$_GET['city']."' AND trip_activity='".$_GET['activity']."'";
      }
      $searchQuery = mysqli_query($conn,$sql);
    }
    $row_cnt = $searchQuery->num_rows;

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Halalwayz
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.min.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link href="./assets/demo/vertical-nav.css" rel="stylesheet" />
  <link href="./assets/css/radiobuttons.css" rel="stylesheet" />
  <link href='dropzone.css' type='text/css' rel='stylesheet'>
  <link rel="stylesheet" href="dist/mtr-datepicker.min.css">
  <link rel="stylesheet" href="dist/mtr-datepicker.default-theme.min.css">
  <link rel="stylesheet" href="css/nice-select.css">
  <link rel="stylesheet" href="css/jquery-ui.multidatespicker.css">
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

 
</head>

<body class="normal-page sidebar-collapse">
<nav class="navbar bg-info navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="bg-info" id="sectionsNav">
  <div class="container">
      <div class="navbar-translate">
          <a class="navbar-brand" href="/"><img src="assets/img/navbarlogo01.png"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="material-icons">home</i> Home
            </a>
          </li>
          <li class="nav-item">
            <a routerLink="" class="nav-link">
              <i class="material-icons">card_travel</i> join halal expert
            </a>
          </li>
        <?php
        /*
        if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
            include 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
            */
        if(!empty($_SESSION['firstname'])){
        ?>
        <li class="button-container nav-item iframe-extern">
          <a href="myprofile.php" class="btn  btn-warning  btn-round btn-block">
            <?php echo $_SESSION['firstname']; ?>
          </a>
        </li>
        <?php  } else { ?>
        <li class="button-container nav-item iframe-extern">
          <a href="login.php" class="btn  btn-warning  btn-round btn-block">
            Login
          </a>
        </li>
        <?php  } ?>
      </ul>
    </div>
  </div>
</nav>
  <div class="page-header header-filter clear-filter">
  </div>
    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                    <div class="container">

                    <h4 class="card-title">
                            <?php if ($row_cnt == 0) { ?>
                                <a href="#pablo">&quot;No trip for your search&quot;</a>
                                </h4>
                                <p class="card-description">
                                  Try to search with another destination and activities
                                </p>
                              <?php } ?>
                              <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                  <div class="card card-raised card-form-horizontal">
                                    <div class="card-body ">
                                      <form method="GET" action="searchresult.php">
                                        <div class="row">
                                          <div class="col-lg-4 col-md-4">
                                          <select class="selectpicker" name="city"  data-style="select-with-transition" title="City" data-size="7">
                                            <option disabled>City</option>
                                            <?php while($result=mysqli_fetch_array($citiesQuery,MYSQLI_ASSOC)) { ?>
                                              <option value="<?php echo $result['trip_dest']; ?>"><?php echo $result['trip_dest']; ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                          <select class="selectpicker" name="activity"  data-style="select-with-transition" title="activity" data-size="7">
                                            <option disabled>activity</option>
                                            <?php while($result=mysqli_fetch_array($activitiesQuery,MYSQLI_ASSOC)) { ?>
                                              <option value="<?php echo $result['trip_activity']; ?>"><?php echo $result['trip_activity']; ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>
                                          <div class="col-md-4">
                                            <button type="submit" class="btn btn-info btn-block">Let's go</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                      <?php if ($row_cnt == 0) { ?>
                        
                      <?php } else { ?>
                        <?php while($result=mysqli_fetch_array($searchQuery,MYSQLI_ASSOC)) { ?>
                            <div class="col-lg-3 col-md-12">
                                <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="card card-blog card-plain">
                                    <div class="card-header card-header-image">
                                        <a target="_blank" href="trip.php?trip_id=<?php echo $result['trip_id']; ?>&name=<?php echo slugify($result['trip_name']); ?>">
                                        <img class="img" src="./upload/<?php echo $result['trip_cover']; ?>">
                                        </a>
                                    </div>
                                    <div class="card-body ">
                                        <h6 class="card-category text-danger">
                                        <?php echo $result['trip_dest']; ?>
                                        </h6>
                                        <h6 class="card-title">
                                        <a target="_blank" href="trip.php?trip_id=<?php echo $result['trip_id']; ?>&name=<?php echo slugify($result['trip_name']); ?>"><?php echo cutString($result['trip_name'],55); ?></a>
                                        </h6>
                                        <p class="card-description">
                                        <?php echo cutString($result['trip_sum'],100); ?>
                                        </p>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="stats">
                                          THB<span class="text-success"> <?php echo $result['price_unit1']." ";?></span>/person
                                        </div>
                                        <div class="stats ml-auto">
                                        <i class="material-icons">favorite</i> <?php echo rand(100,1000)?> &#xB7;
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <?php } } ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  <?php include('footer.php'); ?>
  <!--   Core JS Files   -->
 <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--	Plugin for Sharrre btn -->
  <script src="./assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="./assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="./assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
  <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="./assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
  <!--	Plugin for Small Gallery in Product Page -->
  <script src="./assets/js/plugins/jquery.flexisel.js" type="text/javascript"></script>
  <!-- Plugins for presentation and navigation  -->
  <script src="./assets/demo/modernizr.js" type="text/javascript"></script>
  <script src="./assets/demo/vertical-nav.js" type="text/javascript"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Js With initialisations For Demo Purpose, Don't Include it in Your Project -->
  <script src="./assets/demo/demo.js" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.min.js?v=2.1.1" type="text/javascript"></script>
  <!-- first tab: basic -->
  <script>
    function backFromBasic(){
      window.location="myprofile.php";
    }
    function getTripTypeId(){
      tripTypeId = 0;
      if ($('#travel_trip:checked').val()){
        tripTypeId = 1;
      }else if($('#business_trip:checked').val()){
        tripTypeId = 2;
      }else if($('#medical_trip:checked').val()){
        tripTypeId = 3;
      }else if($('#umrah_trip:checked').val()){
        tripTypeId = 4;
      }
      return tripTypeId;
    }
    function getVehicleId(){
      vehicleId = 0;
      if ($('#walk:checked').val()){
        vehicleId = 1;
      }else if($('#car:checked').val()){
        vehicleId = 2;
      }else if($('#van:checked').val()){
        vehicleId = 3;
      }else if($('#motorbike:checked').val()){
        vehicleId = 4;
      }else if($('#bike:checked').val()){
        vehicleId = 5;
      }else if($('#boat:checked').val()){
        vehicleId = 6;
      }else if($('#public:checked').val()){
        vehicleId = 7;
      }
      return vehicleId;
    }
    function newtrip_basic(){
      var input = document.getElementById("cover");
      if (!input) {
        alert("Um, couldn't find the fileinput element.");
      }
      else if (!input.files) {
        alert("This browser doesn't seem to support the `files` property of file inputs.");
      }
      else {
        if(input.files[0])
        { 
          var file_data = input.files[0];
          var form_data = new FormData();                  
          form_data.append('file', file_data);                         
          $.ajax({
            url: 'upload_handler.php', 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
              if (php_script_response.length <=2){
                alert('Cannot upload cover photo!!');
              }else{
                users_user_id = "<?php echo $_SESSION["userID"];?>";
                vehicleId = getVehicleId();
                tripTypeId = getTripTypeId();
                cover = php_script_response;
                tripName = $('#trip_name').val();
                tripSum = $('#trip_sum').val();
                tripDest = $('#trip_dest').val();
                tripAct = $('#trip_activity').val();
                var form_basic = new FormData()
                form_basic.append('users_user_id',users_user_id);
                form_basic.append('trip_type_id',tripTypeId);
                form_basic.append('vehicle_id',vehicleId);
                form_basic.append('trip_name',tripName);
                form_basic.append('trip_sum',tripSum);
                form_basic.append('trip_dest',tripDest);
                form_basic.append('trip_activity',tripAct);
                form_basic.append('trip_cover',cover);
                form_basic.append('tab','basic');
                $.ajax({
                  url: 'newtrip_backend.php', 
                  dataType: 'text',  // what to expect back from the PHP script, if anything
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_basic,                         
                  type: 'post',
                  success: function(msg){
                    if (msg.length<10){
                      $('#basicTab').removeClass('active');
                      $('#basic').removeClass('active');
                      $('#overviewTab').addClass('active');
                      $('#overview').addClass('active');
                    }else{
                      alert("Error: " + msg);
                    }
                  }
                });
              }
            }
          });
        }else{
                users_user_id = "<?php echo $_SESSION["userID"];?>";
                vehicleId = getVehicleId();
                tripTypeId = getTripTypeId();
                cover = "";
                <?php 
                  if($edit==1){
                    echo "cover='".$trip_cover."';";
                  }
                  ?>
                tripName = $('#trip_name').val();
                tripSum = $('#trip_sum').val();
                tripDest = $('#trip_dest').val();
                tripAct = $('#trip_activity').val();
                var form_basic = new FormData()
                form_basic.append('users_user_id',users_user_id);
                form_basic.append('trip_type_id',tripTypeId);
                form_basic.append('vehicle_id',vehicleId);
                form_basic.append('trip_name',tripName);
                form_basic.append('trip_sum',tripSum);
                form_basic.append('trip_dest',tripDest);
                form_basic.append('trip_activity',tripAct);
                form_basic.append('trip_cover',cover);grW03pe8WvT6H6802NMmKgmNFb82
                form_basic.append('tab','basic');
                $.ajax({
                  url: 'newtrip_backend.php', 
                  dataType: 'text',  // what to expect back from the PHP script, if anything
                  contentType: false,
                  processData: false,
                  data: form_basic,                         
                  type: 'post',
                  success: function(msg){
                    if (msg.length<10){
                      $('#basicTab').removeClass('active');
                      $('#basic').removeClass('active');
                      $('#overviewTab').addClass('active');
                      $('#overview').addClass('active');
                    }else{
                      alert("Error: " + msg);
                    }
                  }
                });
              
        }
      }  
    }
  </script>

 <!-- second tab: overview -->
  <script>
    var dict = {};
    Dropzone.autoDiscover = false;
  var dropzone = new Dropzone ("#dropzonewidget", {
    maxFilesize: 256, // Set the maximum file size to 256 MB
    addRemoveLinks: true, // Don't show remove links on dropzone itself.
    init: function () {
        var myDropzone = this;
        var existing_file;
        $.ajax({ url: 'retrieve_photo.php',
         data: {action: 'test'},
         type: 'post',
         success: function(output) {
            existing_file = output;
            added_file = new Array();
            <?php
              if($edit == 1){
                foreach ($photo_arr as $photo)
                  echo "added_file.push('".$photo."');";
              }
            ?>
            
            for (i = 0; i < existing_file.length; i++) {
              if (added_file.includes(existing_file[i].name)){
                myDropzone.emit("addedfile", existing_file[i]);
              
                //myDropzone.createThumbnailFromUrl(existing_file[i], "http://localhost/trip/upload/"+existing_file[i].name);
                myDropzone.emit("thumbnail", existing_file[i], "upload/"+existing_file[i].name);
                console.log("http://localhost/trip/upload/"+existing_file[i].name);
                myDropzone.emit("complete", existing_file[i]);     
                dict[existing_file[i].name] = existing_file[i].name;
                myDropzone.files.push(existing_file[i]);
              }           
        }
          }
        });
       
        
    }
  });
  dropzone.on("removedfile", function(file){
    $.ajax({
        url: "delete_file.php",
        type: "POST",
        data: { "filename" : dict[file.name] },
        success: function(msg){
          delete dict[file.name];
          //alert(msg);
        }
    });
  });
  dropzone.on("success", function(file,response){
    dict[file.name] = response;
  });
    function backFromOverview(){
      $('#basicTab').addClass('active');
      $('#basic').addClass('active');
      $('#overviewTab').removeClass('active');
      $('#overview').removeClass('active');
    }
    function newtrip_overview(){
  
      fileArr = new Array();
      for(var key in dict) {
	  var value = dict[key];
 	  fileArr.push(value);	
      }
      var form_overview = new FormData()
      form_overview.append('fileList',JSON.stringify(fileArr));
      form_overview.append('tab','overview')
      $.ajax({
          url: 'newtrip_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_overview,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
                $('#overviewTab').removeClass('active');
                $('#overview').removeClass('active');
                $('#detailTab').addClass('active');
                $('#detail').addClass('active');
            }else{
                alert("Error: " + msg);
            }
          }
        });
    }
  </script>

 <!-- third tab: detail -->
<script>
    function backFromDetail(){
      $('#overviewTab').addClass('active');
      $('#overview').addClass('active');
      $('#detailTab').removeClass('active');
      $('#detail').removeClass('active');
    }
    function newtrip_detail(){
      var meeting_addr = $('#meeting_addr').val();
      var meeting_lat = $('#meeting_lat').val();
      var meeting_lng = $('#meeting_lng').val();
      var numDay = Object.keys(detailArr).length;
      var detail_data = {}
      for(var day = 1; day<=numDay; day++){
          detail_data[day] = {};
          for (var det=1; det<=detailArr[day].length; det++)
          {
            var temp = {};
            var sId = "#detail"+day.toString()+"-"+det.toString()+"-s";
            var eId = "#detail"+day.toString()+"-"+det.toString()+"-e";
            var tId = "#detail"+day.toString()+"-"+det.toString()+"-t";
            temp['start'] = $(sId).data('date');
            temp['end'] = $(eId).data('date');
            temp['desc'] = $(tId).val();
            detail_data[day][det] = temp;
          }
      }
    
      var stringData = JSON.stringify( detail_data );
      var form_detail = new FormData()
      form_detail.append('meeting_addr', meeting_addr);
      form_detail.append('meeting_lat', meeting_lat);
      form_detail.append('meeting_lng', meeting_lng);
      form_detail.append('num_day', numDay);
      form_detail.append('trip_detail_data',stringData);
      form_detail.append('tab','detail')
      $.ajax({
          url: 'newtrip_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_detail,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
                $('#detailTab').removeClass('active');
                $('#detail').removeClass('active');
                $('#priceTab').addClass('active');
                $('#price').addClass('active');
            }else{
                alert("Error: " + msg);
            }
          }
        });
    }
  function addPeriod(d,p){
    console.log('start addPeriod',d,p,detailArr);
    var wrapperId = 'detail'+d.toString();
    var wrapper = $('#'+wrapperId);
    var sId = "detail"+d.toString()+"-"+(p+1).toString()+"-s";
    var eId = "detail"+d.toString()+"-"+(p+1).toString()+"-e";
    var tId = "detail"+d.toString()+"-"+(p+1).toString()+"-t";
    var fields = "<div class=\"row\" style=\"margin:2px\"><div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id="+sId+" name="+sId+">Start Time</div><div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id="+eId+" name="+eId+">End Time</div><div class=\"col-sm-6\"><textarea class=\"form-control\" id="+tId+" rows=\"1\"></textarea>Description</div></div>"
    $(wrapper).append(fields)
    detailArr[d].push(p+1);
    console.log('end addPeriod',d,p,detailArr)
    var buttonId = "addPeriod-"+d.toString();
    var newP = p+1
    document.getElementById( buttonId ).setAttribute( "onClick", "javascript: addPeriod("+d.toString()+","+newP.toString()+");" );
     //init DateTimePickers
     materialKit.initFormExtendedDatetimepickers();
// Sliders Init
materialKit.initSliders();
  }
  function addDay(){
    console.log('start addDay',detailArr);
    var currentDay = Object.keys(detailArr).length;
    var newDay = currentDay+1;
    console.log('current day',currentDay,'new day',newDay);
    var buttonId = "addPeriod-"+newDay.toString();
    var funcName = "addPeriod("+newDay.toString()+",1);"
    var newId = "detail"+newDay.toString();
    var sId = "detail"+newDay.toString()+"-1-s";
    var eId = "detail"+newDay.toString()+"-1-e";
    var tId = "detail"+newDay.toString()+"-1-t";
    var wrapper = $('#allDays');
    var fields = "<br><div class=\"container\" style=\"border: 1px solid black;\"><div class=\"row\" style=\"margin:5px\"><h6>Detail for Day "+newDay.toString()+"</h6></div><div class=\"container\" id="+newId+"><div class=\"row\" style=\"margin:2px\"><div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id="+sId+" name="+sId+">Start Time</div><div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id="+eId+" name="+eId+">End Time</div><div class=\"col-sm-6\"><textarea class=\"form-control\" id="+tId+" rows=\"1\"></textarea>Description</div></div></div><div align=\"right\"><br/><button type=\"button\" class=\"btn btn-primary btn-sm\" id="+buttonId+" onclick="+funcName+">More Period</button></div></div>";
    $(wrapper).append(fields);
    detailArr[newDay] = new Array();
    detailArr[newDay].push(1);
    console.log('end addDay',detailArr);
 //init DateTimePickers
 materialKit.initFormExtendedDatetimepickers();
// Sliders Init
materialKit.initSliders();
  }
  var markerArr = new Array();
  function myMap() {
    var x = document.getElementById("map");
    console.log(x);
    var mapProp= {
   
      center:new google.maps.LatLng(13.736717, 100.523186),
      zoom:5
    }
    var map=new google.maps.Map(document.getElementById("map"),mapProp);
    <?php
      if ($edit==1 && $trip_meeting_addr){
        echo "var position = new google.maps.LatLng(".$trip_meeting_lat.", ".$trip_meeting_lng.");";
        echo "placeMarker(position,map);";
        echo "var isClick=true;";
      }else{
        echo "var isClick=false;";
      }
    ?>
    map.addListener('click', function(e) {
      if(isClick){
        markerArr[0].setMap(null);
        markerArr = [];
      }
      placeMarker(e.latLng, map);
      if(!isClick){
        isClick=true;
        
      }
    });
  }
    function placeMarker(position, map) {
        marker = new google.maps.Marker({
        position: position,
        map: map
    
    });
    map.panTo(position);
    marker.setDraggable(true);
    var x = document.getElementById("meeting_lat");
var y = document.getElementById("meeting_lng");
    
        x.value = marker.getPosition().lat();
    y.value = marker.getPosition().lng();
    latlngChange();
    
google.maps.event.addListener( marker, 'click', function ( event ) {
    x.value = this.getPosition().lat();
    y.value = this.getPosition().lng();
    latlngChange();
} );  
google.maps.event.addListener( marker, 'dragend', function ( event ) {
    x.value = this.getPosition().lat();
    y.value = this.getPosition().lng();
    latlngChange();
} );  
   markerArr.push(marker);
  }
  function latlngChange()
    {
        var x = document.getElementById("meeting_lat");
        var y = document.getElementById("meeting_lng")
        var place1 = document.getElementById("meeting_addr");
        var geocoder = new google.maps.Geocoder;
    
        var latlng = {lat: parseFloat(x.value), lng: parseFloat(y.value)};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status == 'OK') {
            if (results[0]) {
              place1.value = results[0].formatted_address;
            } else {
            place1.value ="No address detail";
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
</script>
<!-- fourth tab: price -->
<script>
$(function () {
        $("#chkChildrenPrice").click(function () {
            if ($(this).is(":checked")) {
                $("#dvChkChildrenPrice").show();
            } else {
                $("#dvChkChildrenPrice").hide();
            }
        });
    });
    function backFromPrice(){
      $('#detailTab').addClass('active');
      $('#detail').addClass('active');
      $('#priceTab').removeClass('active');
      $('#price').removeClass('active');
    }
    function newtrip_price(){
      var food_price = 'included';
      if($('#food_excluded:checked').val()){
          food_price = 'excluded'
      }
      var extra_expense = $('#extra_expense').val();
      var max_pass = $('#num_travelers').val();
      var price_type = 'basic';
      if($('#advance_price:checked').val()){
        price_type = 'advance'
      }
      var total_price = Array();
      var unit_price = Array();
      if (price_type == 'basic'){
        var u = $('#price_per_basic').val();
        var t = u*max_pass;
        unit_price.push(u);
        total_price.push(t);
      }else{
        for(var i=1;i<=max_pass;i++){
          var u =  $('#price_per_adv-'+i.toString()).val();
          var t = i*u;
          unit_price.push(u);
          total_price.push(t);
        }
      }
      if ($("#chkChildrenPrice").is(":checked")){
          var price_children_allow = 1;
          var price_children = $("#price_children").val();
      }else{
          var price_children_allow = 0;
          var price_children = 0.0;
      }
      var string_unit = JSON.stringify( unit_price );
      var string_total = JSON.stringify( total_price );
      var form_price = new FormData()
      form_price.append('price_food', food_price);
      form_price.append('price_extra', extra_expense);
      form_price.append('price_max_pass', max_pass);
      form_price.append('price_type', price_type);
      form_price.append('price_unit',string_unit);
      form_price.append('price_total',string_total);
      form_price.append('price_children_allow',price_children_allow);
      form_price.append('price_children',price_children);
      form_price.append('tab','price');
      $.ajax({
          url: 'newtrip_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_price,                   
          type: 'post',
          success: function(msg){
           // alert(msg);
            if (msg.length<10){
                $('#priceTab').removeClass('active');
                $('#price').removeClass('active');
                $('#conditionTab').addClass('active');
                $('#conditions').addClass('active');
            }else{
                alert("Error: " + msg);
            }
          }
        });
    }
  function setPriceText(t)
  {
    if(t=='include'){
      var text =  "<i class=\"material-icons\">local_dining</i>&nbsp;<i class=\"material-icons\">subway</i>&nbsp;<i class=\"material-icons\">local_offer</i><p>Expenses, occur during a trip, are mainly included <br/> - Public or private transportation fares : taxi, bts, mrt, etc.(Please estimate the cost of gasoline or vehicle rental fee, in case of using a private car) <br/> - Foods; Meal(s) during the trip. (Please note that alcohol is always excluded) <br/> - Admission fee: Amusement park, gallery, shows, and etc.</p>";
      document.getElementById("price_text").innerHTML = text;
    }else{
      var text =  "<i class=\"material-icons\">local_dining</i>&nbsp;<i class=\"material-icons\">local_offer</i><br/><p>Travelers pay for their meal(s) during a trip. Only the following expenses are included. <br/> Reminder; Local Experts should calculate your trip’s price including these two expenses <br/> - Public or private transportation fares : taxi, bts, mrt, etc.(Please estimate the cost of gasoline or vehicle rental fee, in case of using a private car)  <br/> - Admission fee: Amusement park, gallery, shows, and etc.</p>";
      document.getElementById("price_text").innerHTML = text;
    }
  }
  
  function setPriceCal(t)
  {
    if(t=='basic'){
      var text="<div class=\"card\"><div class=\"card-content\"><div class=\"row\" style=\"margin:2px;\"><div class=\"col-md-6 col-sm-6\"><input class=\"form-control\" type=\"text\" id=\"price_per_basic\" placeholder=\"0.00\" oninput=\"calculateBasic();\">Price/Person</div><div class=\"col-md-6 col-sm-6\"><div id=\"total_basic\">0.00 - 0.00</div>&nbsp;THB (Total/Trip)</div></div></div></div>"
     
      $('#price_cal').html(text);
      calculateBasic();  
    }else{
      var max_pass = $('#num_travelers').val();
      var text="<div class=\"card\"><div class=\"card-content\"><div class=\"row\" style=\"margin:2px;\">";
      
      for(var i=1;i<=max_pass;i++){
        text= text+"<div class=\"col-md-3 col-sm-3\">"+i.toString()+"x<i class=\"material-icons\">person</i></div><div class=\"col-md-5 col-sm-5\"><input class=\"form-control\" type=\"text\" id=\"price_per_adv-"+i.toString()+"\" placeholder=\"0.00\" oninput=\"calculateAdvance("+i.toString()+");\">Price/Person</div><div class=\"col-md-4 col-sm-4\"><div id=\"total_adv-"+i.toString()+"\">0.00</div>&nbsp;THB</div>";
      }
      
      
      text= text+"</div></div></div>";
      $('#price_cal').html(text);
    }
  }
  function calculateBasic(){
    var max_pass = $('#num_travelers').val();
    var unit_price = $('#price_per_basic').val();
    var total_basic_text = (Number(unit_price).toFixed(2)).toString()+" - "+Number (max_pass * unit_price).toFixed(2).toString();
    $('#total_basic').html(total_basic_text);
  }
  
  function calculateAdvance(i){
    var unit_price_id = '#price_per_adv-'+i.toString();
    var unit_price = $(unit_price_id).val();
    var total_adv_text = Number (i * unit_price).toFixed(2).toString();
    $('#total_adv-'+i.toString()).html(total_adv_text);
  }
  function change_num_pass(){
    if($('#basic_price:checked').val()){
      setPriceCal('basic');
    }
    else{
      setPriceCal('advance');
    }
    $max_pass = $('#num_travelers').val();
    if($('#basic_price:checked').val()){
        calculateBasic();
    }
  }
</script>

<!-- fifth tab:condition -->
<script>
function backFromCondition(){
      $('#priceTab').addClass('active');
      $('#price').addClass('active');
      $('#conditionTab').removeClass('active');
      $('#conditions').removeClass('active');
    }
  function newtrip_condition()
  {
    if ($('#smart_casual:checked').val()){
      var smart_casual = 1;
    }else{
      var smart_casual = 0;
    }
    if ($('#physical_strength:checked').val()){
      var physical_strength = 1;
    }else{
      var physical_strength = 0;
    }
    if ($('#vegan:checked').val()){
      var vegan = 1;
    }else{
      var vegan = 0;
    }
    if ($('#children:checked').val()){
      var children = 1;
    }else{
      var children = 0;
    }
    if ($('#flexible:checked').val()){
      var flexible = 1;
    }else{
      var flexible = 0;
    }
    if ($('#seasonal:checked').val()){
      var seasonal = 1;
    }else{
      var seasonal = 0;
    }
    var dates = $('#datePick').multiDatesPicker('value');
    var from_condition = new FormData()
      from_condition.append('casual', smart_casual);
      from_condition.append('physical', physical_strength);
      from_condition.append('vegan', vegan);
      from_condition.append('children', children);
      from_condition.append('flexible',flexible);
      from_condition.append('seasonal',seasonal);
      from_condition.append('dates',dates);
      from_condition.append('tab','condition');
      $.ajax({
          url: 'newtrip_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: from_condition,                   
          type: 'post',
          success: function(msg){
            //alert(msg);
            if (msg.length<10){
                $('#conditionTab').removeClass('active');
                $('#conditions').removeClass('active');
                $('#submitTab').addClass('active');
                $('#submit').addClass('active');
            }else{
                alert("Error: " + msg);
            }
          }
        });
    
  }
</script>

<!-- sixth tab: submit -->
<script>
function newtrip_submit(){
  window.location='submit.php';
}
</script>
  <script>  
    $(document).ready(function(){
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers({format:"H:mm"});
      // Sliders Init
      materialKit.initSliders();
      $('.timepicker').datetimepicker({
          format: 'HH:mm'
      });
    });
    $(document).ready(function(){
    $('#datePick').multiDatesPicker();
    <?php
      if($edit==1){
        for($i=0;$i<sizeof($date_array);$i++){
          echo "$('#datePick').multiDatesPicker('toggleDate','".$date_array[$i]."');";
        }
      }
    ?>
});
    $(document).ready(function(){
      $('select').niceSelect();
    });
    var detailArr = {};
    $(document).ready(function() {
      
      <?php
        if($edit==1)
          $numday = sizeof(array_keys($trip_detail));
        if ($edit==0 || $numday==0 ){
            echo "detailArr[1] = new Array(); detailArr[1].push(1);";
        }else{
          
          for($d=1;$d<=$numday;$d++){
            echo "detailArr[".$d."] = new Array();";
            $periods = $trip_detail[$d];
            for($p=1;$p<=sizeof($periods);$p++){
              echo "detailArr[".$d."].push(".$p.");";
            }
        }
      }
    ?>
      
    console.log(detailArr);
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-46172202-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();
      // Facebook Pixel Code Don't Delete
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window,
        document, 'script', '//connect.facebook.net/en_US/fbevents.js');
      try {
        fbq('init', '111649226022273');
        fbq('track', "PageView");
      } catch (err) {
        console.log('Facebook Track Error:', err);
      }
    });
  </script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVlIZSpzYkePXCjcm9xRHuFyL2DbKZY0Q&callback=myMap&language=en&region=EN"></script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
</body>

</html>