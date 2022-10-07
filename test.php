<?php

include("./config.php");
$datas = mysqli_query($connection, "SELECT * FROM tb_cart INNER JOIN tb_menu ON tb_menu.id_menu = tb_cart.id_menu INNER JOIN tb_user ON tb_user.id_user = tb_cart.id_user");
// $data = mysqli_fetch_array($datas);
$menus = mysqli_query($connection, "SELECT * FROM tb_menu");
$users = mysqli_query($connection, "SELECT * FROM tb_user");

if (isset($_POST["id"])) {
    $array_id = [];
    $id_menu = $_POST["id"];
    for($i = 0; $i < count($id_menu); $i++){
        $data = array_push($array_id,$id_menu[$i]);
        // var_dump($array_id);
        return $data;
    }

    print_r($data);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="2" style="margin: 10px 12px;" cellpadding="5" cellspacing="2">
        <?php while ($row = mysqli_fetch_assoc($datas)) : ?>
            <tr>
                <td><?= $row["id_menu"] ?></td>
                <td><?= $row["name"] ?></td>
                <td><?= $row["username"] ?></td>
                <td><?= $row["quantity"] ?></td>
                <td><?= $row["total"] ?></td>
            </tr>
        <?php endwhile ?>
    </table>
    <form action="" method="post">
        <?php while ($row = mysqli_fetch_assoc($menus)) : ?>
            <input type="checkbox" name="id[]" id="" value="<?= $row["id_menu"] ?>" checked>
        <?php endwhile ?>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html>