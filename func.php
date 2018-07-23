<?php


function getdatabase()
{
    try{
        return $pdo = new PDO("mysql:host=localhost;dbname=CRM","root","");
    }catch (PDOException $e){
        die($e->getMessage());
    }
}
function gettable($table){
    $pdo = getdatabase();
    $statement = $pdo->prepare("SELECT * FROM $table LIMIT 93");
    $statement->execute();
    $services = $statement->fetchAll(PDO::FETCH_OBJ);
    return $services;
}
function getJointedtables($table1,$table2){
    $pdo = getdatabase();
    $statement = $pdo->prepare("SELECT $table1.id,$table1.service_id,$table1.user_num,$table1.deposit,$table2.serial,$table1.deposit_date,$table1.bank
FROM $table1
JOIN $table2 ON $table1.id = $table2.id WHERE $table2.isaccounted = 0");
    $statement->execute();
    $services = $statement->fetchAll(PDO::FETCH_OBJ);
//    print_r($services);
    return $services;
}
function getservice($table,$id){
    $pdo = getdatabase();
    $statement = $pdo->prepare("SELECT * FROM services WHERE id = $id ORDER BY id DESC LIMIT 1");
    $statement->execute();
    $service = $statement->fetch(PDO::FETCH_OBJ);
    return $service->isp.$service->months. " ماه ".$service->speed." کیلوبیت ".$service->GB." گیگا بایت ";
}
function getdata($table,$id){

    $pdo = getdatabase();
    $statement = $pdo->prepare("SELECT * FROM bank WHERE id = $id ORDER BY id DESC LIMIT 1");
    $statement->execute();
    $service = $statement->fetch(PDO::FETCH_OBJ);
    return $service->name;
}
function addCallInfo($post , $conn){
    session_start();

    try {
        $service_id = substr($post["service"], 0, 1);
        $user_num = $post["user_num"];
        if (array_key_exists("ip",$post)) $ip = 1;
        else $ip = 0;
        $deposit = $post["deposit"];
        $bank = substr($post["bank"], 0, 1);
        $credit_card = $post["credit_card"];
        $deposit_date = $post["deposit_date"];
        $phone_num = $post["phone_num"];
        $operator_id = substr($post["operator"], 0, 1);

        $statment = $conn->prepare("INSERT INTO call_information (call_date,service_id,user_num,ip,deposit,bank,credit_card,deposit_date,phone_num,operator_id)
                                VALUES(TIMESTAMP(curdate(), curtime()),:service_id,:user_num,:ip,:deposit,:bank,:credit_card,:deposit_date,$phone_num,:operator_id)");


        $statment->bindParam("service_id", $service_id);

        $statment->bindParam("user_num", $user_num);

        $statment->bindParam("ip", $ip);

        $statment->bindParam("deposit", $deposit);

        $statment->bindParam("bank", $bank);

        $statment->bindParam("deposit_date", $deposit_date);

        $statment->bindParam("credit_card", $credit_card);

//        $statment->bindParam("phone_num", $phone_num);

        $statment->bindParam("operator_id", $operator_id);

//    $date = date("Y-m-d H:i:s");


        $statment->execute();

        $statement = $conn->prepare("SELECT * FROM call_information ORDER BY ID DESC LIMIT 1");
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_OBJ);
        $_SESSION["id"] = $row->id;

//        echo "done";
    }catch (Exception $e){
        die($e->getMessage());
    }

}
function addPanelReg($post,$conn){
    session_start();

    try {
        $id = $_SESSION["id"];
        $deposit_type = substr($post["deposit_type"], 0, 1);
        $isp_id = substr($post["isp"], 0, 1);
        $agent_id = substr($post["agent"], 0, 1);
        $serial = $post["serial"];
        $comment = $post["comment"];
        $operator_id = substr($post["operator"], 0, 1);

        $statment = $conn->prepare("INSERT INTO panel_registeration (id,isp_id,agent_id,serial,comment,operator_id,isaccounted,deposit_type)
                                VALUES($id,:isp_id,:agent_id,:serial,:comment,:operator_id,0,:deposit_type)");


        $statment->bindParam("isp_id", $isp_id);

        $statment->bindParam("agent_id", $agent_id);

        $statment->bindParam("serial", $serial);

        $statment->bindParam("deposit_type", $deposit_type);

        $statment->bindParam("comment", $comment);

        $statment->bindParam("operator_id", $operator_id);

//    $date = date("Y-m-d H:i:s");


        $statment->execute();


//        echo "done";
    }catch (Exception $e){
        die($e->getMessage());
    }

}
function addservice($post,$conn){
    session_start();

    try {

        $month = $post["month"];
        $GB = $post["GB"];
        $speed = $post["speed"];
        $price = $post["price"];
        $isp = $post["isp"];


        $statment = $conn->prepare("INSERT INTO services (isp,months,GB,speed,price)
                                VALUES(:isp,:months,:GB,:speed,:price)");


        $statment->bindParam("isp", $isp);

        $statment->bindParam("speed", $speed);

        $statment->bindParam("GB", $GB);

        $statment->bindParam("months", $month);

        $statment->bindParam("price", $price);


//    $date = date("Y-m-d H:i:s");


        $statment->execute();


//        echo "done";
    }catch (Exception $e){
        die($e->getMessage());
    }

}

function addAccounting($post,$conn){


    try {

        for ($i = 0; $i < 500 ; $i++){
            if (array_key_exists("$i",$post)) break;
        }


        $id = $i;

        $comment = $post["comment"];

        $operator_id = substr($post["operator"], 0, 1);

        $statment = $conn->prepare("INSERT INTO accounting (id,operator_id,comment)
                                VALUES(:id,:operator_id,:comment)");

        $statment->bindParam("id", $id , PDO::PARAM_INT);

        $statment->bindParam("comment", $comment);

        $statment->bindParam("operator_id", $operator_id);

//    $date = date("Y-m-d H:i:s");


        $statment->execute();

        $statment = $conn->prepare("UPDATE panel_registeration
SET isaccounted=1
WHERE id=$id ");
        $statment->execute();


        echo "done";
    }catch (Exception $e){
        die($e->getMessage());
    }
}
function haslogedin(){
//    var_dump(isset($_COOKIE[""])) ;
    if (isset($_COOKIE["userName"])  && isset($_COOKIE["password"] ) == 1){

//        var_dump($_COOKIE["password"] == "COMP31824" );


        if ( $_COOKIE["userName"] == "ComputerNovin" && $_COOKIE["password"] == "COMP31824" ){

            return true;
//            header("Location: index.php");

        }else header("Location: login.php");

    }else header("Location: login.php");
}
