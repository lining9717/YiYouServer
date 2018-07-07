<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 17:04
 */

require_once('Connect.php');

$orderId = $_POST['orderId'];

$sql_get_userId = "select oUserId from `order` where oId = $orderId";
$result_get_userId = $conn->query($sql_get_userId);

if($result_get_userId->num_rows>0){
    $row_get_userId = $result_get_userId->fetch_assoc();
    $userId = $row_get_userId['oUserId'];
    $sql_get_user_info = "select * from user where uId = $userId";
    $result_user_info = $conn->query($sql_get_user_info);
    if($result_user_info->num_rows>0){
        $row_user_info = $result_user_info->fetch_assoc();
        $data = array(
            "nickname" => $row_user_info['uNickname'],
            "telephone" => $row_user_info['uTelephone'],
            "sex" => $row_user_info['uSex'],
            "headphoto" => $row_user_info['uHeadPhoto'],
            "introduce" => $row_user_info['uIntroduce'],
            "star" => $row_user_info['uStars']
        );
        Response::json(1,"Get user information success",$data);
    }else{
        $data = array(
            "nickname" => " ",
            "telephone" => " ",
            "sex" => " ",
            "headphoto" => " ",
            "introduce" => " ",
            "star" => 0
        );
        Response::json(0,"Get user info error",$data);
    }
}else{
    $data = array(
        "nickname" => " ",
        "telephone" => " ",
        "sex" => " ",
        "headphoto" => " ",
        "introduce" => " ",
        "star" => 0
    );
    Response::json(0,"Get user info error",$data);
}
$conn->close();