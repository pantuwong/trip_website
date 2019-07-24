<?php
    session_start();
    require_once("config.php");
    require_once("functions.php");
    include('include/user.php');
    $user = new User();
    include("db_connect.php");

    $trip_id = $_GET['trip_id'];
    $num_adult = $_GET['num_adult'];
    $num_children = $_GET['num_children'];
    $adult_price = $_GET['adult_price'];
    $children_price = $_GET['children_price'];
    $trip_date = $_GET['date'];
    $cust_comm = $_GET['cust_com'];
    $guide_comm = $_GET['guide_com'];

    if(!isset($_SESSION['userID'])){
      $_SESSION['trip_id'] = $trip_id;
      $_SESSION['num_adult'] = $num_adult;
      $_SESSION['num_children'] = $num_children;
      $_SESSION['adult_price'] = $adult_price;
      $_SESSION['children_price'] = $children_price;
      $_SESSION['trip_date'] = $trip_date;
      $_SESSION['cust_comm'] = $cust_comm;
      $_SESSION['guide_comm'] = $guide_comm;
      header( "location: login.php" );
    }

    $sql = "SELECT * from trips WHERE trip_id='".$_GET['trip_id']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
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

    $sql="SELECT * FROM users WHERE user_id = '".$users_user_id."' LIMIT 1";
    $result = $conn->query($sql); // ทำการ query คำสั่ง sql 
    $data = $result->fetch_assoc();
    $guide_picture = $data['picture'];
    $guide_firstname = $data['first_name'];
    $guide_lastname = $data['last_name'];

    $userid= $_SESSION["userID"];
    $sql="SELECT * FROM users WHERE user_id = '".$userid."' LIMIT 1";

    $result = $conn->query($sql); // ทำการ query คำสั่ง sql 
    $data = $result->fetch_assoc();
    $picture = $data['picture'];
    $firstname = $data['first_name'];
    $lastname = $data['last_name'];
    $email = $data['email'];
    $phone = $data['phone'];


    $conn->close();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery-ui.multidatespicker.css">
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <style>
            body{
                background-color: #152836
            }
            .demo-gallery > ul {
                margin-bottom: 0;
            }
            .demo-gallery > ul > li {
                float: left;
                margin-bottom: 15px;
                margin-right: 20px;
                width: 200px;
            }
            .demo-gallery > ul > li a {
                border: 3px solid #FFF;
                border-radius: 3px;
                display: block;
                overflow: hidden;
                position: relative;
                float: left;
            }
            .demo-gallery > ul > li a > img {
                -webkit-transition: -webkit-transform 0.15s ease 0s;
                -moz-transition: -moz-transform 0.15s ease 0s;
                -o-transition: -o-transform 0.15s ease 0s;
                transition: transform 0.15s ease 0s;
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                height: 100%;
                width: 100%;
            }
            .demo-gallery > ul > li a:hover > img {
                -webkit-transform: scale3d(1.1, 1.1, 1.1);
                transform: scale3d(1.1, 1.1, 1.1);
            }
            .demo-gallery > ul > li a:hover .demo-gallery-poster > img {
                opacity: 1;
            }
            .demo-gallery > ul > li a .demo-gallery-poster {
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
            .demo-gallery > ul > li a .demo-gallery-poster > img {
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
            .demo-gallery > ul > li a:hover .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.5);
            }
            .demo-gallery .justified-gallery > a > img {
                -webkit-transition: -webkit-transform 0.15s ease 0s;
                -moz-transition: -moz-transform 0.15s ease 0s;
                -o-transition: -o-transform 0.15s ease 0s;
                transition: transform 0.15s ease 0s;
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                height: 100%;
                width: 100%;
            }
            .demo-gallery .justified-gallery > a:hover > img {
                -webkit-transform: scale3d(1.1, 1.1, 1.1);
                transform: scale3d(1.1, 1.1, 1.1);
            }
            .demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
                opacity: 1;
            }
            .demo-gallery .justified-gallery > a .demo-gallery-poster {
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
            .demo-gallery .justified-gallery > a .demo-gallery-poster > img {
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
            .demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.5);
            }
            .demo-gallery .video .demo-gallery-poster img {
                height: 48px;
                margin-left: -24px;
                margin-top: -24px;
                opacity: 0.8;
                width: 48px;
            }
            .demo-gallery.dark > ul > li a {
                border: 3px solid #04070a;
            }
            .home .demo-gallery {
                padding-bottom: 80px;
            }
        </style>

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
</head>

