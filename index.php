<?php
/**
 * Created by PhpStorm.
 * User: negin
 * Date: 7/12/2018
 * Time: 10:34
 */
require_once "func.php";

haslogedin();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($_POST["service"] != "" && $_POST["deposit"] != "" && $_POST["bank"] != "" && $_POST["deposit_date"] != "" && $_POST["operator"] != "" ) {
        if (strlen($_POST["user_num"]) == 8 && strlen($_POST["credit_card"]) == 4 && strlen($_POST["phone_num"]) == 10) {
            addCallInfo($_POST, getdatabase());
            header("Location: panelReg.php");
        } else {
            $txt = "طول شماره تلفن و کارت و شماره همراه را کنترل کنید";
            echo "<div class=\"container\"><div class=\"row\"><div class=\"col-lg-8 col-lg-offset-2\">";
            echo "<div class=\"alert alert-danger\">" . $txt . "</div>";
            echo "</div></div></div>";
        }
    }else {
        $txt = "فیلد های الزامی را پر کنید";
        echo "<div class=\"container\"><div class=\"row\"><div class=\"col-lg-8 col-lg-offset-2\">";
        echo "<div class=\"alert alert-danger\">" . $txt . "</div>";
        echo "</div></div></div>";
    }
}


//die;
    require "views\index.view.php";
?>