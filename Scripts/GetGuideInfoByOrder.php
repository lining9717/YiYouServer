<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/11
 * Time: 10:41
 */

require_once("Connect.php");

$orderId = $_POST['orderID'];

$sql_get_guideId = "select oGuideId from `order` where oId = $orderId";
$result_get_guideId = $conn->query($sql_get_guideId);
if($result_get_guideId->num_rows>0){
    $row_get_guideId = $result_get_guideId->fetch_assoc();
    $guideId = $row_get_guideId['oGuideId'];
    $sql_get_guide_info = "select * from guide where gId = $guideId";
    $result_get_guide_info = $conn->query($sql_get_guide_info);
    $row_get_guide_info = $result_get_guide_info->fetch_assoc();
    $sql_get_guideUser_info = "select * from user where uGuideId = $guideId";
    $result_get_guideUser_info = $conn->query($sql_get_guideUser_info);
    $row_get_guideUser_info = $result_get_guideUser_info->fetch_assoc();
    $info = array(
        "nickname" => $row_get_guideUser_info['uNickname'],
        "telephone" => $row_get_guideUser_info['uTelephone'],
        "sex" => $row_get_guideUser_info['uSex'],
        "headphoto" => $row_get_guideUser_info['uHeadPhoto'],
        "introduce" => $row_get_guideUser_info['uIntroduce'],
        "isguide" => $row_get_guideUser_info['uIsGuide'],
        "guideid" => $row_get_guideUser_info['uGuideId'],
        "star" => $row_get_guideUser_info['uStars'],
        "password" => $row_get_guideUser_info['uPassword'],
        "guiderealname"=>$row_get_guide_info['gRealName'],
        "guideIDnumbr"=>$row_get_guide_info['gIDNumber'],
        "guideNumber"=>$row_get_guide_info['gGuideNumber'],
        "guideservercity"=>$row_get_guide_info['gServerCity'],
        "guidestar"=>$row_get_guide_info['gStars']
    );
    Response::json(1, "Get guide information success", $info);
}else{
    Response::json(0,"Get guide id error ".$conn->error,"");
}

$conn->close();
