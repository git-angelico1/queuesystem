<!DOCTYPE html>
<html>
<head>
    <title>STUDENT DASHBOARD</title>
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <style>
      
        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

      
        .form-container {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0; 
            background-image: url('1.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff; 
        }
    </style>
</head>
<body>
<div class="container center-div">
    <div class="row">
        <div class="col-md-25 form-container">
            <form action="{{ route('info.save2') }}" method="post">
                @csrf
                <h4 style="color: black;">KIOSK MACHINE (VISITOR)</h4>
                <div class="form-group">
                    <label style="color: black;">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>  
                    <label style="color: black;">Contact Number</label> 
                    <input type="number" name="contact" id="contact" class="form-control" required>
                    <p style="color: black;">Select Department:</p>
                    <div class="form-check">
                        <input type="radio" id="dep1" name="reg" value="Reg" class="form-check-input" required>
                        <label class="form-check-label" for="dep1" style="color: black;">Registrar</label> 
                    </div>
                    <div class="form-check">
                        <input type="radio" id="dep2" name="reg" value="Cash" class="form-check-input" required>
                        <label class="form-check-label" for="dep2" style="color: black;">Cashier</label> 
                    </div>
                    <div class="form-check">
                        <input type="radio" id="dep3" name="reg" value="Fin" class="form-check-input" required>
                        <label class="form-check-label" for="dep3" style="color: black;">Finance</label> 
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Generate Number</button>
                <a href="kiosk" class="btn btn-secondary btn-block mt-2">Back</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
