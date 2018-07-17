<?php

require_once "func.php";

haslogedin();

//print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["operator"] != "") {
//    if (empty($_POST)){
        addAccounting($_POST, getdatabase());
//    header("Location: panelReg.php");
    } else {
        $txt = "اپراتور را انتخاب کنید";
//    }

        echo "<div class=\"container\"><div class=\"row\"><div class=\"col-lg-8 col-lg-offset-2\">";
        echo "<div class=\"alert alert-danger\">" . $txt . "</div>";
        echo "</div></div></div>";
    }
}

//die;
require "views\accounting.view.php";
?>