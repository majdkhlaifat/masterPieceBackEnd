<!DOCTYPE html>
<html>

<head>
    <title>Medical Report</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

    <div class="row mb-5">
        <div class="col-md-6">
            <h3>Patient Information</h3>
            <p><strong>Name:</strong> {{ $patient->name }}</p>
            <p><strong>Date of Birth:</strong>  {{ $medicalHistory->dob }}</p>
            <p><strong>Email:</strong> {{ $patient->email }}</p>

        </div>
        <div class="col-md-6">
            <h3>&nbsp;</h3>
            <p><strong></strong></p>
            <p><strong>Address:</strong> {{ $patient->address }}</p>
            <p><strong>Phone:</strong> {{ $patient->phone }}</p>

        </div>
    </div>


    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="mb-3">Medical History</h3>
            <table class="table">
                <tbody>
                <tr>
                    <th class="col-md-4">Medical Condition</th>
                    <th>History</th>
                </tr>
                <tr>
                    <td>Have Diabetes Mellitus</td>
                    <td>{{ $medicalHistory->diabetes }}</td>
                </tr>
                <tr>
                    <td>Have Hypertension</td>
                    <td>{{ $medicalHistory->hypertension }}</td>
                </tr>
                <tr>
                    <td>Have Heart Disease</td>
                    <td>{{ $medicalHistory->heart_disease }}</td>
                </tr>
                <tr>
                    <td>Smoker</td>
                    <td>{{ $medicalHistory->smoking }}</td>
                </tr>
                <tr>
                    <td>Blood Type</td>
                    <td>{{ $medicalHistory->blood_type }}</td>
                </tr>
                <tr>
                    <td>History Of Allergies</td>
                    <td>{{ $medicalHistory->allergies }}</td>
                </tr>
                <tr>
                    <td>Any Relevant Medical History Or Comments</td>
                    <td>{{ $medicalHistory->comments }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mb-5">
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
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
