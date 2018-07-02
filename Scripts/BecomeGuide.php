<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/29
 * Time: 16:21
 */

require_once('Connect.php');

$tel = $_POST['tel'];
$guideRealName = $_POST['realname'];
$guideIDNumber = $_POST['IDnumber'];
$guideNumber = $_POST['guidenumber'];
$guideServerCity = $_POST['servercity'];

function isIDNumberUsed($conn,$IDnumber){
    $sql_check = "select gIDNumber from guide";
    $result = $conn->query($sql_check);
    while($row = $result->fetch_assoc()){
        if($row['gIDNumber'] == $IDnumber){
            return true;
        }
    }
    return false;
}

function isGuideNumberUsed($conn,$guidenumber){
    $sql_check = "select gGuideNumber from guide";
    $result = $conn->query($sql_check);
    while($row = $result->fetch_assoc()){
        if($row['gGuideNumber'] == $guidenumber){
            return true;
        }
    }
    return false;
}

if(!isIDNumberUsed($conn,$guideIDNumber)){
    if(!isGuideNumberUsed($conn,$guideNumber)){
        $sql_become_guide = "insert into guide".
                            "(gRealName,gIDNumber,gGuideNumber,gServerCity,gStars) ".
                            "values('$guideRealName','$guideIDNumber','$guideNumber','$guideServerCity',5)";
        if ($conn->query($sql_become_guide) === TRUE) {
           $sql_search_guideId = "select gId from guide where gIDNumber= $guideIDNumber";
           $result_guideId = $conn->query($sql_search_guideId);
           if($result_guideId->num_rows>0){
               $row = $result_guideId->fetch_assoc();
               $guideId = $row['gId'];
               $sql_update_user = "update user set 
                                   uIsGuide = 'yes',
                                   uGuideId = '$guideId'
                                   where uTelephone = '$tel'";
               if ($conn->query($sql_update_user) === TRUE) {
                   Response::json(1,"Become guide success","");
               } else {
                   Response::json(0,"update user information error".$conn->error,"");
               }
           }else{
               Response::json(0,"Become guide fail 1, server error: ".$conn->error,"");
           }
        } else {
            Response::json(0,"Become guide fail 2, server error:".$conn->error,"");
        }
    }else{
        Response::json(0,"Guide number has been used","");
    }
}else{
    Response::json(0,"ID number has been used","");
}

$conn->close();