<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include "config.php";
include "db_connect.php";
require_once "functions.php";
include 'include/user.php';
  $conn = new mysqli($dbHost ,$dbUsername,$dbPassword,$dbName);
    $user = new User();
    if ($conn->connect_errno) {
      echo $conn->connect_error;
      exit;
    }
    else
    {
      $sql="SELECT * FROM users WHERE user_id = '".$_SESSION["userID"]."' LIMIT 1";
      $result = $conn->query($sql); // ทำการ query คำสั่ง sql 
      $data = $result->fetch_assoc();
      $user_status = $data['status'];
      $evidence_id = $data['evidence_id'];
      $evidence_bank = $data['evidence_bank'];
      $evidence_self = $data['evidience_self'];
      $verify_reason = $data['verify_reason'];
      $admin_right = 0;
      $newtrip_right = 0;
      if ($user_status == 0){
        $admin_right = 1;
        $newtrip_right = 1;
        $sql = "SELECT * FROM trips WHERE trip_status != 1";
        $ver_trip_result = $conn->query($sql); // ทำการ query คำสั่ง sql 
        $sql = "SELECT * FROM users WHERE STATUS='1' AND LENGTH(evidence_id)>0 AND LENGTH(evidence_bank)>0 AND LENGTH(evidence_self)>0";
        $ver_user_result = $conn->query($sql); // ทำการ query คำสั่ง sql 
      }else if($user_status == 2){
        $newtrip_right = 1;
      }
      $total=$result->num_rows; 
      $user=$result->fetch_object();
      $sql = "SELECT * FROM trips WHERE users_user_id = '".$_SESSION["userID"]."'";
      $traveTripsQuery = mysqli_query($conn,$sql);
      $sql = "SELECT * FROM trips WHERE trips.users_user_id = '".$_SESSION["userID"]."'";
      $result = $conn->query($sql); // ทำการ query คำสั่ง sql 
      $totalTrips=$result->num_rows; 
         // get settings
        $sql = "SELECT * from settings";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        $customer_commission = $data['customer_commission'];
        $guide_commission = $data['guide_commission'];
        $withdrawal_minimum = $data['withdrawal_minimum'];
        $withdrawal_process_day = $data['withdrawal_process_day'];

        //get all reservation
        $sql = "SELECT * FROM trip_reservation WHERE trip_id in (SELECT trip_id from trips WHERE users_user_id='".$_SESSION["userID"]."')";
        $result = $conn->query($sql);
        $total_in = 0.0;
        while($row=$result->fetch_assoc()){
          $total_in = $total_in + ($row["trip_res_fee"]-$row["trip_res_guide_com"]);
        }

        //get all withdraw
        $sql = "SELECT * FROM withdraw WHERE user_id = '".$_SESSION["userID"]."'";
        $result = $conn->query($sql);
        $total_out = 0.0;
        while($row=$result->fetch_assoc()){
          $total_out = $total_out + $row["withdraw_amt"];
        }

        //  get all booking
        $sql = "SELECT * FROM trips";
        $result = $conn->query($sql);
        $total_trips = 0;
        while($row=$result->fetch_assoc()){
          $total_trips = $total_trips+1;
        }

        $sql = "SELECT * FROM trip_reservation";
        $result = $conn->query($sql);
        $total_res = 0;
        while($row=$result->fetch_assoc()){
          $total_res = $total_res+1;
        }

        $sql = "SELECT * FROM withdraw where user_id='".$_SESSION['userID']."'";
        $result_withdraw = $conn->query($sql);
      $conn->close();
    }
    
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
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.min.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />

</head>

