<?php

include "../../config.php";
session_start();

$transactions = mysqli_query($connection,
    "SELECT * FROM tb_transaksi
    INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id_user
    ORDER BY status ASC,id_transaksi DESC"
);

function changeStatus($data)
{
    global $connection;

    $id_transaksi = $data["id_transaksi"];
    mysqli_query($connection,"UPDATE tb_transaksi SET status = '1' WHERE id_transaksi = '$id_transaksi'");
    return mysqli_affected_rows($connection);
}

if(isset($_POST["submit"]))
{
    if(changeStatus($_POST) > 0)
    {
        header("location:index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../dist/output.css">
</head>

<body class="w-full flex flex-col justify-center items-center bg-yellow-300 select-none">
    <nav class="w-full h-16 mb-8 bg-gray-700 flex justify-between items-center px-5 bg-fixed">
        <div class="text-white">
            <a href="../kasir/index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Home</a>
            <a href="../transaksi/index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Transaksi</a>
        </div>
        <div>
            <a href="../auth/logout.php" onclick="return confirm('yakin ingin logout?')" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 text-white">Logout</a>
        </div>
    </nav>
    <div class="container flex justify-center items-center flex-col">
        <?php while ($row = mysqli_fetch_assoc($transactions)) : ?>
            <div class="w-2/3 h-full flex flex-col p-10 border rounded-lg bg-gray-700 mb-5">
                <div class="flex flex-row text-center mb-2">
                    <span class="font-bold text-xl text-white">Pembeli</span>&nbsp;
                    <span class="font-bold text-xl text-white">:</span>&nbsp;
                    <span class="font-bold text-xl text-white"> <?= $row["username"] ?></span>
                </div>
                <div class="flex flex-row text-center mb-2">
                    <span class="font-bold text-xl text-white">Menu</span>&nbsp;
                    <span class="font-bold text-xl text-white">:</span>&nbsp;
                    <span class="font-bold text-xl text-white"><?= $row["menu"] ?></span>
                </div>
                <div class="flex flex-row text-center mb-2">
                    <span class="font-bold text-xl text-white">Total</span>&nbsp;
                    <span class="font-bold text-xl text-white">:</span>&nbsp;
                    <span class="font-bold text-xl text-white">Rp <?= $row["total"] ?></span>
                </div>
                <div class="flex flex-row text-center mb-2">
                    <span class="font-bold text-xl text-white">Status</span>&nbsp;
                    <span class="font-bold text-xl text-white">:</span>&nbsp;
                    <?php
                    if ($row["status"] == '0') {
                        echo "
                        <span class='font-bold text-xl text-red-500' >
                            Belum Bayar
                        </span>
                        ";
                    } else {
                        echo "
                        <span class='font-bold text-xl text-green-500'>
                            Lunas
                        </span>
                        ";
                    }
                    ?>
                </div>
                <form action="" method="post" class="flex flex-row justify-end items-end -mb-2 mt-2">
                    <input type="hidden" name="id_transaksi" value="<?= $row["id_transaksi"] ?>">
                    <button name="submit" class="py-2 px-4 bg-green-600 font-semibold text-white text-lg rounded hover:bg-green-700 duration-300">Bayar</button>
                    <a href="delete.php?id-transaksi=<?= $row["id_transaksi"] ?>" class="py-2 px-4 bg-red-600 font-semibold text-white text-lg rounded hover:bg-red-700 duration-300 ml-2" onclick="return confirm('ingin menghapus transaksi?')">Delete</a>
                </form>
            </div>
        <?php endwhile ?>
    </div>
</body>

</html>