<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/4
 * Time: 20:40
 */

require_once("Connect.php");

$guideIDnumber = $_POST['guideIDNumber'];

$sql_get_guideId = "select gId from guide where gIDNumber = '$guideIDnumber'";
$result_get_guideId = $conn->query($sql_get_guideId);
if($result_get_guideId->num_rows>0){
    $row_get_guideId = $result_get_guideId->fetch_assoc();
    $guideId = $row_get_guideId['gId'];
    $sql_get_orders_id = "select gogOrderId from getorderguides where gogGuideId = $guideId";
    $result_get_orders_id = $conn->query($sql_get_orders_id);
    if($result_get_orders_id->num_rows>0){
        $data=array();
        while($row_get_orders_id = $result_get_orders_id->fetch_assoc()){
            $orderId = $row_get_orders_id['gogOrderId'];
            $sql_get_order_info = "select * from `order` where oId = $orderId";
            $result_order_info = $conn->query($sql_get_order_info);
            if($result_order_info->num_rows>0){
                $row = $result_order_info->fetch_assoc();
                $info=array(
                    "orderID"=>$row['oId'],
                    "status"=>$row['oStatus'],
                    "place"=>$row['oPlace'],
                    "date"=>$row['oDate'],
                    "numberOfPeople"=>$row['oNumberOfPeople'],
                    "note"=>$row["oDescription"],
                    "userNickname"=>$row['oUserNickname']
                );
                array_push($data,$info);
            }
        }
        if(empty($data)){
            Response::json(0,"No accepted orders","");
        }else{
            Response::json(1,"Get accepted orders success",$data);
        }
    }else{
        Response::json(0,"No accepted orders","");
    }
}else{
    Response::json(0,"Get guide Id fail, server error: ".$conn->error,"");
}


$conn->close();