<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
    require_once "config.php";
    include "db_connect.php";
    require_once "functions.php";
    include 'include/user.php';
    $user = new User();
    $conn = new mysqli($dbHost ,$dbUsername,$dbPassword,$dbName);
    if (!isset($_GET['trip_id'])){
      exit();
    }else{
      $_SESSION['select_trip_id'] = $_GET['trip_id'];
    }
    // get settings
    $sql = "SELECT * from settings";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $customer_commission = $data['customer_commission'];
    $guide_commission = $data['guide_commission'];
    $_SESSION['trip_id'] = $_GET['trip_id'];
    $sql = "SELECT * from trips WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $trip_type_id = $data['trip_type_id'];
    $vehicle_id = $data['vehicle_id'];
    $users_user_id = $data['users_user_id'];
    $trip_name = $data['trip_name'];
    $trip_dest = $data['trip_dest'];
    $trip_sum = $data['trip_sum'];
    $trip_activity = $data['trip_activity'];
    $trip_cover = $data['trip_cover'];
    $trip_meeting_addr = $data['trip_meeting_addr'];
    $trip_meeting_lat = $data['trip_meeting_lat'];
    $trip_meeting_lng = $data['trip_meeting_lng'];
    $trip_condition_casual = $data['trip_condition_casual'];
    $trip_condition_physical = $data['trip_condition_physical'];
    $trip_condition_vegan = $data['trip_condition_vegan'];
    $trip_condition_children = $data['trip_condition_children'];
    $trip_condition_flexible = $data['trip_condition_flexible'];
    $trip_condition_seasonal  = $data['trip_condition_seasonal'];
    $sql = "SELECT * from trip_photo WHERE trip_id='".$_SESSION['trip_id']."'";
    $traveTripsQuery = mysqli_query($conn,$sql);
    $result = $conn->query($sql);
    $photo_arr = array();
    while($row = $result->fetch_assoc()) {
      array_push($photo_arr,$row['trip_photo_name']);
    }
    $sql = "SELECT * from trip_detail WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $trip_detail = array();
    while($row=$result->fetch_assoc()){
      $trip_day = $row['trip_day'];
      $trip_detail_start = $row['trip_detail_start'];
      $trip_detail_start_ap = $row['trip_detail_start_ap'];
      $trip_detail_end = $row['trip_detail_end'];
      $trip_detail_end_ap = $row['trip_detail_end_ap'];
      $trip_detail_description = $row['trip_detail_description'];
      if( !array_key_exists($trip_day,$trip_detail) ){
          $trip_detail[$trip_day] = array();
      }
      $detail = array('trip_detail_start'=>$trip_detail_start, 'trip_detail_start_ap'=>$trip_detail_start_ap, 'trip_detail_end'=>$trip_detail_end, 'trip_detail_end_ap'=>$trip_detail_end_ap, 'trip_detail_description'=>$trip_detail_description);
      array_push($trip_detail[$trip_day], $detail);
    }
    $numday = sizeof(array_keys($trip_detail));
    $sql = "SELECT * from trip_price WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $price_food = $data['price_food'];
    $price_extra = $data['price_extra'];
    $price_max_pass = $data['price_max_pass'];
    $price_type = $data['price_type'];
    $price_unit1 = $data['price_unit1'];
    $price_total1 = $data['price_total1'];
    $price_unit2 = $data['price_unit2'];
    $price_total2 = $data['price_total2'];
    $price_unit3 = $data['price_unit3'];
    $price_total3 = $data['price_total3'];
    $price_unit4 = $data['price_unit4'];
    $price_total4 = $data['price_total4'];
    $price_unit5 = $data['price_unit5'];
    $price_total5 = $data['price_total5'];
    $price_unit6 = $data['price_unit6'];
    $price_total6 = $data['price_total6'];
    $price_unit7 = $data['price_unit7'];
    $price_total7 = $data['price_total7'];
    $price_unit8 = $data['price_unit8'];
    $price_total8 = $data['price_total8'];
    $price_children_allow = $data['price_children_allow'];
    $price_children = $data['price_children'];
    $sql = "SELECT * from trip_reservation WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $res_date_array = array();
    while($row=$result->fetch_assoc()){
      $d = $row['trip_res_date'];
      $data = explode('-',$d);
      $d1 = $data[1]."/".$data[2]."/".$data[0];
      array_push($res_date_array,$d1);
    }
    $sql = "SELECT * from trip_date WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $date_array = array();
    while($row=$result->fetch_assoc()){
      $d = $row['trip_date'];
      $data = explode('-',$d);
      $d1 = $data[1]."/".$data[2]."/".$data[0];
      if (!in_array($d1,$res_date_array))
          array_push($date_array,$d1);
    }
  
    $sql="SELECT * FROM users WHERE user_id = '".$users_user_id."' LIMIT 1";
    $result = $conn->query($sql); // ทำการ query คำสั่ง sql 
    $data = $result->fetch_assoc();
    $picture = $data['picture'];
    $firstname = $data['first_name'];
    $lastname = $data['last_name'];
    $conn->close();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Halalwayz
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.min.css?v=2.0.5" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link href="./assets/demo/vertical-nav.css" rel="stylesheet" />
  <link href="./assets/css/radiobuttons.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/jquery-ui.multidatespicker.css">
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

  <style>
  #map {
  height:400px; 
  margin:0px;
  border: 1px solid black;
  }
  input[name="smart_casual"]  {
      display:none;
    }
 
    input[name="smart_casual"] + label
    {
      background: url("con-icon/01Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0 px;
    }
    input[name="smart_casual"]:checked + label
    {
      background: url("con-icon/01.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    
    input[name="physical_strength"]  {
      display:none;
    }
 
    input[name="physical_strength"] + label
    {
      background: url("con-icon/02Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="physical_strength"]:checked + label
    {
      background: url("con-icon/02.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="vegan"]  {
      display:none;
    }
 
    input[name="vegan"] + label
    {
      background: url("con-icon/03Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="vegan"]:checked + label
    {
      background: url("con-icon/03.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="children"]  {
      display:none;
    }
 
    input[name="children"] + label
    {
      background: url("con-icon/04Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="children"]:checked + label
    {
      background: url("con-icon/04.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="flexible"]  {
      display:none;
    }
 
    input[name="flexible"] + label
    {
      background: url("con-icon/05Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="flexible"]:checked + label
    {
      background: url("con-icon/05.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="seasonal"]  {
      display:none;
    }
 
    input[name="seasonal"] + label
    {
      background: url("con-icon/06Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="seasonal"]:checked + label
    {
      background: url("con-icon/06.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
}
  </style>

<style>
    *,
    *:after,
    *:before {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
    }
    .clearfix:before,
    .clearfix:after {
      content: " ";
      display: table;
    }
    .clearfix:after {
      clear: both;
    }
    .grid {
      max-width: 69em;
      list-style: none;
      margin: 30px auto;
      padding: 1;
    }
    .grid .item {
      display: block;
      float: left;
      padding: 2px;
      width: 33%;
      opacity: 1;
    }
    .grid .item a,
    .grid .item img {
      outline: none;
      border: none;
      display: block;
      max-width: 100%;
    }
    .grid.effect-2 .item.animate {
      -webkit-transform: translateY(200px);
      transform: translateY(200px);
      -webkit-animation: moveUp 0.65s ease forwards;
      animation: moveUp 0.65s ease forwards;
    }
    @-webkit-keyframes moveUp {
      0% {}
      100% {
        -webkit-transform: translateY(0);
        opacity: 1;
      }
    }
    @keyframes moveUp {
      0% {}
      100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        opacity: 1;
      }
    }
    @media screen and (max-width: 900px) {
      .grid .item {
        width: 50%;
      }
      .entry {
        box-shadow: none;
      }
      .entry>.grid>.item {
        width: 50%;
      }
    }
    @media screen and (max-width: 400px) {
      .grid .item {
        width: 100%;
      }
      .entry {
        padding: 20px 0;
      }
      .entry>p {
        padding: 10px;
      }
      .entry>.grid>.item {
        width: 100%;
      }
    }
  </style>

  <style>
    .demo-gallery>ul {
      margin-bottom: 0;
    }
    .demo-gallery>ul>li {
      float: left;
      margin-bottom: 15px;
      margin-right: 20px;
      width: 200px;
    }
    .demo-gallery>ul>li a {
      border: 3px solid #FFF;
      border-radius: 3px;
      display: block;
      overflow: hidden;
      position: relative;
      float: left;
    }
    .demo-gallery>ul>li a>img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      height: 100%;
      width: 100%;
    }
    .demo-gallery>ul>li a:hover>img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }
    .demo-gallery>ul>li a:hover .demo-gallery-poster>img {
      opacity: 1;
    }
    .demo-gallery>ul>li a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }
    .demo-gallery>ul>li a .demo-gallery-poster>img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }
    .demo-gallery>ul>li a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }
    .demo-gallery .justified-gallery>a>img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      height: 100%;
      width: 100%;
    }
    .demo-gallery .justified-gallery>a:hover>img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }
    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster>img {
      opacity: 1;
    }
    .demo-gallery .justified-gallery>a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }
    .demo-gallery .justified-gallery>a .demo-gallery-poster>img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }
    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }
    .demo-gallery .video .demo-gallery-poster img {
      height: 48px;
      margin-left: -24px;
      margin-top: -24px;
      opacity: 0.8;
      width: 48px;
    }
    .demo-gallery.dark>ul>li a {
      border: 3px solid #04070a;
    }
    .home .demo-gallery {
      padding-bottom: 80px;
    }
  </style>

  <script>
    window.console = window.console || function (t) { };
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

  <script>
    if (document.location.search.match(/type=embed/gi)) {
      window.parent.postMessage("resize", "*");
    }
  </script>
</head>

<body class="profile-page sidebar-collapse">
<nav class="navbar bg-info navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll=" " id="sectionsNav">
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
  <div class="page-header header-filter header-small" data-parallax="true"
    <?php
      if(strlen($trip_cover)>0)
        echo "style=\"background-image: url('upload/".$trip_cover."');\"";
      else
        echo "style=\"background-image: url('assets/img/bg9.jpg');\"";
    ?> >
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-center">
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
  <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="<?php echo $picture; ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>
              <div class="name">
                <h5 class="title"><?php echo $firstname." ".$lastname ?></h5>
              </div>
            </div>
          </div>
        </div>
              <div class="card card-plain">
                <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                            <span>
                               <h3><b><?php echo $trip_name; ?></b></h3>
                            </span>
                      </div>
                    </div>
                    <div class="row">
                      <?php
                        if($vehicle_id==1)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"walk\" type=\"radio\" name=\"vehicle\" value=\"walk\" /><label class=\"drinkcard-cc walk\" for=\"walk\"></label></div></div>"; 
                        else if($vehicle_id==2)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"walk\" type=\"radio\" name=\"vehicle\" value=\"car\" /><label class=\"drinkcard-cc car\" for=\"car\"></label></div></div>"; 
                        else if($vehicle_id==3)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"van\" type=\"radio\" name=\"vehicle\" value=\"van\" /><label class=\"drinkcard-cc van\" for=\"van\"></label></div></div>"; 
                        else if($vehicle_id==4)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"motorbike\" type=\"radio\" name=\"vehicle\" value=\"motorbike\" /><label class=\"drinkcard-cc motorbike\" for=\"motorbike\"></label></div></div>"; 
                        else if($vehicle_id==5)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"bike\" type=\"radio\" name=\"vehicle\" value=\"bike\" /><label class=\"drinkcard-cc bike\" for=\"bike\"></label></div></div>"; 
                        else if($vehicle_id==6)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"boat\" type=\"radio\" name=\"vehicle\" value=\"boat\" /><label class=\"drinkcard-cc boat\" for=\"boat\"></label></div></div>"; 
                        else if($vehicle_id==7)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"public\" type=\"radio\" name=\"vehicle\" value=\"public\" /><label class=\"drinkcard-cc public\" for=\"public\"></label></div></div>"; 
                      ?>
                      <?php
                        if($numday > 0 ){
                          echo "<div class=\"col-sm-4 col-md-4\" align=\"center\"><div class=\"row\"><span class=\"input-group-text\"><i class=\"material-icons\">watch_later</i> </span></div><div class=\"row\"><p>".$numday." Day(s)</p></div></div>";
                        }
                        if($price_max_pass > 0 ){
                          echo "<div class=\"col-sm-4 col-md-4\" align=\"center\"><div class=\"row\"><span class=\"input-group-text\"><i class=\"material-icons\">people</i> </span></div><div class=\"row\"><p>1 - ".$price_max_pass." Traveller(s)</p></div></div>";
                        }
                        if( ($vehicle_id>=1&&$vehicle_id<=7) || $numday > 0 || $price_max_pass > 0) 
                          echo "<div class=\"col-md-12 col-sm=12\"><hr></div>";
                      ?>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                               <h4><b>Trip Summarize</b></h4>
                            </span>
                            <p><?php echo $trip_sum; ?></p><br/>
                            <?php $trip_activites = explode(",", $trip_activity);
                            $trip_activites_length = count($trip_activites);
                            for ($i = 0; $i < $trip_activites_length; $i++) {
                              echo '<span class="badge badge-rose">'.$trip_activites[$i].'</span> ';
                            }
                            ?>
                            <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                               <h4><b>Meeting Point (On the first date)</b></h4>
                            </span>
                            <div class="container">
                              <div class="row">
                              <span class="input-group-text">
                                <?php 
                                  if (strlen($trip_meeting_addr)>0){
                                    echo "<p>".$trip_meeting_addr."</p>";
                                  }
                                ?>
                              </span>
                                <div id="map"></div> 
                              </div>
                              <div class="row">
                              <span class="input-group-text">
                               <h4><b>Itinerary</b></h4>
                              </span>
                              <?php
                                if($numday==0){
                                  echo "<p> No detail. </p>";
                                }else{
                                  for($d=1;$d<=$numday;$d++){
                                    if($d>1){
                                      //echo "<br>";
                                    }
                                    echo "<div class=\"col-md-12 col-sm-12\" style=\"margin:5px\">";
                                    echo "<h6><u>Day ".$d."</u></h6>";
                                    echo "<div class=\"table-responsive\">";
                                    echo "<table class=\"table\">";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th class=\"text-center\"></th>";
                                    echo "<th class=\"text-center\"></th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    $details = $trip_detail[$d];
                                    for($p=1;$p<=sizeof($details);$p++){
                                      $start_time = $details[$p-1]['trip_detail_start']." ".$details[$p-1]['trip_detail_start_ap'];
                                      $end_time = $details[$p-1]['trip_detail_end']." ".$details[$p-1]['trip_detail_end_ap']; 
                                      echo "<tr>";
                                      echo "<td style=\"vertical-align:top\" class=\"text-center\">".substr($start_time,0,5)."</td>";
                                      echo "<td class=\"text-left\">".$details[$p-1]['trip_detail_description']."</td>";
                                      echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    echo "</div>";
                                    echo "</div>";
 
                                  }
                                }
                                echo "<div class=\"col-sm-12 col-md-12\"><hr></div>";
                              ?>
                              </div>
                            </div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12">
                          <span class="input-group-text">
                            <h4><b>Extra Conditions</b></h4>
                          </span>
                      </div> 
                      <div class="col-md-12 col-sm-12">
                        <?php
                          if(!($trip_condition_casual==1 || $trip_condition_physical==1 || $trip_condition_vegan==1 || $trip_condition_children==1 || $trip_condition_flexible==1 || $trip_condition_seasonal==1))
                          {
                            echo "<p>No additional conditions</p>";
                          }
                          else{
                            //echo "<div class=\"row\">";
                            if($trip_condition_casual==1){ ?>
                              <div class="row float-left col-md-2">
                                <div class="col-md-12 ml-auto mr-auto text-center">
                                  <img src="con-icon/01Gray.fw.png" width="48px" height="48px">
                                  <h6>Smart casual </h6>
                                </div>
                              </div>
                        <?php
                            }
                            if($trip_condition_physical==1){?>
                              <div class="row float-left col-md-2">
                                <div class="col-md-12 ml-auto mr-auto text-center">
                                  <img src="con-icon/02Gray.fw.png" width="48px" height="48px">
                                  <h6>Physical Strengh </h6>
                                </div>
                              </div>
                        <?php
                            }
                            if($trip_condition_children==1){?>
                              <div class="row float-left col-md-2">
                                <div class="col-md-12 ml-auto mr-auto text-center">
                                  <img src="con-icon/04Gray.fw.png" width="48px" height="48px">
                                  <h6>Children friendly</h6>
                                </div>
                              </div>
                        <?php
                            }
                            if($trip_condition_flexible==1){?>
                              <div class="row float-left col-md-2">
                                <div class="col-md-12 ml-auto mr-auto text-center">
                                  <img src="con-icon/05Gray.fw.png" width="48px" height="48px">
                                  <h6>Flixible plan</h6>
                                </div>
                              </div>
                        <?php
                            }
                            if($trip_condition_seasonal==1)?>
                            <div class="row float-left col-md-2">
                              <div class="col-md-12 ml-auto mr-auto text-center">
                                <img src="con-icon/06Gray.fw.png" width="48px" height="48px">
                                <h6>Seasonal</h6>
                              </div>
                            </div>
                          <?php 
                            //echo "</div>";
                          }
                        ?>
                    </div>

                      </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-lg-4 col-md-4 col-sd-4">
                    <div class="card card-pricing">
                      <div class="card-body" align="center">
                        <div class="form-group">
                          <h6>Trip Date</h6>
                          <input type="text" class="form-control" id="datePick" placeholder="Select date"/><br>
                          <h6 class="float-left" id="adult_price_text">0 Adults ( 0.00 THB )</h6>
                            <div class="btn-group-sm float-right">
                                <button class="btn btn-round btn-white btn-fab btn-round" data-dir="dwn" (click)="adultNumberSpinner('down')" onclick="adultNumberSpinner('down');"> <i class="material-icons">remove</i> </button>
                                <button class="btn btn-round btn-white btn-fab btn-round" data-dir="up" (click)="adultNumberSpinner('up')" onclick="adultNumberSpinner('up');"> <i class="material-icons">add</i> </button>
                            </div>
                          <br>
                          <?php
                          if($price_children_allow!=0)
                          {
                            echo "<br>
                                  <h6 class=\"float-left\" id=\"children_price_text\">0 Children ( 0.00 THB )</h6>
                                  <div class=\"btn-group-sm float-right\">
                                  <button class=\"btn btn-round btn-white btn-fab btn-round\" data-dir=\"dwn\" (click)=\"childrenNumberSpinner('down')\" onclick=\"childrenNumberSpinner('down');\"> <i class=\"material-icons\">remove</i> </button>
                                  <button class=\"btn btn-round btn-white btn-fab btn-round\" data-dir=\"up\" (click)=\"childrenNumberSpinner('up')\" onclick=\"childrenNumberSpinner('up');\"> <i class=\"material-icons\">add</i> </button>
                                 </div>";
                          }?>
                        </div>
                        <br>
                        <hr>
                        <h6 class="float-left">Booking fee+tax</h6><h6 class="float-right" id="total_customer_commission"></h6>
                        <br>
                        <hr>

                        <h6 class="float-left">Total</h6><h3 class="card-title float-right text-success" id="total_price_text">0.00 <small>THB</small></h3>

                        <div class="col-lg-12 col-md-12 ">
                          <button type="button" class="btn btn-warning btn-block" (click)="onReserved()" onclick="bookProceed();">Request to book</button>
                          <p>You won't be charge yet</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12"> 
                  <hr>

                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <span class="input-group-text">
                      <h4><b>Gallery</b></h4>
                    </span>
                  <div class="grid effect-2 demo-gallery" id="grid">
                  <?php while($result=mysqli_fetch_array($traveTripsQuery,MYSQLI_ASSOC)) { ?>
                    <div class="item" data-responsive="<?php echo "upload/".$result['trip_photo_name']; ?> 375, <?php echo "upload/".$result['trip_photo_name']; ?> 480, <?php echo "upload/".$result['trip_photo_name']; ?> 800"
                      data-src="<?php echo "upload/".$result['trip_photo_name']; ?>"><a href="#"><img src="<?php echo "upload/".$result['trip_photo_name']; ?>" alt="" /></a></div>
                      <?php } ?>
                  </div>
                </div> 
                </div>
                <div class="col-md-12 col-sm-12"> 
                  <hr>
                </div>
                </div>
              </div>
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
  <script src="./assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
<script>
    lightGallery(document.getElementById('lightgallery'));
</script>
<script src="js/jquery-ui.multidatespicker.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
    function adultNumberSpinner(mode){
     
      if(mode=='up'){
        if (num_adult+num_children+1 > max_pass){
          //alert("Exceed maximum passenger!!!!");
        }else{
          num_adult = num_adult+1;
          calculate_price();
        }
      }else if(mode=="down"){
        if(num_adult>=2){
          num_adult = num_adult-1;
          calculate_price();
        }
      }
    }
    function childrenNumberSpinner(mode){
      if(mode=='up'){
        if (num_adult+num_children+1 > max_pass){
          //alert("Exceed maximum passenger!!!!");
        }else{
          num_children = num_children+1;
          calculate_price();
        }
      }else if(mode=="down"){
        if(num_children>=1){
          num_children = num_children-1;
          calculate_price();
        }
      }
    }
    function calculate_price(){
      
      if(price_type=="basic"){
        adult_price = num_adult*unit1;
      }else{
        if(num_adult == 1){
          adult_price = total1;
        }else if(num_adult == 2){
          adult_price = total2;
        }else if(num_adult == 3){
          adult_price = total3;
        }else if(num_adult == 4){
          adult_price = total4;
        }else if(num_adult == 5){
          adult_price = total5;
        }else if(num_adult == 6){
          adult_price = total6;
        }else if(num_adult == 7){
          adult_price = total7;
        }else if(num_adult == 8){
          adult_price = total8;
        }
      }
        
        var adult_text = num_adult+" Adults ("+adult_price.toFixed(2)+" THB)";
        $('#adult_price_text').html(adult_text);
        children_price = num_children * price_children;
        var children_text = num_children+" Children ("+children_price.toFixed(2)+" THB)";
        $('#children_price_text').html(children_text);
        var total_price = adult_price + children_price;
        var total_customer_commission = (total_price*(customer_commission /100));
        $('#total_customer_commission').html(total_customer_commission.toFixed(2)+" THB");
        total_price += total_customer_commission;
        $('#total_price_text').html(total_price.toFixed(2)+" THB");
    }
  </script>
  <script>
    function bookProceed(){
      <?php echo "var trip_id=".$_GET['trip_id'].";";?>
      var dates = $('#datePick').datepicker().val();
      if (dates.length == 0){
        alert('Please select a date!');
        $('#datePick').focus();
      }else{
        var cust_com = (adult_price + children_price) * (customer_commission/100);
        var guide_com = (adult_price + children_price) * (guide_commission/100);
        var urlText = "trip_detail.php?trip_id="+trip_id+"&num_adult="+num_adult+"&num_children="+num_children+"&adult_price="+adult_price+"&children_price="+children_price+"&date="+dates+"&cust_com="+cust_com.toFixed(2)+"&guide_com="+guide_com.toFixed(2);
        window.location = urlText;
      }
    }
  </script>
  <script>
    var num_adult;
    var num_children;
    var price_children;
    var max_pass;
    var price_type;
    var unit1;
    var total1;
    var unit2;
    var total2;
    var unit3;
    var total3;
    var unit4;
    var total4;
    var unit5;
    var total5;
    var unit6;
    var total6;
    var unit7;
    var total7;
    var unit8;
    var total8;
    var adult_price = 0.0;
    var children_price=0.0;
    var customer_commission=0.0;
    var guide_commission=0.0;
    $(document).ready(function() {
      <?php 
        echo "availableDates = [";
        $first = true;
        foreach($date_array as $d){
          if(!$first){
            echo ",";
          }else{
            $first=false;
          }
          echo "'".$d."'";
        }
        echo "];";
      ?>
    function unavailable(date) {
        dmy =  ('0' + (date.getMonth() + 1)).slice(-2) + "/" + ('0' + date.getDate()).slice(-2) + "/" + date.getFullYear();
        if ($.inArray(dmy, availableDates) == -1) {
            return [false, "" , "Unavailable"];
        } else {
            return [true, ""];
        }
    }
      $('#datePick').datepicker({beforeShowDay: unavailable, dateFormat: "mm/dd/yy" });
      num_adult = 0;
      num_children = 0;
    <?php 
      if($price_children_allow==1)
        echo "price_children=".$price_children.";"; 
      else
        echo "price_children=0.0;";
    ?>
    <?php echo "max_pass=".$price_max_pass.";"; ?>
    <?php echo "price_type='".$price_type."';"; ?>
    <?php echo "unit1=".$price_unit1.";"; ?>
    <?php echo "total1=".$price_total1.";"; ?>
    <?php echo "unit2=".$price_unit2.";"; ?>
    <?php echo "total2=".$price_total2.";"; ?>
    <?php echo "unit3=".$price_unit3.";"; ?>
    <?php echo "total3=".$price_total3.";"; ?>
    <?php echo "unit4=".$price_unit4.";"; ?>
    <?php echo "total4=".$price_total4.";"; ?>
    <?php echo "unit5=".$price_unit5.";"; ?>
    <?php echo "total5=".$price_total5.";"; ?>
    <?php echo "unit6=".$price_unit6.";"; ?>
    <?php echo "total6=".$price_total6.";"; ?>
    <?php echo "unit7=".$price_unit7.";"; ?>
    <?php echo "total7=".$price_total7.";"; ?>
    <?php echo "unit8=".$price_unit8.";"; ?>
    <?php echo "total8=".$price_total8.";"; ?>
    <?php echo "customer_commission=".$customer_commission.";"; ?>
    <?php echo "guide_commission=".$guide_commission.";";?>
    adultNumberSpinner('up');
    // adultNumberSpinner('up');
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
  <script>
  
  function myMap() {
    var x = document.getElementById("map");
    console.log(x);
    var mapProp= {
      <?php
        if(strlen($trip_meeting_lat) > 0 && strlen($trip_meeting_lng>0))
          echo "center:new google.maps.LatLng(".$trip_meeting_lat.", ".$trip_meeting_lng."),";
        else
          echo "center:new google.maps.LatLng(13.736717, 100.523186),";
      ?>
    
      zoom:15
    }
    var map=new google.maps.Map(document.getElementById("map"),mapProp);
    <?php
    if(strlen($trip_meeting_lat) > 0 && strlen($trip_meeting_lng>0))
    {
      echo "var position = new google.maps.LatLng(".$trip_meeting_lat.", ".$trip_meeting_lng.");";
      echo "placeMarker(position,map);";
    }
    ?>
    }
    function placeMarker(position, map) {
        marker = new google.maps.Marker({
        position: position,
        map: map
    
    });
    map.panTo(position);
    
  }
  $('#datePick').keypress(function(e) {
e.preventDefault();
});
  
  </script>
      <!--  Google Maps Plugin    -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVlIZSpzYkePXCjcm9xRHuFyL2DbKZY0Q&callback=myMap&language=en&region=EN"></script>
 
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>


  <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/masonry/3.2.2/masonry.pkgd.min.js'></script>



  <script id="rendered-js">
    $('#grid2 img').each(function () {
      var $this = $(this);
      $this.wrap('<div class="item"><a></a></div>');
      $('a').removeAttr('href');
    });
    $('#grid2').addClass('effect-2');
    $(window).on('load', function () {
      var $container = $('.grid');
      // initialize
      $container.masonry({
        //columnWidth: 200,
        itemSelector: '.item'
      });
      $('.item > a').removeAttr('href');
    });
      //# sourceURL=pen.js
  </script>

  <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
  <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
  <script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
  <script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
  <script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
  <script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
  <script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
  <script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
  <script>
    lightGallery(document.getElementById('grid'));
  </script>
</body>

</html>