<body class="profile-page sidebar-collapse">
<?php include('header.php') ?>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('./assets/img/city-profile.jpg');"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="<?php echo $_SESSION['photoURL']; ?>" onerror="this.src='assets/img/avatar.jpg'" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>
              <div class="name">
                <h3 class="title"><?php echo $user->first_name." ".$user->last_name; ?></h3>
                <h6>Level 3</h6>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
            <div class="follow">
              <button onclick="location.href='editprofile.php'" type="button" class="btn btn-fab btn-warning btn-round" rel="tooltip" title="Edit profile">
                <i class="material-icons">edit</i>
              </button>
            </div>
          </div>
        </div>
        <div class="description text-center">
          <p><?php echo $user->about;?></p>
        </div>
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto">
            <div class="profile-tabs">
              <ul class="nav nav-pills nav-pills-info justify-content-center" role="tablist">
                <!--
                                                        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                                -->
                <li class="nav-item">
                  <a class="nav-link active" href="#dashboard" role="tab" data-toggle="tab">dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#work" role="tab" data-toggle="tab">Bookings
                  </a>
                </li>
                <?php
                  if($newtrip_right == 1){
                    echo "<li class=\"nav-item\">
                          <a class=\"nav-link\" href=\"#trips\" role=\"tab\" data-toggle=\"tab\">Trips
                          </a>
                          </li>";
                  }
                ?>
                <?php
                  if($admin_right == 1){
                    echo "<li class=\"nav-item\">
                          <a class=\"nav-link\" href=\"#verify_trips\" role=\"tab\" data-toggle=\"tab\">Verify Trips
                          </a>
                          </li>";
                  }
                ?>
                <?php
                  if($admin_right == 1){
                    echo "<li class=\"nav-item\">
                          <a class=\"nav-link\" href=\"#verify_users\" role=\"tab\" data-toggle=\"tab\">Verify Users
                          </a>
                          </li>";
                  }
                ?>
                <?php
                  if($admin_right == 1){
                    echo "<li class=\"nav-item\">
                          <a class=\"nav-link\" href=\"#verify_withdraw\" role=\"tab\" data-toggle=\"tab\">Verify Withdrawal
                          </a>
                          </li>";
                  }
                ?>
                <?php
                  if($admin_right == 0){
                    echo "<li class=\"nav-item\">
                      <a class=\"nav-link\" href=\"#documents\" role=\"tab\" data-toggle=\"tab\">Documents
                  </a>
                </li>";}
                ?>
                <?php 
                  if($admin_right==1){
                    echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"#settings\" role=\"tab\" data-toggle=\"tab\">Settings
                    </a>
                  </li>";
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content tab-space">
        <div class="tab-pane active dashboard" id="dashboard">
            <div class="row">
              <div class="col-md-7 ml-auto mr-auto ">
                <h4 class="title">Wallet</h4>
                <div class="row collections">
                  <div class="col-md-6">
                    <div class="card card-background">
                      <a href="#pablo"></a>
                      <div class="card-body">
                        <h2><label class="badge badge-warning" style="font-size:16px;">Current Balance</label></h2><br/><br/>
                        <a href="#pablo">
                          <h3 class="title"><?php echo number_format($total_in-$total_out,2);?>&nbsp;USD</h3>
                        </a>
                      </div>
                    </div>
                  </div>
                  <?php
                    // if (($total_in-$total_out)>$withdrawal_minimum){
                      if(1){
                  echo "<div class=\"col-md-6\">
                        <div class=\"form-group\">
                          <h6 class=\"title\">Get Paid</h6>
                          <div class=\"input-group\">
                            <input type=\"text\" class=\"form-control\" value=\"0.00\" id=\"withdraw_amt\" /> USD
                          </div>
                          <div class=\"col-md-6 ml-auto\">
                          <button type=\"button\" class=\"btn btn-success btn-sm\" id=\"getpaid\" onclick='getPaid();'>Withdraw</button>
                          </div>
                        </div>
                  </div>";
                    }?>
                </div>
              </div>
              <div class="col-md-2 mr-auto ml-auto stats">
                <h4 class="title">Stats</h4>
                <ul class="list-unstyled">
                  <li>
                    <b><?php echo $total_res;?></b> Bookings</li>
                  <li>
                    <b><?php echo $total_trips;?></b> Trips</li>
                  <!-- <li>
                    <b>331</b> Influencers</li>
                  <li>
                    <b>1.2K</b> Likes</li> -->
                </ul>
                <!-- <hr>
                <h4 class="title">About his Work</h4>
                <p class="description">French luxury footwear and fashion. The footwear has incorporated shiny, red-lacquered soles that have become his signature.</p>
                <hr>
                <h4 class="title">Focus</h4>myprofile.php
                <span class="badge badge-primary">Footwear</span>
                <span class="badge badge-rose">Luxury</span> -->
              </div>
            </div>
          
            <?php 
                $num_row = mysqli_num_rows($result_withdraw);
                if ($num_row > 0 )
                {
            echo "<hr>
            <div class=\"row\">
              <div class=\"col-md-9 ml-auto mr-auto\">
              <h4 class=\"title\">Transactions</h4>
              <div class=\"table-responsive\">
                <table class=\"table table-shopping\">
                  <thead>
                    <tr>
                      <th>Withdraw Amount (THB)</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr> 
                  </thead>
                  <tbody>";
                  while($row=$result_withdraw->fetch_assoc()){
                    if($row['status']==0){
                      $status_text = 'In review';
                    }else if($row['status']==1){
                      $status_text = 'Rejected';
                    }
                    else{
                      $status_text = 'Completed';
                    }
                    $dt = date('d/m/Y - H:i',strtotime($row['datetime']));
                    echo "<tr>
                            <td>".$row['amount']."</td>
                            <td>".$dt."</td>
                            <td>".$status_text."</td>
                    ";
                  }

                 echo" </tbody>
                </table>
              </div>
            </div>";
                }
                ?>

            </div>
          </div>
          <div class="tab-pane documents" id="documents">
            <div class="row">
              <div class="col-md-7 ml-auto mr-auto">
                  <?php
                 
                    if ( ($newtrip_right==0) && (strlen($verify_reason)==0) && (strlen($evidence_id)==0) ) {
                      echo "<h6 class=\"title\"> You are not allowed to create new trip! <br>Please submit documents for verification.</h6>";
                    }else  if ( ($newtrip_right==0) && (strlen($verify_reason)==0) && (strlen($evidence_id)>0)) {
                      echo "<h6 class=\"title\"> Your documents are under review. Please wait, we will confirm it soon.</h6>";
                    }
                    else if ( ($newtrip_right==0) && (strlen($verify_reason)>0) ) {
                      echo "<h6 class=\"title\"> Your latest application is rejected! <br>Please check the <u><span data-toggle=\"tooltip\" data-placement=\"top\" title=\"".$verify_reason."\">
                      [Reason]</u></span> and re-submit again</h6>";
                    }else{
                      echo "<h6 class=\"title\"> Congratulation!! You can create trips. <br>If you want to modify your documents, please contact administrator.</h6>";
                    }
                  ?>
              </div>
            </div>

            <?php 
                  if ((($newtrip_right==0) && (strlen($verify_reason)==0) && (strlen($evidence_id)==0)) ||  (($newtrip_right==0) && (strlen($verify_reason)>0))){
                
                  echo  "
              <div class=\"row\">
              <div class=\"col-md-4 ml-auto mr-auto\">
                <h4>Copy of ID/Passport</h4>
                  <div class=\"fileinput fileinput-new text-center\" data-provides=\"fileinput\">
                    <div class=\"fileinput-new thumbnail img-raised\">
                      <img src=\"./assets/img/image_placeholder.jpg\" alt=\"...\">
                    </div>
                    <div class=\"fileinput-preview fileinput-exists thumbnail img-raised\">
                    </div>
                    <div>
                      <span class=\"btn btn-raised btn-round btn-default btn-file\">
                        <span class=\"fileinput-new\">Select image</span>
                        <span class=\"fileinput-exists\">Change</span>
                        <input type=\"file\" name=\"...\" id=\"evidence_id\" />
                      </span>
                      <a href=\"#pablo\" class=\"btn btn-danger btn-round fileinput-exists\" data-dismiss=\"fileinput\"><i class=\"fa fa-times\"></i> Remove</a>
                    </div>
                  </div>
              </div>
              <div class=\"col-md-4 ml-auto mr-auto\">
                <h4>Copy of bank-account's book</h4>
                  <div class=\"fileinput fileinput-new text-center\" data-provides=\"fileinput\">
                    <div class=\"fileinput-new thumbnail img-raised\">
                      <img src=\"./assets/img/image_placeholder.jpg\" alt=\"...\">
                    </div>
                    <div class=\"fileinput-preview fileinput-exists thumbnail img-raised\">
                    </div>
                    <div>
                      <span class=\"btn btn-raised btn-round btn-default btn-file\">
                        <span class=\"fileinput-new\">Select image</span>
                        <span class=\"fileinput-exists\">Change</span>
                        <input type=\"file\" name=\"...\" id=\"evidence_bank\" />
                      </span>
                      <a href=\"#pablo\" class=\"btn btn-danger btn-round fileinput-exists\" data-dismiss=\"fileinput\"><i class=\"fa fa-times\"></i> Remove</a>
                    </div>
                  </div>
              </div>
              <div class=\"col-md-4 ml-auto mr-auto\">
                <h4>Copy of Photo ID</h4>
                  <div class=\"fileinput fileinput-new text-center\" data-provides=\"fileinput\">
                    <div class=\"fileinput-new thumbnail img-raised\">
                      <img src=\"./assets/img/image_placeholder.jpg\" alt=\"...\">
                    </div>
                    <div class=\"fileinput-preview fileinput-exists thumbnail img-raised\">
                    </div>
                    <div>
                      <span class=\"btn btn-raised btn-round btn-default btn-file\">
                        <span class=\"fileinput-new\">Select image</span>
                        <span class=\"fileinput-exists\">Change</span>
                        <input type=\"file\" name=\"...\" id=\"evidence_self\" />
                      </span>
                      <a href=\"#pablo\" class=\"btn btn-danger btn-round fileinput-exists\" data-dismiss=\"fileinput\"><i class=\"fa fa-times\"></i> Remove</a>
                    </div>
                  </div>
              </div>
              
              </div>
              <div class=\"row\">
              <div class=\"col-md-12 ml-auto mr-auto\">
              <div class=\"text-center\">
                    <a class=\"btn btn-success btn-round float-right\" onclick='upload_evidence();'>Upload</a>
              </div></div>
              
            </div>";
                  }
                  ?>

          </div>   
          <div class="tab-pane settings" id="settings">
            <br><br>
            <div class="row">
              <div class="col-md-5 ml-auto mr-auto">
                  Default customer commission (%):
                  <div class="form-group">
                     <input type="text" class="form-control" id="cust_com"  value="<?php echo $customer_commission; ?>">
                  </div>
              </div>
              <div class="col-md-5 ml-auto mr-auto">
                  Default guide commission (%):
                  <div class="form-group">
                     <input type="text" class="form-control" id="guide_com"  value="<?php echo $guide_commission; ?>">
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-5 ml-auto mr-auto">
                  Minimum amount for withdrawal : 
                    <div class="form-group">
                     <input type="text" class="form-control" id="withdrawal_minimum"  value="<?php echo $withdrawal_minimum; ?>">
                  </div>
              </div>
              <div class="col-md-5 ml-auto mr-auto">
                  Days to process withdrawal :
                  <div class="form-group">
                     <input type="text" class="form-control" id="withdrawal_process_day"  value="<?php echo $withdrawal_process_day; ?>">
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="text-center">
                                    <a class="btn btn-success btn-round float-right" onclick='save_setting()'>Save</a>
                            </div>
            </div>
            </div>
          </div>       
          <div class="tab-pane work" id="work">
          <div class="table-responsive">
            <table class="table table-shopping">
              <thead>
                <tr>
                  <th></th>
                  <th>Trip</th>
                  <th class="th-description">Likes</th>
                  <th class="th-description">Bookings</th>
                  <th class="text-right">Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="img-container">
                      <img src="../assets/img/product1.jpg" alt="...">0887976181
                    </div>
                  </td>
                  <td class="td-name">
                    <a href="#jacket">Spring Jacket</a>
                    <br />
                    <small>by Dolce&Gabbana</small>
                  </td>
                  <td>
                    Red
                  </td>
                  <td>
                    M
                  </td>
                  <td class="td-number">
                    <small>&euro;</small>549
                  </td>
                  <td class="td-actions">
                    <button type="button" rel="tooltip" data-placement="left" title="Remove item" class="btn btn-link">
                      <i class="material-icons">close</i>
                    </button>
                  </td>
                </tr>
                
                <!-- <tr>
                <td colspan="6"></td>
                <td colspan="2" class="text-right">
                  <button type="button" class="btn btn-info btn-round">Complete Purchase <i class="material-icons">keyboard_arrow_right</i></button>
                </td>
              </tr> -->
              </tbody>
            </table>
          </div>
          </div>
          <div class="tab-pane verify_trips" id="verify_trips">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto ">
                <table class="table">
                  <thead>
                      <tr>
                          <th class="text-left"><b>Trip Name</b></th>
                          <th class="text-left"><b>Actions</b></th>
                      </tr>
                      </thead>
                      <?php while($result=mysqli_fetch_array($ver_trip_result,MYSQLI_ASSOC)) { ?>
                      <tr id="tripid<?php echo $result['trip_id'];?>">
                        <td><a href="trip.php?trip_id=<?php echo $result['trip_id'];?>" target="_blank"><?php echo $result['trip_name']?></a></td>
                        <td class="td-actions text-left">
                            <button type="button" rel="tooltip" class="btn btn-success btn-round" <?php echo "onclick='verify(1,".$result['trip_id'].",tripid".$result['trip_id'].",trip_ver_reason".$result['trip_id'].")'" ?>>
                                <i class="material-icons">done</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger btn-round" <?php echo "onclick='verify(2,".$result['trip_id'].",tripid".$result['trip_id'].",trip_ver_reason".$result['trip_id'].")'" ?>>
                              <i class="material-icons">block</i>
                            </button>
                            <div class="form-group">
                     <input type="text" class="form-control" id="trip_ver_reason<?php echo $result['trip_id'];?>"  placeholder="Reason">
                  </div>
                        </td>
                      </tr>
                      <?php } ?>
                </table>
              </div>
            </div>
          </div>

          <div class="tab-pane verify_users" id="verify_users">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto ">
                <table class="table">
                  <thead>
                      <tr>
                          <th class="text-center"><b>Name</b></th>
                          <th class="text-center"><b>Copy of ID</b></th>
                          <th class="text-center"><b>Copy of Bank Account</b></th>
                          <th class="text-center"><b>Copy of PhotoID</b></th>
                      </tr>
                      </thead>
                      <?php while($result=mysqli_fetch_array($ver_user_result,MYSQLI_ASSOC)) { ?>
                      <tr id="user<?php echo $result['user_id'];?>">
                        <td class="text-center"><?php echo $result['first_name']." ".$result['last_name'];?></td>
                        <td class="text-center"><a href="./upload/<?php echo $result['evidence_id'];?>" target="_blank">View</a></td>
                        <td class="text-center"><a href="./upload/<?php echo $result['evidence_bank'];?>" target="_blank">View</a></td>
                        <td class="text-center"><a href="./upload/<?php echo $result['evidence_self'];?>" target="_blank">View</a></td>
                        <td class="td-actions text-left">
                        
                            <button type="button" rel="tooltip" class="btn btn-success btn-round" <?php echo "onclick=\"verify_user(1,'".$result['user_id']."');\"";?>>
                                <i class="material-icons">done</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger btn-round" <?php echo "onclick=\"verify_user(0,'".$result['user_id']."');\"";?>>
                              <i class="material-icons">block</i>
                            </button>
                            <div class="form-group">
                     <input type="text" class="form-control" id="user_ver_reason<?php echo $result['user_id'];?>"  placeholder="Reason">
                  </div>
                        </td>
                      </tr>
                      <?php } ?>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane trips" id="trips">
          <div class="row">
              <div class="col-md-7 ml-auto mr-auto ">
                <th class="text-left"><a href="newtrip.php" class="btn btn-warning btn-round">New</a></th>
                <div class="row">
                    <?php while($result=mysqli_fetch_array($traveTripsQuery,MYSQLI_ASSOC)) { ?>
                      <div class="col-md-12">
                      <div class="card card-profile card-plain">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="card-header card-header-image">
                              <a href="newtrip.php?trip_id=<?php echo $result['trip_id']; ?>">
                                <img class="img" src="./upload/<?php echo $result['trip_cover']; ?>" />
                              </a>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h4 class="card-title text-left"><?php echo cutString($result['trip_name'],55); ?><a href="delete_trip.php?tripid=<?php echo $result['trip_id']; ?>" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-trash"></i></a></h4>
                              <h6 class="card-title text-left"><i>
                              <?php if ($result['trip_status']==0){
                                      echo "Trip status: in review.";
                                    }else if ($result['trip_status']==1){
                                      echo "Trip status: accepted.";
                                    }else {
                                      echo "Trip status: rejected. ";
                                     
                                      echo "<u><span data-toggle=\"tooltip\" data-placement=\"top\" title=\"".$result['trip_ver_reason']."\">
                                      [Reason]
                                    </u></span>";
                                    }
                                   ?></i></h6>
                                  
                              <p class="card-description text-left">
                              <?php echo cutString($result['trip_sum'],80); ?>
                              </p>
                            </div>
                            <div class="card-footer">
                            <div class="stats ml-auto">
                            <i class="material-icons">favorite</i> 342 &#xB7;
                            <i class="material-icons">chat_bubble</i> 45
                          </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                </div>
              </div>
              <div class="col-md-2 mr-auto ml-auto stats">
                <h4 class="title">Stats</h4>
                <ul class="list-unstyled">
                  <li>
                    <b>60</b> Bookings</li>
                  <li>
                    <b><?php echo $totalTrips; ?></b> Trips</li>
                  <li>
                    <b>331</b> Influencers</li>
                  <li>
                    <b>1.2K</b> Likes</li>
                </ul>
                <hr>
                <h4 class="title">About his Work</h4>
                <p class="description">French luxury footwear and fashion. The footwear has incorporated shiny, red-lacquered soles that have become his signature.</p>
                <hr>
                <h4 class="title">Focus</h4>
                <span class="badge badge-primary">Footwear</span>
                <span class="badge badge-rose">Luxury</span>
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
  <script>
    function upload_evidence(){
      var ev_id = document.getElementById("evidence_id");
      var ev_id_data;
      if (!ev_id) {
        alert("Um, couldn't find the copy of ID/passport element.");
      }
      else if (!ev_id.files) {
        alert("This browser doesn't seem to support the `files` property of file inputs.");
      }
      else {
        ev_id_data = ev_id.files[0];
      }
      var ev_bank = document.getElementById("evidence_bank");
      var ev_bank_data;
      if (!ev_bank) {
        alert("Um, couldn't find the copy of bank'account book element.");
      }
      else if (!ev_bank.files) {
        alert("This browser doesn't seem to support the `files` property of file inputs.");
      }
      else {
        ev_bank_data = ev_bank.files[0];
      }
      var ev_self = document.getElementById("evidence_self");
      var ev_self_data;
      if (!ev_self) {
        alert("Um, couldn't find the copy of photoID element.");
      }
      else if (!ev_self.files) {
        alert("This browser doesn't seem to support the `files` property of file inputs.");
      }
      else {
        ev_self_data = ev_self.files[0];
      }
      if(ev_id_data && ev_bank_data && ev_self_data)
      { 
          var form_data = new FormData();                  
          form_data.append('file_id', ev_id_data);
          form_data.append('file_bank',ev_bank_data);
          form_data.append('file_self',ev_self_data);  
          console.log(ev_id_data);
          console.log(ev_bank_data);
          console.log(ev_self_data);                       
          $.ajax({
            url: 'upload_ev_handler.php', 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(msg){
              console.log(msg);
              if (msg.length<10){
              alert('Your documents have been upload! We will verify it soon.');
              location.reload();
            }else{
                 alert("Error: " + msg);
            }
            }
          });
      }else{
        alert('You must choose all evidences to verify yourself!!!');
      }
    }
  </script>
  <script>
      function save_setting(){
      
        var cust_com = $('#cust_com').val();
        var guide_com = $('#guide_com').val();
        var withdrawal_minimum = $('#withdrawal_minimum').val();
        var withdrawal_process_day = $('#withdrawal_process_day').val();
        //console.log(trip_id,num_adult,num_children,adult_price,children_price,trip_date,title,firstname,lastname,email,mobile,country,trip_fee);
        var form_set = new FormData()
        form_set.append('cust_com', cust_com);
        form_set.append('guide_com', guide_com);
        form_set.append('withdrawal_minimum', withdrawal_minimum);
        form_set.append('withdrawal_process_day', withdrawal_process_day);
      $.ajax({
          url: 'setting_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_set,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
              alert('Save setting completed!');
            }else{
                 alert("Error: " + msg);
            }
          }
        });
      }
    </script>
    <script>
      function verify(res,id,cls,cls1){
        var form_res = new FormData()
        form_res.append('trip_id', id);
        form_res.append('trip_status', res);
        form_res.append('trip_ver_reason', $(cls1).val());
        $.ajax({
          url: 'trip_verify_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_res,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
               $(cls).hide();
            }else{
                 alert("Error: " + msg);
            }
          }
        });
      }
    </script>
    <script>
      function getPaid(){
      <?php echo "var valid_amt=".($total_in - $total_out).";\n";?>
      <?php echo "var min_amt=".$withdrawal_minimum.";\n";?>
      <?php echo "var days=".$withdrawal_process_day.";\n";?>
      <?php echo "var user_id='".$_SESSION['userID']."';\n";?>

        var amt = $('#withdraw_amt').val();
        amt = amt.split(',').join('');
        // if (amt > valid_amt){
        //   alert('Your withdraw amount exceed your valid amount!!!');
        // }else if(amt < min_amt){
        //   alert('Your withdraw amount is lower than minimum withdrawable amount!!!');
        // }else{
          var form_withdraw = new FormData();
          form_withdraw.append('user_id',user_id);
          form_withdraw.append('withdraw_amt',amt);
          $.ajax({
          url: 'withdraw_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_withdraw,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
              alert('We will process your withdrawal within '+days+' business days.');
              location.reload();
            }else{
                 alert("Error: " + msg);
            }
          }
        });

        // }

      }
    </script>

