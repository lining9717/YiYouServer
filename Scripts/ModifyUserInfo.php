<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/28
 * Time: 17:17
 */

require_once('Connect.php');

$tel = $_POST['tel'];
$password = $_POST['password'];
$nickname = $_POST['nickname'];
$headicon = $_POST['headicon'];
$sex = $_POST['sex'];
$introduce = $_POST['introduce'];

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
    if($_FILES["file"]["error"]>0){
        Response::json(0,"头像文件传输错误：". $_FILES["file"]["error"],"");
    }else{
        $newfile= time().rand(1,1000).substr($_FILES["file"]["name"],strrpos($_FILES["file"]["name"],"."));
        $imagepath= "http://118.89.18.136/YiYou/image/".$newfile;
        if(move_uploaded_file($_FILES["file"]["tmp_name"], "image/".$newfile)){
            $sql_insert = "insert into user".
                "(uNickname,uTelephone,uSex,uHeadPhoto,uIntroduce,uIsGuide,uStars,uPassword,uGuideId,uCollectGuideId,uCollectEssayId) ".
                "values('$username','$tel','男','$imagepath','让旅行更简单','否',5,'$password',0,0,0)";
            if ($conn->query($sql_insert) === TRUE) {
                Response::json(1,"注册成功","");
            } else {
                Response::json(0,"注册失败2，服务端错误:".$conn->error,"");
            }
        }else{
            Response::json(0,"头像文件移动错误(imageInfo:".$headImage.",username:".$username.")","");
        }
    }
}else{
    Response::json(0,"手机号码已被使用","");
}
$conn->close();