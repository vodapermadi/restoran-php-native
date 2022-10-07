<?php

include("../../config.php");
session_start();
if ($_SESSION["user"] == "") {
    header("location: ./index.php");
}

$id = (int)$_SESSION["id_user"];

$carts = mysqli_query($connection, "SELECT * FROM tb_cart
        INNER JOIN tb_menu ON tb_menu.id_menu = tb_cart.id_menu
        INNER JOIN tb_user ON tb_user.id_user = tb_cart.id_user
        ORDER BY id_cart DESC
    ");

if (isset($_POST["export_id_cart"]) and isset($_POST['total']) and isset($_POST["menu"]) ) {
    $array_id = $_POST["export_id_cart"];
    $array_menu = $_POST["menu"];
    $array_total = $_POST["total"];
    for ($i = 0; $i < count($array_id); $i++) {
        $date = date('Y-m-d');
        $id_cart_loop = (int)$array_id[$i];
        $menu_loop = $array_menu[$i];
        $total_loop = (int)$array_total[$i];

        // var_dump($id,$menu_loop,$total_loop,$date);
        
        mysqli_query($connection,"INSERT INTO tb_transaksi VALUES('','$id','$menu_loop','$total_loop','0','$date')");
        mysqli_query($connection,"DELETE FROM tb_cart WHERE id_user = $id");
    }
    echo"
    <script>
        alert('pesanan sedang di buat silahkan bayar di kasir')
        document.location.href = 'cart.php'
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
            <a href="../user/user-index.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Home</a>
            <a href="./user-menu.php" class="font-bold text-lg font-sans mr-4 hover:underline hover:underline-offset-8">Menu</a>
            <a href="cart.php" class="font-bold text-lg mr-4 hover:underline hover:underline-offset-8">Cart</a>
        </div>
        <div>
            <a href="../auth/logout.php" onclick="return confirm('yakin ingin logout?')" class="font-bold text-lg font-sans hover:underline hover:underline-offset-8 text-white">Logout</a>
        </div>
    </nav>
    <div class="container w-full h-full flex justify-center items-center">
        <div class="w-full h-full flex flex-col justify-start items-start">
            <h1 class="font-bold text-xl">Keranjang <?php $_SESSION["user"]; ?></h1>
            <table class="table-auto text-center w-full my-4 shadow-lg">
                <thead>
                    <tr class="text-lg">
                        <th class="w-1/5 border-b-2 border-r-2 py-2 border-gray-500">Menu</th>
                        <th class="w-1/5 border-b-2 border-r-2 py-2 border-gray-500">Harga</th>
                        <th class="w-1/5 border-b-2 border-r-2 py-2 border-gray-500">Jumlah</th>
                        <th class="w-1/5 border-b-2 border-r-2 py-2 border-gray-500">Total</th>
                        <th class="w-1/5 border-b-2 border-r-2 py-2 border-gray-500">Action</th>
                    </tr>
                </thead>
                <form method="post" action="" class="w-full h-full">
                    <?php while ($row = mysqli_fetch_assoc($carts)) : ?>
                        <?php if ($row["id_user"] == $id) { ?>
                            <tbody>
                                <tr>
                                    <input type="checkbox" name="export_id_cart[]" value="<?= $row["id_cart"] ?>" checked hidden>
                                    <input type="checkbox" name="total[]" value="<?= $row["total"] ?>" checked hidden>
                                    <input type="checkbox" name="menu[]" value="<?= $row["name"] ?>" checked hidden>
                                    <td class="py-2 border-b-2 border-r-2 border-gray-500 font-semibold text-lg"><?= $row["name"] ?></td>
                                    <td class="py-2 font-semibold border-b-2 border-r-2 text-lg border-gray-500 ">Rp<?= $row["price"] ?></td>
                                    <td class="py-2 font-semibold border-b-2 border-r-2 text-lg border-gray-500 "><?= $row["quantity"] ?>/pcs</td>
                                    <td class="py-2 font-semibold border-b-2 border-r-2 text-lg border-gray-500 ">Rp<?= $row["total"] ?></td>
                                    <td class="py-2 font-semibold border-b-2 border-r-2 text-lg border-gray-500 ">
                                        <a href="delete-cart.php?id=<?= $row["id_cart"] ?>" class="text-red-700 hover:text-red-800 duration-300">
                                            delete
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    <?php endwhile ?>
                    <div class="w-full h-full flex justify-end items-end mb-2">
                        <button class="py-2 px-6 bg-green-500 hover:bg-green-600 duration-300 rounded font-bold text-lg text-white" name="transaction" type="submit">
                            Pesan
                        </button>
                    </div>
                </form>
            </table>
        </div>
    </div>

</body>

</html>