<script>
      function verify_user(res,id){
        var objId = '#user_ver_reason'+id;
        var objId1 = '#user'+id;
        var form_res = new FormData()
        if (res==1){
          form_res.append('status', 2);
        }else{
          form_res.append('status', 1);
        }
        
        form_res.append('user_id', id);
        form_res.append('verify_reason', $(objId).val());
        
        $.ajax({
          url: 'user_verify_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_res,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
               $(objId1).hide();
            }else{
                 alert("Error: " + msg);
            }
          }
        });
      }
    </script>
  <script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();
      // Sliders Init
      materialKit.initSliders();
    });
    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
    $(document).ready(function() {
      $('#facebook').sharrre({
        share: {
          facebook: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('facebook');
        },
        template: '<i class="fab fa-facebook-f"></i> Facebook',
        url: 'https://demos.creative-tim.com/material-kit/index.html'
      });
      $('#googlePlus').sharrre({
        share: {
          googlePlus: true
        },
        enableCounter: false,
        enableHover: false,
        enableTracking: true,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('googlePlus');
        },
        template: '<i class="fab fa-google-plus"></i> Google',
        url: 'https://demos.creative-tim.com/material-kit/index.html'
      });
      $('#twitter').sharrre({
        share: {
          twitter: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        buttons: {
          twitter: {
            via: 'CreativeTim'
          }
        },
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('twitter');
        },
        template: '<i class="fab fa-twitter"></i> Twitter',
        url: 'https://demos.creative-tim.com/material-kit/index.html'
      });
    });
  </script>
  <script>
  // FileInput
  $('.form-file-simple .inputFileVisible').click(function() {
    $(this).siblings('.inputFileHidden').trigger('click');
  });
  $('.form-file-simple .inputFileHidden').change(function() {
    var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
    $(this).siblings('.inputFileVisible').val(filename);
  });
  $('.form-file-multiple .inputFileVisible, .form-file-multiple .input-group-btn').click(function() {
    $(this).parent().parent().find('.inputFileHidden').trigger('click');
    $(this).parent().parent().addClass('is-focused');
  });
  $('.form-file-multiple .inputFileHidden').change(function() {
    var names = '';
    for (var i = 0; i < $(this).get(0).files.length; ++i) {
      if (i < $(this).get(0).files.length - 1) {
        names += $(this).get(0).files.item(i).name + ',';
      } else {
        names += $(this).get(0).files.item(i).name;
      }
    }
    $(this).siblings('.input-group').find('.inputFileVisible').val(names);
  });
  $('.form-file-multiple .btn').on('focus', function() {
    $(this).parent().siblings().trigger('focus');
  });
  $('.form-file-multiple .btn').on('focusout', function() {
    $(this).parent().siblings().trigger('focusout');
  });
  </script>
</body>

</html>