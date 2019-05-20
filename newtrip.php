<?php
    session_start();
    if(!isset($_SESSION['userID'])){
      header( "location: login.php" );
    }
    require_once "functions.php";
    include 'include/user.php';
    $user = new User();
    include "db_connect.php";
    $edit = 0;
    if (isset($_GET['trip_id'])){
      $_SESSION['trip_id'] = $_GET['trip_id'];
      $edit = 1;
    }else{
      $_SESSION['trip_id'] = 0;
    }
    if($edit == 1){
      $sql = "SELECT * from trips WHERE trip_id='".$_SESSION['trip_id']."'";
      $result = $conn->query($sql);
      $data = $result->fetch_assoc();
      if ($data['users_user_id']!=$_SESSION['userID']){
        exit("Don't hack!! You must be an owner of this trip");
      }
      $trip_type_id = $data['trip_type_id'];
      $vehicle_id = $data['vehicle_id'];
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
      $sql = "SELECT * from trip_date WHERE trip_id='".$_SESSION['trip_id']."'";
      $result = $conn->query($sql);
      $date_array = array();
      while($row=$result->fetch_assoc()){
        $d = $row['trip_date'];
        $data = explode('-',$d);
        $d1 = $data[1]."/".$data[2]."/".$data[0];
        array_push($date_array,$d1);
      }
    }
    
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
  <link href="./assets/css/material-kit.min.css?v=2.0.5" rel="stylesheet" />
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

  <style>
