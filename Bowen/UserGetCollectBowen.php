<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 14:25
 */

require_once ('Connect.php');

$tel = $_POST['tel'];

$sql_get_userId = "select * from user where uTelephone='$tel'";
$result_get_userId = $conn->query($sql_get_userId);
if($result_get_userId->num_rows>0){
    $row_get_userId = $result_get_userId->fetch_assoc();
    $userId = $row_get_userId['uId'];
    $sql_get_bowenId = "select * from collectedessay where ceUserId = $userId";
    $result_get_bowenId = $conn->query($sql_get_bowenId);
    if($result_get_bowenId->num_rows>0){
        $data=array();
        while($row_get_bowenId = $result_get_bowenId->fetch_assoc()){
            $bowenId = $row_get_bowenId['ceBowenId'];
            $wUserId = $row_get_bowenId['ceUserId'];
            $sql_get_user_headicon = "select uHeadPhoto from user where uId = $wUserId";
            $result_get_user_headicon = $conn->query($sql_get_user_headicon);
            $row_get_user_headicon = $result_get_user_headicon->fetch_assoc();
            $sql_get_bowen_information = "select * from bowen where bId = $bowenId";
            $result_get_bowen_information = $conn->query($sql_get_bowen_information);
            if($result_get_bowen_information->num_rows>0){
                $row_get_bowen_information = $result_get_bowen_information->fetch_assoc();
                $info = array(
                    "bowenId"=>$row_get_bowen_information['bId'],
                    "userNickname"=>$row_get_bowen_information['bUserNickName'],
                    "title"=>$row_get_bowen_information['bTitle'],
                    "ZanNumber"=>$row_get_bowen_information['bZanNumber'],
                    "collectedNumber"=>$row_get_bowen_information['bCollectNumber'],
                    "time"=>$row_get_bowen_information['bTime'],
                    "userheadIcon"=>$row_get_user_headicon['uHeadPhoto']
                );
                array_push($data,$info);
            }
        }
        if(empty($data)){
            Response::json(0,"No collect blog","");
        }else{
            Response::json(1,"Get collect blog success",$data);
        }
    }else{
        Response::json(0,"No collect blog","");
    }
}else{
    Response::json(0,"Account error","");
}
$conn->close();