<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/3
 * Time: 9:57
 */

require_once("Connect.php");

$guideIDNumber = $_POST['IDnumber'];

$sql_server_city = "select * from guide where gIDNumber = '$guideIDNumber'";
$result_server_city = $conn->query($sql_server_city);
if ($result_server_city->num_rows > 0) {
    $row_server_city = $result_server_city->fetch_assoc();
    $serverPlace = $row_server_city['gServerCity'];
    $guideId = $row_server_city['gId'];
    $sql_get_guideUserId = "select uId from user where uGuideId = $guideId";
    $result_guideUserId = $conn->query($sql_get_guideUserId);
    if ($result_guideUserId->num_rows > 0) {
        $row_guideUserId = $result_guideUserId->fetch_assoc();
        $guideUserId = $row_guideUserId['uId'];
        $arr1 = explode(" ", $serverPlace);
        if ($arr1[0] == "北京市" || $arr1[0] == "上海市" || $arr1[0] == "天津市"
            || $arr1[0] == "重庆市" || $arr1[0] == "香港" || $arr1[0] == "澳门") {
            $city = $arr1[0];
        } else {
            $city = $arr1[1];
        }

        $sql_get_orders = "select o.oId,o.oStatus,o.oPlace,o.oDate,o.oNumberOfPeople,o.oDescription,o.oUserNickname
                           from `order` as o, getorderguides as g
                           where (o.oStatus = 'idle' or o.oStatus = 'accepted') and g.gogGuideId != $guideId and g.gogOrderId == o.oId";
        $result_get_orders = $conn->query($sql_get_orders);
        if ($result_get_orders->num_rows > 0) {
            $data = array();
            while ($row_get_orders = $result_get_orders->fetch_assoc()) {
                $place = $row_get_orders['oPlace'];
                $arr2 = explode(" ", $place);
                if ($arr2[0] == "北京市" || $arr2[0] == "上海市" || $arr2[0] == "天津市"
                    || $arr2[0] == "重庆市" || $arr2[0] == "香港" || $arr2[0] == "澳门") {
                    $placecity = $arr2[0];
                } else {
                    $placecity = $arr2[1];
                }
                if ($placecity == $city) {
                    $info = array(
                        "orderID" => $row_get_orders['oId'],
                        "status" => $row_get_orders['oStatus'],
                        "place" => $row_get_orders['oPlace'],
                        "date" => $row_get_orders['oDate'],
                        "numberOfPeople" => $row_get_orders['oNumberOfPeople'],
                        "note" => $row_get_orders["oDescription"],
                        "userNickname" => $row_get_orders['oUserNickname']
                    );
                    array_push($data, $info);
                }
            }
            Response::json(1, "Get nearby orders success 2", $data);
        } else {
            Response::json(0, "No orders", "");
        }
    } else {
        Response::json(0, "Get guide as user id error" . $conn->error, "");
    }
} else {
    Response::json(0, "Get guide server city error", "");
}
$conn->close();