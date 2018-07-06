<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 17:04
 */

require_once('Connect.php');

$sql_get_all_bowen = "select * from bowen";
$result_get_all_bowen = $conn->query($sql_get_all_bowen);
if($result_get_all_bowen->num_rows>0){
    $data = array();
    while($row_get_all_bowen = $result_get_all_bowen->fetch_assoc()){
        $userId = $row_get_all_bowen['bUserId'];
        $sql_get_user_headicon = "select uHeadPhoto from user where uId = $userId";
        $result_get_user_headicon = $conn->query($sql_get_user_headicon);
        if($result_get_user_headicon->num_rows>0){
            $row_get_user_headicon = $result_get_user_headicon->fetch_assoc();
            $info = array(
                "bowenId"=>$row_get_all_bowen['bId'],
                "userNickname"=>$row_get_all_bowen['bUserNickName'],
                "title"=>$row_get_all_bowen['bTitle'],
                "ZanNumber"=>$row_get_all_bowen['bZanNumber'],
                "collectedNumber"=>$row_get_all_bowen['bCollectNumber'],
                "time"=>$row_get_all_bowen['bTime'],
                "userheadIcon"=>$row_get_user_headicon['uHeadPhoto']
            );
            array_push($data,$info);
        }
    }
    Response::json(1,"Get all bowen success",$data);
}else{
    Response::json(0,"No bowen","");
}
$conn->close();