<?php

include("../../config.php");
session_start();
if ($_SESSION["user"] == "") {
    header("location: index.php");
}

function createCart($data){
    global $connection;
    $id_user = $data["id_user"];
    $id_menu = $data["id_menu"];
    $quantity = $data["quantity"];
    $total = $quantity * $data["price"];

    mysqli_query($connection,"INSERT INTO tb_cart VALUES(
        '',
        '$id_menu',
        '$id_user',
        '$quantity',
        '$total'
    )");

    return mysqli_affected_rows($connection);
}

$show_menu = mysqli_query($connection, "SELECT * FROM tb_menu");

if(isset($_POST["add-to-cart"])){
    if(createCart($_POST) > 0 ){
        echo "
        <script>
            alert('keranjang di tambahkan')
            document.location.href = 'cart.php'
        </script>
        ";
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
    <nav class="w-full h-16 mb-8 bg-gray-700 flex justify-between items-center px-5">
        <div class="text-white">
            <a href="../user/user-index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Home</a>
            <a href="./user-menu.php" class="font-bold text-lg font-sans mr-4 hover:underline hover:underline-offset-8">Menu</a>
            <a href="cart.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Cart</a>
        </div>
        <div>
            <a href="../auth/logout.php" onclick="return confirm('yakin ingin logout?')" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 text-white">Logout</a>
        </div>
    </nav>
    <div class="container w-full h-full grid grid-cols-4 gap-4">
        <?php while ($row = mysqli_fetch_assoc($show_menu)) : ?>
            <form method="post" class="flex flex-col py-2 px-4 border rounded-lg bg-gray-700">
                <input type="hidden" name="id_user" value="<?= $_SESSION["id_user"] ?>">
                <input type="hidden" name="id_menu" value="<?= $row["id_menu"] ?>">
                <input type="hidden" name="price" value="<?= $row["price"] ?>">
                <img src="../../img/menu/<?= $row["image_menu"] ?>" class="my-2 rounded-lg" alt="">
                <div class="flex flex-col my-4 h-full justify-center items-start">
                    <span class="text-white font-bold text-lg"><?= $row["name"] ?></span>
                </div>
                <div class="w-full" >
                    <input type="number" name="quantity" id="" value="1" class="w-full text-center py-2 font-semibold text-gray-800 text-lg">
                </div>
                <div class="w-full my-3 flex justify-between">
                    <button type="submit" name="add-to-cart" class="w-1/2 bg-yellow-300 hover:bg-yellow-400 text-lg font-bold text-gray-900 duration-300 rounded-lg flex justify-center items-center">
                        Add to Cart
                    </button>
                    <span class="text-white font-bold text-lg py-2 ">Price : Rp<?= $row["price"] ?></span>
                </div>
            </form>
        <?php endwhile ?>
    </div>

</body>

</html>