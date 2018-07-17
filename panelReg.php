<?php
require_once "func.php";

haslogedin();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
//    if (empty($_POST)){deposit_type
    if ($_POST["isp"] != "" && $_POST["agent"] != "" && $_POST["serial"] != "" && $_POST["operator"] != "" && $_POST["deposit_type"] != "" ) {
        addPanelReg($_POST, getdatabase());

    }else {
        $txt = "فیلد های الزامی را پر کنید";
        echo "<div class=\"container\"><div class=\"row\"><div class=\"col-lg-8 col-lg-offset-2\">";
        echo "<div class=\"alert alert-danger\">" . $txt . "</div>";
        echo "</div></div></div>";
    }

//    }
}

require "views/panelReg.view.php";

