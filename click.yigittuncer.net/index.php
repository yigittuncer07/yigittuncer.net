<?php
session_start();
$myfile = fopen("scripts/log.txt", "r") or die("Unable to open file!");
$_SESSION['num'] = fread($myfile, filesize("scripts/log.txt"));
fclose($myfile);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>click</title>
    <link rel="icon" type="image/png" href="content/click.png" />
    <link rel="stylesheet" href="content/style.css" type="text/css">
    <script>
        var numberTitle = "";
        var button = "";
        var number = "";

        window.onload = function () {
            button = document.getElementById("button1");
            numberTitle = document.getElementById("number");
            number = <?php echo $_SESSION['num'] ?>;
            updateNumber();
            button.addEventListener("click", updateFrontend);
            refresh();
        }

        function refresh() {
            fetch('scripts/update.php').then(response => response.text()).then(data => {
                console.log(data)
            });
            setTimeout(refresh, 2000);
        }

        function updateBackend() {
            fetch('scripts/reduce.php').then(response => response.text()).then(data => { });

        }

        function updateFrontend() {
            if (number == 1) {
                numberTitle.innerHTML = "You Win"
            } else if (number == 0) {
                return
            } else {
                number--;
                updateNumber();
            }
        }

        function updateNumber() {
            numberTitle.innerHTML =numberWithCommas(number);
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
</head>



<body>
    <h1 id="number">100000</h1>
    <button type="button" id="button1" onclick="updateBackend()"> click </button>
</body>

</html>