.dz-image img{width: auto;height: 100%;   left: 50%;
   top: 50%;position:absolute;-webkit-transform: translateY(-50%) translateX(-50%);}
    .ui-datepicker {
width: 100%; /*what ever width you want*/
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
  </style>
</head>

<body class="normal-page sidebar-collapse">
  <?php include('header.php') ?>
  <div class="page-header header-filter clear-filter">
  </div>
  <div class="main main-raised">
    <div class="section section-basic">
      <div class="container">
        <div class="title">
            <h2>New trip</h2>
        </div>  
        <div class="col-lg-12 col-md-12">
              <div class="row">
                <div class="col-md-2">
                  <ul class="nav nav-pills nav-pills-icons" role="tablist">
                    <!--
                        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                    -->
                    <li class="nav-item">
                      <a class="nav-link active" href="#basic" role="tab" data-toggle="tab" id="basicTab">
                         Basic
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#overview" role="tab" data-toggle="tab" id="overviewTab">
                         Photos
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#detail" role="tab" data-toggle="tab" id="detailTab">
                         Detail
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#price" role="tab" data-toggle="tab" id="priceTab">
                         Price
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#conditions" role="tab" data-toggle="tab" id="conditionTab">
                         Conditions
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#submit" role="tab" data-toggle="tab" id="submitTab">
                         Submit
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-10">
                  <div class="tab-content">
                    <div class="tab-pane active" id="basic">
                      <div id="file-uploader">
                        <div class="row">
                          <div class="col-md-5 col-sm-8">
                            <h4>Cover Image</h4><h6>(minimum 1368x912px, maximum 2MB)</h6>
                            <?php 
                              if ($edit==0 || ($edit==1 && !$trip_cover))
                                echo "<div class=\"fileinput fileinput-new text-center\" data-provides=\"fileinput\">";
                              else
                              echo "<div class=\"fileinput fileinput-exists text-center\" data-provides=\"fileinput\">";
                            ?>
                              <div class="fileinput-new thumbnail img-raised">
                                    <img src="./assets/img/image_placeholder.jpg" alt="...">
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail img-raised">
                              <?php
                                 if ($edit==1)
                                  echo "<img src=\"./upload/".$trip_cover."\" alt=\"...\">";
                                ?>
                              </div>
                              <div>
                                <span class="btn btn-raised btn-round btn-default btn-file">
                                  <span class="fileinput-new">Select image</span>
                                  <span class="fileinput-exists">Change</span>
                                  <input type="file" name="..." id="cover" />
                                </span>
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                              </div>
                            </div>
                            <form>
                              <div class="cc-selector">
                                <input [(ngModel)]="vehicle" class="form-check-input" <?php if($edit==1 && $vehicle_id==1) echo  "checked=\"checked\""; ?> id="walk" type="radio"
                                  name="vehicle" value="walk" />
                                <label class="drinkcard-cc walk" for="walk"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" <?php if($edit==0 || ($edit==1 && $vehicle_id==2)) echo  "checked=\"checked\""; ?>  id="car" type="radio"
                                  name="vehicle" value="car" />
                                <label class="drinkcard-cc car" for="car"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" <?php if($edit==1 && $vehicle_id==3) echo  "checked=\"checked\""; ?> type="radio" name="vehicle" id="van"
                                  value="van" />
                                <label class="drinkcard-cc van" for="van"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" <?php if($edit==1 && $vehicle_id==4) echo  "checked=\"checked\""; ?> type="radio" name="vehicle" id="motorbike"
                                  value="motorbike" />
                                <label class="drinkcard-cc motorbike" for="motorbike"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" <?php if($edit==1 && $vehicle_id==5) echo  "checked=\"checked\""; ?> type="radio" name="vehicle" id="bike"
                                  value="bike" />
                                <label class="drinkcard-cc bike" for="bike"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" <?php if($edit==1 && $vehicle_id==6) echo  "checked=\"checked\""; ?> type="radio" name="vehicle" id="boat"
                                  value="boat" /> 
                                <label class="drinkcard-cc boat" for="boat"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" <?php if($edit==1 && $vehicle_id==7) echo  "checked=\"checked\""; ?> type="radio" name="vehicle" id="public"
                                  value="public" />
                                <label class="drinkcard-cc public" for="public"></label>
                              </div>
                            </form>
                          </div>
                          <div class="col-md-7 col-sm-7">
                                <div class="row">
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" <?php if($edut==0 || ($edit==1 && $trip_type_id==1)) echo  "checked=\"checked\""; ?> type="radio" name="triptype" id="travel_trip"
                                        value="Travel trip"  required />
                                      Travel trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" type="radio" name="triptype" id="business_trip" <?php if($edit==1 && $trip_type_id==2) echo  "checked=\"checked\""; ?>
                                        value="Business trip" required />
                                      Business trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" type="radio" name="triptype" id="medical_trip" <?php if($edit==1 && $trip_type_id==3) echo  "checked=\"checked\""; ?>
                                        value="Medical trip" required />
                                      Medical trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" type="radio" name="triptype" id="umrah_trip" <?php if($edit==1 && $trip_type_id==4) echo  "checked=\"checked\""; ?>
                                        value="Umrah trip" required />
                                      Umrah trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">bookmark_border</i>
                                      </span>
                                    </div>
                                    <input [(ngModel)]="tripname" type="text" class="form-control" placeholder="Trip name" id="trip_name" <?php if($edit==1) echo "value='".$trip_name."'";?> />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="material-icons">assignment</i>
                                        </span>
                                      </div>
                                      <textarea [(ngModel)]="tripsummary" maxlength="500" class="form-control" rows="5"
                                        placeholder="Trip summary" id="trip_sum" required><?php if($edit==1) echo $trip_sum;?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">place</i>
                                      </span>
                                    </div>
                                    <input [(ngModel)]="destination" type="text" class="form-control" placeholder="Trip to" id="trip_dest" <?php if($edit==1) echo "value='".$trip_dest."'";?>/>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">assistant</i>
                                      </span>
                                    </div>
                                    <input [(ngModel)]="tripactivity" type="text" class="form-control" id="trip_activity" placeholder="Activity (e.g. Shopping,Eating,Diving)" <?php if($edit==1) echo "value='".$trip_activity."'";?> />
                                  </div>
                                </div>
                                <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_basic()'>Save</a>
                                </div>
                                <div class="text-center">
                                  <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-white btn-round float-right" onclick="backFromBasic()">Back</a>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="tab-pane" id="overview">
                    <div class="col-md-12 col-sm-12">
                     <span class="input-group-text">
                           <i class="material-icons">insert_photo</i> <h4>Photos</h4>
                      </span>
                      <p>Please upload photos to represent trip overview.</p>
                      <div class='content'>
                          <form action="upload_handler.php" class="dropzone" id="dropzonewidget">
 
                        </form> 
                      </div> 
                         <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_overview()'>Save</a>
                         </div>
                        <div class="text-center">
                           <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-white btn-round float-right" onclick="backFromOverview()">Back</a>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="detail">
                      <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">map</i>  <h4>Meeting Point</h4>
                        </span>
                      </div>
                      <div class="row">
                        <p>Please choose your meeting location in the first day of your trip.</p>
                        <div class="col-md-12 col-sm-12">
                           <div id="map" style="height:400px; margin:0px;"></div>
                          <textarea type="text" class="form-control" id="meeting_addr"></textarea> Address of Meeting Point
                          <input type="text" class="form-control" id="meeting_lat" hidden />
                          <input type="text" class="form-control" id="meeting_lng" hidden />
                        </div>
                      </div>
                      <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">local_activity</i>  <h4>Trip Detail</h4>
                        </span>
                      </div>
                      <div class="col-md-12 col-sm-12">
                        <div class="container" id="allDays">
                        <?php
                          if($edit==1)
                            $numday = sizeof(array_keys($trip_detail));
                          if($edit==0 || $numday==0){
                            echo "<div class=\"container\" style=\"border: 1px solid black;\">";
                            echo    "<div class=\"row\" style=\"margin:5px\">";
                            echo        "<h6>Detail for Day 1</h6>";
                            echo    "</div>";
                            echo    "<div class=\"container\" id=\"detail1\">";
                            echo      "<div class=\"row\" style=\"margin:2px;\">";
                            echo         "<div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id=\"detail1-1-s\" name=\"detail1-1-s\">Start Time</div>";                        
                            echo         "<div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id=\"detail1-1-e\" name=\"detail1-1-e\">End Time</div>";     
                            echo          "<div class=\"col-sm-6\"><textarea  type=\"text\" class=\"form-control\" id=\"detail1-1-t\" rows=\"1\"></textarea>Description</div>";
                            echo        "</div>";
                            echo       "</div>";
                            echo      "<div align=\"right\">";
                            echo     "<br/>";
                            echo    "<button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"addPeriod-1\" onclick=\"addPeriod(1,1);\">More Period</button>";
                            echo   "</div>";
                            echo  "</div>";
                          }else{
                            
                            for($d=1;$d<=$numday;$d++){
                              if($d>1){
                                echo "<br>";
                              }
                              echo "<div class=\"container\" style=\"border: 1px solid black;\">";
                              echo    "<div class=\"row\" style=\"margin:5px\">";
                              echo        "<h6>Detail for Day ".$d."</h6>";
                              echo    "</div>";
                              echo    "<div class=\"container\" id=\"detail".$d."\">";
                              $details = $trip_detail[$d];
                              for($p=1;$p<=sizeof($details);$p++){
                                $start_time = $details[$p-1]['trip_detail_start']." ".$details[$p-1]['trip_detail_start_ap'];
                                $end_time = $details[$p-1]['trip_detail_end']." ".$details[$p-1]['trip_detail_end_ap']; 
                                echo      "<div class=\"row\" style=\"margin:2px;\">";
                                echo         "<div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id=\"detail".$d."-".$p."-s\" name=\"detail".$d."-".$p."-s\" value=".$start_time.">Start Time</div>";                        
                                echo         "<div class=\"col-sm-3\"><input class=\"form-control timepicker\" type=\"text\" id=\"detail".$d."-".$p."-e\" name=\"detail".$d."-".$p."-e\" value=".$end_time.">End Time</div>";     
                                echo          "<div class=\"col-sm-6\"><textarea  type=\"text\" class=\"form-control\" id=\"detail".$d."-".$p."-t\" rows=\"1\">".$details[$p-1]['trip_detail_description']."</textarea>Description</div>";
                                echo        "</div>";
                              }
                              echo       "</div>";
                              echo      "<div align=\"right\">";
                              echo     "<br/>";
                              $newP = sizeof($details);
                              echo    "<button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"addPeriod-".$d."\" onclick=\"addPeriod(".$d.",".$newP.");\">More Period</button>";
                              echo   "</div>";
                              echo  "</div>";
                            }
                          }
                          ?>
                        </div>
                        <div align="right">
                            <br/>
                            <button type="button" class="btn btn-primary btn-sm" id="addDay" onclick="addDay();">More Day</button>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12" >
                        <br>
                        <div align="right">
                            <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_detail()'>Save</a>
                            </div>
                            <div class="text-center">
                                  <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-white btn-round float-right" onclick="backFromDetail()">Back</a>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="price">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                              <i class="material-icons">attach_money</i>  <h4>Price</h4>
                            </span>
                            <br>
                            <p>Please, use these price conditions as guides to calculate your trip fee and always make sure to inform your travelers about any additional expenses before the trip day.</p><br/>
                        </div>
                        <div class="container">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="price" id="food_included" value="food_included" <?php
                                        if($edit==0 || $price_food!="excluded"){
                                          echo "checked";
                                        }
                                      ?>  onclick="setPriceText('include');"> All Inclusive
                                  <span class="circle">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                          <div class="col-sm-12 col-md-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="price" id="food_excluded" value="food_excluded" <?php
                                        if($edit==1 && $price_food=="excluded"){
                                          echo "checked";
                                        }
                                      ?> onclick="setPriceText('exclude');" > Food Excluded
                                  <span class="circle">
                                    <span class="check"></span>
                                  </span>
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-12">
                            <div class=container id='price_text'>
                              <?php 
                                if($edit==0 || $price_food!="excluded"){
                                  echo "<i class=\"material-icons\">local_dining</i>&nbsp;<i class=\"material-icons\">subway</i>&nbsp;<i class=\"material-icons\">local_offer</i>
                                  <p>Expenses, occur during a trip, are mainly included <br/>                     
                                        - Public or private transportation fares : taxi, bts, mrt, etc.(Please estimate the cost of gasoline or vehicle rental fee, in case of using a private car) <br/>
                                        - Foods; Meal(s) during the trip. (Please note that alcohol is always excluded) <br/>
                                        - Admission fee: Amusement park, gallery, shows, and etc.
                                  </p>";
                                }else if($price_food=="excluded"){
                                  echo "<i class=\"material-icons\">local_dining</i>&nbsp;<i class=\"material-icons\">local_offer</i><br/><p>Travelers pay for their meal(s) during a trip. Only the following expenses are included. 
                                        <br/> Reminder; Local Experts should calculate your trip’s price including these two expenses <br/> 
                                        - Public or private transportation fares : taxi, bts, mrt, etc.(Please estimate the cost of gasoline or vehicle rental fee, in case of using a private car)  <br/> 
                                        - Admission fee: Amusement park, gallery, shows, and etc.</p>";
                                }
                            ?>
                            </div>
                          </div>
                        </div>
                      </div>
  
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <hr>
                        </div>
                        <div class="container">
                          <div class="col-sm-12 cold-md-12">
                           <span class="input-group-text">
                              <i class="material-icons">attach_money</i>  <h4>Extra expense travelers should prepare</h4>
                            </span>
                            <p>Are there any extra expenses that travelers have to pay during the trip?</p>
                          </div>
                          <div class="col-md-12 col-sm-12" >
                            <br/>
                            <textarea type="text" class="form-control" id="extra_expense" placeholder="e.g. your pocket money" /><?php if($edit==1) echo $price_extra;?></textarea> 
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <hr>
                        </div>
                        <div class="col-md-12 col-sm-12" >
                         <span class="input-group-text">
                          <i class="material-icons">people</i>  <h4>Maximum travelers</h4>
                        </span>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <div class="container">
                            <select id="num_travelers" onchange="change_num_pass();">
                                <option value="1" <?php if($edit==1&&$price_max_pass==1) echo "selected=\"selected\""; ?> >1 Person </option>
                                <option value="2" <?php if($edit==1&&$price_max_pass==2) echo "selected=\"selected\""; ?>>2 Person</option>
                                <option value="3" <?php if($edit==1&&$price_max_pass==3) echo "selected=\"selected\""; ?>>3 Person</option>
                                <option value="4" <?php if($edit==1&&$price_max_pass==4) echo "selected=\"selected\""; ?>>4 Person</option>
                                <option value="5" <?php if($edit==1&&$price_max_pass==5) echo "selected=\"selected\""; ?>>5 Person</option>
                                <option value="6" <?php if($edit==1&&$price_max_pass==6) echo "selected=\"selected\""; ?>>6 Person</option>
                                <option value="7" <?php if($edit==1&&$price_max_pass==7) echo "selected=\"selected\""; ?>>7 Person</option>
                                <option value="8" <?php if($edit==1&&$price_max_pass==8) echo "selected=\"selected\""; ?>>8 Person</option>
                            </select>
                          </div>
                        </div> 
                      </div>

                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <hr>
                        </div>
                        <div class="col-md-12 col-sm-12" >
                          <span class="input-group-text">
                            <i class="material-icons">attach_money</i>  <h4>Pricing Method</h4>
                          </span>
                          <br>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <div class="container">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="price_type" id="basic_price" value="basic_price" 
                                    <?php
                                      if($edit==0 || ($price_type=="basic") || ($price_type!="basic" && $price_type!="advance")) echo "checked"; ?>  onclick="setPriceCal('basic');"> Basic Pricing
                                  <span class="circle">
                                  <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="price_type" id="advance_price" value="advance_price" <?php
                                      if($edit==1 && $price_type=="advance") echo "checked"; ?> onclick="setPriceCal('advance');" > Advance Pricing
                                    <span class="circle">
                                    <span class="check"></span>
                                    </span>
                                </label>
                              </div>
                           </div>
                          </div>
                          <div class="col-md-6 col-sm-6">
                        <div class="container" id="price_cal">
                        <?php 
                          if($edit==0  || ($price_type!="basic" && $price_type!="advance")){
                            echo "<div class=\"card\">
                            <div class=\"card-content\">
                              <div class=\"row\" style=\"margin:2px;\">
                                <div class=\"col-md-6 col-sm-6\"><input class=\"form-control\" type=\"text\" id=\"price_per_basic\" placeholder=\"0.00\" oninput=\"calculateBasic();\">Price/Person</div>
                                <div class=\"col-md-6 col-sm-6\"><div id=\"total_basic\">0.00 - 0.00</div>&nbsp;USD (Total/Trip)</div>
                              </div>
                            </div>
                          </div> ";
                          }else{
                            if($price_type == "basic"){
                              echo "<div class=\"card\">
                              <div class=\"card-content\">
                                <div class=\"row\" style=\"margin:2px;\">
                                  <div class=\"col-md-6 col-sm-6\"><input class=\"form-control\" type=\"text\" id=\"price_per_basic\" placeholder=\"0.00\" value=\"".number_format($price_unit1,2)."\" oninput=\"calculateBasic();\">Price/Person</div>
                                  <div class=\"col-md-6 col-sm-6\"><div id=\"total_basic\">".number_format($price_unit1,2)." - ".number_format($price_total1,2)."</div>&nbsp;USD (Total/Trip)</div>
                                </div>
                              </div>
                            </div> ";                              
                            }else{
                              echo "<div class=\"card\"><div class=\"card-content\"><div class=\"row\" style=\"margin:2px;\">";
                              for($i=1;$i<=$price_max_pass;$i++){
                                if($i==1){
                                  $u = $price_unit1;
                                  $t = $price_total1;
                                }else if($i==2){
                                  $u = $price_unit2;
                                  $t = $price_total2;
                                }
                                else if($i==3){
                                  $u = $price_unit3;
                                  $t = $price_total3;
                                }
                                else if($i==4){
                                  $u = $price_unit4;
                                  $t = $price_total4;
                                }
                                else if($i==5){
                                  $u = $price_unit5;
                                  $t = $price_total5;
                                }
                                else if($i==6){
                                  $u = $price_unit6;
                                  $t = $price_total6;
                                }
                                else if($i==7){
                                  $u = $price_unit7;
                                  $t = $price_total7;
                                }
                                else if($i==8){
                                  $u = $price_unit8;
                                  $t = $price_total8;
                                }
                                echo "<div class=\"col-md-3 col-sm-3\">".$i."x<i class=\"material-icons\">person</i></div><div class=\"col-md-5 col-sm-5\"><input class=\"form-control\" type=\"text\" id=\"price_per_adv-".$i."\" placeholder=\"0.00\" value=\"".number_format($u,2)."\" oninput=\"calculateAdvance(".$i.");\">Price/Person</div><div class=\"col-md-4 col-sm-4\"><div id=\"total_adv-".$i."\">".number_format($t,2)."</div>&nbsp;USD</div>";
                              }
                              echo "</div></div></div>";
                            }
                           
                          }
                        ?>
 
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="card" >
                          <div class="card-content" align="center" >
                            <div class="container">
                          <i class="material-icons">highlight</i>  1,000 - 1,500 THB <br/>
                              Price (per person) <hr>

is recommended for an all-inclusive trip. The price range (shown above) is only the guideline to get higher booking rate. However, you are free to set your own price.
                            </div>
                          </div>
                        </div>
                      </div>                     
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <hr>
                        </div>
                        <div class="container">
                          <div class="col-sm-12 cold-md-12">
                           <span class="input-group-text">
                              <i class="material-icons">child_care</i>  <h4>Additional Options</h4>
                            </span>
                          </div>
                         <div class="col-md-12 col-sm-12" >
                          <div class="form-check">
                           <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" <?php if($edit==1 && $price_children_allow==1) echo "checked"; ?> value="" id="chkChildrenPrice"> Enable Child Price (Age 2-12)
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </div>
                        <div class="cold-md-4 col-sm-4">
                              <div id="dvChkChildrenPrice" <?php if($edit==0 || $price_children_allow==0) echo "style=\"display: none\"";?>>
                              <div class="form-group">
                                  <div class="input-group">
                                    <input [(ngModel)]="destination" type="text" class="form-control" placeholder="0.00" id="price_children" <?php if($edit==1) echo "value=\"".number_format($price_children,2)."\"";?>/> THB (Per Child)
                                  </div>
                                </div>
                          </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-12 col-sm-12" >
                        <br>
                        <div align="right">
                            <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_price()'>Save</a>
                            </div>
                            <div class="text-center">
                                  <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-white btn-round float-right" onclick="backFromPrice()">Back</a>
                            </div>
                        </div>
                      </div>
                    </div>






                    </div>
                    <div class="tab-pane" id="conditions">
                    <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">grain</i>  <h4>Extra Conditions</h4>
                        </span>
                    </div> 
                    <div class="row">
                    <a href="#"  data-toggle="tooltip" data-placement="top" title="Travelers need to wear appropriate outfits neutral colors, no sleeveless shirts and shorts.The dress code's featured most of these locations;temples, museum, or any official places.">
                          <div class="col-md-4 col-sm-4" align="center">
                              <input type='checkbox' name='smart_casual' value='1' <?php if($edit==1 && $trip_condition_casual==1) echo "checked";?> id="smart_casual"/><label for="smart_casual"></label> 
                          </div>
                          </a>
                        <a href="#"  data-toggle="tooltip" data-placement="top" title="Travelers need to be fit and firm, so it will be easier for them to complete your trip. Select this condition, if your trip featured these following activities; boxing, hiking, trekking, kayaking, rafting, etc.">
                          <div class="col-md-4 col-sm-4" align="center">
                           <input type='checkbox' name='physical_strength' <?php if($edit==1 && $trip_condition_physical==1) echo "checked";?> value='1' id="physical_strength"/><label for="physical_strength"></label> 
                          </div>
                        </a>
                        </a>
                         <a href="#"  data-toggle="tooltip" data-placement="top" title="Any activities that travelers can enjoy with their family members and is good with kids, such as going to an amusement park, watching a performance, joining a pottery workshop, etc, can be considered to this condition.">
                          <div class="col-md-4 col-sm-4" align="center">
                              <input type='checkbox' name='children' value='1' <?php if($edit==1 && $trip_condition_children==1) echo "checked";?> id="children"/><label for="children"></label> 
                          </div>
                        </a>
                        <a href="#"  data-toggle="tooltip" data-placement="top" title="Although you stick to your listed itinerary, your trip may be adjusted accordingly to your travelers.">
                          <div class="col-md-4 col-sm-4" align="center">
                              <input type='checkbox' name='flexible' value='1' <?php if($edit==1 && $trip_condition_flexible==1) echo "checked";?> id="flexible"/><label for="flexible"></label> 
                          </div>
                        </a>
                        <a href="#"  data-toggle="tooltip" data-placement="top" title="For any activities places of your trip can be accessed seasonally for example, trekking to the top of Khitchakut mountain, visiting a tropical fruit farm, sightseeing at a national park, and etc, please select this condition.">
                        <div class="col-md-4 col-sm-4" align="center">
                           <input type='checkbox' name='seasonal' value='1' <?php if($edit==1 && $trip_condition_seasonal==1) echo "checked";?> id="seasonal"/><label for="seasonal"></label> 
                        </div>
                        </a>
                    </div>
                    <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">calendar_today</i>  <h4>Operating Days</h4>
                        </span>
                    </div> 
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <div id="datePick"></div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12" >
                        <br>
                        <div align="right">
                            <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_condition()'>Save</a>
                            </div>
                            <div class="text-center">
                                  <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-white btn-round float-right" onclick="backFromCondition()">Back</a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="submit">
                    <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">check_circle</i>  <h4>Submit Your Trip</h4>
                        </span>
                    </div> 
                    <div class="row">
                    To complete your trip listing
When you've completed your trip listing, click 'Submit for approval'. Your trip will be under our review process. Please allow us 3-7 business days to review your listing trip and send you a feedback. Please check your inbox regularly for our email and follow our suggestion to modify your listing. As quality trips are our priority, we only approve trips that meet our standards. Thank you for your kind understanding, and for helping our travelers explore our beautiful Thailand.
</div>
<div class="col-md-12 col-sm-12" >
                        <br>
                        <div align="right">
                            <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_submit()'>Submit</a>
                            </div>
                           
                        </div>
                      </div>
                    </div>
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
  <script src='dropzone.js' type='text/javascript'></script>
  <script src="js/jquery.nice-select.js"></script>
  <script src="js/jquery-ui.multidatespicker.js"></script>
  <script src="js/jquery-ui.js"></script>
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
              console.log(php_script_response);
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
                form_basic.append('trip_cover',cover);
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
            // window.alert('Geocoder failed due to: ' + status);
            place1.value ="No address available. You might click over the sea or river.";
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
	u = u.split(',').join('');
        var t = u*max_pass;
        unit_price.push(u);
        total_price.push(t);
      }else{
        for(var i=1;i<=max_pass;i++){
	  var u =  $('#price_per_adv-'+i.toString()).val();
	  u = u.split(',').join('');
          var t = i*u;
          unit_price.push(u);
          total_price.push(t);
        }
      }
      if ($("#chkChildrenPrice").is(":checked")){
          var price_children_allow = 1;
	  var price_children = $("#price_children").val();
	  price_children = price_children.split(',').join('');
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
      var text="<div class=\"card\"><div class=\"card-content\"><div class=\"row\" style=\"margin:2px;\"><div class=\"col-md-6 col-sm-6\"><input class=\"form-control\" type=\"text\" id=\"price_per_basic\" placeholder=\"0.00\" oninput=\"calculateBasic();\">Price/Person</div><div class=\"col-md-6 col-sm-6\"><div id=\"total_basic\">0.00 - 0.00</div>&nbsp;USD (Total/Trip)</div></div></div></div>"
     
      $('#price_cal').html(text);
      calculateBasic();  
    }else{
      var max_pass = $('#num_travelers').val();
      var text="<div class=\"card\"><div class=\"card-content\"><div class=\"row\" style=\"margin:2px;\">";
      
      for(var i=1;i<=max_pass;i++){
        text= text+"<div class=\"col-md-3 col-sm-3\">"+i.toString()+"x<i class=\"material-icons\">person</i></div><div class=\"col-md-5 col-sm-5\"><input class=\"form-control\" type=\"text\" id=\"price_per_adv-"+i.toString()+"\" placeholder=\"0.00\" oninput=\"calculateAdvance("+i.toString()+");\">Price/Person</div><div class=\"col-md-4 col-sm-4\"><div id=\"total_adv-"+i.toString()+"\">0.00</div>&nbsp;USD</div>";
      }
      
      
      text= text+"</div></div></div>";
      $('#price_cal').html(text);
    }
  }
  function calculateBasic(){
    var max_pass = $('#num_travelers').val();
    var unit_price = $('#price_per_basic').val();
    unit_price = unit_price.split(',').join('');
    var total_basic_text = (Number(unit_price).toFixed(2)).toString()+" - "+Number (max_pass * unit_price).toFixed(2).toString();
    $('#total_basic').html(total_basic_text);
  }
  
  function calculateAdvance(i){
    var unit_price_id = '#price_per_adv-'+i.toString();
    var unit_price = $(unit_price_id).val();
    unit_price = unit_price.join('');
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
