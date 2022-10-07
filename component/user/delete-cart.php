<?php

include("../../config.php");
$id = $_GET["id"];

function deleteCart($id){
    global $connection;
    mysqli_query($connection,"DELETE FROM tb_cart WHERE id_cart = $id");
    return mysqli_affected_rows($connection);
}

if(deleteCart($id) > 0){
    echo"
    <script>
        document.location.href = 'cart.php'
    </script>
    ";
}

?>