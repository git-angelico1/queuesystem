<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var isSpeaking = false;

        function updateSpeech(textToSpeak) {
            if ('speechSynthesis' in window) {
                var synthesis = window.speechSynthesis;

                if (!synthesis.speaking && !isSpeaking) {
                    var utterance = new SpeechSynthesisUtterance(textToSpeak);

                    isSpeaking = true;

                    utterance.onend = function () {
                        isSpeaking = false;
                        console.log("Speech synthesis complete.");
                    };

                    synthesis.speak(utterance);
                } else {
                    console.warn('Speech is already in progress. Wait for the current speech to finish.');
                }
            } else {
                console.error('Speech synthesis not supported');
            }
        }

        var previousData = {
            registrar: '',
            cashier: '',
            finance: ''
        };

        function extractTextToSpeakFromData(data) {
            var combinedText = "";

            var registrarText = $('#textToSpeakRegistrar').text().trim();
            var cashierText = $('#cashierValue').text().trim();
            var financeText = $('#financeValue').text().trim();

            if (registrarText && registrarText !== previousData.registrar) {
                combinedText += "Please proceed to the Registrar Department, Queue Number " + registrarText + ". ";
                previousData.registrar = registrarText;
            }

            if (cashierText && cashierText !== previousData.cashier) {
                combinedText += "Please proceed to the Cashier Department, Queue Number " + cashierText + ". ";
                previousData.cashier = cashierText;
            }

            if (financeText && financeText !== previousData.finance) {
                combinedText += "Please proceed to the Finance Department, Queue Number " + financeText + ". ";
                previousData.finance = financeText;
            }

            return combinedText.trim();
        }

    </script>
        
    
    <title>A4tech</title>
    <style>
         .Body-Design {
            background: white;
            color: #fff;
            font-family: Arial;
            height: 100%;
        }

        .container-fluid {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .now-serving-container {
            padding: 60px;
            text-align: center;
            font-family: calibre;
            font-size: 36px;
            color: black;
            box-shadow: 0 0 30px rgba(0, 0, 1, 5);
            border: 4px solid blue;
            margin-bottom: 20px;
           
        }

        #clock {
            font-family: calibre;
            color: black;
           
        }

        #serving-content {
            font-family: arial;
            font-size: 20px;
            color: black;
            margin-top: 20px;
        }

        .department-container {
            border: 2px solid #000;
            padding: 10px;
            margin-top: 5px;
            
        }


        @media (max-width: 576px) {
            .now-serving-container {
                padding: 30px;
                font-size: 24px;
            }

            #clock {
                font-size: 30px;
            }

            #serving-content {
                font-size: 16px;
            }
        }
    </style>
</head>
<body class="Body-Design">
    <div class="container-fluid">
       
        <div class="now-serving-container">
        <div id="clock" style="text-align: center; font-size: 30px; margin-bottom: 20px;"></div>
            <h1>NOW SERVING</h1>
            <div id="serving-content">
                <h5>REGISTRAR DEPARTMENT</h5>
                <div style="border: 3px solid black; padding: 10px; margin-top: 5px; width: 360px; height: 60px;" class="#serving-content">
                    <h2 style="color: red; font-weight: bold;" id="textToSpeakRegistrar">
                        <?php
                        $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

                        if ($mysqli->connect_error) {
                            die("Connection failed: " . $mysqli->connect_error);
                        }

                        $earliestSql = "SELECT * FROM registrar ORDER BY created_at ASC LIMIT 1";

                        $result = $mysqli->query($earliestSql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row['reg_generate'];
                        }

                        $mysqli->close();
                        ?>
                    </h2>
                </div> <br>
                <h5>CASHIER DEPARTMENT</h5>
                <div style="border: 3px solid black; padding: 10px; margin-top: 5px; width: 360px; height: 60px;">
                <h2 style="color: red; font-weight: bold;" id="cashierValue">
                        <?php
                        $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

                        if ($mysqli->connect_error) {
                            die("Connection failed: " . $mysqli->connect_error);
                        }

                        $earliestSql = "SELECT * FROM cashier ORDER BY created_at ASC LIMIT 1";

                        $result = $mysqli->query($earliestSql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row['cash_generate'];
                        }

                        $mysqli->close();
                        ?>
                    </h2>
                </div><br>
                <h5>FINANCE DEPARTMENT</h5>
                <div style="border: 3px solid black; padding: 10px; margin-top: 5px; width: 360px; height: 60px;" >
                <h2 style="color: red; font-weight: bold; " id="financeValue">
                        <?php
                        $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

                        if ($mysqli->connect_error) {
                            die("Connection failed: " . $mysqli->connect_error);
                        }

                        $earliestSql = "SELECT * FROM finance ORDER BY created_at ASC LIMIT 1";

                        $result = $mysqli->query($earliestSql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row['fin_generate'];
                        }

                        $mysqli->close();
                        ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
           
            const dayOfWeek = new Intl.DateTimeFormat('en-US', { weekday: 'long' }).format(now);
            const day = now.getDate().toString().padStart(2, '0');
            const month = new Intl.DateTimeFormat('en-US', { month: 'long' }).format(now);
            const year = now.getFullYear();
            const time = `${hours}:${minutes} ${dayOfWeek} ${day} ${year}`;
            document.getElementById('clock').textContent = time;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateRegistrarDepartment(data) {
            var $data = $(data);
            var registrarText = $data.find('#textToSpeakRegistrar').text();
            $('#textToSpeakRegistrar').text(registrarText);
        }

        function updateCashierDepartment(data) {
            var $data = $(data);
            var cashierText = $data.find('#cashierValue').text();
            $('#cashierValue').text(cashierText);
        }

        function updateFinanceDepartment(data) {
            var $data = $(data);
            var financeText = $data.find('#financeValue').text();
            $('#financeValue').text(financeText);
        }

        var lastKnownState = null;

        function updateData() {
            $.ajax({
                url: 'reg_queue',
                method: 'GET',
                success: function (data) {
                    if (JSON.stringify(data) !== JSON.stringify(lastKnownState)) {
                        lastKnownState = data;

                        updateRegistrarDepartment(data);
                        updateCashierDepartment(data);
                        updateFinanceDepartment(data); 

                        var textToSpeak = extractTextToSpeakFromData(data);

                        updateSpeech(textToSpeak);

                    } else {
                        console.log('Data has not changed. No need to update.');
                    }
                },
                error: function () {
                    console.error('Error fetching data');
                }
            });
        }

        setInterval(updateData, 10000);
    </script>
</body>
</html>
