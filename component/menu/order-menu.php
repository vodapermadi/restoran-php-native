<?php

include("../../config.php");
session_start();
$id = $_GET["id"];
if ($_SESSION["kasir"] == "") {
    header('location: ../user/index.php');
}

$show_menu = mysqli_query($connection, "SELECT * FROM tb_menu WHERE id_menu = $id");
$row = mysqli_fetch_assoc($show_menu);
$count;

function countPrice($price, $n)
{
    if($n > 0){
        return $price * $n;
    }else{
        $n += 1;
        return $price * $n;
    }
}

if(isset($_POST["bayar"])){
    echo "
    <script>
        alert('pembayaran selesai')
        document.location.href = 'menu-kasir.php'
    </script>
    ";
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
    <nav class="w-full h-16 mb-8 bg-gray-700 flex justify-between items-center px-5">
        <div class="text-white">
            <a href="../kasir/index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Home</a>
            <a href="./menu-kasir.php" class="font-bold text-lg font-sans mr-4 hover:underline hover:underline-offset-8">Menu</a>
        </div>
        <div>
            <a href="../auth/logout.php" onclick="return confirm('yakin ingin logout?')" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 text-white">Logout</a>
        </div>
    </nav>
    <div class="container w-full h-full flex justify-center items-center">
        <div class="grid grid-cols-4 w-1/2 border">
            <div class="flex flex-col py-2 col-span-2 px-4 border rounded-lg bg-gray-500">
                <img src="../../img/menu/<?= $row["image_menu"] ?>" class="my-2 rounded-lg" alt="">
                <div class="flex flex-col my-4 h-full justify-center items-start">
                    <span class="text-white font-bold text-lg"><?= $row["name"] ?></span>
                    <span class="text-white font-bold text-lg">Price : Rp<?= $row["price"] ?></span>
                </div>
            </div>
            <div class="col-span-2 border flex justify-center items-center flex-col">
                <form action="" method="post" class="flex flex-col">
                    <input type="number" name="counting" id="" class="py-2 px-4 font-semibold text-lg outline-none rounded-lg" placeholder="Jumlah Pembelian" value="1">
                    <span class="text-lg font-semibold py-2 px-4 text-gray-700">
                        Hasil : Rp
                        <?php
                        if(isset($_POST["submit"])){
                            echo countPrice($row["price"],$_POST["counting"]);
                        }else{
                            "";
                        }
                        ?>
                    </span>
                    <div class="flex justify-center w-full items-center">
                        <button type="submit" name="submit" class="py-2 w-1/2 px-4 text-center bg-green-500 hover:bg-green-600 duration-300 text-lg mr-1 text-white my-2 font-semibold rounded-lg">Jumlah</button>
                        <button type="submit" name="bayar" onsubmit="buySuccess()" class="py-2 px-4 w-1/2 text-center bg-sky-500 hover:bg-sky-600 duration-300 text-white font-semibold rounded-lg text-lg">Bayar</button><br>
                    </div>
                    <div class="w-full flex justify-center items-center">
                        <a href="./menu-kasir.php" class="py-2 px-4 w-full text-center bg-red-500 hover:bg-red-600 duration-300 text-white font-semibold rounded-lg text-lg">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>