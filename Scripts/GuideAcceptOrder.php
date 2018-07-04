<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/3
 * Time: 9:41
 */

require_once("Connect.php");

$orderId = $_POST['orderID'];
$guideIDnumber = $_POST['IDNumber'];


function isAccept($orderId,$guideId,$conn){
    $sql_get_gog = "select * from getorderguides where gogOrderId = $orderId";
    $result = $conn->query($sql_get_gog);
    while($row = $result->fetch_assoc()){
        if($row['gogGuideId'] == $guideId){
            return true;
        }
    }
    return false;
}

$sql_get_guide_info = "select * from guide where gIDNumber = '$guideIDnumber'";
$result_get_guide_info = $conn->query($sql_get_guide_info);

if($result_get_guide_info->num_rows>0){
    $row_get_guide_info = $result_get_guide_info->fetch_assoc();
    $guideId = $row_get_guide_info['gId'];
    $guideRealname = $row_get_guide_info['gRealName'];
    if(!isAccept($orderId,$guideId,$conn)){
        $sql_accept_order = "insert into getorderguides".
            "(gogOrderId,gogGuideId,gogGuideName) ".
            "values($orderId,$guideId,'$guideRealname')";
        if ($conn->query($sql_accept_order) === TRUE) {
            $sql_update_order_indo = "update `order` set 
                                 oStatus = 'accepted' 
                                 where oId = '$orderId'";
            if($conn->query($sql_update_order_indo) === true){
                Response::json(1,"Accept success","");
            }else{
                Response::json(0,"Update order status fail ".$conn->error,"");
            }
        } else {
            Response::json(0,"Accept fail in server ".$conn->error,"");
        }
    }else{
        Response::json(0,"Guide has accepted this order.","");
    }
}else{
    Response::json(0,"Get guide information error","");
}
$conn->close();