<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/1
 * Time: 16:42
 */

require_once('Connect.php');

$tel = $_POST['tel'];
$place = $_POST['place'];
$date = $_POST['date'];
$numberOfPeople = $_POST['numberOfPeople'];
$description = $_POST['description'];

$sql_user_info = "select * from user where uTelephone = '$tel'";
$result_user = $conn->query($sql_user_info);
if($result_user->num_rows>0){
    $row_user_info = $result_user->fetch_assoc();
    $userId = $row_user_info['uId'];
    $userNickname = $row_user_info['uNickname'];
    $sql_release_order = "insert into `order`".
                          "(oStatus,oUserId,oGuideId,oPlace,oDate,oNumberOfPeople,oDescription,".
                          "oToUserStar,oToGuideStar,oUserNickname,oGuideRealName) ".
                          "values('idle','$userId',0,'$place','$date',$numberOfPeople,'$description',".
                          "0,0,'$userNickname','no')";
    if ($conn->query($sql_release_order) === TRUE) {
        Response::json(1,"Release success","");
    } else {
        Response::json(0,"Release fail 1 in server ".$conn->error,"");
    }
}else{
    Response::json(0,"Account error","");
}

$conn->close();
