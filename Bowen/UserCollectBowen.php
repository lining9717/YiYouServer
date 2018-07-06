<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 11:19
 */

require_once ('Connect.php');

$tel = $_POST['tel'];
$bowenId = $_POST['bowenId'];

function isCollected($userId,$bowenId,$conn){
    $sql = "select * from collectedessay where ceBowenId=$bowenId and ceUserId = $userId";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        return true;
    }
    return false;
}

$sql_get_userId = "select uId from user where uTelephone = '$tel'";
$result_get_userId = $conn->query($sql_get_userId);
if($result_get_userId->num_rows>0){
    $row_get_userId = $result_get_userId->fetch_assoc();
    $userId = $row_get_userId['uId'];
    if(!isCollected($userId,$bowenId,$conn)){
        $sql_get_bowen_info = "select * from bowen where bId = $bowenId";
        $result_get_bowen_info = $conn->query($sql_get_bowen_info);
        if($result_get_bowen_info->num_rows>0){
            $row_get_bowen_info= $result_get_bowen_info->fetch_assoc();
            $bowenTitle= $row_get_bowen_info['bTitle'];
            $bowenUserId = $row_get_bowen_info['bUserId'];
            if($bowenUserId != $userId){
                $sql_collect_bowen = "insert into collectedessay".
                    "(ceBowenId,ceUserId,ceBowenTitle) ".
                    "values($bowenId,$userId,'$bowenTitle')";
                if ($conn->query($sql_collect_bowen) === TRUE) {
                    $sql_update_collect = "select bCollectNumber from bowen where bId = $bowenId";
                    $result_update_collect = $conn->query($sql_update_collect);
                    $row_update_collect = $result_update_collect->fetch_assoc();
                    $collectNumber = (int)($row_update_collect['bCollectNumber']);
                    $collectNumber++;
                    $sql_update_collectNumber = "update bowen set 
                         bCollectNumber = $collectNumber
                         where bId = $bowenId";
                    if ($conn->query($sql_update_collectNumber) === TRUE) {
                        Response::json(1,"Collect success","");
                    } else {
                        Response::json(0,"Update collect number fail in server ".$conn->error,"");
                    }
                } else {
                    Response::json(0,"Collect fail in server ".$conn->error,"");
                }
            }else{
                Response::json(0,"You can collect your own blog ","");
            }
        }else{
            Response::json(0,"Get bowen information error: ".$conn->error,"");
        }
    }else{
        Response::json(0,"You have collected this blog","");
    }
}else{
    Response::json(0,"Account error","");
}
$conn->close();