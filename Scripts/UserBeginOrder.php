<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/4
 * Time: 11:17
 */

require_once("Connect.php");

$orderId = $_POST['orderID'];
$guideNumber = $_POST['guideNumber'];

$sql_get_guide_information = "select * from guide where gGuideNumber='$guideNumber'";
$result_get_guide_information = $conn->query($sql_get_guide_information);

if($result_get_guide_information->num_rows>0){
    $row_get_guide_information = $result_get_guide_information->fetch_assoc();
    $guideId = $row_get_guide_information['gId'];
    $guideRealName = $row_get_guide_information['gRealName'];
    $sql_update_order = "update `order` set
                         oStatus = 'begin',
                         oGuideId = $guideId,
                         oGuideRealName = '$guideRealName'
                         where oId = $orderId";
    if ($conn->query($sql_update_order) === TRUE) {
        Response::json(1,"Order begin","");
    } else {
        Response::json(0,"Fail, server fail:".$conn->error,"");
    }
}else{
    Response::json(0,"No guide information","");
}

$conn->close();