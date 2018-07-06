<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 15:54
 */

require_once ('Connect.php');

$tel = $_POST['tel'];
$bowenId = $_POST['bowenId'];
$content = $_POST['content'];
$time = $_POST['time'];

$sql_get_user_information = "select * from user where uTelephone='$tel'";
$result_get_user_information = $conn->query($sql_get_user_information);
if($result_get_user_information->num_rows>0){
    $row_get_user_information = $result_get_user_information->fetch_assoc();
    $userId = $row_get_user_information['uId'];
    $userNickname = $row_get_user_information['uNickname'];
    $userHeadIcon= $row_get_user_information['uHeadPhoto'];
    $sql_comment = "insert into comment".
                   "(cContent,cUserId,cUserNickName,cTime,cUserHeadIcon,cBowenId) ".
                   "values('$content',$userId,'$userNickname','$time','$userHeadIcon',$bowenId)";
    if ($conn->query($sql_comment) === TRUE) {
        Response::json(1,"Comment bowen success","");
    } else {
        Response::json(0,"Comment fail 1 in server ".$conn->error,"");
    }
}else{
    Response::json(0,"Account error","");
}
$conn->close();
