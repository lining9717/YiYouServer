<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/5
 * Time: 16:33
 */

require_once('Connect.php');

$tel = $_POST['tel'];
$password = $_POST['newPassword'];

$sql_set_new_pwd = "update user set
                    uPassword = '$password'
                    where uTelephone = '$tel'";

if ($conn->query($sql_set_new_pwd) === TRUE) {
    Response::json(1,"Set new password success","");
} else {
    Response::json(0,"Set new password fail, server error: ".$conn->error,"");
}
$conn->close();