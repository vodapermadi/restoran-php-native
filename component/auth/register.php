<?php

include('../../config.php');
function register($data){
    global $connection;

    $username = $data["username"];
    $password = $data["password"];
    $status = $data["status"];
    
    // check username
    $name = mysqli_query($connection,"SELECT * FROM tb_user WHERE username = '$username'");
    if(mysqli_fetch_assoc($name)){
        echo "
        <script>
            alert('username sudah terpakai')
        </script>
        ";
        return false;
    }

    // add data to database
    mysqli_query($connection,"INSERT INTO tb_user VALUES (
        '',
        '$username',
        '$password',
        '$status'
        )
    ");

    return mysqli_affected_rows($connection);
}

if(isset($_POST["submit"])){
    if(register($_POST) > 0){
        echo"
        <script>
            alert('data berhasil di tambahkan')
            document.location.href = '../user/index.php'
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
    <title>Register | Page</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <link rel="shortcut icon" href="./../img/logo1.png" type="image/x-icon">
</head>
<body class="bg-gray-800">
    <div class="w-full h-screen flex justify-center items-center">
        <form method="post" action="" class="w-1/3 h-2/3 border border-gray-200 rounded-lg flex flex-col items-center py-4 bg-yellow-300">
            <img src="../../img/logo2.png" alt="" class="pt-8 pb-4 mt-4">
            <input type="hidden" name="status" value="user">
            <div class="py-2 w-2/3">
                <input type="text" name="username" id="" placeholder="Username" class="w-full py-3 px-2 font-semibold focus:outline-none rounded">
            </div>
            <div class="py-2 w-2/3">
                <input type="password" name="password" id="" placeholder="Password" class="w-full py-3 px-2 font-semibold focus:outline-none rounded">
            </div>
            <div class="py-2 w-2/3 justify-center items-center flex">
                <a href="../user/index.php" type="submit" class="bg-gray-800 mr-2 py-2 px-4 text-white font-bold text-lg rounded-lg hover:bg-gray-400 hover:scale-110 hover:text-black duration-300">
                    Back
                </a>
                <button type="submit" name="submit" class="bg-gray-800 py-2 px-4 text-white font-bold text-lg rounded-lg hover:bg-gray-400 hover:text-black hover:scale-110 duration-300">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>
</html>