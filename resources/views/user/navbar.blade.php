<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> <!-- for navbar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!--google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto&family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <style>
        .navbar-nav .nav-item:hover .nav-link {
            background-color: transparent;
        }
        .max-w-7xl {
            background-color: transparent;
        }
    </style>

</head>
<body>
<div class="text">
        <!-- Navbar -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0 ">
                <div class="container">
                <img src="{{ asset('assets/imgs/LogoMakr-0qlole.png') }}" alt="logo" width="100px" height="80px">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.booking.create')}}">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.patientPortal') }}">Patient Portal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.chatbot') }}">Chatbot</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.weightManagement') }}">BMI Calculator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.telemedicine')}}">Telemedicine Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.heart-age')}}">Heart Age Test</a>
                        </li>
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                            <a class="nav-link" href="{{url('myAppointment')}}">My Appointment</a>
                        </li>
                    <x-app-layout/>


                    @else
                    <!-- <div class="links">
                        <a href="{{ route('register') }}"><button type="button">Sign UP </button></a> or
                        <a href="{{ route('login') }}"><button type="button">Login </button></a>
                    </div> -->
                    @endauth
                    @endif
                    </ul>

                </div>
                </div>
            </nav>
        </header>
