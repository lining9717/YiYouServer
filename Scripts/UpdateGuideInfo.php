<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/1
 * Time: 10:54
 */

require_once('Connect.php');

$guideIDNumber = $_POST['IDNumber'];
$guideServerCity = $_POST['servercity'];

$update_guide_sql = "update guide set
                     gServerCity = '$guideServerCity'
                     where gIDNumber = '$guideIDNumber'";
if ($conn->query($update_guide_sql) === TRUE) {
    Response::json(1,"修改成功","");
} else {
    Response::json(0,"修改失败1，服务端错误:".$conn->error,"");
}
$conn->close();