<body class="profile-page sidebar-collapse">
  <?php include('header.php') ?>
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
          <h1 class="title"><?php echo $trip_name; ?></h1>
          <h4><?php echo $trip_dest; ?></h4>
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
                <img src="<?php echo $guide_picture; ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>
              <div class="name">
                <h3 class="title"><?php echo $guide_firstname." ".$guide_lastname ?></h3>
              </div>
            </div>
          </div>
        </div>
              <div class="card card-plain">
                <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">
                      <div class="card">
                        <div class="card-body">
                          <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                             <h5><b>General Information</b></h5>
                            </span>
                           </div>
                        <div class="container">
                          <div class="row">
                            <div class="container">
                              <select class="selectpicker" data-style="select-with-transition" title="Title" id="res_title">
                                <option>Choose your title</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Ms.">Ms.</option>
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="res_fn" placeholder="Firstname" value="<?php echo $firstname; ?>" >
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="res_ln" placeholder="Lastname" value="<?php echo $lastname; ?>" >
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="email" placeholder="Email" value="<?php echo $email; ?>" >
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="mobile" placeholder="Mobile ( with country code )" value="<?php echo $phone; ?>" >
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="container">
                            <select class="selectpicker" data-style="select-with-transition" title="Country" id="res_country">
                                <option disabled>Choose your country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antartica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo">Congo, the Democratic Republic of the</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                <option value="Croatia">Croatia (Hrvatska)</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="France Metropolitan">France, Metropolitan</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                <option value="Holy See">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran (Islamic Republic of)</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia, Federated States of</option>
                                <option value="Moldova">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                <option value="Saint LUCIA">Saint LUCIA</option>
                                <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                <option value="Span">Spain</option>
                                <option value="SriLanka">Sri Lanka</option>
                                <option value="St. Helena">St. Helena</option>
                                <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syrian Arab Republic</option>
                                <option value="Taiwan">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Viet Nam</option>
                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Yugoslavia">Yugoslavia</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <!-- <div class="row">
                      <div class="card">
                        <div class="card-body">
                        <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                             <h5><b>Payment</b></h5>
                            </span>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          Payment form : will do after confirmation of payment methods
                        </div>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <div class="col-lg-4 col-md-4 col-sd-4">
                <div class="card card-pricing">
                  <div class="card-body">

                    <h4 align="left"><b><?php echo $trip_name; ?></b></h4><br>
                    <b>Date:&nbsp;</b><?php 
                      $dates = explode("/",$trip_date);
                      if($dates[0]=="01"){
                        $m = "January";
                      }else if($dates[0]=="02"){
                        $m = "February";
                      }else if($dates[0]=="03"){
                        $m = "March";
                      }else if($dates[0]=="04"){
                        $m = "April";
                      }else if($dates[0]=="05"){
                        $m = "May";
                      }else if($dates[0]=="06"){
                        $m = "June";
                      }else if($dates[0]=="07"){
                        $m = "July";
                      }else if($dates[0]=="08"){
                        $m = "August";
                      }else if($dates[0]=="09"){
                        $m = "September";
                      }else if($dates[0]=="10"){
                        $m = "October";
                      }else if($dates[0]=="11"){
                        $m = "November";
                      }else if($dates[0]=="12"){
                        $m = "December";
                      }
                      echo $dates[1]." ".$m." ".$dates[2];
                    ?><br>
                

                    <ul>
                        <li><p id="adult_price"><?php echo $num_adult; ?> Adults ( <?php echo number_format((float)($adult_price), 2, '.', ''); ?> USD )</p>
                        <li><p id="children_price"><?php echo $num_children; ?> Children ( <?php echo number_format((float)($children_price), 2, '.', ''); ?> USD)</p>
                        <h3 class="card-title text-success" id="total_price"><?php echo number_format((float)($adult_price+$children_price+$cust_comm), 2, '.', ''); ?><small> USD</small></h3>
                        <!-- <li><button class="btn btn-warning btn-block" (click)="onReserved()" onclick="bookFinish();">Check out</button></li> -->
                        <div id="paypal-button-container"></div>
                    </ul>
                    
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
<script src="https://www.paypal.com/sdk/js?client-id=AT4qWUDsBl-XwCvYJPJzPFV_NmV9WcFojk8AeSZTWJF49zsA7BUeNzU30S4BDIq7ITLhW6xtKTzs1gzx&currency=THB"></script>
<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      <?php
          echo "var adult_price=".$adult_price.";";
          echo "var children_price=".$children_price.";";
          echo "var cust_comm=".$cust_comm.";";
      ?>
      trip_fee = adult_price + children_price + cust_comm;

      return actions.order.create({
        purchase_units: [{
          amount: {
            value: trip_fee
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        // alert('Transaction completed by ' + details.payer.name.given_name);
        console.log(details);
        if (details.status="COMPLETED"){
          bookFinish(1,'paypal',trip_fee);
        }else{
          bookFinish(0);
        }
        
      });
    }
  }).render('#paypal-button-container');
</script>


    <script>
      function bookFinish(status,method='',fee=0.0){
        <?php
          echo "var trip_id='".$trip_id."';";
          echo "var num_adult=".$num_adult.";";
          echo "var num_children=".$num_children.";";
          echo "var trip_date='".$trip_date."';";
          echo "var cust_com=".$cust_comm.";";
          echo "var guide_com=".$guide_comm.";";
        ?>
        var title = $('#res_title').val();
        var firstname = $('#res_fn').val();
        var lastname = $('#res_ln').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var country = $('#res_country').val();

        //console.log(trip_id,num_adult,num_children,adult_price,children_price,trip_date,title,firstname,lastname,email,mobile,country,trip_fee);
        var form_res = new FormData()
        form_res.append('trip_id', trip_id);
        form_res.append('trip_res_adult', num_adult);
        form_res.append('trip_res_child', num_children);
        form_res.append('trip_res_date', trip_date);
        form_res.append('trip_res_title',title);
        form_res.append('trip_res_fn',firstname);
        form_res.append('trip_res_ln',lastname);
        form_res.append('trip_res_email',email);
        form_res.append('trip_res_mobile',mobile);
        form_res.append('trip_res_country',country);
        form_res.append('trip_res_fee',fee)
        form_res.append('trip_res_payment_status',status);
        form_res.append('trip_res_payment_method',method);
        form_res.append('trip_res_cust_com',cust_com);
        form_res.append('trip_res_guide_com',guide_com);
      $.ajax({
          url: 'reserve_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_res,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
              window.location =  "finish_reserve.php";
            }else{
                 alert("Error: " + msg);
            }
          }
        });
      }
    </script>
  <script>
    $(document).ready(function() {
      var trip_fee = 0.0;
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


 
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
</body>

</html>
