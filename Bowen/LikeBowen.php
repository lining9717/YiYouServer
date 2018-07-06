<?php
/**
 * Created by PhpStorm.
 * User: lining
 * Date: 2018/7/6
 * Time: 8:43
 */

require_once('Connect.php');

$bowenId = $_POST['bowenId'];

$sql_like_bowen="select bZanNumber from bowen where bId = $bowenId";
$result_like_bowen = $conn->query($sql_like_bowen);
if($result_like_bowen->num_rows>0){
    $row_lick_bowen=$result_like_bowen->fetch_assoc();
    $likes = (int)($row_lick_bowen['bZanNumber']);
    $likes++;
    $sql_update_likes = "update bowen set 
                         bZanNumber = $likes
                         where bId = $bowenId";
    if ($conn->query($sql_update_likes) === TRUE) {
        Response::json(1,"Like bowen success","");
    } else {
        Response::json(0,"Like fail in server ".$conn->error,"");
    }
}else{
    Response::json(0,"Get blog error: ".$conn->error,"");
}
$conn->close();