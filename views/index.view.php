<?php
require_once "func.php";?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" dir="rtl">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <link id="datepickerTheme" href="style/persian-datepicker.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/locale/nl.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <title>CRM</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <form action="index.php" method="post">

                <h2>CRM</h2>
                <hr>

                <div class="form-group">
                    <label for="user_num">شماره تلفن :</label>
                    <input type="text" name="user_num" class="form-control" onkeyup="showLast(this.value);">

                </div>

                <div id="lastPurchase">

                </div>
                <div class="form-group">
                    <label for="service">نوع سرویس</label>
                    <select class="form-control" id="service" name="service">
                        <option>-</option>
                        <option id="makeService">سرویس را دستی وارد کنید</option>
                        <?php
                        $services = gettable("services");
                        foreach ($services as $service) {
                            echo "<option>";
                            if ($service->months != "")
                                echo $service->id ." | ". $service->months . " ماه " . $service->speed . " کیلوبیت " . $service->GB . " گیگابایت " . $service->price . " ریال ";
                            else echo $service->id ." | ".$service->isp.$service->GB . " گیگابایت " . $service->price;
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="checkbox_label">ip</label>
                    <input type="checkbox" class="checkbox" name="ip">
                </div>
                <div class="form-group">
                    <label for="deposit">مبلغ</label>
                    <input type="text" name="deposit" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bank">بانک</label>
                    <select class="form-control" id="bank" name="bank">
                        <?php
                        $bank = gettable("bank");
                        foreach ($bank as $item) {
                            echo "<option>";
                            echo $item->id ." | ".$item->name ;
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="credit_card">۴ رقم اخر کارت :</label>
                    <input type="text" name="credit_card" class="form-control">
                </div>


                <div class="form-group">
                    <label for="deposit_date">زمان واریز : </label>
                    <div class="form-group">
                        <!--                        <input id="inputGroupAlt" type="text" class="form-control" placeholder="Alt Field"-->
                        <!--                               disabled>-->
                    </div>
                    <div class="form-group">
                        <div class="input-group datetimepicker">

                            <input id="inputGroupAlt2" type="text" class="form-control" placeholder="Alt Field" name="deposit_date">

                            <span id="inputGroup" class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="phone_num">شماره همراه :</label>
                    <input type="text" name="phone_num" class="form-control">
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
                    <button type="button" class="btn btn-link"><a href="accounting.php">حسابداری</a> </button>
                </div>

            </form>
        </div>
    </div>
    <script src="persian-date.min.js"></script>
    <script src="persian-datepicker.js"></script>

    <script type="text/javascript">
        var defaults = {
            calendarWeeks: true,
            showClear: true,
            showClose: true,
            allowInputToggle: true,
            useCurrent: false,
            ignoreReadonly: true,
            minDate: new Date(),
            toolbarPlacement: 'top',
            locale: 'nl',
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-angle-up',
                down: 'fa fa-angle-down',
                previous: 'fa fa-angle-left',
                next: 'fa fa-angle-right',
                today: 'fa fa-dot-circle-o',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        };

        


        $(document).ready(function () {


            $('#inputGroup').persianDatepicker({
                altField: '#inputGroupAlt,#inputGroupAlt2',
                altFormat: 'YYYY-MM-DD HH:mm:ss',
                calendar: {
                    persian: {
                        enabled: true,
                        locale: 'en',
                        leapYearMode: "algorithmic" // "astronomical"
                    },

                    gregorian: {
                        enabled: false,
                        locale: 'en'
                    }
                },
                timePicker: {
                    enabled: true
                }
            });

        });
    //    ajax for last purchase;


        function showLast(str) {

            if (str == "" ){
                document.getElementById("lastPurchase").innerHTML = "";
                return;


            }else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                        document.getElementById("lastPurchase").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("Post", "showlast.php?q=" + str, true);
                xmlhttp.send();
            }



        }



    </script>
</div>
</body>
</html>