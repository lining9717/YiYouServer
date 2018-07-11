<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/11
 * Time: 10:49
 */

require_once("Connect.php");
$orderId = $_POST['orderID'];

$sql_get_userId = "select oUserId from `order` where oId = $orderId ";
$result_get_userId = $conn->query($sql_get_userId);
if($result_get_userId->num_rows>0){
    $row_get_userId = $result_get_userId->fetch_assoc();
    $userId = $row_get_userId['oUserId'];
    $sql_getUserInfo = "select * from user where uId = $userId";
    $result_get_userInfo = $conn->query($sql_getUserInfo);
    $row_get_userInfo = $result_get_userInfo->fetch_assoc();
    $info = array(
        "nickname" => $row_get_userInfo['uNickname'],
        "telephone" => $row_get_userInfo['uTelephone'],
        "sex" => $row_get_userInfo['uSex'],
        "headphoto" => $row_get_userInfo['uHeadPhoto'],
        "introduce" => $row_get_userInfo['uIntroduce'],
        "isguide" => $row_get_userInfo['uIsGuide'],
        "guideid" => $row_get_userInfo['uGuideId'],
        "star" => $row_get_userInfo['uStars'],
        "password" => $row_get_userInfo['uPassword'],
    );
    Response::json(1, "Get user information success", $info);
}else{
    Response::json(0,"Get user id error ".$conn->error,"");
}

$conn->close();