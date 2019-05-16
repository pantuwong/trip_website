<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  include "config.php";
  include "db_connect.php";
  include "functions.php";
  $conn = new mysqli($dbHost ,$dbUsername,$dbPassword,$dbName);
    include 'include/user.php';
    $user = new User();


	if ($conn->connect_errno) {
		echo $conn->connect_error;
		exit;
	}
	else
	{


    if ($_POST['update']=="true") {
      $sql = "UPDATE users SET 
                  first_name = '".$_POST["first_name"]."' ,
                  last_name = '".$_POST["last_name"]."' ,
                  about = '".$_POST["about"]."' ,
                  gender = '".$_POST["gender"]."' ,
                  languages = '".$_POST["languages"]."' ,
                  phone = '".$_POST["phone"]."' ,
                  passportCountry = '".$_POST["passportCountry"]."' ,
                  currentCity = '".$_POST["currentCity"]."' ,
                  address = '".$_POST["address"]."' 
                  WHERE user_id = '".$_SESSION["userID"]."' ";

      if ($conn->query($sql) === TRUE) {
        $_SESSION['firstname']=$_POST['first_name'];
        $_SESSION['lastname']=$_POST['last_name'];      
          //echo "Record updated successfully";
      } else {
          //echo "Error updating record: " . $conn->error;
      }

    }

    //echo $_SESSION['userID'];
    $userid = $_SESSION['userID'];
    $sql = "SELECT * FROM users WHERE user_id='".$_SESSION["userID"]."' ";

    $query = mysqli_query($conn,$sql);
    /*
    while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        echo $result["first_name"];
    }*/
    $sql = "SELECT * FROM countries ORDER BY country_name ASC";
    $countriesQuery = mysqli_query($conn,$sql);
    
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
            </div>
          </div>
        </div>
        <?php
        while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
        ?>
            <form class="contact-form" action="editprofile.php" method="POST">
                <div class="col-md-8 ml-auto mr-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="firstname" class="bmd-label-floating">First name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $result["first_name"];?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="lastname" class="bmd-label-floating">Last name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $result["last_name"];?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                          <label for="gender" class="bmd-label-floating">Gender</label>
                          <div class="row ml-auto">
                            <div class="form-check col-md-3">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1" checked> Male
                                <span class="circle">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                            <div class="form-check col-md-3">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="2"> Female
                                <span class="circle">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                            <div class="form-check col-md-3">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios11" value="3"> Other
                                <span class="circle">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="language" class="bmd-label-floating">Languages</label>
                          <div class="row ml-auto">
                          <input type="text" name="languages" value="<?php echo $result["languages"];?>" class="tagsinput form-control" data-role="tagsinput" data-color="rose">
                          <!-- You can change data-color="rose" with one of our colors primary | warning | info | danger | success -->
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="email" class="bmd-label-floating">Email</label>
                            <input disabled type="text" class="form-control" name="email" value="<?php echo $result["email"];?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="phone" class="bmd-label-floating">Phone number</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $result["phone"];?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                          <select class="selectpicker" data-style="select-with-transition" name="passportCountry" title="Country of your Passport" data-size="7">
                            <?php while($countries=mysqli_fetch_array($countriesQuery,MYSQLI_ASSOC)) {?>
                              <option value="<?php echo $countries['country_name']; ?>" <?php if($countries['country_name']==$result['passportCountry']) { echo "selected"; } ?>><?php echo $countries['country_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="city" class="bmd-label-floating">Current city</label>
                            <input type="text" class="form-control" name="currentCity" value="<?php echo $result["currentCity"];?>">
                            </div>
                        </div>
                        <div class="form-group label-floating col-md-12">
                            <label class="form-control-label bmd-label-floating" for="exampleInputTextarea"> Address</label>
                            <textarea class="form-control" rows="5" id="address" name="address"><?php echo $result["address"];?></textarea>
                        </div>
                        <div class="form-group label-floating col-md-12">
                            <label class="form-control-label bmd-label-floating" for="exampleInputTextarea"> You can write about yourself here...</label>
                            <textarea class="form-control" rows="5" id="about" name="about" maxlength="200"><?php echo $result["about"];?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="update" value="true">
                </div>
                <div class="row">
                <div class="col-md-4 ml-auto mr-auto text-center">
                    <button onclick="location.href='myprofile.php'" type="button" class="btn btn-white btn-round">
                        Cancel
                    </button>
                    <button class="btn btn-success btn-round" type="submit">
                        Save
                    </button>
                </div>
                </div>
                <br>
            </form>
            <?php
            }
            ?>
            <?php
            //mysqli_close($conn);
            ?>
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
  <script src="./assets/js/material-kit.min.js?v=2.1.1" type="text/javascript"></script>
  
  <script>
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
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });
  </script>
</body>

</html>