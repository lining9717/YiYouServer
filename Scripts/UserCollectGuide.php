<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 10:21
 */

require_once('Connect.php');

$guideNumber = $_POST['guideNumber'];
$userTel = $_POST['tel'];

$sql_get_userId = "select uId from user where uTelephone = '$userTel'";
$result_get_userId = $conn->query($sql_get_userId);
if($result_get_userId->num_rows>0){
    $row_get_userId = $result_get_userId->fetch_assoc();
    $userId = $row_get_userId['uId'];
    $sql_get_guide_info = "select * from guide where gGuideNumber = '$guideNumber'";
    $result_get_guide_info = $conn->query($sql_get_guide_info);
    if($result_get_guide_info->num_rows>0){
        $row_get_guide_info = $result_get_guide_info->fetch_assoc();
        $guideId = $row_get_guide_info['gId'];
        $guideRealname = $row_get_guide_info['gRealName'];
        $sql_get_guide_headicon = "select uHeadPhoto from user where uGuideId=$guideId";
        $result_get_guide_headicon = $conn->query($sql_get_guide_headicon);
        if($result_get_guide_headicon->num_rows>0){
            $row_get_guide_headicon = $result_get_guide_headicon->fetch_assoc();
            $guideHeadIcon = $row_get_guide_info['uHeadPhoto'];
            $sql_collect = "insert into collectedguide".
                           "(cgGuideId,cgUserId,cgGuideRealName,cgGuideHeadIcon) ".
                           "values($guideId,$userId,'$guideRealname','$guideHeadIcon')";
            if ($conn->query($sql_collect) === TRUE) {
                Response::json(1,"Collect success","");
            } else {
                Response::json(0,"Collect fail in server ".$conn->error,"");
            }
        }else{
            Response::json(0,"Get guide head icon error: ".$conn->error,"");
        }
    }else{
        Response::json(0,"Get guide information error: ".$conn->error,"");
    }
}else{
    Response::json(0,"Account error","");
}
$conn->close();