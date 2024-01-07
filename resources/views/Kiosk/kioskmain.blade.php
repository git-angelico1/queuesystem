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
            justify-content: center;
            overflow: hidden;
        }

        header {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .department-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 60px;
            height: 80vh;
            overflow: auto;
        }

        .department-card {
            width: 200px;
            height: 250px;
            margin: 50px;
            padding: 25px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 3px solid black;
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
            width: 130px;
            height: 110px;
            margin: auto;
            display: block;
        }

        .proceed-button {
            background: linear-gradient(to bottom, #000, #000);
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            margin-top: 20px;
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
    </style>
</head>
<body>
    <header>
        <h1>KIOSK MACHINE</h1>
    </header>
    <div class="department-cards">
        <div class="department-card">
            <h3>STUDENT</h3>
            <img src="stud.png" alt="Student Image">
            <button class="proceed-button" onclick="redirectToDepartment('student')">Proceed</button>
        </div>
        <div class="department-card">
            <h3>VISITOR</h3>
            <img src="visitor.png" alt="Visitor Image">
            <button class="proceed-button" onclick="redirectToDepartment('visitor')">Proceed</button>
        </div>
    </div>

    <footer>
        <p>&copy;A4TECH 2023. All Rights Reserved.</p>
    </footer>

    <script>
        function redirectToDepartment(selectedDepartment) {
            const departmentUrls = {
                student: 'studentdepartment',
                visitor: 'visitordepartment',
            };

            if (departmentUrls[selectedDepartment]) {
                window.location.href = departmentUrls[selectedDepartment];
            }
        }
    </script>
</body>
</html>
