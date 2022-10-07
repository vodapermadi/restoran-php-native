<?php

include "../../config.php";
session_start();
$id = $_GET["id-transaksi"];

mysqli_query($connection,"DELETE FROM tb_transaksi WHERE id_transaksi = $id");
echo"
<script>
    alert('data transaksi berhasil di hapus')
    document.location.href = 'index.php'
</script>
";

?>