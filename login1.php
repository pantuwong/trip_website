<?php
session_start(); // ใช้งาน session
require_once("functions.php");//  ไฟล์เชื่อมต่อฐานข้อมูล
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--  กำหนดขอบเขตท้อมูลการร้องขอ มี profile กับ email-->
    <meta name="google-signin-scope" content="profile email">
<!--    กำหนด client ID ที่เราได้สร้างไว้-->
    <meta name="google-signin-client_id" content="866623462982-euestsfmpftkeue88g9s07lff520dtug.apps.googleusercontent.com">
    <title>javascript google login</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
<!--    ต้องมีการเรียกใช้งาน Google Platform Library ในหน้าที่มีการใช้งาน Google Sign In-->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
 
<body>
 
 
<div>
<?php if(!isset($_SESSION['userID']) || $_SESSION['userID']==""){?>
ยังไม่ได้ล็อกอิน ไม่มี session ชื่อ ses_user_id แสดงปุ่มล็อกอินด้วย Google<br><br>
<!--  วางปุ่มล็อกอินด้วย Google ในตำแหน่งที่ต้องการ-->
<div class="g-signin2" data-onsuccess="onSignIn" data-theme="light"></div>
<br>
<br>
<?php }else{ ?>
<strong>userID</strong>: <?=$_SESSION['userID']?><br>
<strong>userName</strong>: <?=$_SESSION['ses_user_name']?><br>
<strong>LastLogin</strong>: <?=$_SESSION['ses_user_last_login']?><br>
<!--ปุ่มล็อกเอ้าท์ออกจาก Google Sign In อย่างง่าย ที่ให้เราออกจากการล็อกอินผ่าน Google-->
<a href="javascript:void(0);" onclick="signOut();">Sign out</a>   
<!--ซ่อนปุ่มล็อกอิน เพราะจำเป้นต้องมีการเรียกใช้งานกรณีต้องการเรียกใช้การล็อกเอาท์-->
<div class="g-signin2" data-onsuccess="onSignIn" data-theme="light" style="display:none;"></div>
<?php } ?>
</div>
 
 
   
    <script>
        var urlDirect="http://localhost/index.php"; // หนัาที่ต้องการให้แสดงหลังล็อกอิน
     
/*      สังเกตจากปุ่มล็อกอินด้านบน จะเห็นว่ามีการกำหนด data-onsuccess="onSignIn"
        ซึ่งก็คือเมื่อมีการล็อกอินผ่าน Google แล้วให้เรียกใช้งานฟังก์ชั่น ที่ชื่อ onSignIn*/
      function onSignIn(googleUser) {
           
        // ขอมูลของผู้ใช้งานที่ล็อกอิน ที่เราสามารถนำไปใช้งานได้ 
        var profile = googleUser.getBasicProfile();
        //console.log("ID: " + profile.getId()); // google แนะนำว่าไม่ควรส่งคานี้ไปเก็บไว้บน server 
        // ค่า ID นี้เราสามรรถประยุกต์เพิ่มเติมตามต้องการ เช่นอาจจะเข้ารหัสก่อนบันทึกหรืออะไรก็ได้
        // แต่ในที่นี้จะใช้วิธีอยางง่่ายเพื่อเป็นแนวทาง
        //console.log('Full Name: ' + profile.getName());
        //console.log('Given Name: ' + profile.getGivenName());
        //console.log('Family Name: ' + profile.getFamilyName());
        //console.log("Image URL: " + profile.getImageUrl());
        //console.log("Email: " + profile.getEmail());
 
        // google แนะนำให้ใช้ ID token สำหรับใช้ในการตรวจสอบการล็อกอิน
        var id_token = googleUser.getAuthResponse().id_token;
        //console.log("ID Token: " + id_token);
         
        if(profile.getId()!=null && profile.getName()!=null){
            // ส่งข้อมูลไปใช้งาน เช่นตรวจสอบการล็อกอิน หรือสร้างข้อมูลสมาชิกใหม่  
            $.post("checkuser.php",{  
                email:profile.getEmail()
            },function(data){  
                //console.log(data);  
                window.location=urlDirect;  
            });     
        }else{
            alert("เกิดข้อผิดพลาด กรุณาลอกใหม่!");  
        }
         
      };
    </script>
     
     
     <script>
/*      ฟังก์ชั่นล็อกเอาท์*/
      function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            // เรียกไฟล์ล็อกเอาท์ เพื่อล้างค่าตัวแปร session  
            $.post("logout.php",function(){  
                  console.log('User signed out.');
                  window.location='login1.php'; // รีโหลดหน้านี้ใหม่
            });             
 
        });
      }
    </script>    
     
</body>
</html>