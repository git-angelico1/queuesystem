
<!DOCTYPE html>
    <html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> ADMIN DASHBOARD </title>
        
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

            
            function connectWebSocket() {
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
                console.log('WebSocket message received:', data);

                if (data.registrar) {
                    updateRegistrarDepartment(data.registrar);
                }
                if (data.cashier) {
                    updateCashierDepartment(data.cashier);
                }
                if (data.finance) {
                    updateFinanceDepartment(data.finance);
                }
            });

            }

            function updateRegistrarDepartment(value) {
                console.log('Updating Registrar Department:', value);
                $('#textToSpeakRegistrar').text(value);
            }

            function updateCashierDepartment(value) {
                console.log('Updating Cashier Department:', value);
                $('#cashierValue').text(value);
            }

            function updateFinanceDepartment(value) {
                console.log('Updating Finance Department:', value);
                $('#financeValue').text(value);
            }

            connectWebSocket();
        </script>

        <title>LIVE MONITOR</title>
        <style>
            .Body-Design {
                background: linear-gradient(45deg, rgba(137,117,252,1) 0%, rgba(249,255,209,1) 0%);
                color: #fff;
                font-family: Arial;
            }

            .monitor-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                padding: 10px;
            }

            .video-container {
                display: flex;
                flex-direction: column;
                margin-top: 20px;
                margin-right: 60px; 
                background-color: black;
                border: 2px solid #000;
            }

            video {
                width: 100%;
            }

            .now-serving-container {
                padding: 60px;
                text-align: center;
                font-family: Arial;
                font-size: 36px;
                color: black;
                margin-top: 20px;  
                margin-right: 10px; 
                box-shadow: 0 0 30px rgba(0, 0, 1, 5);   
                border: 2px solid #000;

            }

            #clock {
                font-family: Arial;
                font-size: 40px;
                color: black;
                text-shadow: 3px 2px white;
                margin-left: 65%;
                margin-top: 20px;
            }

            #serving-content {
                font-family: Arial;
                font-size: 20px;
                color: black;
                margin-top: 20px;
            }
            body, html {
                margin: 0;
                padding: 0;
                height: 100%;
                overflow: hidden;
            }
        </style>
    </head>
    <body class="Body-Design">
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand mt-2 mt-lg-0">
            <img
                src="larpi.png"
                width="86"
                height="60"
                loading="lazy"
            />
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link py-3 px-6 ml-4 btn btn-outline-warning rounded-full" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-6 ml-4 btn btn-outline-warning rounded-full" href="upload">Upload Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-6 ml-4 btn btn-outline-warning rounded-full" href="fetch_video">Monitor</a>
                </li>
            </ul>
        </div>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
        <div class="monitor-container">
            <div class="row">
                <div class="col-md-8">
                    <div class="video-container">
                        @foreach($data as $row)
                        <div class="l-10 py-3 px-6">
                            <div style="overflow: hidden;">
                                <video width="800" height="570" autoplay muted loop>
                                    <source src="{{ asset('upload1/' . $row['video']) }}" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="now-serving-container">
                        <h1 style="text-shadow: 3px 2px white;">NOW SERVING</h1>
                        <div id="serving-content">
                        <div style="border: 2px solid #000; padding: 10px;" class="#serving-content">
                        <h6>REGISTRAR DEPARTMENT</h6>
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
                } else {
                    echo '---';
                }

                $mysqli->close();
                ?>
                </h2>
            </div> <br></br>


            <div style="border: 2px solid #000; padding: 10px; margin-top: 5px;">
                        <h6>CASHIER DEPARTMENT</h6>
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
                } else {
                    echo '---';
                }

                $mysqli->close();
                ?>
                </h2>
            </div><br></br>


            <div style="border: 2px solid #000; padding: 10px; margin-top: 5px;">
                        <h6>FINANCE DEPARTMENT</h6>
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
                } else {
                    echo '---';
                }

                $mysqli->close();
                ?>
                </h2>
            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
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

                        // Update the HTML content based on the new data
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
