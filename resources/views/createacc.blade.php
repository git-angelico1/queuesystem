<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet">
    <style>
        .custom-form {
            border: 2px solid #000;
            border-radius: 0.3rem;
            padding: 20px;
        }

        .custom-input {
            border: 1px solid #ccc;
            border-radius: 0.25rem;
        }

        .custom-button {
            background-color: #8fc4b7;
            color: #fff;
            border: none;
            border-radius: 0.3rem;
        }

        
        .custom-select select option[value="1"] {
            font-style: italic;
            color: #999;
        }
    </style>
    <title> CREATE ACCOUNT </title>
</head>
<body>
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3 custom-form">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">CREATE ACCOUNT</h3>

                            <form class="px-md-2">
                                <div class="form-outline mb-4">
                                    <input type="text" id="username" class="form-control custom-input" />
                                    <label class="form-label" for="username">Username</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" class="form-control custom-input" />
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="confirmPassword" class="form-control custom-input" />
                                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                                </div>

                                <div class="mb-4">
                                    <select class="select custom-input custom-select" id="department">
                                        <option value="1">Select Department</option>
                                        <option value="Registrar">Registrar</option>
                                        <option value="Cashier">Cashier</option>
                                        <option value="Finance">Finance</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg mb-1 custom-button">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
