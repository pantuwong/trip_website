<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include "config.php";
include "db_connect.php";
include "functions.php";
//$conn = new mysqli($dbHost ,$dbUsername,$dbPassword,$dbName);

if(isset($_SESSION['select_trip_id'])){
  unset($_SESSION['select_trip_id']);
}

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

  // get trip destination
  $sql = "SELECT
  trips.trip_dest
  FROM
  trips
  GROUP BY
  trips.trip_dest
  ORDER BY
  trips.trip_dest ASC
  ";
  $tripDestQuery = mysqli_query($conn,$sql);


  // get Travel trip
  $sql = "SELECT
  trips.trip_id,
  trips.trip_name,
  trips.trip_sum,
  trips.trip_dest,
  trip_price.price_unit1,
  trips.trip_cover,
	trips.trip_status
  FROM
  trip_price
  RIGHT JOIN trips ON trips.trip_id = trip_price.trip_id
  WHERE trips.trip_status = '1' AND trips.trip_type_id =1 ORDER BY trips.trip_id DESC LIMIT 7";
  $traveTripsQuery = mysqli_query($conn,$sql);

  $sql = "SELECT
  trips.trip_id,
  trips.trip_name,
  trips.trip_sum,
  trips.trip_dest,
  trip_price.price_unit1,
  trips.trip_cover,
	trips.trip_status
  FROM
  trip_price
  RIGHT JOIN trips ON trips.trip_id = trip_price.trip_id
  WHERE trips.trip_status = '1' AND trips.trip_type_id =2 ORDER BY trips.trip_id DESC LIMIT 7";
  $businessTripsQuery = mysqli_query($conn,$sql);

  $sql = "SELECT
  trips.trip_id,
  trips.trip_name,
  trips.trip_sum,
  trips.trip_dest,
  trip_price.price_unit1,
  trips.trip_cover,
	trips.trip_status
  FROM
  trip_price
  RIGHT JOIN trips ON trips.trip_id = trip_price.trip_id
  WHERE trips.trip_status = '1' AND trips.trip_type_id =3 ORDER BY trips.trip_id DESC LIMIT 7";
  $medicalTripsQuery = mysqli_query($conn,$sql);

  $sql = "SELECT
  trips.trip_id,
  trips.trip_name,
  trips.trip_sum,
  trips.trip_dest,
  trip_price.price_unit1,
  trips.trip_cover,
	trips.trip_status
  FROM
  trip_price
  RIGHT JOIN trips ON trips.trip_id = trip_price.trip_id
  WHERE trips.trip_status = '1' AND trips.trip_type_id =4 ORDER BY trips.trip_id DESC LIMIT 7";
  $umrahTripsQuery = mysqli_query($conn,$sql);
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
    <?php echo $settings->sitename; ?>
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
</head>

