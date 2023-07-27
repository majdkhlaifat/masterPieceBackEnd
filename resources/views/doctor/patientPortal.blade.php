<!DOCTYPE html>
<html>

<head>
    <title>Medical Report</title>
    <!-- Include Bootstrap CSS -->

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Website Logo -->
        <a class="navbar-brand" href="{{route('doctor.home')}}">
            <img src="{{ asset('assets/imgs/LogoMakr-0qlole.png') }}" alt="HealthHub Logo" width="70" height="70">
        </a>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Add other navbar links or buttons as needed -->
            </ul>
        </div>
        @if (Route::has('login'))
            @auth
                <x-app-layout>

                </x-app-layout>
            @endauth
        @endif
    </div>
</nav>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"></head>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Medical Report</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Patient Information</h3>
            <p><strong>Name:</strong> {{ $patient->name }}</p>
            <p><strong>Date of Birth:</strong> [Patient Date of Birth]</p>
            <p><strong>Email:</strong> {{ $patient->email }}</p>

        </div>
        <div class="col-md-6">
            <h3>&nbsp;</h3>
            <p><strong></strong></p>
            <p><strong>Address:</strong> {{ $patient->address }}</p>
            <p><strong>Phone:</strong> {{ $patient->phone }}</p>

        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h3>Medical History</h3>
            <p>[Medical History Details]</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Doctor's Notes</h3>
            <form action="{{ route('addNotice') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                <div class="form-group">
                    <label for="doctor_notes">Add Notes for {{ $patient->name }}</label>
                    <textarea class="form-control" id="doctor_notes" rows="5" name="notice"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Notes</button>
            </form>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Additional Information</h3>
            <p>[Additional information can be included here, such as follow-up appointments, referrals, etc.]</p>
            <hr>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
