<?php

require_once "func.php";
//echo $_GET["str"];
$str = $_GET["q"];
$pdo = getdatabase();
$statement = $pdo->prepare("SELECT * FROM call_information WHERE user_num LIKE '%".$str."%' ORDER BY id DESC LIMIT 1");
$statement->execute();
$user = $statement->fetch(PDO::FETCH_OBJ);
if ($user != null) {
    $statement = $pdo->prepare("SELECT * FROM services WHERE id = $user->service_id ORDER BY id DESC LIMIT 1");
    $statement->execute();
    $service = $statement->fetch(PDO::FETCH_OBJ);

    echo "<table class=\"table table-hover table-bordered results\">
       <thead>
    <tr>
        <th class=\"col-md-2 col-xs-2\">شماره تلفن</th>
        <th class=\"col-md-2 col-xs-2\">سرویس</th>
        <th class=\"col-md-2 col-xs-2\">شماره همراه</th>
        <th class=\"col-md-2 col-xs-2\">تاریخ</th>
    </tr>
    </thead>
    ";


    echo "<tbody><tr>";

    echo "<th>" . $user->user_num . "</th>";
    echo "<td>" . $service->months . " ماه " . $service->speed . " کیلوبیت " . $service->GB . " گیگابایت</td>";
    echo "<td>" . $user->phone_num . "</td>";
    echo "<td>" . $user->call_date . "</td>";
    echo "</tr></tbody></table>";
}
//mysql_close($pdo);
die;
require "views\index.view.php";
