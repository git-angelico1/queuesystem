<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateData() {
            $.ajax({
                url: 'reg_controller',
                method: 'GET',
                success: function (data) {
                    $('#serving-content').html(data);
                },
                error: function () {
                    console.error('Error fetching data');
                }
            });
        }

        function notify() {
            var queueNumber = $('#serving-content').find('.regenerate-number').text();
            speak(queueNumber);
        }

        function speak(text) {
            var customText = "Please proceed to the Registrar Department." + text;

            var msg = new SpeechSynthesisUtterance();
            msg.text = customText;
            window.speechSynthesis.speak(msg);
            console.log('Text-to-speech:', customText);
        }

        setInterval(updateData, 3000);
    </script>

    <title>Queue System Controller(REGISTRAR)</title>
    <style>
        body {
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: arial;
        }

        .container {
            background-color: skyblue;
            border: 3px solid black;
            border-radius: 15px;
            padding: 40px;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .dashboard {
            font-size: 40px;
            font-family: calibre;
            margin-bottom: 20px;
            color: black;
        }

        .button {
            padding: 12px 24px;
            margin: 9px;
            font-size: 18px;
            cursor: pointer;
            background-color: transparent;
            color: black;
            border: 3px solid black;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .button:hover {
            background-color: red;
            transform: scale(1.1);
        }

        .notification {
            font-size: 24px;
            margin-top: 20px;
            color: #28a745;
            animation: fadeInOut 2s infinite;
            text-decoration: underline;
        }

        @keyframes fadeInOut {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: transparent; 
            border: 2px solid black;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 24px;
            color: black;
            transition: transform 0.3s;
        }

        .logout-btn:hover {
            transform: scale(1.1);
        }

        .regenerate-number {
            font-weight: bold;
            font-size: 32px; 
        }
    </style>
</head>
<body>
    <form method="post" action="{{ route('registrar.logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
    <div class="container">
        <h1 class="dashboard">REGISTRAR CONTROLLER</h1>
        <h2 style="color: black; font-weight: bold;" id="textToSpeakRegistrar">
            <div id="serving-content">
                <?php
                $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                $earliestSql = "SELECT * FROM registrar ORDER BY created_at ASC LIMIT 1";

                $result = $mysqli->query($earliestSql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $queuenumber = $row['reg_generate'];
                    $studentname = $row['reg_name'];
                    $studentID = $row['reg_studentId'];
                    $Purpose = $row['reg_purpose'];
                    $otherpurpose = $row['reg_otherPurpose'];

                    echo "<span class='regenerate-number'> Queue Number: $queuenumber </span><br>";
                    echo "Name: " . $studentname . "<br>";
                    echo "ID: " .  $studentID . "<br>";
                    echo "Purpose: ";

                    if ($Purpose == "other") {
                        echo $otherpurpose;
                    } else {
                        echo $Purpose;
                    }
                    echo "<br>";

                } else {
                    echo '---';
                }

                $mysqli->close();
                ?>
            </h2>

            <form action="{{ route('next.student') }}" method="POST" id="next-form">
                @csrf
                <button type="submit" class="button" id="next-button">NEXT</button>
            </form>
            <button type="button" class="button" id="notify-button" onclick="notify()">NOTIFY</button>
        </div>
    </div>
</body>
</html>
