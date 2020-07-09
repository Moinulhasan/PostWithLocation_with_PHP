<?php

//////// first findout the Country Latitude Longitue which was store in database 
//////// when user login into a system

$sqlQ = "SELECT country,longitude,latitude,city FROM candid_database.user_name where id_user_name = $user ";

$resultQ = $con->query($sqlQ);
$recordsHip = array();
/////// formating the data 
while($rowQ = $resultQ->fetch_assoc()){
    $recordsHip['lan'] = $rowQ['longitude'];
    $recordsHip['lat'] = $rowQ['latitude'];
    $recordsHip['country'] = $rowQ['country'];
    $recordsHip['city'] = $rowQ['city'];
   
    }
////// assign the datao into a veriable so that we can excuite this easily
$lat = $recordsHip['lat'];
$lon = $recordsHip['lan'];
$country = $recordsHip['country'] ;
$city =  $recordsHip['city'];

///// this is main logication sql
///// here lat and lan are the functional value 
///// and $lat and $lan are the value form database
///// here i eplement this sql with 5 miles you can aslo use what ever u want

//// here i also checking the post i am geting except the current user post .
$sql = "SELECT id_posts, SQRT(
    POW(69.1 * (lat - $lat), 2) +
    POW(69.1 * ($lon - lan) * COS(lat / 57.3), 2)) AS distance
FROM posts where id_user_name != $user HAVING distance < 5  ORDER BY distance  ";
$id = array();
$result = $con->query($sql);

/////// after geting the value just formating it
if ($result->num_rows > 0) {
  
   while($row = $result->fetch_assoc()) {
      $id[] = $row['id_posts'];
        }
}
