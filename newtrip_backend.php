<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");
    if (isset($_POST['tab']) && $_POST['tab']=='basic')
    {
        $users_user_id = $_POST['users_user_id'];
        $vehicle_id = $_POST['vehicle_id'];
        $trip_type_id = $_POST['trip_type_id'];
        $trip_name = addslashes($_POST['trip_name']);
        $trip_sum = addslashes($_POST['trip_sum']);
        $trip_dest = addslashes($_POST['trip_dest']);
        $trip_activity = addslashes($_POST['trip_activity']);
        $trip_cover = $_POST['trip_cover'];
        if($_SESSION['trip_id']==0)
        {
            $sql = "INSERT INTO trips (trip_type_id, vehicle_id, users_user_id, trip_name, trip_sum, trip_dest, trip_activity, trip_cover ) VALUES ('".$trip_type_id."','".$vehicle_id."','".$users_user_id."','".$trip_name."','".$trip_sum."','".$trip_dest."','".$trip_activity."','".$trip_cover."')";
        
        }else{
            $trip_id = $_SESSION['trip_id'];
            $sql = "SELECT * from trips WHERE trip_id='".$_SESSION['trip_id']."'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            $trip_cover_old = $data['trip_cover'];
            $filename = 'upload/'.$trip_cover_old;
            unlink($filename);
            $sql = "UPDATE trips SET trip_status='0', trip_ver_reason='', trip_type_id='".$trip_type_id."', vehicle_id='".$vehicle_id."', users_user_id='".$users_user_id."', trip_name='".$trip_name."',trip_sum='".$trip_sum."',trip_dest='".$trip_dest."',trip_activity='".$trip_activity."', trip_cover='".$trip_cover."' WHERE trip_id = '".$trip_id."'";
        }
    
        if ($conn->query($sql) === TRUE) 
        {
            if($_SESSION['trip_id']===0)
            {
                $_SESSION['trip_id'] = $conn->insert_id;
            }
            echo "Success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else if (isset($_POST['tab']) && $_POST['tab']=='overview'){
        $fileList = json_decode($_POST['fileList']);
        
        if($_SESSION['trip_id']==0)
        {
            $sql = "INSERT INTO trips () VALUES ()";
            $conn->query($sql);
            $_SESSION['trip_id'] = $conn->insert_id;
            $trip_id = $_SESSION['trip_id'];
        }else{
            $trip_id = $_SESSION['trip_id'];
            $sql = "DELETE FROM trip_photo where trip_id='".$trip_id."'";
            $conn->query($sql);
        }
       
        $succues = TRUE;
        for($i = 0; $i < sizeof($fileList); $i++)
        {
            $sql = "INSERT INTO trip_photo (trip_id,trip_photo_name) VALUES ('".$trip_id."','".$fileList[$i]."')";
            if (!$conn->query($sql) === TRUE){
                $succues = FALSE;
                $err_sql = $sql;
            }
            
        }
        if($succues){
            echo "Success";
        }else{
            echo "Error: " . $err_sql . "<br>" . $conn->error;
        }
    }else if (isset($_POST['tab']) && $_POST['tab']=='detail'){
        $detail_data = json_decode($_POST['trip_detail_data'],true);
        $trip_meeting_addr = $_POST['meeting_addr'];
        $trip_meeting_lat = $_POST['meeting_lat'];
        $trip_meeting_lng = $_POST['meeting_lng'];
        $trip_num_day = $_POST['num_day'];
        if($_SESSION['trip_id']==0)
        {
            $sql = "INSERT INTO trips ( trip_meeting_addr, trip_meeting_lat, trip_meeting_lng, trip_num_day ) VALUES ('".$trip_meeting_addr."','".$trip_meeting_lat."','".$trip_meeting_lng."','".$trip_num_day."')";
            $conn->query($sql);
            $_SESSION['trip_id'] = $conn->insert_id;
            $trip_id = $_SESSION['trip_id'];
        
        }else{
            $trip_id = $_SESSION['trip_id'];
            $sql = "UPDATE trips SET  trip_status='0', trip_ver_reason='', trip_meeting_addr='".$trip_meeting_addr."', trip_meeting_lat='".$trip_meeting_lat."', trip_meeting_lng='".$trip_meeting_lng."', trip_num_day='".$trip_num_day."'  WHERE trip_id = '".$trip_id."'";
            $conn->query($sql);
        }
        $succues = TRUE;
        $sql = "DELETE FROM trip_detail where trip_id='".$trip_id."'";
        $conn->query($sql);
        for($d=1;$d<=$trip_num_day;$d++){
            $day_data = $detail_data[$d];
            $num_p = sizeof(array_keys($day_data));
            for($p=1;$p<=$num_p;$p++){
                $start = $day_data[$p]["start"];
                $start_ap = substr($start, -2);
                $end = $day_data[$p]["end"];
                $end_ap = substr($end,-2);
                $desc = addslashes($day_data[$p]["desc"]);
                $sql = "INSERT INTO trip_detail ( trip_id, trip_day, trip_detail_start, trip_detail_end, trip_detail_start_ap, trip_detail_end_ap, trip_detail_description ) VALUES ('".$trip_id."','".$d."','".$start."','".$end."','".$start_ap."','".$end_ap."','".$desc."')";
                if (!$conn->query($sql) === TRUE) {
                    $succues = FALSE;
                    $err_sql = $sql;
                }
            }
        }
        if($succues){
            echo "success";
        }else{
            echo "Error: " . $err_sql . "<br>" . $conn->error;
        }
    }
    else if (isset($_POST['tab']) && $_POST['tab']=='price'){
        $price_food = $_POST['price_food'];
        $price_extra = addslashes($_POST['price_extra']);
        $price_max_pass = $_POST['price_max_pass'];
        $price_type = $_POST['price_type'];
        $price_unit = array();
        $price_total = array();
        $price_unit_array = json_decode($_POST['price_unit'],true);
        $price_total_array = json_decode($_POST['price_total'],true);
	$loop_limit = $price_max_pass;
	$price_children_allow = $_POST['price_children_allow'];
	$price_children = $_POST['price_children'];
        if($price_type=='basic')
            $loop_limit = 1;
        for($i=0;$i<$loop_limit;$i++){
            array_push($price_unit, $price_unit_array[$i]);
            array_push($price_total, $price_total_array[$i]);
        }
        if($_SESSION['trip_id']==0)
        {
            $sql = "INSERT INTO trips ( ) VALUES ()";
            $conn->query($sql);
            $_SESSION['trip_id'] = $conn->insert_id;
            $trip_id = $_SESSION['trip_id'];
        
        }else{
            $trip_id = $_SESSION['trip_id'];
            $sql = "DELETE FROM trip_price where trip_id='".$trip_id."'";
            $conn->query($sql);
        }
        $sql = "INSERT INTO trip_price (trip_id, price_food,price_extra, price_max_pass, price_type ";
        for($i=1;$i<=$loop_limit;$i++){
            $sql = $sql.",price_unit".$i.", price_total".$i;
        }
        $sql = $sql.", price_children_allow, price_children ) VALUES ('".$trip_id."','".$price_food."','".$price_extra."','".$price_max_pass."','".$price_type."'";
        for($i=1;$i<=$loop_limit;$i++){
            $sql = $sql.",'".$price_unit[$i-1]."','".$price_total[$i-1]."'";
        }
        $sql = $sql.",'".$price_children_allow."','".$price_children."')";
        if ($conn->query($sql) === TRUE) {
	    echo "success";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else if (isset($_POST['tab']) && $_POST['tab']=='condition'){
        $casual = $_POST['casual'];
        $physical = $_POST['physical'];
        $vegan = $_POST['vegan'];
        $children = $_POST['children'];
        $flexible = $_POST['flexible'];
        $seasonal = $_POST['seasonal'];
        $dates = explode(",",$_POST['dates']);
        
        if($_SESSION['trip_id']==0)
        {
            $sql = "INSERT INTO trips (trip_condition_casual, trip_condition_physical, trip_condition_vegan, trip_condition_children, trip_condition_flexible, trip_condition_seasonal) VALUES ('".$casual."','".$physical."','".$vegan."','".$children."','".$flexible."','".$seasonal."')";
            $conn->query($sql);
            $_SESSION['trip_id'] = $conn->insert_id;
            $trip_id = $_SESSION['trip_id'];
        
        }else{
            $trip_id = $_SESSION['trip_id'];
            $sql = "UPDATE trips SET  trip_status='0', trip_ver_reason='', trip_condition_casual='".$casual."', trip_condition_physical='".$physical."', trip_condition_vegan='".$vegan."', trip_condition_children='".$children."', trip_condition_flexible='".$flexible."', trip_condition_seasonal='".$seasonal."' WHERE trip_id='".$trip_id."'";
            $conn->query($sql);
        }
    	$temp_sql = $sql; 
        $sql = "DELETE FROM trip_date where trip_id='".$trip_id."'";
       $conn->query($sql);
        $succues = TRUE;
        for($i=0;$i<sizeof($dates);$i++){
            if ( strlen($dates[$i]) > 0 )
            {
                $sql = "INSERT INTO trip_date (trip_id, trip_date) VALUES ('".$trip_id."',STR_TO_DATE('".$dates[$i]."','%m/%d/%Y'))";
        
                if ($conn->query($sql) === FALSE) {
                    $succues = FALSE;
                    $err_sql = $sql;
                }
            }
        }
        
        if ($succues) {
	    echo "success";
        }else{
            echo "Error: " . $err_sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
?>
