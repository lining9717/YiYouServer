<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 11:32
 */

require_once('Connect.php');

$bowenId = $_POST['bowenId'];

$sql_get_all_bowen = "select * from bowen where bId = $bowenId";
$result_get_all_bowen = $conn->query($sql_get_all_bowen);
if($result_get_all_bowen->num_rows>0){
    $data = array();
    $row_get_all_bowen = $result_get_all_bowen->fetch_assoc();
    $userId = $row_get_all_bowen['bUserId'];
    $sql_get_user_headicon = "select uHeadPhoto from user where uId = $userId";
    $result_get_user_headicon = $conn->query($sql_get_user_headicon);
    if($result_get_user_headicon->num_rows>0){
        $row_get_user_headicon = $result_get_user_headicon->fetch_assoc();
        $info = array(
            "bowenId"=>$row_get_all_bowen['bId'],
            "userId"=>$row_get_all_bowen['bUserId'],
            "userNickname"=>$row_get_all_bowen['bUserNickName'],
            "title"=>$row_get_all_bowen['bTitle'],
            "content"=>$row_get_all_bowen['bBody'],
            "ZanNumber"=>$row_get_all_bowen['bZanNumber'],
            "collectedNumber"=>$row_get_all_bowen['bCollectNumber'],
            "time"=>$row_get_all_bowen['bTime'],
            "image"=>$row_get_all_bowen['bImage'],
            "userheadIcon"=>$row_get_user_headicon['uHeadPhoto']
        );
        array_push($data,$info);
    }
    Response::json(1,"Get select bowen success",$data);
}else{
    $data = array();
    $info = array(
        "bowenId"=>" ",
        "userId"=>" ",
        "userNickname"=>" ",
        "title"=>" ",
        "content"=>" ",
        "ZanNumber"=>0,
        "collectedNumber"=>0,
        "time"=>" ",
        "image"=>" ",
        "userheadIcon"=>" "
    );
    array_push($data,$info);
    Response::json(0,"No bowen",$data);
}
$conn->close();