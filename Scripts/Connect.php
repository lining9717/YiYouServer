<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 14:41
 */

class Response{
    public static function json($code,$message="",$data=array()){
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        //输出json
        echo urldecode(json_encode($result));
        exit;
    }
}

$servername = "localhost";
$username = "root";
$password = "Abc12345";
$dbname = "YiYou";

$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    Response::json(0,urlencode("连接数据库失败:".$conn->connect_error),"");
    die("连接失败: " . $conn->connect_error);
}





