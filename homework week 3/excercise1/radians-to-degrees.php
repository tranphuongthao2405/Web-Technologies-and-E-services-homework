<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Radians to Degrees</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <?php
    // function to print the form
    function print_form($input, $result, $check_data)
    {
    ?>
        <h1>Radians to Degrees conversion calculator</h1>
        <?php
        if ($check_data == false)
            echo "<h2>Vui lòng kiểm tra lại dữ liệu</h2>";
        ?>
        <form action="radians-to-degrees.php" method="POST">
            <table class="calc2">
                <tbody>
                    <tr>
                        <td>
                            <p>Enter Radians:</p><input type="text" id="input" name="input" autofocus="" value="<?php echo $input ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><input type="button" id="pi" value="Click to add π" class="btn" onclick="setPI()"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Submit" />
                            <button type="button" title="Reset" onclick="reset()">Reset</button>
                            <button type="button" title="Swap conversion" onclick="location.href='degrees-to-radians.php';">Swap</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Degrees result:</p>
                            <textarea id="result" rows="4" readonly=""><?php echo $input ?>×180° / π = <?php echo $result ?>°</textarea>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </form>
    <?php
    }

    // convert from degrees value to radian value
    function radian_to_degree($input, $isPi)
    {
        if ($isPi)
            return round($input * 180, 5);
        else {
            return round($input * 180 / M_PI, 6);
        }
    }

    // check input data
    function check_data_number($input)
    {
        if (is_numeric($input) && $input >= 0) {
            return true;
        }
        return false;
    }

    // check input data comply with π? return -1 if not and return the number of π
    function check_data_Pi($input)
    {
        if ($input == 'π')
            return 1;
        $length = strlen($input);
        $endCharacter = substr($input, $length - 2, $length - 1);
        if ($length > 2 && $endCharacter == "π") {
            $value = substr($input, 0, $length - 2);
            try {
                if (is_numeric($value) == true)
                    return (int)$value;
                return -1;
            } catch (Exception $e) {
                return -1;
            }
        }
        return -1;
    }

    // check POST request
    if (!isset($_POST["submit"])) {
        print_form(0, 0, true);
    } else {
        $input = $_POST["input"];
        $isPi = check_data_Pi($input);
        $isNumber = check_data_number($input);

        if ($isPi != -1) {
            $result = radian_to_degree($isPi, true);
            print_form($input, $result, true);
        } else if ($isNumber) {
            $result = radian_to_degree($input, false);
            print_form($input, $result, true);
        } else
            print_form(0, 0, false);
    }
    ?>
    <script src="events.js"></script>
</body>

</html>