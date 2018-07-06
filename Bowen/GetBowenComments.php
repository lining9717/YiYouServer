<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 16:42
 */

require_once ('Connect.php');

$bowenId = $_POST['bowenId'];

$sql_get_comments = "select * from comment where cBowenId = $bowenId";
$result_get_comments = $conn->query($sql_get_comments);
if($result_get_comments->num_rows>0){
    $data = array();
    while($row=$result_get_comments->fetch_assoc()){
        $info=array(
            "content"=>$row['cContent'],
            "usernickname"=>$row['cUserNickName'],
            "time"=>$row['cTime'],
            "userHeadicon"=>$row['cUserHeadIcon'],
        );
        array_push($data,$info);
    }
    Response::json(1,"Get comments success",$data);
}else{
    Response::json(0,"No comments","");
}
$conn->close();