<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 8:49
 */

require_once("Connect.php");

$orderId = $_POST['orderId'];
$star = $_POST['star'];

function updateUserStar($userId,$conn){
    $sql_get_user_star = "select oToUserStar from `order` where oUserId = $userId";
    $result_get_user_star = $conn->query($sql_get_user_star);
    $sum=0;
    $count=0;
    while($row=$result_get_user_star->fetch_assoc()){
        if($row['oToUserStar'] != 0){
            $sum += $row['oToUserStar'];
            $count++;
        }
    }
    $star = $sum/$count;
    $sql_update_user_star = "update user set
                              uStars = $star
                              where uId = $userId";
    if ($conn->query($sql_update_user_star) === TRUE) {
        return true;
    }
    return false;
}

$sql_get_order_status = "select * from `order` where oId = $orderId";
$result_get_order_status = $conn->query($sql_get_order_status);
if($result_get_order_status->num_rows>0){
    $row_get_order_status = $result_get_order_status->fetch_assoc();
    $userId = $row_get_order_status['oUserId'];
    if($row_get_order_status['oToGuideStar'] == 0){
        $sql_guide_finish_order = "update `order` set
                          oToUserStar = $star
                          where oId = $orderId";
    }else{
        $sql_guide_finish_order = "update `order` set
                          oStatus = 'finished',
                          oToUserStar = $star
                          where oId = $orderId";
    }
    if ($conn->query($sql_guide_finish_order) === TRUE) {
        if(updateUserStar($userId,$conn)){
            Response::json(1,"Finish order success","");
        }else{
            Response::json(0,"Finish fail, update user star fail","");
        }
    }else{
        Response::json(0,"Finish fail, server error: ".$conn->error,"");
    }
}else{
    Response::json(0,"Get order status fail:".$conn->error,"");
}
$conn->close();