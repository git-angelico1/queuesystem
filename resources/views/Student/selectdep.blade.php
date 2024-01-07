<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: skyblue;
            height: 100vh; 
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden; 
        }

        header {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .department-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center; 
            gap: 20px; 
            margin-top: 20px;
            height: 80vh; 
            overflow: auto;
        }

        .department-card {
            width: 180px; 
            height: 200px; 
            margin: 30px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 2px solid black;
        }

        .department-card:hover {
            background-color: #fff;
            transform: scale(1.05); 
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3); 
        }

        .department-card h3 {
            margin: 0;
            flex-grow: 1;
        }

        .department-card img {
            width: 100px; 
            height: 80px; 
            margin: auto; 
            display: block; 
        }

        .proceed-button {
            background: linear-gradient(to bottom, #000, #000);
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .proceed-button:hover {
            background: linear-gradient(to bottom, #007BFF, #0056b3);
        }

        footer {
            margin-top: 20px;
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
        .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background: transparent;
        border: 2px solid white; 
        padding: 10px 15px; 
        cursor: pointer;
        font-size: 24px;
        color: #fff;
        transition: transform 0.3s;
        }

        .back-button:hover { 
            transform: scale(1.2);
        }
    </style>
</head>
<body>
<button class="back-button" onclick="history.go(-1)">&#8592;</button>
    <header>
        <h1>Select Department</h1>
    </header>

    <div class="department-cards">
        <div class="department-card">
            <h3>Cashier Department</h3>
            <img src="cashier.png" alt="Cashier Image">
            <button class="proceed-button" onclick="redirectToDepartment('cashier')">Proceed</button>
        </div>
        <div class="department-card" >
            <h3>Registrar Department</h3>
            <img src="registrar.png" alt="Registrar Image">
            <button class="proceed-button" onclick="redirectToDepartment('registrar')">Proceed</button>
        </div>
        <div class="department-card" >
            <h3>Finance Department</h3>
            <img src="finance.png" alt="Finance Image">
            <button class="proceed-button" onclick="redirectToDepartment('finance')">Proceed</button>
        </div>
    </div>

    <footer>
        <p>&copy;A4TECH 2023. All Rights Reserved.</p>
    </footer>

    <script>
        function redirectToDepartment(selectedDepartment) {
            const departmentUrls = {
                cashier: 'cashier_department',
                registrar: 'registrar_department',
                finance: 'finance_department',
            };

            if (departmentUrls[selectedDepartment]) {
                window.location.href = departmentUrls[selectedDepartment];
            }
        }
    </script>
</body>
</html>
