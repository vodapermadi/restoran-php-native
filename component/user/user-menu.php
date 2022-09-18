<?php

include("../../config.php");
session_start();
if($_SESSION["user"] == ""){
    header("location: index.php");
}
$show_menu = mysqli_query($connection,"SELECT * FROM tb_menu");

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
            <a href="../user/user-index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Home</a>
            <a href="./menu-kasir.php" class="font-bold text-lg font-sans mr-4 hover:underline hover:underline-offset-8">Menu</a>
        </div>
        <div>
            <a href="../auth/logout.php" onclick="return confirm('yakin ingin logout?')" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 text-white">Logout</a>
        </div>
    </nav>
    <div class="container w-full h-full grid grid-cols-4 gap-4">
        <?php while($row = mysqli_fetch_assoc($show_menu)) : ?>
            <div class="flex flex-col py-2 px-4 border rounded-lg bg-gray-700">
                <img src="../../img/menu/<?= $row["image_menu"] ?>" class="my-2 rounded-lg" alt="">
                <div class="flex flex-col my-4 h-full justify-center items-start">
                    <span class="text-white font-bold text-lg"><?= $row["name"] ?></span>
                    <span class="text-white font-bold text-lg">Price : Rp<?= $row["price"] ?></span>
                </div>
            </div>
        <?php endwhile?>
    </div>

</body>
</html>