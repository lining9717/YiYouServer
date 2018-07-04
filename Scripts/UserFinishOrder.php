<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/4
 * Time: 15:06
 */

require_once('Connect.php');

$orderId = $_POST['orderId'];
$star = $_POST['star'];

function updateGuideStar($guideId,$conn){
    $sql_get_guide_star = "select oToGuideStar from `order` where oGuideId = $guideId";
    $result_get_guide_star = $conn->query($sql_get_guide_star);
    $sum=0;
    $count=0;
    while($row=$result_get_guide_star->fetch_assoc()){
        if($row['oToGuideStar'] != 0){
            $sum += $row['oToGuideStar'];
            $count++;
        }
    }
    $star = $sum/$count;
    $sql_update_guide_star = "update guide set
                              gStars = $star
                              where gId = $guideId";
    if ($conn->query($sql_update_guide_star) === TRUE) {
        return true;
    }
    return false;
}

$sql_get_order_status = "select * from `order` where oId = $orderId";
$result_get_order_status = $conn->query($sql_get_order_status);
if($result_get_order_status->num_rows>0){
    $row_get_order_status = $result_get_order_status->fetch_assoc();
    $guideId = $row_get_order_status['oGuideId'];
    if($row_get_order_status['oToUserStar'] == 0){
        $sql_user_finish_order = "update `order` set
                          oToGuideStar = $star
                          where oId = $orderId";
    }else{
        $sql_user_finish_order = "update `order` set
                          oStatus = 'finished',
                          oToGuideStar = $star
                          where oId = $orderId";
    }
    if ($conn->query($sql_user_finish_order) === TRUE) {
        if(updateGuideStar($guideId,$conn)){
            Response::json(1,"Finish order success","");
        }else{
            Response::json(0,"Finish fail, update guide star fail","");
        }
    } else {
        Response::json(0,"Finish fail, server error: ".$conn->error,"");
    }

}else{
    Response::json(0,"Get order status fail:".$conn->error,"");
}

$conn->close();

