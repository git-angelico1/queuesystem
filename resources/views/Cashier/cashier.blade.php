<!DOCTYPE html>
<html>
<head>
    <title>CASHIER DEPARTMENT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        body {
            background: linear-gradient(45deg, rgba(254, 254, 254, 1) 0%, rgba(110, 110, 110, 1) 38%, rgba(209, 246, 199, 1) 100%);
            color: #fff;
            font-family: arial;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            margin: auto;
            animation: fadeInUp 1s;
        }

        .header {
            color: #fff;
            padding: 10px 0;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        h4 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            color: #333;
        }

        .form-control {
            border: 2px solid #ccc;
            border-radius: 0; 
        }

        .btn {
            margin-top: 20px;
            background-color: blue;
            color: #fff;
            border: 2px solid;
            border-radius: 50px;
            padding: 15px 30px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn:hover {
            background: rgb(137,117,252);
            background: linear-gradient(45deg, rgba(137,117,252,1) 0%, rgba(0,152,167,1) 0%);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background: transparent;
            border: 2px solid black;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 24px;
            color: #fff;
            transition: transform 0.3s;
        }

        .back-button:hover {
            transform: scale(1.2);
        }

        .custom-dropdown {
            position: relative;
        }

        .custom-dropdown select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 40%;
            padding: 2px;
            border: 2px solid black;
            border-radius: 5px;
            background-color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .other-textbox {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <button class="back-button" onclick="history.go(-1)">&#8592;</button>
    <div class="row justify-content-center mt-6">
        <div class="col-md-10">
            <div class="card form-container">
                <div class="header">
                    <h4>KIOSK </h4>
                    <h3>(CASHIER DEPARTMENT)</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('cash.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="cash_name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stud_id">Student ID</label>
                            <input type="number" name="cash_studentId" id="cash_studentId" class="form-control" maxlength="15" required>
                            
                        </div>
                        <div class="form-group" style="display: none;">
                            <label for="contact">Contact Number</label>
                            <input type="number" name="cash_studentContact" id="cash_studentContact" class="form-control" maxlength="15">
                        </div>
                        <div class="form-group custom-dropdown">
                            <label for="purpose">Purpose</label>
                            <select name="cash_purpose" id="cash_purpose" class="form-control" onchange="toggleTextbox()" required>
                                <option value="" disabled selected>Select Purpose</option>
                                <option value="Tuition Fee">Tuition Fee</option>
                                <option value="Enrollment Fee">Enrollment Fee</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group other-textbox"> 
                            <label for="otherPurpose">Other Purpose</label>
                            <input type="text" name="cash_otherPurpose" id="cash_otherPurpose" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-block">Generate Number</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5">
        <p>&copy; A4TECH 2023. All Rights Reserved.</p>
    </footer>
    <script>
        function toggleTextbox() {
            var purposeDropdown = document.getElementById('cash_purpose');
            var otherTextbox = document.querySelector('.other-textbox');

            if (purposeDropdown.value === 'other') {
                otherTextbox.style.display = 'block';
            } else {
                otherTextbox.style.display = 'none';
            }
        }
    </script>
</div>
</body>
</html>
