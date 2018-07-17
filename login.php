<?php
require_once "func.php";

//
//if (haslogedin() )
//    header("Location: index.php");

//print_r($_POST);
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userName = $_POST["username"] . "";
        $password = $_POST["password"] . "";
//    if ($userName != null && $password != null){
//        $users = getdatabase();
        if ($userName == "ComputerNovin" && $password == "COMP31824") {

            echo "hey";
            setcookie("userName", "ComputerNovin", time() + (86400 * 30 * 12));
            setcookie("password", "COMP31824", time() + (86400 * 30 * 12));
            header("Location: index.php");
            die();

        }

//    }
    }
}catch (Exception $e){
    die($e->getMessage());
}
//
//if ($_SERVER["REQUEST_METHOD"] == "POST"){
//    $userName = $_POST['username'];
//    $password = $_POST['password'];
////    print_r($_POST);
//    if ($userName != null && $password != null){
//        $users = getdatabase();
//        if ( $users[$userName] == $password ){
//
//            $_SESSION['username'] = $userName;
//            header("Location: index.php");
//            die();
//        }
//
//    }
//}


require "views\login.view.php";
