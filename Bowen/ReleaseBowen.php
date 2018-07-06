<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 15:01
 */

require_once('Connect.php');

$userTel = str_replace('"','', $_POST['tel']);
$title = $_POST['title'];
$content = $_POST['content'];
$time = str_replace('"','', $_POST['time']);
$imageInfo = str_replace('"','', $_POST['imageInfo']);

$sql_get_user_info = "select * from user where uTelephone = '$userTel'";
$result_get_user_info = $conn->query($sql_get_user_info);
if($result_get_user_info->num_rows>0){
    $row_get_user_info = $result_get_user_info->fetch_assoc();
    $userId = $row_get_user_info['uId'];
    $userNickname = $row_get_user_info['uNickname'];
    if($imageInfo == 'no'){
        $sql_release_bowen = "insert into bowen".
                             "(bUserId,bUserNickName,bTitle,bBody,bZanNumber,bCollectNumber,bTime,bImage) ".
                             "values($userId,'$userNickname','$title','$content',0,0,'$time','no')";
        if ($conn->query($sql_release_bowen) === TRUE) {
            Response::json(1,"Release bowen success","");
        } else {
            Response::json(0,"Release fail 1 in server ".$conn->error,"");
        }
    }else{
        if($_FILES["file"]["error"]>0){
            Response::json(0,"Image file error：". $_FILES["file"]["error"],"");
        }else{
            $filename = $_FILES["file"]["name"];
            $newfile= time().rand(1,1000).substr($filename,strrpos($filename,"."));
            $imagepath= "http://118.89.18.136/YiYou/image/".$newfile;
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "image/".$newfile)){
                $sql_release_bowen = "insert into bowen".
                    "(bUserId,bUserNickName,bTitle,bBody,bZanNumber,bCommentId,bCollectNumber,bTime,bImage) ".
                    "values($userId,'$userNickname','$title','$content',0,0,0,'$time','$imagepath')";
                if ($conn->query($sql_release_bowen) === TRUE) {
                    Response::json(1,"Release bowen success","");
                } else {
                    Response::json(0,"Release fail 2 in server ".$conn->error,"");
                }
            }else{
                Response::json(0,"Image file move error","");
            }
        }
    }
}else{
    Response::json(0,"Get user information error: ".$conn->error,"");
}
$conn->close();

