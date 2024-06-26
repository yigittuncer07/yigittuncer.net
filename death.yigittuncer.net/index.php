<!DOCTYPE html>
<html lang="en">

<head>
    <title>death.yigittuncer.net</title>
    <link rel="icon" href="content/favicon.png">
    <link rel="stylesheet" href="content/style.css">
    <script>

        document.addEventListener('DOMContentLoaded', initialize_boxes);

        function initialize_boxes() {
            const container = document.getElementById('container');
            createBoxes(4000);
        }

        function createBoxes(numberOfBoxes) {
            for (let i = 0; i < numberOfBoxes; i++) {
                const box = document.createElement('div');
                box.classList.add('box');
                box.style.backgroundColor = "#eab676";
                container.appendChild(box);
            }
        }

        function changeBoxColor(noOfBoxesToColor) {
            const boxes = document.querySelectorAll('.box');
            for (let i = 0; i < 4000; i++) {
                boxes[i].style.backgroundColor = "#eab676";
            }
            if (noOfBoxesToColor > 4000) {
                noOfBoxesToColor = 4000;
            }
            for (let i = 0; i < noOfBoxesToColor; i++) {
                boxes[i].style.backgroundColor = "#403220";
            }
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        function drawRed() {
            const boxes = document.querySelectorAll('.box');

            // Reset the color of all boxes
            boxes.forEach(box => {
                box.style.backgroundColor = "#eab676";
            });

            for (var i = 0; i < 4000; i++) {
                boxes[i].style.backgroundColor = "#e31e1e";
            }
        }


        function change_boxes() {
            event.preventDefault();//Prevents page refresh
            dateInput = document.getElementById('dateInput').value;

            //Null-check
            if (dateInput == "") {
                alert("please enter a date before submitting");
                return;
            }
            // console.log("given date is : " + dateInput);

            currentDate = new Date();
            currentDate = formatDate(currentDate);


            const daysSinceBirth = calculateDaysBetweenDates(dateInput, currentDate);
            // console.log("DateInput: " + dateInput + "\ncurrentDate: " + currentDate + "\ndaysSinceBirth: " + daysSinceBirth);
            const weeksSinceBirth = Math.floor(daysSinceBirth / 7);
            const resultText = document.getElementById('resultText');
            const extraText = document.getElementById('extraText');
            extraText.exists();

            if (dateInput == "1881-05-19") {
                resultText.textContent = "“The biggest battle is the war against ignorance.” ― Mustafa Kemal Ataturk";
                drawRed();
            } else {
                changeBoxColor(weeksSinceBirth);
                if (weeksSinceBirth < 0) {
                    resultText.textContent = "I feel like you can't be born in the future :)";

                } else if (weeksSinceBirth > 4000) {
                    resultText.textContent = "Statistically you should be dead, but you're still here! Keep going grandpa/grandma!";

                } else {
                    resultText.textContent = "You have lived " + weeksSinceBirth + " weeks out of your expected 4000, so you have about " + (4000 - weeksSinceBirth) + " weeks left. Doesn't seem like much does it?";
                    extraText.textContent = "by bye";
                }
            }
        }

        function calculateDaysBetweenDates(dateString1, dateString2) {
            const date1 = new Date(dateString1);
            const date2 = new Date(dateString2);
            if (isNaN(date1.getTime()) || isNaN(date2.getTime())) {
                console.error('Invalid date format');
                return NaN;
            }
            const timeDifference = date2 - date1;
            const daysDifference = Math.floor(timeDifference / (86400000));//1000 * 60 * 60 * 24 = 86400000 
            return daysDifference;
        }

    </script>
</head>

<body>
    <main>

        <a href="https://yigittuncer.net">
            <header>
                <h1 id="mainHeader">DEATH</h1>
            </header>
        </a>

        <p>
            The average lifespan of a human is 4000 weeks. Enter your birthdate to see how many you have left!
        </p>

        <form>
            <label for="dateInput">Enter your birthdate:</label>
            <input type="date" id="dateInput" name="dateInput">
            <input onclick="change_boxes()" type="submit" value="tell me when the misery ends!">
        </form>


        <div id="container"></div>

        <div id="resultText"></div>

        <div id="extraText"></div>

    </main>
</body>

</html>