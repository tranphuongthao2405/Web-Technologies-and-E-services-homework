<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Exercise 3.2</title>
</head>

<body>
    <?php
    // print display dates in letter
    function print_date($date)
    {
        $time = strtotime($date);
        $date = getdate($time);
        echo $date['weekday'], ', ', $date['month'], ' ', $date['mday'], ', ', $date['year'];
    }
    // Calculate the difference in days between two dates
    function sub_date($date1, $date2)
    {
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        echo (int)(abs($time2 - $time1) / 86400);
    }

    // Calculate the difference in years between two dates
    function sub_year($date1, $date2)
    {
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        $interval = $date1->diff($date2);
        echo $interval->y;
    }
    ?>

    <?php
    // form input
    function form_enter($name1, $birthday1, $name2, $birthday2)
    {
    ?>
        <div class="section1">
            <form action="week3.2.php" method="POST">
                <div>
                    <h1>First person: </h1>
                    <p>Name:</p>
                    <label><input type="text" name="name1" required value="<?php echo $name1 ?>" /></label>
                    <p>Birthday:</p>
                    <label><input placeholder="Date of birth" type="text" name="birthday1" onfocus="(this.type='date')" onblur="(this.type='text')" required value="<?php echo $birthday1 ?>" /></label>
                </div>
                <br>
                <div>
                    <h1>Second person:</h1>
                    <p>Name:</p>
                    <label><input type="text" name="name2" required value="<?php echo $name2 ?>" /></label>
                    <p>Birthday:</p>
                    <label><input placeholder="Date of birth" type="text" name="birthday2" onfocus="(this.type='date')" onblur="(this.type='text')" required value="<?php echo $birthday2 ?>" /></label>
                </div><br>
                <div class="center"><input type="submit" name="submit" value="Submit" /></div>
            </form>
        </div>

    <?php
    }
    // print result
    function confirm_form($name1, $birthday1, $name2, $birthday2)
    {
    ?>
        <div class="result">
            <div class="section">
                <h1>First people:</h1>
                <p>Name: <?php echo $name1 ?></p>
                <p>Birthday: <?php print_date($birthday1) ?></p>
                <p>Age: <?php sub_year($birthday1, date('Y-m-d')) ?></p>
            </div>
            <div class="section">
                <h1>Second people:</h1>
                <p>Name: <?php echo $name2 ?></p>
                <p>Birthday: <?php print_date($birthday2) ?></p>
                <p>Age: <?php sub_year($birthday2, date('Y-m-d')) ?></p>
            </div>
            <hr>
            <div class="section">
                <p>The difference in days between two dates: <?php sub_date($birthday1, $birthday2);
                                                                echo " days" ?></p>
                <p>The difference years between two persons: <?php sub_year($birthday1, $birthday2);
                                                                echo " years" ?></p>
            </div>
        </div>
    <?php
    }

    // check date
    function check_date($d1, $d2)
    {
        $date1 = array_map('intval', explode('-', $d1));
        $date2 = array_map('intval', explode('-', $d2));
        if (checkdate($date1[1], $date1[2], $date1[0]) && checkdate($date2[1], $date2[2], $date2[0])) {
            confirm_form($_POST['name1'], $_POST['birthday1'], $_POST['name2'], $_POST['birthday2'],);
        } else {
            echo "<p>Date is not validate!</p>";
            form_enter($_POST['name1'], $_POST['birthday1'], $_POST['name2'], $_POST['birthday2']);
        }
    }
    ?>
    <?php
    if (!isset($_POST['submit'])) {
        form_enter('', '', '', '');
    } else {
        check_date($_POST['birthday1'], $_POST['birthday2']);
    }
    ?>
</body>

</html>