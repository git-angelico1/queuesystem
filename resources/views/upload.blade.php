<!Doctype html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title> ADMIN UPLOAD </title>
<head>
<style>
     .Body-Design {
                background: linear-gradient(45deg, rgba(137,117,252,1) 0%, rgba(249,255,209,1) 0%);
                color: #fff;
                font-family: Arial;
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

<div class="container mt-5">
    <h1 class="text-xl font-bold mb-6 px-1" style="color: black;">MANAGE VIDEO</h1>
    <table class="table mt-5">
        <thead class="bg-warning text-black fw-bold" style="color: black;">
            <th> # </th>
            <th> Video Name </th>
            <th> Date Uploaded </th>
            <th> Action </th>
        </thead>  
        <tbody class="text-black-600 font-light" style="color: black;">
            @foreach ($myvid as $index => $vid)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 ">{{$index + 1}}</td>
                <td class="py-3 px-6 ">{{$vid->video}}</td>
                <td class="py-3 px-6 ">{{$vid->created_at}}</td>
                <td class="py-3 px-6 text-center">
                    <form method="post" action="{{ route('delete.video', $vid->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill" style="color: white;">REMOVE</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="position: absolute; top: 180px; right: 210px;">
    <form method="post" action="{{ Route('insert.file') }}" enctype="multipart/form-data" class="d-flex justify-content-end">
        {{ csrf_field() }}
        <div class="form-group" style="color: black;">
            <input type="file" name="video" class="form-control-file" accept="video/*">
            @if($errors->has('video'))
                <p class="text-danger">{{ $errors->first('video') }}</p>
            @endif
        </div>
        <div class="form-group ml-2">
            <input type="submit" name="click" class="btn btn-primary" value="Upload Video">
        </div>
    </form>
</div>

</body>
</html>