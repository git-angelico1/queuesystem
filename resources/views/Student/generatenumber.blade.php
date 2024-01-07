<!DOCTYPE html>
<html>
<head>
    <title>Generate Number</title>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <style>
        
        .container {
            font-family: arial;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(45deg, rgba(245,250,250,1) 8%, rgba(90,240,255,1) 47%);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        
        #countdown {
            font-size: 36px;
            font-weight: bold;
            color: #007bff; 
        }

        
        body {
            background: linear-gradient(to bottom, #78a6d0, #5c90bd);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Here's your Generated Queue number: {{ $latestStudent->reg_generate }}</h1>
        <p>Redirecting to Dashboard in <span id="countdown">10</span> seconds...</p>
    </div>

    <script>
        function updateCountdown(seconds) {
            document.getElementById("countdown").textContent = seconds;
        }

        let secondsRemaining = 10;
        updateCountdown(secondsRemaining);

        const countdownInterval = setInterval(function() {
            secondsRemaining--;
            updateCountdown(secondsRemaining);

            if (secondsRemaining <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "kiosk";
            }
        }, 1000);
    </script>
</body>
</html>
