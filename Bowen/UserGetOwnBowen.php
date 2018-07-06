<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 9:14
 */

require_once('Connect.php');
$tel = $_POST['tel'];

$sql_get_userId = "select * from user where uTelephone = '$tel'";
$result_get_userId = $conn->query($sql_get_userId);
if($result_get_userId->num_rows>0){
    $row_get_userId = $result_get_userId->fetch_assoc();
    $userId = $row_get_userId['uId'];
    $sql_get_user_own_bowen = "select * from bowen where bUserId = $userId";
    $result_get_user_own_bowen = $conn->query($sql_get_user_own_bowen);
    if($result_get_user_own_bowen->num_rows>0){
        $data = array();
        while($row_get_user_own_bowen = $result_get_user_own_bowen->fetch_assoc()){
            $info = array(
                "bowenId"=>$row_get_user_own_bowen['bId'],
                "userNickname"=>$row_get_user_own_bowen['bUserNickName'],
                "title"=>$row_get_user_own_bowen['bTitle'],
                "ZanNumber"=>$row_get_user_own_bowen['bZanNumber'],
                "collectedNumber"=>$row_get_user_own_bowen['bCollectNumber'],
                "time"=>$row_get_user_own_bowen['bTime'],
                "userheadIcon"=>$row_get_userId['uHeadPhoto']
            );
            array_push($data,$info);
        }
        Response::json(1,"Get user's bowen success",$data);
    }else{
        Response::json(0,"No bowen","");
    }
}else{
    Response::json(0,"Get user id error: ".$conn->error,"");
}
$conn->close();