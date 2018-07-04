<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/4
 * Time: 11:20
 */

require_once("Connect.php");
$orderId = $_POST['orderID'];

$sql_get_guides = "select gogGuideId from getorderguides where gogOrderId = $orderId";
$result_get_guides =  $conn->query($sql_get_guides);
if($result_get_guides->num_rows>0){
    $data = array();
    while ($row_get_guides = $result_get_guides->fetch_assoc()){
        $guideId = $row_get_guides['gogGuideId'];
        $sql_guide_info = "select * from guide where gId = $guideId";
        $result_guide_info = $conn->query($sql_guide_info);
        if($result_guide_info->num_rows>0) {
            $row = $result_guide_info->fetch_assoc();
            $info = array(
                "realname" => $row['gRealName'],
                "guideNumber" => $row['gGuideNumber'],
                "servercity" => $row['gServerCity'],
                "star" => $row['gStars']
            );
            array_push($data, $info);
        }
    }
    Response::json(1,"Get guide information success",$data);
}else{
    Response::json(0,"No guide information","");
}

$conn->close();
