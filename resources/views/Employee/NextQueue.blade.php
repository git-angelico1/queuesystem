<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
    var socket = new WebSocket('ws://localhost:3000');

    socket.addEventListener('open', (event) => {
        console.log('WebSocket connection opened');
    });

    socket.addEventListener('close', (event) => {
        console.log('WebSocket connection closed');
    });

    socket.addEventListener('error', (event) => {
        console.error('WebSocket error:', event);
    });

    socket.addEventListener('message', (event) => {
        var data = JSON.parse(event.data);

        
        updateDepartment('textToSpeakRegistrar', data.registrar);

        
        updateDepartment('cashierValue', data.cashier);

        
        updateDepartment('financeValue', data.finance);
    });

   
    function updateDepartment(elementId, value) {
        var element = document.getElementById(elementId);

        if (element) {
            element.textContent = value;
        }
    }
    </script>
    <style>
        .department-container {
            border: 2px solid #000;
            padding: 21px;
        }

        .department-title {
            font-family: cursive;
            font-size: 15px;
            font-weight: bold;
        }

        .department-value {
            font-family: cursive;
            font-size: 25px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="department-container">
        <div class="department-title">REGISTRAR DEPARTMENT</div>
        <div class="department-value">
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
        </div>
    </div>

    <div class="department-container mt-5">
        <div class="department-title">CASHIER DEPARTMENT</div>
        <div class="department-value">
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
        </div>
    </div>

    <div class="department-container mt-5 mb-7">
        <div class="department-title">FINANCE DEPARTMENT</div>
        <div class="department-value">
            <h2 style="color: red; font-weight: bold;" id="financeValue">
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
</body>
</html>
