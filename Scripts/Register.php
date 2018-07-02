<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 15:21
 */

require_once('Connect.php');
$username = str_replace('"','', $_POST['username']);
$password = str_replace('"','', $_POST['password']);
$tel = str_replace('"','', $_POST['tel']);
$headImage = str_replace('"','', $_POST['imageInfo']);

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
    if($headImage == 'default'){
        $imagepath = "http://118.89.18.136/YiYou/image/default.png";
        $sql_insert = "insert into user".
            "(uNickname,uTelephone,uSex,uHeadPhoto,uIntroduce,uIsGuide,uStars,uPassword,uGuideId) ".
            "values('$username','$tel','男','$imagepath','让旅行更简单','否',5,'$password',0)";
        if ($conn->query($sql_insert) === TRUE) {
            Response::json(1,"Register success","");
        } else {
            Response::json(0,"Register fail 1 in server ".$conn->error,"");
        }
    }else{
        if($_FILES["file"]["error"]>0){
            Response::json(0,"Image file error：". $_FILES["file"]["error"],"");
        }else{
            $filename = $_FILES["file"]["name"];
            $newfile= time().rand(1,1000).substr($filename,strrpos($filename,"."));
            $imagepath= "http://118.89.18.136/YiYou/image/".$newfile;
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "image/".$newfile)){
                $sql_insert = "insert into user".
                    "(uNickname,uTelephone,uSex,uHeadPhoto,uIntroduce,uIsGuide,uStars,uPassword,uGuideId) ".
                    "values('$username','$tel','男','$imagepath','让旅行更简单','yes',5,'$password',0)";
                if ($conn->query($sql_insert) === TRUE) {
                    Response::json(1,"Register success","");
                } else {
                    Response::json(0,"Register fail 2 in server ".$conn->error,"");
                }
            }else{
                Response::json(0,"Image file move error (imageInfo:".$headImage.
                    ",username:".$username.
                    ",image:".$filename.
                    ",imagepath:".$imagepath.")","");
            }
        }
    }
}else{
    Response::json(0,"Telephone has been used","");
}
$conn->close();


