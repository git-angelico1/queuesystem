<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateData() {
            $.ajax({
                url: 'fin_controller',
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
            var customText = "Please proceed to the Finance Department." + text;

            var msg = new SpeechSynthesisUtterance();
            msg.text = customText;
            window.speechSynthesis.speak(msg);
            console.log('Text-to-speech:', customText);
        }

        setInterval(updateData, 3000);

    </script>
    <title>Queue System Controller(FINANCE)</title>
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

        .number {
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
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
    </style>
</head>

<body>
    <form method="post" action="{{ route('finance.logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
    <div class="container">
        <h1 class="dashboard">FINANCE CONTROLLER</h1>
        <h2 style="color: black; font-weight: bold;">
            <div id="serving-content">
                <?php
                $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                $earliestSql = "SELECT * FROM finance ORDER BY created_at ASC LIMIT 1";

                $result = $mysqli->query($earliestSql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $queuenumber = $row['fin_generate'];
                    $studentname = $row['fin_name'];
                    $studentID = $row['fin_studentId'];
                    $Purpose = $row['fin_purpose'];
                    $otherpurpose = $row['fin_otherPurpose'];

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
            </div>
        </h2>

        <form action="{{ route('next.student3') }}" method="POST">
            @csrf
            <button type="submit" class="button" id="next-button">NEXT</button>
        </form>
        <button type="button" class="button" id="notify-button" onclick="notify()">NOTIFY</button>
    </div>
</body>

</html>
