<!DOCTYPE html>
<html>
<head>
    <title>STUDENT DASHBOARD</title>
    
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
      
        body {
            background: linear-gradient(135deg, #3498db, #e74c3c); 
            color: #fff; 
            font-family: Arial, sans-serif; 
        }
        
        
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px; 
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 800px; 
            width: 100%;
            margin: auto; 
        }

       
        .header {
            background-color: #007BFF;
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

        
        label {
            color: #333; 
        }

        
        .form-control {
            border: 1px solid #ccc; 
        }

        
        .btn {
            margin-top: 20px;
            background-color: #007BFF; 
            color: #fff; 
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card form-container">
                <div class="header">
                    <h4>KIOSK MACHINE (STUDENT)</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('info.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stud_id">Student ID</label>
                            <input type="number" name="stud_id" id="stud_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="number" name="contact" id="contact" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Select Department</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="Registrar">Registrar</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Finance">Finance</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Generate Number</button>
                        <a href="kiosk" class="btn btn-secondary btn-block mt-2">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
