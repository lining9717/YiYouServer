<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 15:13
 */

require_once('Connect.php');


$sql_login = "select * from user where uTelephone = '$tel'";

$result = $conn->query($sql_login);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($password == $row['uPassword']) {
        $data = array(
            "nickname" => $row['uNickname'],
            "telephone" => $row['uTelephone'],
            "sex" => $row['uSex'],
            "headphoto" => $row['uHeadPhoto'],
            "introduce" => $row['uIntroduce'],
            "isguide" => $row['uIsGuide'],
            "guideid" => $row['uGuideId'],
            "star" => $row['uStars'],
            "password" => $row['uPassword']
        );
        Response::json(1, "登录成功", $data);
    } else {
        $data = array(
            "nickname" => "error password",
            "telephone" => "error password",
            "sex" => "error password",
            "headphoto" => "error password",
            "introduce" => "error password",
            "isguide" => "error password",
            "guideid" => 0,
            "star" => 0,
            "password" => "error password"
        );
        Response::json(0, "密码错误", $data);
    }
} else {
    $data = array(
        "nickname" => "empty telephone",
        "telephone" => "empty telephone",
        "sex" => "empty telephone",
        "headphoto" => "empty telephone",
        "introduce" => "empty telephone",
        "isguide" => "empty telephone",
        "guideid" => 0,
        "star" => 0,
        "password" => "empty telephone"
    );
    Response::json(0, "账户不存在", $data);
}
$conn->close();





