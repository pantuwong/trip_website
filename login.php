<?php
    session_start();
    //require_once("functions.php");
    include('include/user.php');
    $user = new User();
?>
<!DOCTYPE html>  
 <html lang="en">  
  <head>  
   <title>Halalwayz</title>  
   <meta charset="UTF-8">  
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
 </head>  
 <!-- Below is the initialization snippet for my Firebase project. It will vary for each project -->  
 <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>  
 <script>  
  // Initialize Firebase  
  var config = {  
    apiKey: 'AIzaSyAkrn_GV6YLwFhv8e3IXo8WalRqfkrUYcM',
            authDomain: 'halalwayz-server.firebaseapp.com',
            databaseURL: 'https://halalwayz-server.firebaseio.com',
            projectId: 'halalwayz-server',
            storageBucket: 'halalwayz-server.appspot.com',
            messagingSenderId: '866623462982'
  };  
  firebase.initializeApp(config);  
 </script>  
 <!-- The code below initializes the sign-in widget from FirebaseUI web. -->  
 <script src="https://cdn.firebase.com/libs/firebaseui/1.0.0/firebaseui.js"></script>  
   <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/1.0.0/firebaseui.css" />  
   <script type="text/javascript">  
    var uiConfig = {  
     signInSuccessUrl: 'loggedIn.php',  
     signInOptions: [  
      // Specify providers you want to offer your users.  
      firebase.auth.GoogleAuthProvider.PROVIDER_ID,  
      firebase.auth.EmailAuthProvider.PROVIDER_ID  
     ],  
     // Terms of service url can be specified and will show up in the widget.  
     tosUrl: '<your-tos-url>'  
    };  
    // Initialize the FirebaseUI Widget using Firebase.  
    var ui = new firebaseui.auth.AuthUI(firebase.auth());  
    // The start method will wait until the DOM is loaded.  
    ui.start('#firebaseui-auth-container', uiConfig);  
 </script>  
 <!-- Include a simple background image & and title -->  
 <body class="login-page sidebar-collapse">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="page-header header-filter" filter-color="blue" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-signup">
            <h2 class="text-center brand">Sign in</h2>
            <div class="card-body">
                <div id="firebaseui-auth-container"></div> 
                <br>
                <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  <body>  
 
  </body>  
 </html>  