<?php


require_once "func.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    addservice($_POST,getdatabase());
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel Registeration</title>
    <link rel="stylesheet" href="style/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <form action="add.php" method="post">

                <h2>ثبت پنل</h2>
                <hr>
                <div class="form-group">
                    <label for="isp">isp :</label>
                    <select class="form-control" id="isp" name="isp">

                        <option>sabanet</option>
                        <option>asiatech</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="month">ماه :</label>
                    <select class="form-control" id="month" name="month">
                        <option></option>

                        <option>1</option>
                        <option>3</option>
                        <option>6</option>
                        <option>12</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="speed">سرعت :</label>
                    <select class="form-control" id="speed" name="speed">
                        <option></option>
                        <option>512</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>8</option>
                        <option>16</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="GB">حجم :</label>
                    <input type="text" name="GB" class="form-control">

                </div>

                <div class="form-group">
                    <label for="price">قیمت :</label>
                    <input type="text" name="price" class="form-control">

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger" name="submit">ثبت</button>
                    <button type="button" class="btn btn-link"><a href="index.php">بازگشت</a> </button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
