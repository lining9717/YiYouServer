<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/6/27
 * Time: 15:13
 */

require_once('Connect.php');

$password = str_replace('"','', $_POST['password']);
$tel = str_replace('"','', $_POST['tel']);

$sql_login = "select * from user where uTelephone = '$tel'";

$result_login = $conn->query($sql_login);
if ($result_login->num_rows > 0) {
    $row_login = $result_login->fetch_assoc();
    if ($password == $row_login['uPassword']) {
        if($row_login['uIsGuide'] == 'no'){
            $data = array(
                "nickname" => $row_login['uNickname'],
                "telephone" => $row_login['uTelephone'],
                "sex" => $row_login['uSex'],
                "headphoto" => $row_login['uHeadPhoto'],
                "introduce" => $row_login['uIntroduce'],
                "isguide" => $row_login['uIsGuide'],
                "guideid" => $row_login['uGuideId'],
                "star" => $row_login['uStars'],
                "password" => $row_login['uPassword'],
                "guiderealname"=>" ",
                "guideIDnumbr"=>" ",
                "guideNumber"=>" ",
                "guideservercity"=>" ",
                "guidestar"=>" "
            );
            Response::json(1, "Login Success", $data);
        }else{
            $sql_get_guide_info = "select * from guide where gId = ".$row_login['uGuideId'];
            $result_guideInfo = $conn->query($sql_get_guide_info);
            if($result_guideInfo->num_rows>0){
                $row_guideInfo = $result_guideInfo->fetch_assoc();
                $data = array(
                    "nickname" => $row_login['uNickname'],
                    "telephone" => $row_login['uTelephone'],
                    "sex" => $row_login['uSex'],
                    "headphoto" => $row_login['uHeadPhoto'],
                    "introduce" => $row_login['uIntroduce'],
                    "isguide" => $row_login['uIsGuide'],
                    "guideid" => $row_login['uGuideId'],
                    "star" => $row_login['uStars'],
                    "password" => $row_login['uPassword'],
                    "guiderealname"=>$row_guideInfo['gRealName'],
                    "guideIDnumbr"=>$row_guideInfo['gIDNumber'],
                    "guideNumber"=>$row_guideInfo['gGuideNumber'],
                    "guideservercity"=>$row_guideInfo['gServerCity'],
                    "guidestar"=>$row_guideInfo['gStars']
                );
                Response::json(1, "Login Success", $data);
            }
        }
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
            "password" => "error password",
            "guiderealname"=>"error password",
            "guideIDnumbr"=>"error password",
            "guideNumber"=>"error password",
            "guideservercity"=>"error password",
            "guidestar"=>"error password"
        );
        Response::json(0, "Password incorrect", $data);
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
        "password" => "empty telephone",
        "password" => "empty telephone",
        "guiderealname"=>"empty telephone",
        "guideIDnumbr"=>"empty telephone",
        "guideNumber"=>"empty telephone",
        "guideservercity"=>"empty telephone",
        "guidestar"=>"empty telephone"
    );
    Response::json(0, "Account doesn't exist", $data);
}
$conn->close();






