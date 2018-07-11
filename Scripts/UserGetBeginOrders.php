<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/4
 * Time: 15:13
 */

require_once('Connect.php');

$tel = $_POST['tel'];

$sql_get_user_info = "select uId from user where  uTelephone = '$tel'";
$result_user_info = $conn->query($sql_get_user_info);
if($result_user_info->num_rows>0){
    $row_user_info = $result_user_info->fetch_assoc();
    $userId = $row_user_info['uId'];
    $sql_get_unfinished_oreders = "select * from `order` where oUserId = $userId and oStatus = 'begin'";
    $result_get_unfinished_order = $conn->query($sql_get_unfinished_oreders);
    if($result_get_unfinished_order->num_rows>0){
        $data = array();
        while($row = $result_get_unfinished_order->fetch_assoc()){
            $guideId = $row['oGuideId'];
            $sql_get_guide_headicon = "select * from user where uGuideId = $guideId";
            $result_get_guide_headicon = $conn->query($sql_get_guide_headicon);
            $row_get_guide_headicon = $result_get_guide_headicon->fetch_assoc();

            if($row['oToGuideStar'] == 0){
                $info = array(
                    "orderID"=>$row['oId'],
                    "status"=>$row['oStatus'],
                    "place"=>$row['oPlace'],
                    "date"=>$row['oDate'],
                    "numberOfPeople"=>$row['oNumberOfPeople'],
                    "note"=>$row["oDescription"],
                    "userNickname"=>$row['oUserNickname'],
                    "guideHeadIcon"=>$row_get_guide_headicon['uHeadPhoto']
                );
                array_push($data,$info);
            }
        }
        if(empty($data)){
            $info = array(
                "orderID"=>0,
                "status"=>" ",
                "place"=>" ",
                "date"=>" ",
                "numberOfPeople"=>0,
                "note"=>" ",
                "userNickname"=>" ",
                "guideHeadIcon"=>" "
            );
            array_push($data,$info);
            Response::json(0,"No begin orders",$data);
        }else{
            Response::json(1,"Get begin orders success",$data);
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
            "userNickname"=>" ",
            "guideHeadIcon"=>" "
        );
        array_push($data,$info);
        Response::json(0,"No begin orders",$data);
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
        "userNickname"=>" ",
        "guideHeadIcon"=>" "
    );
    array_push($data,$info);
    Response::json(0,"Account error",$data);
}
$conn->close();