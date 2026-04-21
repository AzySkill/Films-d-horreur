<?php

$db_username = 'test@mail.com';
$db_password = '$2y$10$8OwCd4CVJwhNsV84FATn3.TxrC8EKssQhIZHG7FJ.oo2/EaeqdFUG';

$db_username2 = 'alekssaliaj03@gmail.com';
$db_password2 = '$2y$10$px8LEvVa.Ewe.0R.P/tW5O6mHS.03wHrsuAnBOLn4AwFKMt.y8QdK';

if(
    ($db_username === $_POST['username'] && $db_password === $_POST['password']) ||
    ($db_username2 === $_POST['username'] && $db_password2 === $_POST['password'])
){
    session_start();
    $_SESSION['is_connected'] = $_POST['username'];
    header('Location: dashboard.php');
}else{
    header('Location: login.php?error=1');
}

?>