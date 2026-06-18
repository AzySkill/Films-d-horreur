<?php

$db_username = 'test@mail.com';
$db_password = '$2y$10$8OwCd4CVJwhNsV84FATn3.TxrC8EKssQhIZHG7FJ.oo2/EaeqdFUG';
$user_name = 'Test';
$user_initial = 'T';

$db_username2 = 'alekssaliaj03@gmail.com';
$db_password2 = '$2y$10$px8LEvVa.Ewe.0R.P/tW5O6mHS.03wHrsuAnBOLn4AwFKMt.y8QdK';
$user_name2 = 'Aleks';
$user_initial2 = 'A';

if(
    ($db_username === $_POST['username'] && $db_password === $_POST['password'])
){
    session_start();
    $_SESSION['is_connected'] = $_POST['username'];
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_initial'] = $user_initial;
    header('Location: admin-dashboard.php');
}elseif(
    ($db_username2 === $_POST['username'] && $db_password2 === $_POST['password'])
){
    session_start();
    $_SESSION['is_connected'] = $_POST['username'];
    $_SESSION['user_name'] = $user_name2;
    $_SESSION['user_initial'] = $user_initial2;
    header('Location: admin-dashboard.php');
}else{
    header('Location: login.php?error=1');
}

?>