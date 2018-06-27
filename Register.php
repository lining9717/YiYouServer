<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 15:21
 */

require_once('Connect.php');
$username = $_POST['username'];
$password = $_POST['password'];
$tel = $_POST['tel'];

function isTelUsed($conn,$telnumber){
    $sql_check = "select uTelephone from user";
    $result = $conn->query($sql_check);
    while($row = $result->fetch_assoc()){
        if($row['uTelephone'] == $telnumber){
            return true;
        }
    }
    return false;
}

if(!isTelUsed($conn,$tel)){
    $sql_insert = "insert into user".
        "(uNickname,uTelephone,uSex,uHeadPhoto,uIntroduce,uIsGuide,uStars,uPassword,uGuideId,uCollectGuideId,uCollectEssayId) ".
        "values('$username','$tel','男','默认','让旅行更简单','否',5,'$password',0,0,0);";
    if ($conn->query($sql_insert) === TRUE) {
        Response::json(1,"注册成功","");
    } else {
        Response::json(0,"注册失败，服务端错误:".$conn->error,"");
    }
}else{
    Response::json(0,"手机号码已被使用","");
}
$conn->close();