<body class="blog-posts">
  <?php include('header.php') ?>
  <div class="page-header header-filter header-medium" data-parallax="true" style="background-image: url('./assets/img/bg16.jpg');">
    <div class="container">
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-center">
          <h1 class="brand">Halalwayz </h1>
          <h4>
          Book the best Muslim local experts enabling you to explore the region local culture and bring you to the most popular local destination trip with halal wayz.
          </h4>
        </div>

      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="blogs-4" id="blogs-4">
          <div class="container">
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
            <!-- start section -->
            <div class="container">
            <div class="title">
              <h3>Travel trips</h3>
            </div>
            <div class="row">
              <?php while($result=mysqli_fetch_array($traveTripsQuery,MYSQLI_ASSOC)) { ?>
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
                        <h6 class="card-category text-danger text-left">
                          <?php echo $result['trip_dest']; ?>
                        </h6>
                        <h6 class="card-title text-left">
                          <a target="_blank" href="trip.php?trip_id=<?php echo $result['trip_id']; ?>&name=<?php echo slugify($result['trip_name']); ?>"><?php echo cutString($result['trip_name'],55); ?></a>
                        </h6>
                        <p class="card-description text-left">
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
              <?php } ?> 
              <div class="col-lg-3 col-md-12">
                <div class="row">
                  <div class="col-lg-12 col-md-6">
                    <div class="card card-blog card-plain">
                      <div class="card-header card-header-image">
                        <a href="searchresult.php?type=1">
                          <img class="img" src="./assets/img/more1.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-raised card-background" style="background-image: url('./assets/img/IMG_5444.jpg')">
                <div class="card-body">
                  <h6 class="card-category text-info"></h6>
                  <h3 class="card-title">Have your dream trip?</h3>
                  <p class="card-description">
                  .
                  </p>
                  <a href="#pablo" class="btn btn-warning btn-round">
                    Join halal expert
                  </a>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
            <h3>Bussiness trips</h3>
            </div>
            <div class="row">
              <?php while($result=mysqli_fetch_array($businessTripsQuery,MYSQLI_ASSOC)) { ?>
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
                        <h6 class="card-category text-danger text-left">
                          <?php echo $result['trip_dest']; ?>
                        </h6>
                        <h6 class="card-title text-left">
                          <a target="_blank" href="trip.php?trip_id=<?php echo $result['trip_id']; ?>&name=<?php echo slugify($result['trip_name']); ?>"><?php echo cutString($result['trip_name'],55); ?></a>
                        </h6>
                        <p class="card-description text-left">
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
              <?php } ?> 
              <div class="col-lg-3 col-md-12">
                <div class="row">
                  <div class="col-lg-12 col-md-6">
                    <div class="card card-blog card-plain">
                      <div class="card-header card-header-image">
                        <a href="searchresult.php?type=2">
                          <img class="img" src="./assets/img/more3.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
            <h3>Medical trips</h3>
            </div>
            <div class="row">
              <?php while($result=mysqli_fetch_array($medicalTripsQuery,MYSQLI_ASSOC)) { ?>
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
                        <h6 class="card-category text-danger text-left">
                          <?php echo $result['trip_dest']; ?>
                        </h6>
                        <h6 class="card-title text-left">
                          <a target="_blank" href="trip.php?trip_id=<?php echo $result['trip_id']; ?>&name=<?php echo slugify($result['trip_name']); ?>"><?php echo cutString($result['trip_name'],55); ?></a>
                        </h6>
                        <p class="card-description text-left">
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
              <?php } ?> 
              <div class="col-lg-3 col-md-12">
                <div class="row">
                  <div class="col-lg-12 col-md-6">
                    <div class="card card-blog card-plain">
                      <div class="card-header card-header-image">
                        <a href="searchresult.php?type=3">
                          <img class="img" src="./assets/img/more2.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
            <h3>Umrah trips</h3>
            </div>
            <div class="row">
              <?php while($result=mysqli_fetch_array($umrahTripsQuery,MYSQLI_ASSOC)) { ?>
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
                        <h6 class="card-category text-danger text-left">
                          <?php echo $result['trip_dest']; ?>
                        </h6>
                        <h6 class="card-title text-left">
                          <a target="_blank" href="trip.php?trip_id=<?php echo $result['trip_id']; ?>&name=<?php echo slugify($result['trip_name']); ?>"><?php echo cutString($result['trip_name'],55); ?></a>
                        </h6>
                        <p class="card-description text-left">
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
              <?php } ?> 
              <div class="col-lg-3 col-md-12">
                <div class="row">
                  <div class="col-lg-12 col-md-6">
                    <div class="card card-blog card-plain">
                      <div class="card-header card-header-image">
                        <a href="searchresult.php?type=4">
                          <img class="img" src="./assets/img/more4.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--     *********    END BLOG CARDS      *********      -->
        <?php echo $_SESSION['first_name']; ?>
        <?php //$my_array = geLogedintUser('alphonse99@gmail.com'); 
        echo $_SESSION['user']['first_name'];
        ?> 
      </div>
    </div>
  </div>
  <!--  End Modal -->

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

  </script>
</body>

</html>