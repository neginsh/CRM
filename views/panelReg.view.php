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
            <form action="panelReg.php" method="post">

                <h2>ثبت پنل</h2>
                <hr>
                <div class="form-group">
                    <label for="deposit_type">تراکنش :</label>
                    <select class="form-control" id="deposit_type" name="deposit_type">
                        <?php
                        $bank = gettable("deposit_type");
                        foreach ($bank as $item) {
                            echo "<option>";
                            echo $item->id ." | ".$item->name ;
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="isp">isp :</label>
                    <select class="form-control" id="isp" name="isp">
                        <?php
                        $bank = gettable("isp");
                        foreach ($bank as $item) {
                            echo "<option>";
                            echo $item->id ." | ".$item->name ;
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="agent">نماینده :</label>
                    <select class="form-control" id="agent" name="agent">
                        <?php
                        $bank = gettable("agents");
                        foreach ($bank as $item) {
                            echo "<option>";
                            echo $item->id ." | ".$item->name ;
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="serial">سریال :</label>
                    <input type="text" name="serial" class="form-control">
                </div>
                <div class="form-group">
                    <label for="comment">توضیحات :</label>
                    <input type="text" name="comment" class="form-control">
                </div>
                <div class="form-group">
                    <label for="operator">اپراتور :</label>
                    <select class="form-control" id="operator" name="operator">
                        <?php
                        $operator = gettable("operators");
                        foreach ($operator as $item) {
                            echo "<option>";
                            echo $item->id ." | ".$item->name ;
                            echo "</option>";
                        }
                        ?>
                    </select>
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