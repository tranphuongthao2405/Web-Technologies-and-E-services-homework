<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Degrees to Radians</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <?php
    // function to print the form
    function print_form($degree, $result, $check_data)
    {
    ?>
        <h1>Degrees to Radians conversion calculator</h1>
        <?php
        if ($check_data == false)
            echo "<h2>Vui lòng kiểm tra lại dữ liệu</h2>";
        ?>
        <form autocomplete="off" action="degrees-to-radians.php" method="POST">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p>Enter Degrees:</p><input type="text" id="input" name="input" autofocus="" value="<?php echo $degree ?>">
                        </td>
                        <td>°</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Submit" />
                            <button type="button" title="Reset" onclick="reset()">Reset</button>
                            <button type="button" title="Swap conversion" onclick="location.href='radians-to-degrees.php' ;">Swap</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Radians result:</p>
                            <textarea id="result" rows="4" value="<?php echo $result ?>"><?php echo $degree ?>° × π / 180° = <?php echo round($result, 5) ?>π rad = <?php echo round($result * M_PI, 5) ?> rad
                            </textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    <?php
    }

    // convert from degrees value to radian value
    function degree_to_radian($input)
    {
        return $input / 180.0;
    }

    // check input data
    function check_data($input)
    {
        if (is_numeric($input) && $input >= 0) {
            return true;
        }
        return false;
    }

    // check POST request
    if (!isset($_POST["submit"])) {

        print_form(0, degree_to_radian(0), true);
    } else {
        // check input data
        $input = $_POST["input"];
        if (check_data($input)) {
            $result = degree_to_radian($input);
            print_form($input, $result, true);
        } else
            print_form(0, degree_to_radian(0), false);
    }
    ?>

    <script src="events.js"></script>
</body>

</html>