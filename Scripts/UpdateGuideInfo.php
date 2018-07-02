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
    Response::json(1,"Update success","");
} else {
    Response::json(0,"Update fail, server error: ".$conn->error,"");
}
$conn->close();