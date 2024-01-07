<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .Body-Design {
            background: linear-gradient(45deg, rgba(137,117,252,1) 0%, rgba(249,255,209,1) 0%);
            color: #fff;
            font-family: Arial;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .gallery-container {
            text-align: center;
            margin-top: 80px; 
        }

        .gallery-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery-item img {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease-out;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .modal-body img {
            width: 100%;
            height: auto;
        }

        /* Style for enlarged image in modal */
        .modal-lg {
            max-width: 70%;
            border: 2px solid #fff;
            border-radius: 10px;
            overflow: hidden;
            margin: auto;
        }

        .modal-content {
            background: transparent;
            border: none;
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
    
    <div class="container gallery-container">
        <div class="gallery-header" style="color: black">GALLERY</div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_1.png">
                    <img src="carousel_1.png" class="d-block w-100" alt="Image 1">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_2.png">
                    <img src="carousel_2.png" class="d-block w-100" alt="Image 2">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_3.png">
                    <img src="carousel_3.png" class="d-block w-100" alt="Image 2">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_4.png">
                    <img src="carousel_4.png" class="d-block w-100" alt="Image 2">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_5.png">
                    <img src="carousel_5.png" class="d-block w-100" alt="Image 2">
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_7.png">
                    <img src="carousel_7.png" class="d-block w-100" alt="Image 2">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_8.png">
                    <img src="carousel_8.png" class="d-block w-100" alt="Image 2">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="gallery-item" data-toggle="modal" data-target="#imageModal" data-src="carousel_9.png">
                    <img src="carousel_9.png" class="d-block w-100" alt="Image 2">
                </div>
            </div>
         
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" id="modalImage" alt="Preview">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $('.gallery-item').click(function() {
            var src = $(this).data('src');
            $('#modalImage').attr('src', src);
        });
    </script>
</body>
</html>
