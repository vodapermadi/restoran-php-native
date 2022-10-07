<?php

include('../../config.php');
session_start();
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //check username
    $user = mysqli_query($connection, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $data = mysqli_fetch_assoc($user);
    $data_id = $data["id_user"];
    if (mysqli_num_rows($user) === 1) {
        // check level
        if ($data["level"] == "admin") {
            $_SESSION["admin"] = $username;
            $_SESSION["id_admin"] = $data_id;
            echo "
            <script>
                document.location.href = '../admin/index.php'
                alert('berhasil login')
            </script>
            ";
        }else if($data["level"] == "kasir"){
            $_SESSION["kasir"] = $username;
            $_SESSION["id_kasir"] = $data_id;
            echo "
            <script>
                document.location.href = '../kasir/index.php'
                alert('berhasil login')
            </script>
            ";
        }else if($data["level"] == "user"){
            $_SESSION["user"] = $username;
            $_SESSION["id_user"] = $data_id;
            echo "
            <script>
                document.location.href = './user-index.php'
                alert('berhasil login')
            </script>
            ";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VodaResto</title>
    <link rel="shortcut icon" href="./img/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../../dist/output.css">
</head>

<body>
    <div class="w-full h-screen">
        <div class="flex justify-center items-center">
            <div class="w-3/5 h-screen bg-gray-900 flex justify-center items-center flex-col">
                <img src="../../img/pizza.jpg" alt="" class="w-2/3 rounded-lg">
                <div class="w-2/5 h-1/6 bg-gray-200 flex flex-col justify-center items-center mt-3 rounded-lg">
                    <span class="text-2xl font-bold font-mono text-gray-800">Welcome to VodaResto</span>
                    <span class="text-lg font-bold font-mono text-gray-800">the tastiest pizza in italy</span>
                </div>
            </div>
            <div class="w-2/5 h-screen bg-yellow-300 flex flex-col">
                <div class="header py-4 px-6 flex justify-end items-end">
                    <a href="../auth/register.php" class="bg-gray-800 py-2 px-4 text-white font-bold text-lg rounded-lg hover:bg-gray-400 hover:text-black duration-300 mx-2">Register</a>
                </div>
                <div class="body flex flex-col justify-center items-center w-full mt-10">
                    <div class="my-4">
                        <img src="../../img/logo2.png" alt="logo kedua">
                    </div>
                    <form action="" method="POST" class="w-1/2">
                        <div class="py-2 w-full flex flex-col justify-center items-center">
                            <input type="text" name="username" placeholder="Username" class="w-full py-3 px-2 font-semibold focus:outline-none rounded">
                        </div>
                        <div class="py-2 w-full flex flex-col justify-center items-center">
                            <input type="password" name="password" placeholder="Password" class="w-full py-3 px-2 font-semibold focus:outline-none rounded">
                        </div>
                        <div class="py-2 w-full flex flex-col justify-center items-center">
                            <button type="submit" name="submit" class="bg-gray-800 py-2 px-4 text-white font-bold text-lg rounded-lg hover:bg-gray-400 hover:text-black duration-300">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>