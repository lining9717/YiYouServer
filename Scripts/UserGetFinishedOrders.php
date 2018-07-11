<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 9:45
 */

require_once('Connect.php');

$tel = $_POST['tel'];

$sql_get_user_info = "select uId from user where  uTelephone = '$tel'";
$result_user_info = $conn->query($sql_get_user_info);
if($result_user_info->num_rows>0){
    $row_user_info = $result_user_info->fetch_assoc();
    $userId = $row_user_info['uId'];
    $sql_get_unfinished_oreders = "select * from `order` where oUserId = $userId 
                      and (oStatus = 'finished' or (oStatus = 'begin' and oToGuideStar != 0 and oToUserStar = 0))";
    $result_get_unfinished_order = $conn->query($sql_get_unfinished_oreders);
    if($result_get_unfinished_order->num_rows>0){
        $data = array();
        while($row = $result_get_unfinished_order->fetch_assoc()){
            $info = array(
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
        if(empty($data)){
            $info = array(
                "orderID"=>0,
                "status"=>" ",
                "place"=>" ",
                "date"=>" ",
                "numberOfPeople"=>0,
                "note"=>" ",
                "userNickname"=>" "
            );
            array_push($data,$info);
            Response::json(0,"No finished orders",$data);
        }else{
            Response::json(1,"Get finished orders success",$data);
        }
    }else{
        $data=array();
        $info = array(
            "orderID"=>0,
            "status"=>" ",
            "place"=>" ",
            "date"=>" ",
            "numberOfPeople"=>0,
            "note"=>" ",
            "userNickname"=>" "
        );
        array_push($data,$info);
        Response::json(0,"No finished orders",$data);
    }
}else{
    $data=array();
    $info = array(
        "orderID"=>0,
        "status"=>" ",
        "place"=>" ",
        "date"=>" ",
        "numberOfPeople"=>0,
        "note"=>" ",
        "userNickname"=>" "
    );
    array_push($data,$info);
    Response::json(0,"Account error",$data);
}
$conn->close();