<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">

    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        body{
            padding:20px 20px;
        }

        .results tr[visible='false'],
        .no-result{
            display:none;
        }

        .results tr[visible='true']{
            display:table-row;
        }

        .counter{
            padding:8px;
            color:#ccc;
        }
    </style>
    <title>حسابداری</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
<div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="جستجو...">
</div>
<span class="counter pull-right"></span>
<form action="accounting.php" method="post">
<table class="table table-hover table-bordered results">
    <thead>
    <tr>
        <th>#</th>
        <th class="col-md-2 col-xs-2">سرویس</th>
        <th class="col-md-2 col-xs-2">شماره تلفن</th>
        <th class="col-md-2 col-xs-2">مبلغ</th>
        <th class="col-md-2 col-xs-2">سریال</th>
        <th class="col-md-2 col-xs-2">تاریخ</th>
        <th class="col-md-2 col-xs-2">بانک</th>

        <th>-</th>
    </tr>
    <tr class="warning no-result">
        <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr>
    </thead>
    <tbody>
    <tr>
<!--        <th scope="row">1</th>-->
<!--        <th scope="row">1</th>-->
<!--        <td>Vatanay Özbeyli</td>-->
        <?php
        $table = getJointedtables("call_information","panel_registeration");
//        print_r($table);
            foreach ($table as $row){
                echo "<tr>";
                echo "<th>".$row->id."</th>";
                echo "<td>".getservice("services",$row->service_id)."</td>";
                echo "<td>".$row->user_num."</td>";
                echo "<td>".$row->deposit."</td>";
                echo "<td>".$row->serial."</td>";
                echo "<td>".$row->deposit_date."</td>";
                echo "<td>".getdata("bank",$row->bank)."</td>";
                echo "<td>"."<input type=\"checkbox\" name=\"".$row->id."\">"."</td>";
                echo "</tr>";

            }

        ?>
    </tr>
    </tbody>
</table>

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

<script>
    $(document).ready(function() {
        $(".search").keyup(function () {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
            });

            $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','false');
            });

            $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','true');
            });

            var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

            if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
        });
    });
</script>
</body>
</html>