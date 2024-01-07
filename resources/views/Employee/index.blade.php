<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue System Controller</title>
    <style>
        body {
            background: linear-gradient(to bottom, #78a6d0, #5c90bd);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            max-width: 600px; /* Set a maximum width for the container */
            width: 90%; /* Set a percentage width for responsiveness */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a subtle box shadow */
        }

        .dashboard {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333; /* Text color */
        }

        .number {
            font-size: 36px;
            color: #333; /* Text color */
        }

        .button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 18px;
            cursor: pointer;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1); /* Add a subtle button shadow */
        }

        .button:hover {
            background-color: #0055a5; /* Darker shade of blue for hover */
        }

        .notification {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="dashboard">NOW SERVING</h1>
        <h1 id="studentId" class="number">
        <?php
        $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $earliestSql = "SELECT * FROM students ORDER BY created_at ASC LIMIT 1";
        

        $result = $mysqli->query($earliestSql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $studentId = $row['student_id'];
            $name = $row['name'];
           

            echo "Queue Number: " . $studentId . "<br>";
            echo "Name: " . $name . "<br>";
            

        } else {
            echo '---';
        }
 
        $mysqli->close();
        ?>
        </h1>
        <form action="{{ route('next.student') }}" method="POST">
        @csrf
        
        <button type="submit" class="button">NEXT</button>
        <button type="button" class="button" onclick="showNotification()">NOTIFY</button>
        </form>
        <script>
            function showNotification() {          
                const studentIdText = document.getElementById("studentId").textContent;
                alert("Notifying student: " + studentIdText);
            }
        </script>
    </div>
</body>
</html>
