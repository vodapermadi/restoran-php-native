<?php

include("../../config.php");
session_start();
if ($_SESSION["admin"] == "") {
    header('location: ../user/index.php');
}

$show_user = mysqli_query($connection,"SELECT * FROM tb_user");

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
            <a href="../admin/index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Home</a>
            <a href="../menu/menu-admin.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Menu</a>
            <a href="./index-user.php" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8">User</a>
        </div>
        <div>
            <a href="../auth/logout.php" onclick="return confirm('yakin ingin logout?')" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 text-white">Logout</a>
        </div>
    </nav>
    <div class="container w-full h-full grid grid-cols-4 gap-4">
        <?php while ($row = mysqli_fetch_assoc($show_user)) : ?>
            <?php if($row["level"] === "admin"){ ?>
            <div class="flex flex-col py-2 px-4 border rounded-lg bg-gray-700">
                <div class="flex flex-col my-4 h-full justify-center items-start">
                    <span class="text-white font-bold text-lg">Username : <?= $row["username"] ?></span>
                    <span class="text-white font-bold text-lg">Status : <?= $row["level"] ?></span>
                </div>
                <div class="flex h-full items-end flex-row">
                    <a href="update-user.php?id=<?= $row["id_user"] ?>" class="text-white text-center py-2 px-4 bg-sky-600 hover:bg-sky-700 duration-300 font-bold text-lg mr-3 rounded w-full">Edit Profil</a>
                </div>
            </div>
            <?php }?>
            <?php if($row["level"] === "kasir" or $row["level"] === "user" ) {?>
            <div class="flex flex-col py-2 px-4 border rounded-lg bg-gray-700">
                <div class="flex flex-col my-4 h-full justify-center items-start">
                    <span class="text-white font-bold text-lg">Username : <?= $row["username"] ?></span>
                    <span class="text-white font-bold text-lg">Status : <?= $row["level"] ?></span>
                </div>
                <div class="flex justify-end h-full items-end flex-row">
                    <a href="update-user.php?id=<?= $row["id_user"] ?>" class="text-white py-2 px-4 bg-sky-600 hover:bg-sky-700 duration-300 font-bold text-lg mr-3 rounded">Edit</a>
                    <a href="delete-user.php?id=<?= $row["id_user"] ?>" onclick="return confirm('ingin hapus data ini?')" class="text-white py-2 px-4 bg-red-600 hover:bg-red-700 duration-300 font-bold text-lg rounded">Delete</a>
                </div>
            </div>
            <?php } ?>
        <?php endwhile ?>
    </div>
</body>

</html>