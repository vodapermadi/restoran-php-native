<?php

include("../../config.php");
session_start();
if ($_SESSION["kasir"] == "") {
    header('location: ../user/index.php');
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
    <nav class="w-full h-16 bg-gray-700 flex justify-between items-center px-5 bg-fixed">
        <div class="text-white">
            <a href="index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Home</a>
            <a href="../menu/menu-kasir.php" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 mr-4">Menu</a>
        </div>
        <div>
            <a href="../auth/logout.php" onclick="return confirm('yakin ingin logout?')" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 text-white">Logout</a>
        </div>
    </nav>
    <div class="container flex justify-center items-center">
        <div class="border border-yellow-500 py-4 px-8 my-20 rounded bg-gray-500 animate-bounce hover:bg-gray-600 duration-300">
            <span class="font-bold text-xl text-white select-none">Welcome, <?= $_SESSION["kasir"]; ?></span>
        </div>
    </div>
    <div class="px-8 py-12 my-5 bg-gray-700">
        <div class="flex justify-start items-center w-full h-full">
            <div class="p-4 border border-yellow-500 w-1/2 bg-yellow-300 rounded-lg">
                <img src="../../img/restoran1.jpg" class="w-full" alt="">
            </div>
            <div class="p-8 w-1/2 ">
                <span class="font-semibold text-lg text-white">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique ipsum aut quasi quo inventore. Nisi perferendis rem quod commodi placeat obcaecati ullam aliquam at, error illo a autem quisquam labore? Minima, expedita consectetur. Libero natus minima sed consectetur ipsa. Libero voluptatem, ipsum quas tempora soluta quaerat laboriosam sint eligendi numquam!
                </span>
            </div>
        </div>
    </div>
    <div class="px-8 py-12 my-5">
        <div class="flex justify-center items-center w-full h-full">
            <div class="p-8 w-1/2">
                <span class="font-semibold text-lg">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa animi asperiores ea corrupti nulla eveniet, odit numquam tenetur reiciendis vero assumenda dolorem quis dignissimos officia eum odio nostrum laudantium veritatis quos fuga est. Possimus dignissimos exercitationem soluta. Consectetur iure iste laboriosam. Enim soluta, voluptatibus, a quae sequi in omnis repellat, inventore totam adipisci debitis magni quo. Saepe quisquam, mollitia, molestiae expedita facere libero fugiat exercitationem dolorem sequi magnam rem reiciendis! Maxime architecto voluptas sunt quis ratione dolorum consectetur accusantium blanditiis perspiciatis velit nostrum, inventore mollitia cupiditate! Atque totam accusantium libero recusandae laudantium id nam repudiandae ea sed? Aspernatur, repudiandae sapiente?
                </span>
            </div>
            <div class="p-4 border border-gray-700 w-1/2 bg-gray-800 rounded-lg">
                <img src="../../img/restoran2.jpg" class="h-1/2" alt="">
            </div>
        </div>
    </div>
    <div class="px-8 py-12 my-5 bg-gray-700">
        <div class="flex justify-start items-center w-full h-full">
            <div class="p-4 border border-yellow-500 w-1/2 bg-yellow-300 rounded-lg">
                <img src="../../img/restoran3.jpg" class="w-full" alt="">
            </div>
            <div class="p-8 w-1/2 ">
                <span class="font-semibold text-lg text-white">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique ipsum aut quasi quo inventore. Nisi perferendis rem quod commodi placeat obcaecati ullam aliquam at, error illo a autem quisquam labore? Minima, expedita consectetur. Libero natus minima sed consectetur ipsa. Libero voluptatem, ipsum quas tempora soluta quaerat laboriosam sint eligendi numquam!
                </span>
            </div>
        </div>
    </div>
    <div class="h-16 w-full bg-gray-800 flex justify-center items-center">
        <span class="font-bold text-xl text-white">
            Created By <a href="https://github.com/vodapermadi" class="underline underline-offset-8 hover:text-gray-400 duration-300">Voda Permadi</a>
        </span>
    </div>
</body>

</html>