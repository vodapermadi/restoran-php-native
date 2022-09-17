<?php

include("../../config.php");
session_start();
if ($_SESSION["admin"] == "") {
    header('location: ../user/index.php');
}
$id = $_GET["id"];

function deleteUser($id){
    global $connection;
    mysqli_query($connection,"DELETE FROM tb_user WHERE id_user = $id");
    return mysqli_affected_rows($connection);
}

if(deleteUser($id) > 0){
    header("location: index-user.php");
}

?>