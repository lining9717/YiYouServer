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
    $row_get_all_bowen = $result_get_all_bowen->fetch_assoc();
    $data = array(
        "userId"=>$row_get_all_bowen['bUserId'],
        "userNickname"=>$row_get_all_bowen['bUserNickName'],
        "title"=>$row_get_all_bowen['bTitle'],
        "content"=>$row_get_all_bowen['bBody'],
        "ZanNumber"=>$row_get_all_bowen['bZanNumber'],
        "commentID"=>$row_get_all_bowen['bCommentId'],
        "collectedNumber"=>$row_get_all_bowen['bCollectNumber'],
        "time"=>$row_get_all_bowen['bTime'],
        "image"=>$row_get_all_bowen['bImage']
    );
    Response::json(1,"Get all bowen success",$data);
}else{
    $data = array(
        "userId"=>"empty",
        "userNickname"=>"empty",
        "title"=>"empty",
        "content"=>"empty",
        "ZanNumber"=>"empty",
        "commentID"=>"empty",
        "collectedNumber"=>"empty",
        "time"=>"empty",
        "image"=>"empty"
    );
    Response::json(0,"No bowen",$data);
}
$conn->close();