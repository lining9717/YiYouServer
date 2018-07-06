<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 11:03
 */

require_once ('Connect.php');

$orderId = $_POST['orderId'];

$sql_cancel_order = "delete from `order` where oId=$orderId and oStatus = 'idle'";
if ($conn->query($sql_cancel_order) === TRUE) {
    Response::json(1,"Cancel idle order success","");
} else {
    Response::json(0,"Cancel idle order fail, server error: ".$conn->error,"");
}
$conn->close();
