<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 11:38
 */

require_once("Connect.php");

$tel = $_POST['tel'];

$sql_get_userId = "select uId from user where uTelephone='$tel'";
$result_get_userId = $conn->query($sql_get_userId);
if($result_get_userId->num_rows>0){
    $row_get_userId = $result_get_userId->fetch_assoc();
    $userId = $row_get_userId['uId'];
    $sql_get_guideId = "select cgGuideId from collectedguide where cgUserId = $userId";
    $result_get_guideId = $conn->query($sql_get_guideId);
    if($result_get_guideId->num_rows>0){
        $data=array();
        while($row_get_guideId=$result_get_guideId->fetch_assoc()){
            $guideId = $row_get_guideId['cgGuideId'];
            $sql_get_guide_headicon = "select uHeadPhoto from user where uGuideId=$guideId";
            $result_get_guide_headicon = $conn->query($sql_get_guide_headicon);
            $row_get_guide_headicon = $result_get_guide_headicon->fetch_assoc();
            $sql_get_guide_information = "select * from guide where gId=$guideId";
            $result_get_guide_information = $conn->query($sql_get_guide_information);
            if($result_get_guide_information->num_rows>0){
                $row_get_guide_information = $result_get_guide_information->fetch_assoc();
                $info = array(
                    "guiderealname"=>$row_get_guide_information['gRealName'],
                    "guideIDnumbr"=>$row_get_guide_information['gIDNumber'],
                    "guideNumber"=>$row_get_guide_information['gGuideNumber'],
                    "guideservercity"=>$row_get_guide_information['gServerCity'],
                    "guidestar"=>$row_get_guide_information['gStars'],
                    "guideHeadIcon"=>$row_get_guide_headicon['uHeadPhoto']
                );
                array_push($data,$info);
            }
        }
        if(empty($data)){
            $info = array(
                "guiderealname"=>0,
                "guideIDnumbr"=>" ",
                "guideNumber"=>" ",
                "guideservercity"=>" ",
                "guidestar"=>0,
                "guideHeadIcon"=>" "
            );
            array_push($data,$info);
            Response::json(0,"No collect guides",$data);
        }else{
            Response::json(1,"Get collect guides success",$data);
        }
    }else{
        $data=array();
        $info = array(
            "guiderealname"=>0,
            "guideIDnumbr"=>" ",
            "guideNumber"=>" ",
            "guideservercity"=>" ",
            "guidestar"=>0,
            "guideHeadIcon"=>" "
        );
        array_push($data,$info);
        Response::json(0,"No collect guides",$data);
    }
}else{
    $data=array();
    $info = array(
        "guiderealname"=>0,
        "guideIDnumbr"=>" ",
        "guideNumber"=>" ",
        "guideservercity"=>" ",
        "guidestar"=>0,
        "guideHeadIcon"=>" "
    );
    array_push($data,$info);
    Response::json(0,"Get user id fail:".$conn->error,$data);
}
$conn->close();
