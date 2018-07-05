<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 9:45
 */

require_once("Connect.php");
$guideIDnumber = $_POST['guideIDNumber'];

$sql_get_guideId = "select gId from guide where gIDNumber = '$guideIDnumber'";
$result_get_guideId = $conn->query($sql_get_guideId);
if($result_get_guideId->num_rows>0){
    $row_get_guideId = $result_get_guideId->fetch_assoc();
    $guideId = $row_get_guideId['gId'];
    $sql_get_begin_oreders = "select * from `order` where oGuideId = $guideId and oStatus = 'finished'";
    $result_get_begin_oreders = $conn->query($sql_get_begin_oreders);
    if($result_get_begin_oreders->num_rows>0){
        $data = array();
        while($row = $result_get_begin_oreders->fetch_assoc()){
            if($row['oToGuideStar'] == 0){
                $info = array(
                    "orderID"=>$row['oId'],
                    "status"=>$row['oStatus'],
                    "place"=>$row['oPlace'],
                    "date"=>$row['oDate'],
                    "numberOfPeople"=>$row['oNumberOfPeople'],
                    "note"=>$row["oDescription"],
                    "userNickname"=>$row['oUserNickname']
                );
                array_push($data,$info);
            }
        }
        if(empty($data)){
            Response::json(0,"No finished orders","");
        }else{
            Response::json(1,"Get finished orders success",$data);
        }
    }else{
        Response::json(0,"No finished orders","");
    }
}else{
    Response::json(0,"Guide ID number error","");
}
$conn->close();